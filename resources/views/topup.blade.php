@php
    use Illuminate\Support\Number;
    $nominals = [10000, 20000, 50000, 100000, 250000, 500000];
@endphp

@extends('app_layout')

@section('content')
    <x-user-saldo/>
    <section class="p-4">
        <div class="my-5">
            <p class="text-gray-600">Silahkan Masukkan</p>
            <h2 class="text-2xl font-bold">Nominal Topup</h2>
        </div>
        <form method="POST" action="#" x-data="{
                        amount: '',
                        selected: null,
                        setAmount(val) {
                            this.amount = val;
                            this.selected = val;
                        },
                        clearSelected() {
                            this.selected = null;
                        }
                    }">
            @csrf
            <div class="grid grid-cols-7 grid-rows-3 gap-2">
                <div class="col-span-4 col-start-1">
                    <input
                        type="number"
                        min="1"
                        id="manualAmount"
                        name="amount"
                        required
                        value="{{old('amount')}}"
                        class="w-full py-3 px-4 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                        placeholder="Masukkan nominal lain (min. Rp10.000)"
                        x-model="amount"
                        @input="clearSelected"
                    >
                </div>
                <div class="col-span-4 col-start-1 row-start-2">
                    <button
                        type="submit"
                        class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300"
                    >
                        Top Up
                    </button>
                </div>
                <template x-for="nominal in  {{json_encode($nominals)}}" :key="nominal">
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
    </section>
@endsection
