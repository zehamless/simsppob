@extends('auth.auth_layout')
@section('content')
    <div class="grid grid-cols-2">
        <div class="flex justify-center py-12">
            <div class="w-full max-w-md justify-center">
                <div class="flex items-center gap-3 justify-center">
                    <img src="{{asset('assets/Logo.png')}}">
                    <h1 class="font-bold text-2xl">SIMRS</h1>
                </div>
                <div class="m-8 justify-center items-center">
                    <h2 class="text-2xl font-bold text-center"> Lengkapi data untuk membuat akun</h2>
                </div>
                <div>
                    <form>

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
