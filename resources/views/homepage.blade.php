@extends('app_layout')

@section('content')
    <!-- User Profile and Balance -->
    <x-user-saldo :saldo="$saldo" :first_name="$profile['first_name']" :last_name="$profile['last_name']"
                  :avatar-src="$profile['profile_image']"/>

    <!-- Services Grid -->
    <div class="grid grid-cols-4 md:grid-cols-6 gap-4 p-4 items-start">
        @foreach($services as $service)
            <a href="#"
               class="flex flex-col items-center justify-center p-3">
                <div class="p-2 rounded-lg hover:shadow">
                    <img src="{{$service['service_icon']}}" alt="">
                </div>
                <span class="text-xs mt-1 text-center text-gray-600">{{$service['service_name']}}</span>
            </a>
        @endforeach

    </div>

    <!-- Banner Section -->
    <section class="p-4">
        <h3 class="font-medium mb-4">Temukan promo menarik</h3>

        <div class="flex overflow-x-auto gap-4 pb-4 -mx-4 px-4">
            @foreach($banners as $banner)
                <div class="flex-shrink-0">
                    <img src="{{$banner['banner_image']}}" alt="{{$banner['banner_name']}}" class="rounded-xl w-full h-32 object-cover">
                </div>
            @endforeach
        </div>
    </section>
@endsection
