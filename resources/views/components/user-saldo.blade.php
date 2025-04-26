<section {{ $attributes->class(['p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-6']) }}>
    <div class="flex flex-col items-center md:items-start md:gap-4">
        <img
            src="https://placehold.co/80x80/gray/white?text=Avatar"
            alt="User avatar"
            class="rounded-full w-20 h-20"
        />
        <div class="flex flex-col items-center md:items-start mt-2 md:mt-0">
            <p class="text-gray-600">Selamat datang,</p>
            <h2 class="text-2xl font-bold">Kristanto Wibowo</h2>
        </div>
    </div>

    <div class="bg-red-500 text-white rounded-xl p-6 ml-6 flex-1 mt-4 md:mt-0" x-data="{showSaldo: false}">
        <p class="text-sm mb-1">Saldo anda</p>
        <template x-if="showSaldo">
            <h3 class="text-3xl font-bold mb-2">Rp 125544</h3>
        </template>
        <template x-if="!showSaldo">
            <h3 class="text-3xl font-bold mb-2">Rp •••••••</h3>
        </template>
        <button class="flex items-center text-sm" id="toggleBalance" @click="showSaldo = !showSaldo">
            <template x-if="showSaldo">
                <span>Sembunyikan Saldo</span>
            </template>
            <template x-if="!showSaldo">
                <span>Lihat Saldo</span>
            </template>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="w-4 h-4 ml-1">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        </button>
    </div>
</section>
