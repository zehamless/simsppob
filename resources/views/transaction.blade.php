@extends('app_layout')

@section('content')
    <x-user-saldo
        :saldo="$saldo"
        :first_name="$profile['first_name']"
        :last_name="$profile['last_name']"
        :avatar-src="$profile['profile_image']"
    />

    <section class="p-4" x-data="transactionHistory()">
        <h2 class="text-xl font-bold mb-4">Transaction History</h2>

        <div class="space-y-4">
            <template x-for="tx in transactions" :key="tx.invoice_number">
                <div class="flex flex-col p-4 bg-white shadow rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-bold text-lg"
                                 :class="tx.transaction_type === 'TOPUP' ? 'text-green-500' : 'text-red-500'">
                                <span x-text="tx.transaction_type === 'TOPUP' ? '+' : '-'"></span>
                                Rp<span x-text="formatAmount(tx.total_amount)"></span>
                            </div>
                            <div class="text-xs text-gray-500 mt-1" x-text="formatDate(tx.created_on)"></div>
                        </div>
                        <div class="text-right font-semibold" x-text="tx.description"></div>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="!transactions.length" class="text-center py-4 text-gray-500">
            No transactions found
        </div>

        <div class="mt-4 flex justify-center">
            <button
                class="px-4 py-2 bg-white text-red-500 rounded hover:bg-red-600 hover:text-white w-full sm:w-auto flex items-center justify-center"
                @click="showMore"
                :disabled="loading"
            >
                <span x-show="!loading">Show More</span>
                <span x-show="loading" class="flex items-center">
                                        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4" fill="none"/>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                        </svg>
                                        Loading...
                                    </span>
            </button>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('transactionHistory', () => ({
                transactions: @json($transactions, JSON_THROW_ON_ERROR | JSON_HEX_TAG),
                offset: @json($transactions, JSON_THROW_ON_ERROR | JSON_HEX_TAG).length,
                limit: 10,
                fetchUrl: '{{ route('history.get') }}',
                loading: false,

                async showMore() {
                    if (this.loading) return;
                    this.loading = true;

                    try {
                        const res = await fetch(`${this.fetchUrl}?offset=${this.offset}&limit=${this.limit}`);
                        if (!res.ok) throw new Error('Fetch failed');

                        const data = await res.json();
                        this.transactions.push(...data);
                        this.offset += data.length;
                    } catch (e) {
                        console.error(e);
                    } finally {
                        this.loading = false;
                    }
                },

                formatAmount(amount) {
                    return Number(amount).toLocaleString('id-ID', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 2
                    });
                },

                formatDate(dateStr) {
                    return new Date(dateStr).toLocaleDateString('id-ID', {
                        day: '2-digit', month: 'short', year: 'numeric',
                        hour: '2-digit', minute: '2-digit', timeZone: 'Asia/Jakarta'
                    }) + ' WIB';
                }
            }))
        });
    </script>
@endpush
