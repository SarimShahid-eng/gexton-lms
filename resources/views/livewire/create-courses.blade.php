            <div x-data="{ showCourseForm: false }" class="grid grid-cols-12 gap-4 md:gap-6">
                <div class="col-span-12 space-y-6 xl:col-span-12">
                    <div
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                        <h5 class="flex justify-between items-center text-lg font-semibold dark:text-gray-200">
                            Create Courses

                            <!-- Toggle Button -->
                            <button @click="showCourseForm = !showCourseForm"
                                class="transition-transform hover:rotate-90">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </h5>

                        <!-- Form Section -->
                        <form wire:submit.prevent="save">
                            @csrf
                            <div x-show="showCourseForm" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95" class="space-y-4 mt-4">


                                <!-- Course Title -->
                                <div class="input-group">

                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Course Title
                                    </label>
                                    <input type="text" placeholder="Enter Title" wire:model="course_title"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    @error('course_title')
                                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" wire:model="update_id">
                                <!-- Course Description -->
                                <div class="input-group">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Course Description
                                    </label>
                                    <textarea placeholder="Enter a description..." rows="6" wire:model="course_description"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                                    @error('course_description')
                                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Selects Row -->
                                <div class="input-group">

                                    <div class="flex gap-4 items-end">


                                        <div class="w-1/3 relative z-20 bg-transparent">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                Duration Entry Test Time
                                            </label>
                                             <input type="number" placeholder="Enter Minutes"
                                                wire:model="minutes"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                            @error('minutes')
                                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/3 relative z-20 bg-transparent">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                               Questions limit
                                            </label>
                                            <input type="number" placeholder="Enter Questions limit"
                                                wire:model="questions_limit"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                            @error('questions_limit')
                                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/3 relative z-20 bg-transparent">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                               Inernship Time Period
                                            </label>
                                            <select :class="selected && 'text-gray-800 dark:text-white/90'"
                                                wire:model="Duration"
                                                class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 dark:bg-dark-900">
                                                <option value="">Select Weeks</option>
                                                @foreach (range(1, 48) as $week)
                                                    <option
                                                        value="{{ $week == 1 ? $week . ' ' . 'Week' : $week . ' ' . 'Weeks' }}">
                                                        {{ $week }}
                                                        {{ $week == 1 ? 'Week' : 'Weeks' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Duration')
                                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="input-group">

                                    <div class="flex gap-4">

                                        {{-- <div class="w-1/3 relative z-20 bg-transparent">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                Duration
                                            </label>
                                            <select :class="selected && 'text-gray-800 dark:text-white/90'"
                                                wire:model="Duration"
                                                class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 dark:bg-dark-900">
                                                <option value="">Select Weeks</option>
                                                @foreach (range(1, 48) as $week)
                                                    <option
                                                        value="{{ $week == 1 ? $week . ' ' . 'Week' : $week . ' ' . 'Weeks' }}">
                                                        {{ $week }}
                                                        {{ $week == 1 ? 'Week' : 'Weeks' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Duration')
                                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <div class="w-1/3 relative z-20 bg-transparent">
                                            <label
                                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                Session
                                            </label>
                                            <input type="text" disabled value="{{ $session_active->session_year }}"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                                            h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                            placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white/90
                                            dark:placeholder:text-white/30" />
                                            <input type="hidden" wire:model="session_year_id" />
                                        </div>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button wire:loading.attr="disabled" wire:target="save" type="submit"
                                        class="inline-flex items-center gap-1 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">Submit
                                        <div wire:loading wire:target="save"
                                            class="w-4 h-4 animate-spin rounded-full border-2 border-solid border-white border-t-transparent">
                                        </div>
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
                                    See All Courses
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
                                                    ID
                                                </p>
                                            </div>
                                        </th>
                                        <th class="py-3">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Course Title
                                                </p>
                                            </div>
                                        </th class="py-3">
                                        <th class="py-3">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Duration Test Time
                                                </p>
                                            </div>
                                        </th>
                                        <th class="py-3">
                                            <div class="flex items-center col-span-2">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Duration
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


                                    @forelse ($courses as $course)
                                        <tr>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $loop->iteration }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $course->course_title }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $course->test_time }}

                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $course->Duration }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td class="py-3">
                                                <div class="flex items-center gap-2">
                                                    <button wire:click="edit({{ $course->id }})"
                                                        @click="showCourseForm = true"
                                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                                        title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                                        </svg>
                                                    </button>

                                                    <button wire:click="confirmDelete({{ $course->id }})"
                                                        class="inline-flex items-center text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600"
                                                        title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd"
                                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                clip-rule="evenodd" />
                                                        </svg>


                                                    </button>
                                                </div>
                                            </td>
                                        @empty
                                            <td colspan="12">
                                                <div class="text-center py-12">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-12 h-12 text-gray-400 mx-auto">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                                                    </svg>
                                                    <h3
                                                        class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                                                        No courses
                                                        records found</h3>
                                            </td>
                        </div>
                        </tr>
                        @endforelse

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
                        {{ $courses->links() }}
                    </div>
                </div>

                @push('script')
                    <script>
                        window.addEventListener('course-saved', event => {
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
                        window.addEventListener('course-deleted', event => {
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
                    </script>
                @endpush

            </div>
