@role('admin')
    <div class="mainParent" wire:key="dashboard-main">
        {{-- <div class="flex gap-5 my-3 card bg-white p-6 rounded-xl align-end border border-gray-200">
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 font-['Open_Sans']">Center
                    Selection</label>
                <select wire:model.live="study_center_filter"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Center</option>
                    @foreach (config('filters.study_centers') as $value => $label)
                        <option wire:key="{{ $value }}" value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <label
                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 font-['Open_Sans']">Domicile
                    Selection</label>
                <select wire:model.live="domicile_category_filter"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Domicile</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 font-['Open_Sans']">Gender
                    Selection</label>
                <!-- Input Field -->
                <select wire:model.live="gender_filter"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="transgender">Transgender</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 font-['Open_Sans']">Course
                    Selection</label>
                <!-- Input Field -->
                <select wire:model.live="course_filter"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->title }}">{{ $course->title }}</option>
                    @endforeach

                </select>
            </div>
        </div> --}}
        <div class="grid grid-cols-12 gap-4 md:gap-6 ">
            <div class="col-span-12 xl:col-span-6">
                <!-- Card One -->
                @include('partials.cards.card1')

            </div>
            <div class="col-span-12 xl:col-span-6">
                <!-- ====== Card Two Start -->
                @include('partials.cards.card2')
                <!-- ====== Card Two End -->
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl flex">
                {{-- 💡 Embed the Livewire Component here --}}
                @livewire('enroll-student-gender-chart', key('gender-chart'))
                @livewire('enroll-student-age-group', key('age-group'))
            </div>
        </div>
        <div class="">
            <div class="max-w-7xl flex">
                @livewire('enroll-by-time-slot', key('time-slot'))

            </div>
        </div>
        <div class="mt-3">
            <div class="max-w-7xl flex">
                @livewire('student-education-background-chart', key('education-background'))
            </div>
        </div>
        <div class="mt-3">
            <div class=" mt-3 max-w-7xl flex">
                @livewire('course-wise-enrollment-chart', key('course-wise-enrollment-chart'))
            </div>
            <div class="mt-3 max-w-7xl flex">
                @livewire('center-wise-enrollment-chart', key('center-wise-enrollment-chart'))
            </div>
            <div class="mt-3 max-w-7xl flex">
                @livewire('domicile-wise-enrollment-chart', key('domicile-wise-enrollment-chart'))
            </div>
        </div>
    </div>
@endrole
<script>
    // Gender Chart (Pie)
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($genderCounts->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($genderCounts->toArray())) !!},
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
            }]
        },
    });
</script>
@role('student')
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 p-6" x-data="{ activeTab: 'modules' }">
        <!-- Left Column -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Welcome Card -->
            <div class="bg-white rounded-xl p-6 border border-gray-300 shadow-md">
                <div class="flex flex-col md:flex-row justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Welcome back, {{ Auth::user()->full_name }} !</h2>
                    </div>
                </div>
                <div class="mt-10 overflow-x-auto rounded-2xl border border-slate-200 shadow-sm">
                    <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
                        <thead class="bg-slate-50 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Campus</th>
                                <th class="px-6 py-4">Batch</th>
                                <th class="px-6 py-4">Course</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach ($enrollments as $enrollment)
                                <tr class="hover:bg-slate-50 transition">
                                    <!-- Campus -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10l9-6 9 6v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 21V9h6v12" />
                                                </svg>
                                            </div>
                                            <span>{{ $enrollment->campus->title }}</span>
                                        </div>
                                    </td>

                                    <!-- Batch -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h8m-8 6h16" />
                                                </svg>
                                            </div>
                                            <span>{{ $enrollment->batch->title }}</span>
                                        </div>
                                    </td>

                                    <!-- Course -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 20l9-5-9-5-9 5 9 5z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 12V4l9 5-9 5z" />
                                                </svg>
                                            </div>
                                            <span>{{ $enrollment->course->title }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    @endrole
    @role('teacher')
        <div class="grid grid-cols-12 gap-4 md:gap-6 ">
            <div class="col-span-12 xl:col-span-6">
                <!-- Card One -->
                @include('partials.cards.card1')
                <!-- Card One -->

            </div>
            <div class="col-span-12 xl:col-span-6">
                <!-- ====== Card Two Start -->
                @include('partials.cards.card2')

                <!-- ====== Card Two End -->
            </div>
        </div>
    @endrole
