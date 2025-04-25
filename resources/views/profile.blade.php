@extends('app_layout')
@section('content')
    <div class="my-6 flex flex-col items-center" x-data="avatarUploader()">
        <div class="relative mb-4">
            <div class="h-32 w-32 overflow-hidden rounded-full border-2 border-gray-100">
                <img
                    x-bind:src="previewUrl"
                    alt="Profile avatar"
                    class="h-full w-full object-cover"
                >
            </div>
            <label class="absolute bottom-0 right-0 rounded-full bg-white p-2 shadow-md cursor-pointer">
                <input type="file" class="hidden" @change="preview">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </label>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Kristanto Wibowo</h1>
    </div>
    <div>
        <form class="space-y-5 w-full" x-data="{ editing: false }" @submit.prevent="/* handle save here */">
            <!-- Email -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-400 text-xl">@</span>
                    </div>
                    <input
                        id="email"
                        type="email"
                        :disabled="!editing"
                        class="w-full pl-12 pr-3 py-3 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="masukan email anda"
                    >
                </div>
            </div>

            <!-- First Name -->
            <div class="space-y-1">
                <label for="firstName" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-user fa-sm text-gray-400"></i>
                    </div>
                    <input
                        id="firstName"
                        type="text"
                        :disabled="!editing"
                        class="w-full pl-12 pr-3 py-3 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="nama depan"
                    >
                </div>
            </div>

            <!-- Last Name -->
            <div class="space-y-1">
                <label for="lastName" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-user fa-sm text-gray-400"></i>
                    </div>
                    <input
                        id="lastName"
                        type="text"
                        :disabled="!editing"
                        class="w-full pl-12 pr-3 py-3 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="nama belakang"
                    >
                </div>
            </div>

            <template x-if="!editing">
                <button
                    type="button"
                    class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 mt-5"
                    @click="editing = true"
                >
                    Edit Profile
                </button>
            </template>
            <template x-if="editing">
                <button
                    type="submit"
                    class="w-full py-3 text-base bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition duration-300 mt-5"
                >
                    Save
                </button>
            </template>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function avatarUploader() {
            return {
                previewUrl: 'https://ui-avatars.com/api/?name=Sample+User&background=random',
                preview(event) {
                    const file = event.target.files[0];
                    this.previewUrl = URL.createObjectURL(file);
                },
            }
        }
    </script>
@endpush
