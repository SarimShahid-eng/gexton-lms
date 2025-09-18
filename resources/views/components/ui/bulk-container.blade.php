@props([
    'method' => 'bulkAction',
    'buttonLabel' => 'Apply',
    'confirmTitle' => 'Are you sure?',
    'confirmText' => 'Proceed with this action?',
    'confirmButtonText' => 'Yes, continue',
    'cancelButtonText' => 'Cancel',
    'successTitle' => 'Success',
    'successText' => 'Action completed.',
])

<div x-data="bulkBox({
    method: @js($method),
    messages: {
        confirmTitle: @js($confirmTitle),
        confirmText: @js($confirmText),
        confirmBtn: @js($confirmButtonText),
        cancelBtn: @js($cancelButtonText),
        successTitle: @js($successTitle),
        successText: @js($successText),
    }
})" class="relative">
    <!-- Action bar: only visible when something is selected -->
    <div x-show="selectedCount > 0" x-transition
        class="mb-3 flex items-center justify-between gap-3 rounded-md border border-rose-200 bg-rose-50 px-3 py-2 text-sm">
        <div>
            <span class="font-medium" x-text="selectedCount"></span>
            <span>selected</span>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" class="rounded-md bg-rose-600 px-3 py-2 text-white hover:bg-rose-700"
                @click="confirmAndRun()">
                {{ $buttonLabel }}
            </button>
            <button type="button" class="rounded-md border px-3 py-2 hover:bg-gray-50" @click="clear()">
                Clear
            </button>
        </div>
    </div>

    {{ $slot }}
</div>

{{-- Put this helper once (e.g., in your layout footer) --}}
<script>
    function bulkBox(opts) {
        return {
            // fully reactive array (not Set)
            selected: [],
            get selectedCount() {
                return this.selected.length
            },
            has(id) {
                id = String(id);
                return this.selected.includes(id)
            },
            add(id) {
                id = String(id);
                if (!this.has(id)) this.selected.push(id)
            },
            remove(id) {
                id = String(id);
                this.selected = this.selected.filter(x => x !== id)
            },
            toggle(id, checked = null) {
                id = String(id);
                if (checked === null) checked = !this.has(id);
                checked ? this.add(id) : this.remove(id);
            },
            bulkSet(ids = [], value = true) {
                ids = ids.map(String);
                if (value) {
                    const set = new Set([...this.selected, ...ids]);
                    this.selected = Array.from(set);
                } else {
                    const kill = new Set(ids);
                    this.selected = this.selected.filter(x => !kill.has(x));
                }
            },
            clear() {
                this.selected = []
            },

            method: opts.method,
            messages: opts.messages,
            confirmAndRun() {
                if (!this.selectedCount) return;
                const m = this.messages;
                const wire = this.$wire;

                Swal.fire({
                    title: m.confirmTitle,
                    text: m.confirmText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: m.confirmBtn,
                    cancelButtonText: m.cancelBtn,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#3b82f6',
                    showLoaderOnConfirm: true,

                    preConfirm: () => {
                        return wire.call(this.method, this.selected)
                            .then(() => {
                                // ✅ success toast
                                Livewire.dispatch('student-update', {
                                    icon: 'success',
                                    text: m.successText ||
                                        'Enrollment(s) canceled successfully!'
                                });

                                this.clear();
                            })
                            .catch((e) => {
                                // ❌ error toast
                                Livewire.dispatch('student-update', {
                                    icon: 'error',
                                    text: e?.message || 'Something went wrong.'
                                });

                                throw e;
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading(),
                });
            }

        }
    }
</script>
