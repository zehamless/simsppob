@extends('app_layout')
@section('content')
    <div class="my-6 flex flex-col items-center" x-data="avatarUploader()">
        <div class="relative mb-4">
            <div
                class="h-32 w-32 overflow-hidden rounded-full border-4 @error('image') border-red-500 @else border-gray-50 @enderror">
                <img
                    :src="previewUrl"
                    alt="Profile avatar"
                    class="h-full w-full object-cover"
                    onerror="this.onerror=null;this.src='{{ asset('assets/Profile Photo.png') }}';"
                >
                <form x-ref="avatarForm" action="{{ route('profile.image') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <input x-ref="hiddenFileInput" type="file" name="image" class="hidden">
                </form>
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
        <h1 class="text-2xl font-bold text-gray-800">{{$profile['first_name']. ' '. $profile['last_name']}}</h1>
    </div>
    <div>
        <form x-ref="profileForm" class="space-y-5 w-full"
              x-data="{ editing: {{ session('isEditing', false) ? 'true' : 'false' }} }"
              action="{{route('profile.post')}}" method="POST">
            @csrf
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
                        name="email"
                        value="{{old('email', $profile['email'])}}"
                        disabled
                        class="w-full pl-12 pr-3 py-3 text-base border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none"
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
                        name="first_name"
                        value="{{old('first_name', $profile['first_name'])}}"
                        :disabled="!editing"
                        class="w-full pl-12 pr-3 py-3 text-base border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none"
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
                        name="last_name"
                        value="{{old('last_name', $profile['last_name'])}}"
                        :disabled="!editing"
                        class="w-full pl-12 pr-3 py-3 text-base border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none"
                        placeholder="nama belakang"
                    >
                </div>
            </div>

            <template x-if="!editing">
                <div>
                    <button
                        type="button"
                        class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 mt-5"
                        @click="editing = true"
                    >
                        Edit Profile
                    </button>
         <form method="POST" action="{{ route('logout') }}">
             @csrf
             <button
                 type="submit"
                 class="w-full py-3 text-base bg-white text-red-500 font-semibold rounded-md mt-5 border hover:bg-gray-100"
             >
                 Logout
             </button>
         </form>
                </div>
            </template>
            <template x-if="editing">
                <div>
                    <button
                        type="submit"
                        class="w-full py-3 text-base bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition duration-300 mt-5"
                    >
                        Save
                    </button>
                    <button
                        type="button"
                        @click="editing = false"
                        class="w-full py-3 text-base bg-white text-red-500 font-semibold rounded-md mt-5 border hover:bg-gray-100"
                    >
                        Kembali
                    </button>
                </div>
            </template>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('avatarUploader', () => ({
                previewUrl: '{{ $profile['profile_image'] }}',
                preview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);

                        this.$refs.hiddenFileInput.files = dataTransfer.files;

                        this.previewUrl = URL.createObjectURL(file);
                        this.$refs.avatarForm.submit();
                    }
                }

            }));
        })
    </script>
@endpush
