<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white">
<div class="min-h-screen bg-white">
    <!-- Full-width border under header -->
    <div class="w-full border-b">
        <div class="max-w-screen-md mx-auto">
            <!-- Header -->
            <header class="flex justify-between items-center p-4">
                <a href="{{route('home')}}" class="flex items-center">
                    <img src="{{asset('assets/Logo.png')}}" alt="" srcset="">
                    <span class="ml-2 font-semibold">SIMS PPOB</span>
                </a>
                <nav class="flex gap-6">
                    <a href="{{ route('topup') }}"
                       class="text-sm {{ request()->routeIs('topup') ? 'font-bold text-red-500 underline' : '' }}">
                        Top Up
                    </a>
                    <a href="{{ route('history') }}"
                       class="text-sm {{ request()->routeIs('history') ? 'font-bold text-red-500 underline' : '' }}">
                        Transaction
                    </a>
                    <a href="{{ route('profile') }}"
                       class="text-sm {{ request()->routeIs('profile') ? 'font-bold text-red-500 underline' : '' }}">
                        Akun
                    </a>
                </nav>
            </header>
        </div>
    </div>

    <!-- Flash Messages and Content -->
    <div class="max-w-screen-md mx-auto">
        @if (session('success'))
            <div class="mt-4 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mt-4 px-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <main class="pb-20">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
