<div>
    <div class="col-span-12 space-y-6 xl:col-span-12">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Student Entry Test Result
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
                                        SNO
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Student Name
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
                                        Course Name
                                    </p>
                                </div>
                            </th class="py-3">
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Correct Answer
                                    </p>
                                </div>
                            </th>

                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Total Questions
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Percentage
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Result
                                    </p>
                                </div>
                            </th>

                        </tr>
                    </thead>
                    <!-- table header end -->

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach ($student_entries as $student_entry)
                            <tr wire:key="student-{{ $student_entry->student_id }}">
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
                                            {{ $student_entry->user->full_name }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $student_entry->user->email }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $student_entry->course->course_title }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $student_entry->correct_ans }}

                                        </p>
                                    </div>
                                </td>

                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $student_entry->total_questions }}

                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $student_entry->percentage }}

                                        </p>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center" x-data="{ open: false }" x-init="window.addEventListener('changeResult-alert', () => {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: 'Do you really want to change the result?',
                                            icon: 'warning',
                                            showCancelButton: true,

                                            confirmButtonText: 'Yes, Confirmed',
                                            cancelButtonText: 'No, Cancel',
                                            confirmButtonColor: '#e11d48',
                                            cancelButtonColor: '#3b82f6',
                                            preConfirm: () => {
                                                $dispatch('resultChangeConfirmed')
                                            }
                                        });
                                    })">
                                        <select
                                            wire:change="updateResult($event.target.value,{{ $student_entry->student_id }})"
                                            class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800
                                                shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                                                dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800
                                                dark:bg-dark-900">
                                            <option value="">Select Status</option>
                                            <option @selected($student_entry->user->student_details->result === 'In_progress') value="In_progress">In progress
                                            </option>
                                            <option @selected($student_entry->user->student_details->result === 'pass') value="pass">PASS</option>
                                            <option @selected($student_entry->user->student_details->result === 'fail') value="fail">FAIL</option>
                                        </select>
                                    </div>
                                </td>



            </div>
            </tr>
            @endforeach

            </tbody>
            </table>
            <div class="mt-3">
                {{ $student_entries->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('resultChange-success', event => {
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
