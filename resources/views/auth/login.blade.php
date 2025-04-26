@extends('auth.auth_layout')
@section('content')
    <div class="w-full max-w-lg justify-center">
        <x-app_logo/>
        <div class="m-8 justify-center items-center">
            <h2 class="text-2xl font-bold text-center">Lengkapi data untuk membuat akun</h2>
        </div>
        <div>
            <form class="space-y-5 w-full" action="{{route('login.post')}}" method="POST">
                @csrf
                <!-- Email -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="@error('email') text-red-500 @else text-gray-400 @enderror text-xl">@</span>
                    </div>
                    <input
                            type="email"
                            name="email"
                            required
                            value="{{old('email')}}"
                            class="w-full pl-12 pr-3 py-3 text-base border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none"
                            placeholder="masukan email anda"
                    >
                </div>

                <!-- Password with Alpine.js -->
                <div class="relative" x-data="{ showPassword: false }">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-lock fa-sm @error('password') text-red-500 @else text-gray-400 @enderror"></i>
                    </div>
                    <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            class="w-full pl-12 pr-12 py-3 text-base border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none"
                            placeholder="buat password"
                    >
                    <button
                            type="button"
                            class="absolute inset-y-0 right-0 flex items-center pr-3"
                            @click="showPassword = !showPassword"
                    >
                        <i :class="showPassword ? 'fas fa-eye-slash fa-sm' : 'fas fa-eye fa-sm'"
                           class="@error('password') text-red-500 @else text-gray-400 @enderror"></i>
                    </button>
                </div>

                <!-- Login Button -->
                <button
                        type="submit"
                        class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 mt-5"
                >
                    Login
                </button>
            </form>
        </div>
    </div>

@endsection
