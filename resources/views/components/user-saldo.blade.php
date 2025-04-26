@props(['saldo', 'first_name', 'last_name', 'avatarSrc'])

<section {{ $attributes->class(['p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-6']) }}>
    <div class="flex flex-col items-center md:items-start md:gap-4">
        <img
            src="{{ $avatarSrc }}"
            alt="User avatar"
            class="rounded-full w-20 h-20"
            onerror="this.onerror=null;this.src='{{ asset('assets/Profile Photo.png') }}';"
        />
        <div class="flex flex-col items-center md:items-start mt-2 md:mt-0">
            <p class="text-gray-600">Selamat datang,</p>
            <h2 class="text-2xl font-bold">{{ $first_name . ' ' . $last_name }}</h2>
        </div>
    </div>

    <div class="bg-red-500 text-white rounded-xl p-6 ml-6 flex-1 mt-4 md:mt-0" x-data="{showSaldo: false}">
        <p class="text-sm mb-1">Saldo anda</p>
        <template x-if="showSaldo">
            <h3 class="text-3xl font-bold mb-2">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
        </template>
        <template x-if="!showSaldo">
            <h3 class="text-3xl font-bold mb-2">Rp •••••••</h3>
        </template>
        <button class="flex items-center text-sm cursor-pointer" id="toggleBalance" @click="showSaldo = !showSaldo">
            <template x-if="showSaldo">
                                        <span>
                                            Sembunyikan Saldo
                                            <i class="fas fa-eye-slash ml-1"></i>
                                        </span>
            </template>
            <template x-if="!showSaldo">
                                        <span>
                                            Lihat Saldo
                                            <i class="fas fa-eye ml-1"></i>
                                        </span>
            </template>
        </button>
    </div>
</section>
