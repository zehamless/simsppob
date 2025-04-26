@extends('app_layout')
@section('content')
    <!-- User Profile and Balance -->
    <x-user-saldo :saldo="$saldo" :first_name="$profile['first_name']" :last_name="$profile['last_name']"
                  :avatar-src="$profile['profile_image']"/>

    <section class="p-4" x-data="{ showModal: {{ session('showModal', false) ? 'true' : 'false' }} }">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-lg shadow w-fit ">
                <img src="{{$service['service_icon']}}" alt="" srcset="">
            </div>
            <h2 class="text-2xl font-bold">{{$service['service_name']}}</h2>
        </div>
        <div class="mt-5">
            <form x-ref="payForm" action="{{route('service.post')}}" method="POST">
                @csrf
                <input type="hidden" name="service_code" value="{{$service['service_code']}}">
                <div class="col-span-4 col-start-1">
                    <input
                        type="number"
                        min="1"
                        disabled
                        name="amount"
                        value="{{$service['service_tariff']}}"
                        class="w-full py-3 px-4 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                    />
                </div>
                <button
                    type="button"
                    @click="showModal = true"
                    class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300"
                >
                    Bayar
                </button>
            </form>
        </div>

        <!-- Modal -->
        <div x-show="showModal"
             class="fixed inset-0 flex items-center justify-center z-50"
             style="background-color: rgba(0,0,0,0.1); display: none;">
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-xs w-full text-center">
                <div class="mx-auto mb-4 flex justify-center">
                    @if(session()->has('isSuccess'))
                        @if(session('isSuccess'))
                            <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500 text-4xl"></i>
                        @endif
                    @else
                        <img src="{{ asset('assets/Logo.png') }}" alt="Default Logo" class="w-10 h-10">
                    @endif
                </div>
                <p class="mb-2 text-sm font-medium">{{$service['service_name']}} senilai</p>
                <p class="mb-6 text-xl font-bold">Rp{{number_format($service['service_tariff'], 0, ',', '.')}} ?</p>
                <p class="text-sm text-gray-500 mb-4">{{session('message')}}</p>

                <div class="flex flex-col gap-3">
                    @if(session()->has('isSuccess'))
                        <a
                            href="{{ route('home') }}"
                            class="w-full py-2 text-base text-gray-500 font-medium hover:text-gray-700"
                        >Kembali ke Beranda
                        </a>
                    @else
                        <button
                            type="button"
                            @click="$refs.payForm.submit()"
                            class="w-full py-2 text-base  text-red-500 font-medium hover:text-red-700"
                        >Ya, lanjutkan Bayar
                        </button>
                        <button
                            type="button"
                            @click="showModal = false"
                            class="w-full py-2 text-base text-gray-500 font-medium hover:text-gray-700"
                        >Batalkan
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
