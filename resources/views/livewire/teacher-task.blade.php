<div x-data="{ showCourseForm: false }" class="grid grid-cols-12 gap-4 md:gap-6">
    <div class="col-span-12 space-y-6 xl:col-span-12">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <h5 class="flex justify-between items-center text-lg font-semibold dark:text-gray-200">
                Create Task

                <!-- Toggle Button -->
                <button @click="showCourseForm = !showCourseForm" class="transition-transform hover:rotate-90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </h5>

            <!-- Form Section -->
            <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">

                @csrf
                <div x-show="showCourseForm" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="space-y-4 mt-4">

                    <!-- Task Title -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Task Title
                        </label>
                        <input type="text" wire:model="task_title" placeholder="Enter Task Title"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                                        h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                        placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white/90
                                        dark:placeholder:text-white/30" />
                        @error('task_title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Task Description -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Task Description
                        </label>
                        <textarea wire:model="task_description" placeholder="Enter Task Description"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                                w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white/90
                                dark:placeholder:text-white/30"></textarea>
                        @error('task_description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Number of Days -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Number of Days
                        </label>
                        <select wire:model="number_of_days"
                            class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                                shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                                                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800
                                                dark:bg-dark-900">
                            <option value="">Select Days</option>
                            @for ($i = 1; $i <= 60; $i++)
                                <option value="{{ $i }}">{{ $i }} day{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('number_of_days')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Total Marks -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Total Marks
                        </label>

                        <select wire:model="total_marks"
                            class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                                shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                                                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800
                                                dark:bg-dark-900">
                            <option value="">Select Marks</option>
                            @for ($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}">{{ $i }} Mark{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>

                        @error('total_marks')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Attachment Link -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Attachment Link
                        </label>
                        <input type="file" wire:model="attachment_link"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                                h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white/90
                                dark:placeholder:text-white/30" />
                        @error('attachment_link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Group Name -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Group
                        </label>
                        <select wire:model="group_name"
                            class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                                shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                                                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800
                                                dark:bg-dark-900">
                            <option value="">Select Group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                        @error('group_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Session Year ID -->
                    <!-- Session -->
                    <div class="input-group">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Session
                        </label>
                        <input type="text" disabled value="{{ $session_active->session_year }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800
                                        h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                        placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white/90
                                        dark:placeholder:text-white/30" />
                        <input type="hidden" wire:model="session_year_id" />
                    </div>
                    <!-- Submit Button -->
                    <div>
                        <button
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
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
                        See All Task
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
                                        Created Date
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Task Title
                                    </p>
                                </div>
                            </th class="py-3">


                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Number of Days
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Group
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Assigned Time
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Status
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


                        @foreach ($tasks as $task)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $task->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $task->task_title }}
                                    </p>
                                </td>


                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $task->number_of_days }} Days
                                    </p>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $task->group->group_name }}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                @if ($task->assigned_task == 1)
                                                    {{ $task->updated_at->format('d M Y') }}
                                                @else
                                                    <span class="text-red-500">Not Assigned Yet</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button wire:click="update_task({{ $task->id }})" @disabled($task->assigned_task == 1)
                                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-md hover:from-green-600 hover:to-emerald-700 transition-all duration-300 ease-in-out transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:scale-100"



                                        title="{{ $task->assigned_task == 1 ? 'Already Assigned' : 'Assign Task' }}">
                                        @if ($task->assigned_task == 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Assigned
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4l16 8-16 8V4z" />
        </svg>
                                            Assign
                                        @endif
                                    </button>
                                </td>



                                <td class="py-3">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="view_task({{ $task->id }})"
                                            class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                                            title="View Task">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <button wire:click="edit({{ $task->id }})" @click="showCourseForm = true"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                            </svg>
                                        </button>

                                        <button wire:click="confirmDelete({{ $task->id }})"
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
                            </tr>
                        @endforeach
                        <div x-data="{ open: false }" x-init="window.addEventListener('swal-confirm', () => {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'Do you really want to delete this task?',
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
                <div class="mt-3">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>






        @push('script')
            <script>
                window.addEventListener('task-saved', event => {
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
                window.addEventListener('marks-saved', event => {
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
    <div x-data="{ showTaskViewModal: false }" x-on:open-task-view-modal.window="showTaskViewModal = true" style="z-index: 99999">
        <!-- Modal -->
        <div x-show="showTaskViewModal" x-transition
            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-50" style="display: none;">

            <!-- Background Overlay -->
            <div @click="showTaskViewModal = false" class="fixed inset-0 bg-gray-400/50 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div @click.outside="showTaskViewModal = false"
                class="relative z-10 w-full max-w-4xl bg-white dark:bg-gray-900 rounded-3xl p-6 lg:p-10 shadow-xl overflow-y-auto max-h-[80vh]">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white/90">Students Tasks</h2>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Total: <strong>{{ $submitedTasksCount }}</strong>
                        </span>
                        <button @click="showTaskViewModal = false"
                            class="text-gray-500 hover:text-black dark:hover:text-white text-xl font-bold">
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-800 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3">Students</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Attachment</th>
                                <th class="px-4 py-3">Students Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submitedTasks as $task)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $task->user->full_name }} </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $showToggle = strlen($task->description) > 50; // or use 100/120 as per visual length
                                        @endphp

                                        <div x-data="{ expanded: false }">
                                            <p class="text-sm text-gray-800 overflow-hidden text-ellipsis"
                                                :class="expanded ? '' : 'line-clamp-style'"
                                                style="display: -webkit-box; -webkit-box-orient: vertical;"
                                                x-text="expanded ? @js($task->description) : @js(Str::limit($task->description, 50))">
                                            </p>

                                            @if ($showToggle)
                                                <button @click="expanded = !expanded"
                                                    class="mt-1 text-blue-600 hover:underline text-xs font-medium">
                                                    <span x-show="!expanded">Show More</span>
                                                    <span x-show="expanded">Show Less</span>
                                                </button>
                                            @endif
                                        </div>

                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($task->attachment_link)
                                            <a href="{{ asset('attachments/' . $task->attachment_link) }}"
                                                class="text-blue-500 underline" target="_blank">
                                                View
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <select wire:model.lazy="marks.{{ $task->id }}"
                                            class="w-24 px-2 py-1 border rounded">
                                            <option value="">Select Marks</option>
                                            @for ($i = 0; $i <= 50; $i++)
                                                <option value="{{ $i }}">{{ $i }} Marks
                                                </option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Buttons -->
                <div class="mt-6 text-right">
                    <button @click="showTaskViewModal = false"
                        class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
