<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Gexton Internship Portal
    </title>
    <link rel="icon" href="{{ asset('assets/logo/fav_icon.png') }}" type="image/png" />
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
    <style>
        .swal2-container {
            z-index: 100000000 !important;
        }
    </style>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    @include('partials.preloader')


    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        @auth

            <!-- ===== Sidebar Start ===== -->
            @include('partials.sidebar')
        @endauth
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

            <!-- Small Device Overlay Start -->
            @include('partials.overlay')
            <!-- Small Device Overlay End -->
            @auth
                <!-- ===== Header Start ===== -->
                @include('partials.header')
                <!-- ===== Header End ===== -->
            @endauth
            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    {{-- <div class="grid grid-cols-12 gap-4 md:gap-6"> --}}
                    {{ $slot }}
                    {{-- </div> --}}
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->


    </div>
    @livewireScripts
    @stack('script')
    <!-- ===== Page Wrapper End ===== -->

</body>

</html>
