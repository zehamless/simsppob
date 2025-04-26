<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class PayServiceController extends Controller
{


    public function __construct(private readonly ApiService $apiService)
    {
    }

    public function index($serviceCode)
    {
        $token = session('token');
        $verifyOptions = ['verify' => $this->apiService->verifySsl];
        $baseUrl = $this->apiService->baseUrl;

        $response = Http::pool(fn(Pool $pool) => [
            $pool->as('saldo')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['balance']),
            $pool->as('services')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['services']),
            $pool->as('profile')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['profile']),
        ]);
        $profile = $response['profile']['data'] ?? [
            'first_name' => '',
            'last_name' => '',
            'profile_image' => '',
        ];
        $service = collect($response['services']['data'])->firstWhere('service_code', $serviceCode) ?? [
            'service_code' => 'invalid',
            'service_name' => 'Invalid Service',
            'service_icon' => asset('assets/Pulsa.png'),
            'description' => '',
            'service_tariff' => null,
        ];

        $saldo = $response['saldo']['data']['balance'];
        return view('service', ['service' => $service, 'profile' => $profile, 'saldo' => $saldo]);
    }

    public function payService(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'service_code' => 'required|string',
        ]);
        $token = session('token');
        $response = $this->apiService->transaction($validated, token: $token);
        if ($response->successful()){
            return redirect()->back()->with([
                'isSuccess'=> true,
                'message' => 'Berhasil',
                'showModal' => true,
            ]);
        }
        return redirect()->back()->with([
            'isSuccess'=> false,
            'message' => $response->json('message'),
            'showModal' => true,
        ]);
    }
}
