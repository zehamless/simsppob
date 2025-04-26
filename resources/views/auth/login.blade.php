@extends('auth.auth_layout')
@section('content')
    <div class="grid grid-cols-2">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-lg justify-center">
                <x-app_logo/>
                <div class="m-8 justify-center items-center">
                    <h2 class="text-2xl font-bold text-center">Lengkapi data untuk membuat akun</h2>
                </div>
                <div>
                    <form class="space-y-5 w-full" action="{{route('register.post')}}" method="POST">
                        @csrf
                        <!-- Email -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-400 text-xl">@</span>
                            </div>
                            <input
                                type="email"
                                name="email"
                                class="w-full pl-12 pr-3 py-3 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="masukan email anda"
                            >
                        </div>


                        <!-- Password with Alpine.js -->
                        <div class="relative" x-data="{ showPassword: false }">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-lock fa-sm text-gray-400"></i>
                            </div>
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                class="w-full pl-12 pr-12 py-3 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="buat password"
                            >
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-3"
                                @click="showPassword = !showPassword"
                            >
                                <i :class="showPassword ? 'fas fa-eye-slash fa-sm' : 'fas fa-eye fa-sm'"
                                   class="text-gray-400"></i>
                            </button>
                        </div>

                        <!-- Register Button -->
                        <button
                            type="submit"
                            class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 mt-5"
                        >
                            Registrasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-gray-50">
            <img src="{{asset('assets/Illustrasi Login.png')}}" class="h-full w-full object-cover"
                 alt="Login Illustration">
        </div>
    </div>
@endsection
