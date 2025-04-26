<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen items-center justify-center bg-white">

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        <div class="grid grid-cols-2">
            <div class="flex flex-col justify-center items-center">
                @yield('content')
                <div class="w-full px-4 mt-20">
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
