<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;
    protected bool $verifySsl;

    public function __construct()
    {
        $this->baseUrl = config('auth_api.url');
        $this->verifySsl = !config('app.debug');
    }

    private function makeRequest($method, $endpoint, $payload = [], $token = null): ?array
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

    public function registration($payload): ?array
    {
        return $this->makeRequest('post', '/registration', $payload);
    }

    public function login($payload): ?array
    {
        return $this->makeRequest('post', '/login', $payload);
    }

    public function getProfile($payload, $token): ?array
    {
        return $this->makeRequest('get', '/profile', $payload, $token);
    }

    public function updateProfile($payload, $token): ?array
    {
        return $this->makeRequest('put', '/profile', $payload, $token);
    }

    public function uploadImage($payload, $token): ?array
    {
        return $this->makeRequest('post', '/profile/image', $payload, $token);
    }

    public function getBanner(): ?array
    {
        return $this->makeRequest('get', '/banner');
    }

    public function getService($token): ?array
    {
        return $this->makeRequest('get', '/services', [], $token);
    }

    public function getBalance($token): ?array
    {
        return $this->makeRequest('get', '/balance', [], $token);
    }

    public function topup($payload, $token): ?array
    {
        return $this->makeRequest('post', '/topup', $payload, $token);
    }

    public function transaction($payload, $token): ?array
    {
        return $this->makeRequest('get', '/transaction', $payload, $token);
    }

    public function getTransactionHistory($token): ?array
    {
        return $this->makeRequest('get', '/transaction/history', [], $token);
    }
}
