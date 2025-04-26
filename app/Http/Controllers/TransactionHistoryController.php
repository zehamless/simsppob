<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionHistoryController extends Controller
{

    public function __construct(private readonly ApiService $apiService)
    {
    }

    public function index()
    {

        $token = session('token');
        $verifyOptions = ['verify' => $this->apiService->verifySsl];
        $baseUrl = $this->apiService->baseUrl;

        $response = Http::pool(fn(Pool $pool) => [
            $pool->as('saldo')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['balance']),
            $pool->as('profile')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['profile']),
            $pool->as('transaction')->withOptions($verifyOptions)->withToken($token)->get($baseUrl . $this->apiService::ENDPOINTS['transaction_history'], [
                'offset' => 0,
                'limit' => 10,
            ]),
        ]);
        $profile = $response['profile']['data'] ?? [
            'first_name' => '',
            'last_name' => '',
            'profile_image' => '',
        ];

        $saldo = $response['saldo']['data']['balance'];
        $transactions = $response['transaction']['data']['records'] ?? [];
        return view('transaction', [
            'profile' => $profile,
            'saldo' => $saldo,
            'transactions' => $transactions,
        ]);
    }

    public function getTransactions(Request $request)
    {
        $validated = $request->validate([
            'offset' => 'required|integer',
            'limit' => 'required|integer',
        ]);

        $token = session('token');
        $response = $this->apiService->getTransactionHistory(token: $token, payload: $validated);
        if ($response->successful()) {
            return response()->json($response['data']['records'] ?? []);
        }
        return response()->json([]);
    }
}
