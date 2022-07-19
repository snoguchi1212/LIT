<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset("images/LIT_logo.png") }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>


    <header>
        <nav class="bg-white shadow dark:bg-gray-800">
            <div class="container px-6 py-4 mx-auto">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-semibold text-gray-700">
                            <img src={{ asset('images/LIT_logo.png') }} width="8%">
                        </div>

                        <!-- Mobile menu button -->
                        <div class="flex lg:hidden">
                            <button type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                                <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                    <div class="-mx-4 lg:flex lg:items-center">
                        <a href="{{ route('teacher.login') }}" class="whitespace-nowrap inline-block mx-2 mt-2 px-4 py-2 text-sm text-gray-700 capitalize lg:mt-0 dark:text-gray-200 border-solid border-2 border-opacity-0 hover:shadow hover:border-opacity-25 hover:border-gray-900">講師用ログイン</a>
                        <a href="{{ route('owner.login') }}" class="whitespace-nowrap inline-block mx-2 mt-2 px-4 py-2 text-sm text-gray-700 capitalize lg:mt-0 dark:text-gray-200 border-solid border-2 border-opacity-0 hover:shadow hover:border-opacity-25 hover:border-gray-900">管理者用ログイン</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="w-full bg-center bg-cover h-[32rem]" style="background-image: url({{ asset('images/study_header.jpg'); }}">
            <div class="flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-50">
                <div class="text-center">
                    <h1 class="whitespace-nowrap text-2xl font-semibold text-white uppercase lg:text-3xl">L<span class="text-gray-300">earn</span> i<span class="text-gray-300">t</span> <span class="text-gray-300">By</span> T<span class="text-gray-300">ap</span></h1>
                    <button type="button" onclick="location.href='{{ route('student.login') }}'" class="w-full px-4 py-2 mt-4 text-base uppercase transition-colors duration-200 transform bg-white hover:bg-gray-100 text-gray-800 font-semibold border border-gray-400 rounded shadow">Login</button>
                </div>
            </div>
        </div>
    </header>
</html>
