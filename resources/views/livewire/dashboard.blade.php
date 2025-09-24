@role('admin')
    <div>
        {{-- <div class="flex gap-5 my-3">
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Batch</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Center</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Course</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Gender</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
        </div>
        <div class="flex gap-5 my-3">
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Qualification</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Age Group</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
            <div class="filter-parent w-1/3">
                <!-- Input Field -->
                <select wire:model="domicile_category"
                    class="w-full h-11 rounded-lg border border-gray-300 dark:border-gray-700
                                   bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-800 dark:text-white
                                   placeholder:text-gray-400 dark:placeholder:text-white/30
                                   focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-50
                                   shadow-sm transition duration-150 ease-in-out">
                    <option selected>Select Time Slot</option>
                    <option value="urban">Urban</option>
                    <option value="rural">Rural</option>
                </select>
            </div>
        </div> --}}

        <div class="grid grid-cols-12 gap-4 md:gap-6 ">
            <div class="col-span-12 xl:col-span-6">
                <!-- Card One -->
                @include('partials.cards.card1')
                <!-- Card One -->
                {{-- <div>
                <h3 class="text-lg font-bold mb-2">Gender Ratio</h3>
                <canvas id="genderChart"></canvas>
            </div> --}}
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
                @livewire('enroll-student-gender-chart')
                @livewire('enroll-student-age-group')
            </div>
        </div>
        <div class="">
            <div class="max-w-7xl flex">
                @livewire('enroll-by-time-slot')

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
