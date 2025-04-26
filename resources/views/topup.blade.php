@extends('app_layout')

@section('content')
    <!-- User Profile and Balance -->
    <x-user-saldo :saldo="$saldo" :first_name="$profile['first_name']" :last_name="$profile['last_name']"
                  :avatar-src="$profile['profile_image']"/>
    <section class="p-4" x-data="{
                                                                        amount: 0,
                                                                        showModal: {{ session('showModal', false) ? 'true' : 'false' }},
                                                                        selected: null,
                                                                        setAmount(val) {
                                                                            this.amount = val;
                                                                            this.selected = val;
                                                                        },
                                                                        clearSelected() {
                                                                            this.selected = null;
                                                                        }
                                                                    }">
        <div class="my-5">
            <p class="text-gray-600">Silahkan Masukkan</p>
            <h2 class="text-2xl font-bold">Nominal Topup</h2>
        </div>
        <form method="POST" x-ref="topup" action="{{ route('topup.post') }}">
            @csrf
            <div class="grid grid-cols-7 grid-rows-3 gap-2">
                <div class="col-span-4 col-start-1">
                    <input
                        type="number"
                        min="10000"
                        id="manualAmount"
                        name="top_up_amount"
                        required
                        value="{{ old('amount') }}"
                        class="w-full py-3 px-4 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                        placeholder="Masukkan nominal lain (min. Rp10.000)"
                        x-model="amount"
                        @input="clearSelected"
                    >
                </div>
                <div class="col-span-4 col-start-1 row-start-2">
                    <button
                        type="button"
                        @click="showModal = true"
                        :disabled="amount<10000"
                        x-bind:class="(amount<10000 ? 'opacity-50 cursor-not-allowed ' : '') + (selected ? 'disabled' : '')"
                        class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300"
                    >
                        Top Up
                    </button>
                </div>
                <template x-for="nominal in {{ json_encode($nominals) }}" :key="nominal">
                    <div>
                        <button
                            type="button"
                            class="w-full p-3 text-sm border border-gray-300 rounded-md transition"
                            :class="selected == nominal ? 'bg-red-500 text-white' : 'hover:bg-red-100'"
                            @click="setAmount(nominal)"
                            x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(nominal)"
                        ></button>
                    </div>
                </template>
            </div>
        </form>
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
                <p class="mb-2 text-sm font-medium">Topup senilai</p>
                <p class="mb-6 text-xl font-bold"
                   x-text="amount ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount) : ''">
                </p>
                <p class="text-sm text-gray-500 mb-4">{{ session('message') }}</p>

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
                            @click="$refs.topup.submit()"
                            class="w-full py-2 text-base text-red-500 font-medium hover:text-red-700"
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
