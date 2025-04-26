<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen items-center justify-center bg-white">

    <!-- Page Content -->
    <main>
        <div class="grid grid-cols-2">
            <div class="flex flex-col justify-center items-center">
                @yield('content')
                <div class="w-full px-6 mt-20">
                    <x-error-message/>
                </div>
            </div>
            <div class="bg-gray-50">
                <img src="{{asset('assets/Illustrasi Login.png')}}" class="h-full w-full object-cover"
                     alt="Login Illustration">
            </div>
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>
