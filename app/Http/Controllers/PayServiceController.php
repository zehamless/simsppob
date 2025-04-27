<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayServiceController extends Controller
{


    public function __construct(private readonly ApiService $apiService)
    {
    }

    public function index($serviceCode)
    {
        $token = session('token');

        $endpoints = [
            'balance' => 'balance',
            'profile' => 'profile',
            'services' => 'services',
        ];
        $response = $this->apiService->makePooledRequests($endpoints, $token);
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

        $saldo = $response['balance']['data']['balance'];
        return view('service', ['service' => $service, 'profile' => $profile, 'saldo' => $saldo]);
    }

    public function payService(Request $request)
    {
        try {
            $validated = $request->validate([
                'service_code' => 'required|string',
            ]);
            $token = session('token');
            $response = $this->apiService->transaction($validated, token: $token);
            if ($response['status']) {
                return redirect()->back()->with([
                    'isSuccess' => true,
                    'message' => 'Berhasil',
                    'showModal' => true,
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'isSuccess' => false,
                'message' => $response['message'] ?? 'Gagal',
                'showModal' => true,
            ]);
        }
    }
}
