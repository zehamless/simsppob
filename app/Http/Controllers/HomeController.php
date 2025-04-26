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
        $verifyOptions = ['verify' => $this->apiService->verifySsl];
        $baseUrl = $this->apiService->baseUrl;

        $response = Http::pool(fn(Pool $pool) => [
            $pool->as('saldo')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['balance']),
            $pool->as('services')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['services']),
            $pool->as('banner')->withOptions($verifyOptions)->get($baseUrl . $this->apiService::ENDPOINTS['banner']),
            $pool->as('profile')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['profile']),
        ]);

        $services = $response['services']['data'];
        $balance = $response['saldo']['data']['balance'];
        $profile = $response['profile']['data'];
        $banners = $response['banner']['data'];

        return view('homepage', [
            'services' => $services,
            'saldo' => $balance,
            'profile' => $profile,
            'banners' => $banners,
        ]);
    }
}
