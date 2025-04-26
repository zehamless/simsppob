<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ApiService
{
    public const ENDPOINTS = [
        'registration' => '/registration',
        'login' => '/login',
        'profile' => '/profile',
        'profile_image' => '/profile/image',
        'banner' => '/banner',
        'services' => '/services',
        'balance' => '/balance',
        'topup' => '/topup',
        'transaction' => '/transaction',
        'transaction_history' => '/transaction/history',
    ];

    public mixed $baseUrl;
    public bool $verifySsl;

    public function __construct()
    {
        $this->baseUrl = config('auth_api.url');
        $this->verifySsl = !config('app.debug');
    }

    private function makeRequest(string $method, string $endpoint, array $payload = [], string $token = null): array|\Illuminate\Http\Client\Response
    {
        $url = $this->baseUrl . $endpoint;

        try {
            $request = Http::withOptions(['verify' => $this->verifySsl]);

            if ($token) {
                $request = $request->withToken($token);
            }

            return $request->$method($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function registration(array $payload): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('post', self::ENDPOINTS['registration'], $payload);
    }

    public function login(array $payload): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('post', self::ENDPOINTS['login'], $payload);
    }

    public function getProfile(array $payload, string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['profile'], $payload, $token);
    }

    public function updateProfile(array $payload, string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('put', self::ENDPOINTS['profile'], $payload, $token);
    }

    public function uploadImage(array $payload, string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('post', self::ENDPOINTS['profile_image'], $payload, $token);
    }

    public function getBanner(): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['banner']);
    }

    public function getService(string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['services'], [], $token);
    }

    public function getBalance(string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['balance'], [], $token);
    }

    public function topup(array $payload, string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('post', self::ENDPOINTS['topup'], $payload, $token);
    }

    public function transaction(array $payload, string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['transaction'], $payload, $token);
    }

    public function getTransactionHistory(string $token): array|\Illuminate\Http\Client\Response
    {
        return $this->makeRequest('get', self::ENDPOINTS['transaction_history'], [], $token);
    }
}
