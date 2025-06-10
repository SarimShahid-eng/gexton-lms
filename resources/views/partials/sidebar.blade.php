
    <aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
        class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
        <!-- SIDEBAR HEADER -->
        <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
            class="flex items-center gap-2 pt-8 sidebar-header pb-7">
            <a href="index.html">
                <span class="logo font-bold dark:text-gray-200" :class="sidebarToggle ? 'hidden' : ''">
                    GEXTON NEW LMS PORTAL

                </span>

            </a>
        </div>
        <!-- SIDEBAR HEADER -->

        <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
            <!-- Sidebar Menu -->
            <nav x-data="{ selected: $persist('Dashboard') }">
                <!-- Menu Group -->
                <div>
                    <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                        <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                            MENU
                        </span>

                        <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                            class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                fill="" />
                        </svg>
                    </h3>

                    <ul class="flex flex-col gap-4 mb-6">
                        @role('admin')
                            <!-- Menu Item Dashboard -->
                            <li>
                                <a href="{{ route('dashboard') }}" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    'menu-item-active' => request()->routeIs('dashboard'),
                                ])>
                                    <svg @class([
                                        'menu-item-icon-inactive',
                                        'menu-item-icon-active' => request()->routeIs('dashboard'),
                                    ]) width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                            fill="" />
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Dashboard
                                    </span>

                                </a>


                            </li>

                            <!-- Menu Item Dashboard -->

                            <!-- Menu Item Course -->
                            <li>
                                <a href="" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')" class="menu-item group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Courses
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Course -->
                            <!-- Menu Item Group -->
                            <li>
                                <a href="" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')" class="menu-item group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Groups
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Group -->
                            <!-- Menu Item Group -->
                            <li>
                                <a href="" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    // 'menu-item-active' => ,
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Students
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Group -->
                            <!-- Menu Item Group -->
                            <li>
                                <a href="" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Teacher
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Group -->

                            <li>
                                <a href="" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    // 'menu-item-active' ,
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                    </svg>


                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Questions
                                    </span>
                                </a>
                            </li>
                            <!-- Menu Item Group -->
                            <li>
                                <a href="#" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    // 'menu-item-active' => request()->routeIs('show_result'),
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                    </svg>


                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Result
                                    </span>
                                </a>
                            </li>
                        @endrole
                        @role('teacher')
                            <li>
                                <a href="{{ route('teacher.students') }}" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    'menu-item-active' => request()->routeIs('teacher.students'),
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>


                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Students
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('teacher.task') }}" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    'menu-item-active' => request()->routeIs('teacher.task'),
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                    </svg>



                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Task
                                    </span>
                                </a>
                            </li>
                        @endrole
                        @role('student')
                            <li>
                                <a href="{{ route('students.create_task') }}" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    'menu-item-active' => request()->routeIs('students.create_task'),
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                    </svg>



                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Task List
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('students.upload_task') }}" @class([
                                    'menu-item',
                                    'group',
                                    'menu-item-inactive',
                                    'menu-item-active' => request()->routeIs('students.upload_task'),
                                ])
                                    @click="selected = (selected === 'Calendar' ? '':'Calendar')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                    </svg>




                                    <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                        Upload Task
                                    </span>
                                </a>
                            </li>
                        @endrole
                        <!-- Menu Item Group -->

                    </ul>
                </div>


            </nav>
            <!-- Sidebar Menu -->


        </div>
    </aside>
