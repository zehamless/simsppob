@extends('app_layout')
@section('content')
    <x-user-saldo/>
    <section class="p-4" x-data="{
                 transactions: [
                 { date: '2023-08-17T11:10:10.000Z', desc: 'Top Up', amount: 100000 },
                 { date: '2023-08-17T11:10:10.000Z', desc: 'Listrik', amount: -50000 },
                 { date: '2023-08-17T11:10:10.000Z', desc: 'Top Up', amount: 200000 },
                 { date: '2023-08-17T11:10:10.000Z', desc: 'Pulsa', amount: -25000 },
                 ]
                 }">
        <h2 class="text-xl font-bold mb-4">Transaction History</h2>
        <div class="space-y-4">
            <template x-for="trx in transactions" :key="trx.date + trx.desc + trx.amount">
                <div class="flex justify-between items-start p-4 bg-white shadow rounded-lg">
                    <div class="flex flex-col items-start flex-shrink-0 w-32">
                        <div
                            :class="trx.amount > 0 ? 'text-green-600' : 'text-red-600'"
                            class="font-bold text-lg"
                            x-text="(trx.amount > 0 ? '+' : '') + trx.amount.toLocaleString('id-ID')"
                        ></div>
                        <div class="text-xs text-gray-500 mt-1"
                             x-text="new Date(trx.date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })"></div>
                    </div>
                    <div class="flex-1 text-right">
                        <div class="font-semibold" x-text="trx.desc"></div>
                    </div>
                </div>
            </template>
        </div>
    </section>
@endsection
