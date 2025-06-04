<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign In| Gexton Internship Portal</title>
    <style>
        form .checkbox {
            accent-color: #f26822;
        }

        form .checkbox a {
            margin-left: auto;
            font-size: 14px;
            text-decoration: none;
            color: black;
        }

        form a:hover {
            color: #000;
        }

        .gradient-button {
            background: linear-gradient(-45deg, #fb460b, #f05826, #ff813f);
            background-size: 400% 400%;
            animation: gradientAnim 8s ease infinite;
        }

        @keyframes gradientAnim {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="flex items-center justify-center bg-gray-100" x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark bg-gray-900': darkMode === true }">

    <!-- ===== Preloader Start ===== -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @include('partials.preloader')
    {{-- <include src="./partials/preloader.html"></include> --}}
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->

    </head>

    <body class="">
        <div class="flex flex-col lg:flex-row w-full h-full lg:h-[100vh] shadow-lg bg-white rounded-lg overflow-hidden">

            <!-- Left SVG Section -->
            <div class="hidden lg:block lg:w-6/12 bg-center"
                style="display:flex; flex-direction:column; justify-content:center; align-items:center">
                <img src=" {{ asset('assets/logo/LOGOAA.png') }}"
                    style="width:100%; max-width:450px; padding-bottom:50px;">
                <img src=" {{ asset('assets/logo/courses.png') }}"
                    style="width:100%; max-width:700px; padding: 0px 15px 20px;">
                <!-- Background image only -->
            </div>

            <!-- Right Form Section -->
            <div class="w-full lg:w-6/12 flex items-center justify-center p-8 gradient-button">
                <div class="w-full max-w-lg">
                    <div class="mb-8">
                        <img src="{{ asset('assets/logo/white_logo.png') }}" alt="Logo"
                            class="mx-auto max-w-xs mb-6" />
                        <h2 class="text-4xl text-white font-bold">Sign In</h2>
                        <p class="text-sm text-gray-100">Enter your email and password to sign in!</p>
                    </div>

                    <form class="space-y-4" method="POST" action="{{ route('login.attempt') }}">
                        @csrf
                        <div>
                            <label for="email" class="block text-m font-medium text-white mb-1">Email</label>
                            <input type="email" id="email" name="email" required placeholder="info@gmail.com"
                                class="w-full bg-white px-4 py-4 border-none rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
                            @error('email')
                                <p class="text-white ms-2 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-m font-medium text-white mb-1">Password</label>
                            <div class="relative">
                                <input type="password" id="password" required placeholder="************"
                                    name="password"
                                    class="w-full bg-white px-4 py-4 border-none rounded-md pr-10 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                            </div>
                            @error('password')
                                <p class="text-white ms-2 mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <button type="submit"
                            class="w-full bg-white text-orange py-2 px-4 rounded-md text-lg font-semibold shadow-md hover:opacity-90"
                            style="color:#f05826">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- </body> --}}
        <!-- ===== Page Wrapper End ===== -->
    </body>

</html>
