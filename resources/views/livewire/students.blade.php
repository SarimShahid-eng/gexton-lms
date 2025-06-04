<div x-data="{ showCourseForm: true }" class="grid grid-cols-12 gap-4 md:gap-6">
    <div class="col-span-12 space-y-6 xl:col-span-12">

    </div>
    @livewireScripts

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
                                        Created Date
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        student Title
                                    </p>
                                </div>
                            </th class="py-3">
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Seesion
                                    </p>
                                </div>
                            </th>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Group Name
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Course
                                    </p>
                                </div>
                            </th>
                            <th class="py-3">
                                <div class="flex items-center col-span-2">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Timing
                                    </p>
                                </div>
                            </th>

                        </tr>
                    </thead>
                    <!-- table header end -->

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">


                        @foreach ($students as $student)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {{ $student->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $student->full_name }}
                                    </p>
                                </td>

                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $student->session->session_year }}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $student->student_details->course->course_title }}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ $student->student_details->group->group_name }}
                                    </p>
                                </td>
                                <td class="py-3">
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                        {{ \Carbon\Carbon::parse($student->student_details->group->from)->format('h:i A') }}
                                        To
                                        {{ \Carbon\Carbon::parse($student->student_details->group->to)->format('h:i A') }}
                                    </p>
                                </td>


                            </tr>
                        @endforeach

            </div>
            </tbody>
            </table>
            <div class="mt-3">
                {{-- {{ $students->links() }} --}}
            </div>
        </div>
    </div>



</div>
