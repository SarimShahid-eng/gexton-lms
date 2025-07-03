<div class="grid grid-cols-12 gap-4 md:gap-6" x-data="{ showCourseForm: false }">
    <div class="col-span-12 space-y-6 xl:col-span-12">
        <div x-data="questionFormComponent(), { showCourseForm: false }" x-init="init()"
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <h5 class="flex justify-between items-center text-lg font-semibold dark:text-gray-200">
                Create Question

                <button @click="showCourseForm = !showCourseForm" class="transition-transform hover:rotate-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </h5>

            <form wire:submit.prevent="save">
                <div x-show="showCourseForm" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="space-y-4 mt-4">
                    <!-- Course Select -->
                    <!-- Title -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Title
                        </label>
                        <input type="text" wire:model.defer="title" placeholder="Enter question title"
                            class="h-11 w-full rounded-lg border px-4 py-2.5 text-sm dark:placeholder:text-white/30" />
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Question Text -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Question
                        </label>
                        <textarea wire:model.defer="question" placeholder="Enter the question here"
                            class="h-32 w-full rounded-lg border px-4 py-2.5 text-sm dark:placeholder:text-white/30"></textarea>
                        @error('question')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>


                    <div x-data="questionFormComponent()" x-init="init();
                    window.addEventListener('question-saved', () => resetForm());"
                        x-on:edit-question-loaded.window="loadQuestion($event.detail)">

                        <!-- Hidden inputs for Livewire sync -->
                        <input type="hidden" x-ref="optionsInput" wire:model.defer="options" />
                        <input type="hidden" x-ref="correctInput" wire:model.defer="correct_answer" />

                        <!-- Dynamic Options -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <label class="text-base font-semibold text-gray-800 dark:text-gray-200">
                                    Add your options
                                </label>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Mark one as correct</span>
                            </div>

                            <template x-for="(answer, index) in options" :key="index">
                                <div class="group relative flex items-center gap-4 mb-4 p-3 border rounded-lg">
                                    <div class="flex-1">
                                        <input type="text" x-model.debounce.300ms="options[index]"
                                            @input.debounce.300ms="updateLivewire()" placeholder="Enter answer option"
                                            class="w-full px-4 py-3 rounded-lg border" />
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <!-- Radio with value as index -->
                                        <input type="radio" :value="index" x-model="correct_answer"
                                            @change="updateLivewire()" />
                                        <span>Correct</span>
                                    </div>

                                    <button type="button" @click="removeOption(index)" x-show="options.length > 1"
                                        class="text-red-500 hover:bg-gray-100 rounded-full p-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <button type="button" @click="addOption()"
                                class="mt-4 px-4 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                                + Add Answer
                            </button>
                        </div>
                    </div>


                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-span-12 space-y-6 xl:col-span-12">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        See All Questions
                    </h3>
                </div>

            </div>

            <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                    <!-- table header start -->
                    <thead>
                        <tr class="border-gray-100 border-y dark:border-gray-800">
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Title
                                    </p>
                                </div>
                            </th>

                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Question
                                    </p>
                                </div>
                            </th>

                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Action
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- table header end -->

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">


                        @foreach ($questions as $question)
                            <tr>


                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ @$question->title }}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {!! $question->question !!}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="edit({{ $question->id }})" @click="showCourseForm = true"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                            </svg>
                                        </button>

                                        {{-- <button wire:click="confirmDelete({{ $question->id }})"
                                            class="inline-flex items-center text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>


                                        </button> --}}
                                    </div>
                                </td>

            </div>
            </tr>
            @endforeach
            <div x-data="{ open: false }" x-init="window.addEventListener('swal-confirm', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to delete this course?',
                    icon: 'warning',
                    showCancelButton: true,

                    confirmButtonText: 'Yes, Delete it',
                    cancelButtonText: 'No, Cancel',
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#3b82f6',
                    preConfirm: () => {
                        @this.deleteCourse(); // Call Livewire method to delete the course
                    }
                });
            })">
            </div>
            </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $questions->links() }}
        </div>
    </div>
</div>

<script>
    window.addEventListener('question-saved', event => {
        let data = event.detail;
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        })
        Toast.fire({
            icon: "success",
            title: data.text
        });

    });
    window.addEventListener('question-deleted', event => {
        let data = event.detail;
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        })
        Toast.fire({
            icon: "success",
            title: data.text
        });

    });


    function questionFormComponent() {
        return {
            options: [],
            correct_answer: '',
            //  showCourseForm: false, // colon, not equal sign

            init() {
                this.$watch('options', () => this.updateLivewire());
                this.$watch('correct_answer', () => this.updateLivewire());
            },

            loadQuestion(data) {
                this.options = (typeof data.options === 'string') ?
                    JSON.parse(data.options).map(opt => opt.trim()) :
                    (data.options || ['']);

                this.correct_answer = this.options.indexOf((data.correct_answer || '').trim());
                if (this.correct_answer === -1) this.correct_answer = ''; // no correct answer selected

                this.updateLivewire();
            },

            updateLivewire() {
                this.$refs.optionsInput.value = JSON.stringify(this.options);
                // store correct answer text, not index
                this.$refs.correctInput.value = this.options[this.correct_answer] || '';
                this.$refs.optionsInput.dispatchEvent(new Event('input'));
                this.$refs.correctInput.dispatchEvent(new Event('input'));
            },

            addOption() {
                this.options.push('');
                this.updateLivewire();
            },

            removeOption(index) {
                if (index === this.correct_answer) {
                    this.correct_answer = '';
                } else if (index < this.correct_answer) {
                    this.correct_answer -= 1; // adjust index if needed
                }
                this.options.splice(index, 1);
                this.updateLivewire();
            },
            resetForm() {
                this.options = [''];
                this.correct_answer = null;
                this.updateLivewire();
            }
        }
    }
</script>
