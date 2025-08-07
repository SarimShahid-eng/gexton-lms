<div x-data="{ showCourseForm: false }" class="grid grid-cols-12 gap-4 md:gap-6 p-4">
    <!-- Create Course Section -->
    <div class="col-span-12 space-y-6">
        <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800/50 p-4 sm:p-6 shadow-sm">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white font-['Open_Sans']">
                    Create New Course
                </h3>
                <button @click="showCourseForm = !showCourseForm"
                    class="w-10 h-10 rounded-lg  bg-gradient-to-br from-slate-800 via-slate-900 to-black dark:from-slate-900 dark:via-black dark:to-slate-950 hover:from-gray-600 hover:to-gray-700 text-white flex items-center justify-center transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    aria-label="Toggle course creation form" title="Toggle Course Form">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 transition-transform duration-200"
                        :class="showCourseForm ? 'rotate-45' : ''">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>

            <!-- Form Section -->
            <form wire:submit.prevent="save" x-show="showCourseForm" x-cloak
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-6 space-y-6">
                @csrf
                <div class="space-y-6">
                    {{-- Row 1: Phase & Campus --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Phases
                            </label>
                            <select wire:model.live="phase_id"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                aria-describedby="phase-error">
                                <option value="">Select Phase</option>
                                @foreach ($phases as $phase)
                                    <option value="{{ $phase->id }}" {{ $phase->id == $phase_id ? 'selected' : '' }}>
                                        {{ $phase->title }}</option>
                                @endforeach
                            </select>
                            @error('phase_id')
                                <p id="phase-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Batch
                            </label>
                            <select wire:model.live="campus_id"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                aria-describedby="campus-error">
                                <option value="">Select Batch</option>
                                @foreach ($campuses as $campus)
                                    <option value="{{ $campus->id }}" {{ $campus->id == $campus_id ? 'selected' : '' }}>
                                        {{ $campus->title }}</option>
                                @endforeach
                            </select>
                            @error('campus_id')
                                <p id="campus-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Batch Title --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Campus
                            </label>
                            <select wire:model="batch_id"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                aria-describedby="batch-error">
                                <option value="">Select Campus</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ $batch->id == $batch_id ? 'selected' : '' }}>
                                        {{ $batch->title }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <p id="batch-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 9a3 3 0 116 0 3 3 0 01-6 0zm4 4H9a3 3 0 00-3 3v1h10v-1a3 3 0 00-3-3zM21 12h-6m0 0v-6m0 6l-3-3m0 0l-3 3" />
                                </svg>
                                Teacher
                            </label>
                            <select wire:model.live="user_id"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                aria-describedby="user-error">
                                <option value="">Select Teacher</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p id="user-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Course Title
                            </label>
                            <input type="text" wire:model="title" placeholder="Enter course title"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 font-['Open_Sans']"
                                aria-describedby="title-error">
                            @error('title')
                                <p id="title-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Course Description -->
                        <div class="space-y-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 font-['Open_Sans'] flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Course Description
                            </label>
                            <textarea wire:model="description" rows="4" placeholder="Enter detailed course description"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none font-['Open_Sans']"
                                aria-describedby="description-error"></textarea>
                            @error('description')
                                <p id="description-error" class="text-red-500 text-sm mt-1 font-['Open_Sans']">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- Submit Button --}}
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="w-full flex justify-end">
                            <button wire:loading.attr="disabled" wire:target="save" type="submit"
                                class="group relative inline-flex items-center gap-2 px-6 py-2.5
                                    bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800
                                    text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md
                                    transition-all duration-200 hover:scale-105
                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                    disabled:opacity-50 disabled:cursor-not-allowed font-['Open_Sans']">

                                {{-- Loading --}}
                                <div wire:loading wire:target="save" class="flex items-center gap-2">
                                    <div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                                    <span>Saving...</span>
                                </div>

                                {{-- Normal --}}
                                <div wire:loading.remove wire:target="save" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>{{ $editMode ? 'Update Batch' : 'Create Batch' }}</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>



            </form>
        </div>
    </div>

    <!-- Courses List Section -->
    <div class="col-span-12 space-y-6">
        <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800/50 p-4 sm:p-6 shadow-sm">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                <!-- Title -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white/90 font-['Open_Sans']">
                        All Courses
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Manage courses information, edit details, and perform actions.
                    </p>
                </div>

                <!-- Total Count -->
                <div class="mt-3 sm:mt-0">
                    <div class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 rounded-lg inline-block">
                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                            {{ $courses->total() }} Courses
                        </span>
                    </div>
                </div>
            </div>

            <!-- Search Box (Below Table Heading) -->
            <div class="mt-6 mb-4">
                <input type="text" wire:model.live="search" placeholder="Search by name "
                    class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm
               focus:ring focus:ring-blue-200 focus:outline-none text-sm">
            </div>

            <!-- Table Container -->
            <div class="w-full overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/30">
                        <tr>
                            <th scope="col"
                                class="py-3.5 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                #
                            </th>
                            <th scope="col"
                                class="py-3.5 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                Course
                            </th>
                            <th scope="col"
                                class="py-3.5 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                Teacher
                            </th>
                            <th scope="col"
                                class="py-3.5 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                Campus
                            </th>
                            <th scope="col"
                                class="py-3.5 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                Batch
                            </th>
                            <th scope="col"
                                class="py-3.5 px-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300 font-['Open_Sans']">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($courses as $course)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                                <td class="py-4 px-3">
                                    <span
                                        class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-sm font-semibold text-blue-600 dark:text-blue-400 font-['Open_Sans']">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="py-4 px-3">
                                    <p class="font-semibold text-gray-800 dark:text-white font-['Open_Sans']">
                                        {{ $course->title }}
                                    </p>
                                </td>
                                <td class="py-4 px-3">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white font-['Open_Sans']">
                                        {{ $course->user->full_name ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="py-4 px-3">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white font-['Open_Sans']">
                                        {{ $course->campus->title ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="py-4 px-3">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white font-['Open_Sans']">
                                        {{ $course->batch->title ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="py-4 px-3">
                                    <div class="flex items-center justify-center gap-3">
                                        <!-- Edit Button with Tooltip -->
                                        <div x-data="{ showTooltip: false }" class="relative">
                                            <button wire:click="edit({{ $course->id }})"
                                                @click="showCourseForm = true" @mouseenter="showTooltip = true"
                                                @mouseleave="showTooltip = false"
                                                class="group relative inline-flex items-center justify-center w-9 h-9  text-blue-500 hover:bg-blue-500/10 rounded-full transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                aria-label="Edit course {{ $course->title }}">
                                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <div x-show="showTooltip"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-1"
                                                class="absolute z-10 bottom-full mb-2 left-1/2 transform -translate-x-1/2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-md shadow-md whitespace-nowrap">
                                                Edit course
                                            </div>
                                        </div>

                                        <!-- Delete Button with Tooltip -->
                                        <div x-data="{ showTooltip: false }" class="relative">
                                            <button wire:click="confirmDelete({{ $course->id }})"
                                                @mouseenter="showTooltip = true" @mouseleave="showTooltip = false"
                                                class="group relative inline-flex items-center justify-center w-9 h-9 text-red-500 hover:bg-red-500/10 rounded-full transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                aria-label="Delete course {{ $course->title }}">
                                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <div x-show="showTooltip"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-1"
                                                class="absolute z-10 bottom-full mb-2 left-1/2 transform -translate-x-1/2 px-3 py-1.5 bg-gray-900 text-white text-sm rounded-md shadow-md whitespace-nowrap">
                                                Delete course
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2 font-['Open_Sans']">
                                            No Courses Found
                                        </h3>
                                        <p class="text-gray-500 dark:placeholder-gray-400 font-['Open_Sans']">
                                            Get started by creating your first course.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($courses->hasPages())
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                        {{ $courses->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert Confirmation -->
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
                @this.deleteCourse();
            }
        });
    })">
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('course-saved', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: event.detail.icon,
                title: event.detail.text
            });
        });

        window.addEventListener('course-deleted', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'success',
                title: event.detail.text
            });
        });
    </script>
@endpush
