@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
<div x-data="{ showstudentForm: false }" class="grid grid-cols-12 gap-4 md:gap-6">
<div class="col-span-12 space-y-6 xl:col-span-12">
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
        <h5 class="flex justify-between items-center text-lg font-semibold dark:text-gray-200">
            Create Students

            <!-- Toggle Button -->
            <button @click="showstudentForm = !showstudentForm"
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
            <div x-show="showstudentForm" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="space-y-4 mt-4">



                <!--Student Related Info -->

                <div class="input-group">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Student Related Info
                    </label>
                    <div class="flex gap-4">
                        <!-- COURSE -->
                        <div class="w-1/3 relative z-20 bg-transparent">
                            <select id="selectedCourseId" wire:model.live="course_id" name="course_id"
                                class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 dark:bg-dark-900"
                                id="courseSelect" data-width="100%">
                                <option value="">Select Course</option>
                                @foreach ($this->courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

<<<<<<< HEAD
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
                                                    Full Name
                                                </p>
                                            </div>
                                        </th>
                                        <th class="py-3">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Email
                                                </p>
                                            </div>
                                        </th>

                                        <th class="py-3">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Course
                                                </p>
                                            </div>
                                        </th class="py-3">
                                        <th class="py-3">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Group
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
                                    @forelse ($students as $student)
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
                                                        {{ $student->firstname }} {{ $student->lastname }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $student->email }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $student->student_details->course->course_title }}

                                                    </p>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $student->student_details->group->group_name }}

                                                    </p>
                                                </div>
                                            </td>

                                            <td class="py-3">
                                                <div class="flex items-center gap-2">
                                                    <button wire:click="edit({{ $student->id }})"
                                                        @click="showstudentForm = true"
                                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                                        title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                                        </svg>
                                                    </button>

                                                    {{-- <button wire:click="confirmDelete({{ $student->id }})"
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
                                                        No Students
                                                        records found</h3>
                                            </td>
                                        </div>
                                        </tr>
                                    @endforelse

                                </tbody>

                        {{-- <div x-data="{ open: false }" x-init="window.addEventListener('swal-confirm', () => {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'Do you really want to delete this student?',
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
                        </div> --}}
                        </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $students->links() }}
=======
                        <!-- GROUP -->
                        <div class="w-1/3 relative z-20 bg-transparent">
                            <select wire:model="group_id" wire:change="setTeacher($event.target.value)"
                                name="group_id" id="groupSelect"
                                class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 dark:bg-dark-900">
                                <option value="">Select Groups</option>
                                @foreach ($this->batchgroups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- TEACHER -->
                        <div class="w-1/3 relative z-20 bg-transparent">
                            <input type="text" placeholder="Enter Teacher Name"
                                wire:model="teacher_name" disabled
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            @error('teacher_name')
                                <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                            @enderror
>>>>>>> a93fd89d4e9a266ae65685fa68f62b9e21645bf9
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Email
                    </label>
                    <input type="text" placeholder="Enter Email" wire:model="email"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('email')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Firstname -->
                <div class="input-group">

                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        First Name
                    </label>
                    <input type="text" placeholder="Enter Firstname" wire:model="firstname"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('firstname')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" wire:model="update_id">
                <!--Lastname -->
                <div class="input-group">

                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Last Name
                    </label>
                    <input type="text" placeholder="Enter Lastname" wire:model="lastname"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('lastname')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">

                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Phone Number
                    </label>
                    <input type="text" placeholder="Enter Phone number" wire:model="phone"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('phone')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <!--Password -->
                <div class="input-group">

                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Password
                    </label>
                    <input type="text" placeholder="Enter Password" wire:model="password"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('password')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">

                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Confirm Password
                    </label>
                    <input type="text" placeholder="Confirm Password"
                        wire:model="password_confirmation"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('password_confirmation')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Status -->
                <div class="input-group">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>
                    <select wire:model="is_active"
                        class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800
                                dark:bg-dark-900">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('is_active')
                        <span class="text-red-500 ms-2 mt-1">{{ $message }}</span>
                    @enderror
                </div>
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
                    See All Students
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
                                    Full Name
                                </p>
                            </div>
                        </th>

                        <th class="py-3">
                            <div class="flex items-center">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Courses
                                </p>
                            </div>
                        </th class="py-3">
                        <th class="py-3">
                            <div class="flex items-center">
                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                    Groups
                                </p>
                            </div>
                        </th>
                        <th class="py-3">
                            <div class="flex items-center">
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
                    @forelse ($students as $student)
                    {{-- @dd($student) --}}
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
                                        {{ $student->firstname }} {{ $student->lastname }}
                                    </p>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $student->student_details->course->course_title }}

                                    </p>
                                </div>
                            </td>

                            <td class="py-3">
                                <div class="flex items-center">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                        {{ $student->student_details->group->group_name }}

                                    </p>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full
                                {{ $student->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $student->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            </td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <button wire:click="edit({{ $student->id }})"
                                        @click="showstudentForm = true"
                                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.45z" />
                                        </svg>
                                    </button>

                                    {{-- <button wire:click="confirmDelete({{ $student->id }})"
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
                                        No Students
                                        records found</h3>
                            </td>
                        </div>
                        </tr>
                    @endforelse

                </tbody>

        {{-- <div x-data="{ open: false }" x-init="window.addEventListener('swal-confirm', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this student?',
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
        </div> --}}
        </tbody>
        </table>
        <div class="mt-3">
            {{ $students->links() }}
        </div>
    </div>
</div>

@push('script')
    <!-- Bottom of body -->
    <script>
        window.addEventListener('student-saved', event => {
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
