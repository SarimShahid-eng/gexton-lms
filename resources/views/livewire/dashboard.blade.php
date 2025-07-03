
@role('admin')
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
@role('student')
<div class="grid grid-cols-1 lg:grid-cols-1 gap-6 p-6" x-data="{ activeTab: 'modules' }">
    <!-- Left Column -->
    <div class="lg:col-span-3 space-y-6">
        <!-- Welcome Card -->
        <div class="bg-white rounded-xl p-6 border border-gray-300 shadow-md">
            <div class="flex flex-col md:flex-row justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Welcome back, Student!</h2>
                    <p class="text-gray-600 mt-2">You have 3 assignments to complete this week</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-center">
                    <div class="bg-indigo-600/10 p-3 rounded-lg mr-4">
                        <i class="fas fa-book text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Courses</p>
                        <p class="text-gray-900 font-bold">5</p>
                    </div>
                </div>

                <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-center">
                    <div class="bg-green-600/10 p-3 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Completed</p>
                        <p class="text-gray-900 font-bold">12</p>
                    </div>
                </div>

                <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-center">
                    <div class="bg-amber-600/10 p-3 rounded-lg mr-4">
                        <i class="fas fa-clock text-amber-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Pending</p>
                        <p class="text-gray-900 font-bold">3</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="bg-white rounded-xl border border-gray-300 shadow-md overflow-hidden">
            <!-- Tabs -->
            <div class="border-b border-gray-300">
                <div class="flex -mb-px">
                    <button @click="activeTab = 'modules'"
                        :class="activeTab === 'modules'
                            ?
                            'border-indigo-600 text-indigo-600' :
                            'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-400'"
                        class="py-4 px-6 text-center border-b-2 font-medium text-sm">
                        <i class="fas fa-layer-group mr-2"></i> Course Modules
                    </button>

                    <button @click="activeTab = 'tasks'"
                        :class="activeTab === 'tasks'
                            ?
                            'border-indigo-600 text-indigo-600' :
                            'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-400'"
                        class="py-4 px-6 text-center border-b-2 font-medium text-sm">
                        <i class="fas fa-tasks mr-2"></i> Assignments
                    </button>

                    <button @click="activeTab = 'resources'"
                        :class="activeTab === 'resources'
                            ?
                            'border-indigo-600 text-indigo-600' :
                            'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-400'"
                        class="py-4 px-6 text-center border-b-2 font-medium text-sm">
                        <i class="fas fa-file-alt mr-2"></i> Resources
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Modules Tab -->
                <div x-show="activeTab === 'modules'">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Web Development Bootcamp Modules</h3>

                    <div class="space-y-3">
                        <div
                            class="module-item bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start cursor-pointer hover:border-indigo-600/30">
                            <div class="bg-indigo-600/10 p-2 rounded mr-4 mt-1">
                                <span class="text-indigo-600 font-bold">01</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">HTML & CSS Fundamentals</h4>
                                <p class="text-gray-600 text-sm mt-1">Learn the building blocks of web development</p>
                                <div class="flex items-center mt-3">
                                    <div class="h-1.5 bg-gray-300 rounded-full flex-1 mr-3">
                                        <div class="h-full bg-indigo-600 rounded-full" style="width: 85%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600">85%</span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span><i class="fas fa-video mr-1"></i> 12 lectures</span>
                                    <span><i class="fas fa-clock mr-1"></i> 4h 22m</span>
                                </div>
                            </div>
                            <button class="text-gray-600 hover:text-gray-900 ml-4">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <div
                            class="module-item bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start cursor-pointer hover:border-indigo-600/30">
                            <div class="bg-indigo-600/10 p-2 rounded mr-4 mt-1">
                                <span class="text-indigo-600 font-bold">02</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">JavaScript Essentials</h4>
                                <p class="text-gray-600 text-sm mt-1">Master the language of the web</p>
                                <div class="flex items-center mt-3">
                                    <div class="h-1.5 bg-gray-300 rounded-full flex-1 mr-3">
                                        <div class="h-full bg-indigo-600 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600">65%</span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span><i class="fas fa-video mr-1"></i> 18 lectures</span>
                                    <span><i class="fas fa-clock mr-1"></i> 6h 45m</span>
                                </div>
                            </div>
                            <button class="text-gray-600 hover:text-gray-900 ml-4">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <div
                            class="module-item bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start cursor-pointer hover:border-indigo-600/30">
                            <div class="bg-indigo-600/10 p-2 rounded mr-4 mt-1">
                                <span class="text-indigo-600 font-bold">03</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Laravel Backend Development</h4>
                                <p class="text-gray-600 text-sm mt-1">Build robust web applications</p>
                                <div class="flex items-center mt-3">
                                    <div class="h-1.5 bg-gray-300 rounded-full flex-1 mr-3">
                                        <div class="h-full bg-indigo-600 rounded-full" style="width: 42%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600">42%</span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span><i class="fas fa-video mr-1"></i> 15 lectures</span>
                                    <span><i class="fas fa-clock mr-1"></i> 8h 10m</span>
                                </div>
                            </div>
                            <button class="text-gray-600 hover:text-gray-900 ml-4">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tasks Tab -->
                <div x-show="activeTab === 'tasks'" x-cloak>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Pending Assignments</h3>
                        <button class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg">
                            <i class="fas fa-plus mr-1"></i> New Task
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs uppercase bg-gray-150 text-gray-600">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Assignment</th>
                                    <th scope="col" class="px-4 py-3">Module</th>
                                    <th scope="col" class="px-4 py-3">Due Date</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-300 hover:bg-gray-200/50">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-code text-indigo-600 mr-3"></i>
                                            Create Dashboard UI
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">Laravel Backend</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-amber-600 mr-2"></i>
                                            <span>Jun 30, 2025</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="bg-amber-600/10 text-amber-600 text-xs px-2 py-1 rounded">In
                                            Progress</span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-200/50">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-database text-purple-600 mr-3"></i>
                                            Database Schema Design
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">Laravel Backend</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-green-600 mr-2"></i>
                                            <span>Jul 5, 2025</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-blue-600/10 text-blue-600 text-xs px-2 py-1 rounded">Pending</span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-200/50">
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                            User Authentication
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">Laravel Backend</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-green-600 mr-2"></i>
                                            <span>Jun 25, 2025</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-600/10 text-green-600 text-xs px-2 py-1 rounded">Completed</span>
                                    </td>
                                    <td class="px-4 py-3 text-rightPRECISION
                                        <button class="text-indigo-600
                                        hover:text-indigo-800">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Resources Tab -->
                <div x-show="activeTab === 'resources'" x-cloak>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Course Resources</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start">
                            <div class="bg-indigo-600/10 p-3 rounded-lg mr-4">
                                <i class="fas fa-file-pdf text-indigo-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Laravel Documentation</h4IPS <p
                                        class="text-gray-600 text-sm mt-1">Official Laravel 10 documentation</p>
                                    <div class="flex text-xs text-gray-500 mt-3">
                                        <span class="mr-3"><i class="far fa-file mr-1"></i> PDF</span>
                                        <span><i class="far fa-clock mr-1"></i> 1.2 MB</span>
                                        </diventery </div>
                                        <button class="ml-auto text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>

                                    <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start">
                                        <div class="bg-amber-600/10 p-3 rounded-lg mr-4">
                                            <i class="fab fa-js text-amber-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">JavaScript Cheatsheet</h4>
                                            <p class="text-gray-600 text-sm mt-1">Modern JS syntax reference</p>
                                            <div class="flex text-xs text-gray-500 mt-3">
                                                <span class="mr-3"><i class="far fa-file mr-1"></i> PDF</span>
                                                <span><i class="far fa-clock mr-1"></i> 850 KB</span>
                                            </div>
                                        </div>
                                        <button class="ml-auto text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>

                                    <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start">
                                        <div class="bg-purple-600/10 p-3 rounded-lg mr-4">
                                            <i class="fab fa-css3-alt text-purple-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Tailwind CSS Guide</h4>
                                            <p class="text-gray-600 text-sm mt-1">Complete Tailwind reference</p>
                                            <div class="flex text-xs text-gray-500 mt-3">
                                                <span class="mr-3"><i class="far fa-file mr-1"></i> PDF</span>
                                                <span><i class="far fa-clock mr-1"></i> 2.1 MB</span>
                                            </div>
                                        </div>
                                        <button class="ml-auto text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>

                                    <div class="bg-gray-150 border border-gray-300 rounded-lg p-4 flex items-start">
                                        <div class="bg-blue-600/10 p-3 rounded-lg mr-4">
                                            <i class="fas fa-video text-blue-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Alpine.js Tutorial</h4>
                                            <p class="text-gray-600 text-sm mt-1">Video tutorial collection</p>
                                            <div class="flex text-xs text-gray-500 mt-3">
                                                <span class="mr-3"><i class="far fa-file mr-1"></i> MP4</span>
                                                <span><i class="far fa-clock mr-1"></i> 350 MB</span>
                                            </div>
                                        </div>
                                        <button class="ml-auto text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Progress Card -->
                <div class="bg-white rounded-xl border border-gray-300 shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Course Progress</h3>

                    <div class="flex justify-center">
                        <div class="relative">
                            <svg class="w-40 h-40">
                                <circle class="text-gray-300" stroke-width="10" stroke="currentColor"
                                    fill="transparent" r="65" cx="80" cy="80" />
                                <circle class="text-indigo-600" stroke-width="10" stroke-linecap="round"
                                    stroke="currentColor" fill="transparent" r="65" cx="80" cy="80"
                                    stroke-dasharray="410" stroke-dashoffset="410" style="stroke-dashoffset: 164;" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <span class="text-2xl font-bold text-gray-900">60%</span>
                                    <p class="text-xs text-gray-600">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Modules Completed</span>
                            <span class="text-gray-900">8/12</span>
                        </div>
                        <div class="h-2 bg-gray-300 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-600 rounded-full" style="width: 66%"></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Assignments Done</span>
                            <span class="text-gray-900">15/20</span>
                        </div>
                        <div class="h-2 bg-gray-300 rounded-full overflow-hidden">
                            <div class="h-full bg-green-600 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Deadlines -->
                <div class="bg-white rounded-xl border border-gray-300 shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Upcoming Deadlines</h3>
                        <button class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-amber-600/10 p-2 rounded mr-3">
                                <i class="fas fa-exclamation text-amber-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Dashboard Design</h4>
                                <p class="text-gray-600 text-sm">Due in 3 days</p>
                            </div>
                            <span class="ml-auto text-amber-600 font-medium">High</span>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-blue-600/10 p-2 rounded mr-3">
                                <i class="fas fa-file-code text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">API Integration</h4>
                                <p class="text-gray-600 text-sm">Due in 5 days</p>
                            </div>
                            <span class="ml-auto text-blue-600 font-medium">Medium</span>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-600/10 p-2 rounded mr-3">
                                <i class="fas fa-database text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Database Schema</h4>
                                <p class="text-gray-600 text-sm">Due in 7 days</p>
                            </div>
                            <span class="ml-auto text-purple-600 font-medium">Low</span>
                        </div>
                    </div>

                    <button
                        class="w-full mt-6 py-2 text-center bg-gray-150 hover:bg-gray-200 border border-gray-300 text-gray-600 rounded-lg transition-colors">
                        View All Deadlines
                    </button>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl border border-gray-300 shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h3>

                    <div class="space-y-4">
                        <div class="flex">
                            <div class="mr-3">
                                <div class="bg-green-600/10 p-2 rounded-full">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Completed assignment</p>
                                <p class="text-xs text-gray-600">User Authentication</p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="mr-3">
                                <div class="bg-blue-600/10 p-2 rounded-full">
                                    <i class="fas fa-comment-alt text-blue-600"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Posted comment</p>
                                <p class="text-xs text-gray-600">On Dashboard Design</p>
                                <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="mr-3">
                                <div class="bg-indigo-600/10 p-2 rounded-full">
                                    <i class="fas fa-book-open text-indigo-600"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Started module</p>
                                <p class="text-xs text-gray-600">Laravel Backend Development</p>
                                <p class="text-xs text-gray-500 mt-1">Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
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