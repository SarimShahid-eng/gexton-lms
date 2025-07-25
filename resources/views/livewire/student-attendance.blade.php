<div class="grid grid-cols-12 gap-4 md:gap-6">
    <!-- Filter Section Wrapper -->

    <div class="flex justify-between items-center w-[74vw] mb-4">
        <!-- Course Dropdown -->
        <div class="w-[48%]">
            <label for="course_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Select Course
            </label>
            <select id="course_id" wire:model.live="course_id"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                aria-describedby="batch-error">
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">
                        Batch: {{ $course->batch->title }} — Course: {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Attendance Date Picker -->
        <div class="w-[48%]">
            <label for="attendanceDate" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                Attendance Date
            </label>
            <input type="date" id="attendanceDate" wire:model.live="attendanceDate"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" />
        </div>

    </div>


    <!-- Attendance Table -->
    <div class="col-span-12 space-y-6">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 px-4 pb-3 pt-4 sm:px-6">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white font-['Open_Sans']">Student Attendances
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage attendance for selected course</p>
                </div>
            </div>

            <!-- Form Start -->
            <form wire:submit.prevent="saveAttendance">
                <div class="w-full overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                        <!-- Table Header -->
                        <thead class="bg-gray-50 dark:bg-gray-800/30">
                            <tr>
                                <th class="py-3 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">#
                                </th>
                                <th class="py-3 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                    Name</th>
                                <th class="py-3 px-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                                    <div class="flex items-center space-x-4 mt-2">
                                        <label class="text-xs text-gray-600 dark:text-gray-300">
                                            <input type="radio" wire:click="markAll('present')" name="mark_all">
                                            Present
                                        </label>
                                        <label class="text-xs text-gray-600 dark:text-gray-300">
                                            <input type="radio" wire:click="markAll('absent')" name="mark_all"> Absent
                                        </label>
                                        <label class="text-xs text-gray-600 dark:text-gray-300">
                                            <input type="radio" wire:click="markAll('leave')" name="mark_all"> Leave
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($students as $student)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                    <td class="py-3 px-3">
                                        <span
                                            class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-sm font-semibold text-blue-600 dark:text-blue-400">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 text-gray-800 dark:text-white font-['Open_Sans']">
                                        {{ $student->full_name }}
                                    </td>
                                    <td class="py-3 px-3">
                                        <div class="flex items-center space-x-3">
                                            <label class="text-sm text-green-600 dark:text-green-400">
                                                <input type="radio" wire:model.defer="attendances.{{ $student->id }}"
                                                    value="present"> P
                                            </label>
                                            <label class="text-sm text-red-600 dark:text-red-400">
                                                <input type="radio" wire:model.defer="attendances.{{ $student->id }}"
                                                    value="absent"> A
                                            </label>
                                            <label class="text-sm text-yellow-500 dark:text-yellow-400">
                                                <input type="radio" wire:model.defer="attendances.{{ $student->id }}"
                                                    value="leave"> L
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                                No Students Found
                                            </h3>
                                            <p class="text-gray-500 dark:text-gray-400">
                                                No student records are available at the moment.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                @if (count($students))
                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-all">
                            Save Attendance
                        </button>
                    </div>
                @endif
            </form>

        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('attendace-saved', event => {
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

            window.addEventListener('teacher-deleted', event => {
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
</div>
