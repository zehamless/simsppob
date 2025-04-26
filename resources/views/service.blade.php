@extends('app_layout')
@section('content')
    <x-user-saldo/>
    <section class="p-4">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-lg bg-gray-50 shadow w-fit ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-8 h-8 text-amber-500">
                    <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold">Listrik</h2>
        </div>
        <div class="mt-5">
            <form>
                <div class="col-span-4 col-start-1">
                    <input
                        type="number"
                        min="1"
                        id="manualAmount"
                        required
                        name="amount"
                        value="{{old('amount')}}"
                        class="w-full py-3 px-4 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                        placeholder="Masukkan nominal lain (min. Rp10.000)"/>
                </div>
                <button
                    type="submit"
                    class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300"
                >
                    Bayar
                </button>
            </form>
        </div>
    </section>
@endsection
