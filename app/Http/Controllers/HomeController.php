<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct(private readonly ApiService $apiService)
    {
    }

    public function __invoke()
    {
        $token = session('token');
        $endpoints = [
            'balance' => 'balance',
            'services' => 'services',
            'banner' => 'banner',
            'profile' => 'profile',
        ];
        $response = $this->apiService->makePooledRequests(endpoints: $endpoints, token: $token);
        $services = $response['services']['data'] ?? [];
        $balance = $response['balance']['data']['balance'] ?? 0;
        $profile = $response['profile']['data'] ?? [
            'first_name' => '',
            'last_name' => '',
            'profile_image' => '',
        ];
        $banners = $response['banner']['data'] ?? [];
        return view('homepage', [
            'services' => $services,
            'saldo' => $balance,
            'profile' => $profile,
            'banners' => $banners,
        ]);
    }
}
