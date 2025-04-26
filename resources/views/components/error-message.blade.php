@foreach ($errors->all() as $error)
    <div x-data="{ show: true }"
         x-show="show"
         class="w-full mt-2">
        <div class="bg-red-50 text-red-400 px-4 py-2 rounded relative" role="alert">
            <button type="button"
                    class="absolute inset-y-0 right-2 flex items-center text-red-400 hover:text-red-500 text-lg font-bold focus:outline-none"
                    @click="show = false"
                    aria-label="Close">
                &times;
            </button>
            <span>{{ $error }}</span>
        </div>
    </div>
@endforeach
