<div x-data="{ showQuizForm: false }" class="grid grid-cols-12 gap-4 md:gap-6">
    <div class="col-span-12 space-y-6 xl:col-span-12">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <h5 class="flex justify-between items-center text-lg font-semibold dark:text-gray-200">
                Create Quiz

                <!-- Toggle Button -->
                <button @click="showQuizForm = !showQuizForm" class="transition-transform hover:rotate-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </h5>

            <!-- Form Section -->
            <form wire:submit.prevent="save">
                @csrf
                <div x-show="showQuizForm" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="space-y-4 mt-4">
                    <!-- Course Title -->
                    <div class="input-group">

                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Quiz Title
                        </label>
                        <input type="text" placeholder="Enter Title" wire:model="title"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('title')
                            <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Course Description -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Quiz Description
                        </label>
                        <textarea placeholder="Enter a description..." rows="6" wire:model="description"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                        @error('description')
                            <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Campus Batch Courses Select -->
                    <div class="both-group-merged flex gap-4 items-center">
                        <!-- Campuses -->
                        <div class="w-1/3  input-group">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Campus
                            </label>
                            <select id="selcted_campus" wire:model.live="selectedCampus"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-400">
                                <option value="">Select Campus</option>
                                @foreach ($campuses as $campus)
                                    <option @selected($campus->id === $updatedCampusId) value="{{ $campus->id }}">{{ $campus->title }}</option>
                                @endforeach
                            </select>
                            @error('selectedCampus')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Assign Group Select -->
                        @if (!is_null($batches))
                            <div class="w-1/3  input-group">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Assign to Batch
                                </label>
                                <select id="selcted_campus" wire:model.live="selectedBatch"
                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-400">
                                    <option value="">Select batches</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                                    @endforeach
                                </select>
                                @error('selectedBatch')
                                    <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Assign courses Select -->
                        @if (!is_null($courses))
                            <div class="w-1/3  input-group">
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Select Courses
                                </label>
                                <select id="selcted_campus" wire:model="course_id"
                                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                        dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-400">
                                    <option value="">Select Courses</option>

                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                    @endforeach

                                    @error('course_id')
                                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        @endif


                    </div>
                    {{-- Quiz Duration and Marks --}}
                    <div class="both-group-merged flex gap-4 items-center">
                        <!-- exam duration Select -->
                        <div class="w-1/3 input-group">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Quiz Duration
                            </label>
                            <input type="number" placeholder="Enter in Minutes" wire:model="duration"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            @error('duration')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- marks -->
                        <div class="w-1/3 input-group">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Marks
                            </label>
                            <input type="number" placeholder="Marks" wire:model="marks"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            @error('marks')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Date --}}
                        <div class="w-1/3 input-group">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Date
                            </label>
                            <input type="date" wire:model="date"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            @error('date')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div>
                        <button wire:loading.attr="disabled" wire:click="showQuestionTeacherWise" type="button"
                            class="inline-flex items-center gap-1 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">Step
                            2. Grab
                            Questions
                            <div wire:loading wire:target="showQuestionTeacherWise"
                                class="w-4 h-4 animate-spin rounded-full border-2 border-solid border-white border-t-transparent">
                            </div>
                        </button>
                        <p>
                            @error('selectedRows')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </p>
                    </div>
                    {{-- show teachers added questions  only --}}
                    <div x-data="{ showGrabbedQuestion }" window.show-question-grab-complete="showGrabbedQuestion = true">
                        <div x-show="showGrabbedQuestion">
                            @if ($teachersAddedQuestion)
                                <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                            All Questions
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
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Select
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="py-3">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            ID
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="py-3">
                                                    <div class="flex items-center">
                                                        <p
                                                            class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                            Question
                                                        </p>
                                                    </div>
                                                </th class="py-3">


                                            </tr>
                                        </thead>
                                        <!-- table header end -->

                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">

                                            @foreach ($teachersAddedQuestion as $question)
                                                <tr wire:key="row-{{ $question->id }}">
                                                    <td class="py-3">
                                                        <input type="checkbox" wire:model="selectedRows"
                                                            value="{{ $question->id }}"
                                                            class="form-checkbox w-5 text-brand-500 border border-gray-300 rounded-md" />
                                                    </td>
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
                                                                {{ $question->question }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button wire:loading.attr="disabled" wire:target="save" type="submit"
                        class="inline-flex items-center gap-1 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">Submit
                        <div wire:loading wire:target="save"
                            class="w-4 h-4 animate-spin rounded-full border-2 border-solid border-white border-t-transparent">
                        </div>
                    </button>
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
                        See All Quiz
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
                                        Quiz Title
                                    </p>
                                </div>
                            </th class="py-3">
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Quiz Description
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


                        @foreach ($quizes as $quiz)
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
                                            {{ $quiz->title }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $quiz->description }}

                                        </p>
                                    </div>
                                </td>


                                <td class="py-3">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="edit({{ $quiz->id }})" @click="showQuizForm = true"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                            </svg>
                                        </button>

                                        {{-- <button wire:click="confirmDelete({{ $Quiz->id }})"
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
                {{ $quizes->links() }}
            </div>
        </div>

        @push('script')
            <script>
                window.addEventListener('quiz-saved', event => {
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
                        icon: data.icon,
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
