@extends('app_layout')

@section('content')
    <!-- User Profile and Balance -->
    <x-user-saldo/>

    <!-- Services Grid -->
    <div class="grid grid-cols-4 md:grid-cols-6 gap-4 p-4">
        <!-- PBB -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-emerald-500">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">PBB</span>
        </a>

        <!-- Listrik -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-amber-500">
                    <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Listrik</span>
        </a>

        <!-- Pulsa -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-indigo-500">
                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                    <path d="M12 18h.01"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Pulsa</span>
        </a>

        <!-- PDAM -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-blue-500">
                    <path
                        d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 15a7 7 0 0 0 7 7z"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">PDAM</span>
        </a>

        <!-- PGN -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-red-500">
                    <path
                        d="M12 12c2-2.96 0-7-1-8 0 3.038-1.773 4.741-3 6-1.226 1.26-2 3.24-2 5a6 6 0 1 0 12 0c0-1.532-1.056-3.94-2-5-1.786 3-2 4-4 2Z"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">PGN</span>
        </a>

        <!-- TV Langganan -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-purple-500">
                    <rect width="20" height="15" x="2" y="7" rx="2" ry="2"></rect>
                    <polyline points="17 2 12 7 7 2"></polyline>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">TV Langganan</span>
        </a>

        <!-- Musik -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-pink-500">
                    <path d="M9 18V5l12-2v13"></path>
                    <circle cx="6" cy="18" r="3"></circle>
                    <circle cx="18" cy="16" r="3"></circle>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Musik</span>
        </a>

        <!-- Voucher Game -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-green-500">
                    <line x1="6" x2="10" y1="11" y2="11"></line>
                    <line x1="8" x2="8" y1="9" y2="13"></line>
                    <line x1="15" x2="15.01" y1="12" y2="12"></line>
                    <line x1="18" x2="18.01" y1="10" y2="10"></line>
                    <rect width="20" height="12" x="2" y="6" rx="2"></rect>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Voucher Game</span>
        </a>

        <!-- Voucher Makanan -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-blue-700">
                    <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                    <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                    <line x1="6" x2="6" y1="2" y2="4"></line>
                    <line x1="10" x2="10" y1="2" y2="4"></line>
                    <line x1="14" x2="14" y1="2" y2="4"></line>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Voucher Makanan</span>
        </a>

        <!-- Kurban -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-gray-600">
                    <path
                        d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Kurban</span>
        </a>

        <!-- Zakat -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-emerald-600">
                    <circle cx="8" cy="8" r="6"></circle>
                    <path d="M18.09 10.37A6 6 0 1 1 10.34 18"></path>
                    <path d="M7 6h1v4"></path>
                    <path d="m16.71 13.88.7.71-2.82 2.82"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Zakat</span>
        </a>

        <!-- Paket Data -->
        <a href="#"
           class="flex flex-col items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="w-6 h-6 text-cyan-500">
                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                </svg>
            </div>
            <span class="text-xs mt-1 text-center">Paket Data</span>
        </a>
    </div>

    <!-- Promo Section -->
    <section class="p-4">
        <h3 class="font-medium mb-4">Temukan promo menarik</h3>

        <div class="flex overflow-x-auto gap-4 pb-4 -mx-4 px-4">
            <!-- Promo 1 -->
            <div class="bg-red-500 text-white rounded-xl p-4 min-w-[280px] flex-shrink-0">
                <h4 class="font-bold text-lg mb-1">Saldo Gratis!</h4>
                <p class="text-xs mb-4 max-w-[200px]">Saldo SIMS PPOB gratis maksimal Rp25.000 untuk pengguna
                    pertama</p>
                <a href="#" class="text-xs underline">Lihat detail</a>
            </div>

            <!-- Promo 2 -->
            <div class="bg-pink-300 text-gray-800 rounded-xl p-4 min-w-[280px] flex-shrink-0">
                <h4 class="font-bold text-lg mb-1">Diskon listrik!</h4>
                <p class="text-xs mb-4 max-w-[200px]">diskon untuk setiap pembayaran listrik prabyar pelanggan 10%</p>
                <a href="#" class="text-xs underline">Lihat detail</a>
            </div>

            <!-- Promo 3 -->
            <div class="bg-blue-400 text-white rounded-xl p-4 min-w-[280px] flex-shrink-0">
                <h4 class="font-bold text-lg mb-1">Promo makan!</h4>
                <p class="text-xs mb-4 max-w-[200px]">dapatkan voucher makan di restoran favorit anda dengan melakukan
                    transaksi disini</p>
                <a href="#" class="text-xs underline">Lihat detail</a>
            </div>

            <!-- Promo 4 -->
            <div class="bg-gray-200 text-gray-800 rounded-xl p-4 min-w-[280px] flex-shrink-0">
                <h4 class="font-bold text-lg mb-1">Cashback 25%</h4>
                <p class="text-xs mb-4 max-w-[200px]">untuk setiap pembayaran voucher game diatas Rp100.000</p>
                <a href="#" class="text-xs underline">Lihat detail</a>
            </div>

            <!-- Promo 5 -->
            <div class="bg-amber-200 text-gray-800 rounded-xl p-4 min-w-[280px] flex-shrink-0">
                <h4 class="font-bold text-lg mb-1">Buy 1 Get 2!</h4>
                <p class="text-xs mb-4 max-w-[200px]">Gratis dua tiket bioskop untuk setiap pembelian satu tiket
                    pembelian</p>
                <a href="#" class="text-xs underline">Lihat detail</a>
            </div>
        </div>
    </section>
@endsection
