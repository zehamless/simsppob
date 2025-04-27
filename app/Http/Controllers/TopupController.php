<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Exception;
use Illuminate\Http\RedirectResponse;

class TopupController extends Controller
{
    private const NOMINALS = [10000, 20000, 50000, 100000, 250000, 500000];

    public function __construct(private readonly ApiService $apiService)
    {
    }

    public function index()
    {
        $token = session('token');

        $endpoints = [
            'balance' => 'balance',
            'profile' => 'profile',
        ];
        $response = $this->apiService->makePooledRequests($endpoints, $token);
        $profile = $response['profile']['data'] ?? [
            'first_name' => '',
            'last_name' => '',
            'profile_image' => '',
        ];

        $saldo = $response['balance']['data']['balance'];
        return view('topup', [
            'profile' => $profile,
            'saldo' => $saldo,
            'nominals' => self::NOMINALS,
        ]);
    }

    public function topup(): ?RedirectResponse
    {
        try {
            $validated = request()->validate([
                'top_up_amount' => 'required|integer|min:10000'
            ]);
            $token = session('token');
            $response = $this->apiService->topup($validated, token: $token);
            if ($response['status']) {
                return redirect()->back()->with([
                    'isSuccess' => true,
                    'message' => 'Berhasil',
                    'showModal' => true,
                ]);
            }
            return redirect()->back()->with([
                'isSuccess' => false,
                'message' => 'Gagal',
                'showModal' => true,
            ]);
        } catch (Exception) {
            return redirect()->back()->with([
                'isSuccess' => false,
                'message' => 'Gagal',
                'showModal' => true,
            ]);
        }
    }
}
