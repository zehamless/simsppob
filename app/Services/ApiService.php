<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ApiService
{
    public const ENDPOINTS = [
        'registration' => '/registration',
        'login' => '/login',
        'profile' => '/profile',
        'profile_image' => '/profile/image',
        'profile_update' => '/profile/update',
        'banner' => '/banner',
        'services' => '/services',
        'balance' => '/balance',
        'topup' => '/topup',
        'transaction' => '/transaction',
        'transaction_history' => '/transaction/history',
    ];

    private const ENDPOINT_METHODS = [
        '/registration' => 'post',
        '/login' => 'post',
        '/profile' => 'get',
        '/profile/image' => 'put',
        '/profile/update' => 'put',
        '/banner' => 'get',
        '/services' => 'get',
        '/balance' => 'get',
        '/topup' => 'post',
        '/transaction' => 'post',
        '/transaction/history' => 'get',
    ];

    private const PUBLIC_ENDPOINTS = [
        '/registration',
        '/login',
        '/banner',
    ];

    private string $baseUrl;
    private bool $verifySsl;

    public function __construct()
    {
        $this->baseUrl = config('auth_api.url');
        $this->verifySsl = !config('app.debug');
    }

    private function getMethod(string $endpoint): string
    {
        return self::ENDPOINT_METHODS[$endpoint] ?? 'get';
    }

    private function isAuthRequired(string $endpoint): bool
    {
        return !in_array($endpoint, self::PUBLIC_ENDPOINTS);
    }

    private function makeRequest(string $method, string $endpoint, array|UploadedFile $payload = [], ?string $token = null)
    {
        $url = $this->baseUrl . $endpoint;

        try {
            $request = Http::withOptions(['verify' => $this->verifySsl]);

            if ($token) {
                $request = $request->withToken($token);
            }

            if ($payload instanceof UploadedFile) {
                return $request->attach('file', file_get_contents($payload->getRealPath()), $payload->getClientOriginalName())
                    ->{$method}($url);
            }

            return $request->$method($url, $payload);
        } catch (ConnectionException $e) {
            return ['status' => false, 'message' => 'Connection error: ' . $e->getMessage()];
        }
    }

    public function makePooledRequests(array $endpoints, ?string $token = null, array $payloads = []): array
    {
        return Http::pool(function (Pool $pool) use ($endpoints, $token, $payloads) {
            $pooledRequests = [];

            foreach ($endpoints as $alias => $endpoint) {
                $alias = is_numeric($alias) ? basename($endpoint) : $alias;

                $endpointPath = self::ENDPOINTS[$endpoint] ?? $endpoint;

                $method = $this->getMethod($endpointPath);

                $requiresAuth = $this->isAuthRequired($endpointPath);

                $payload = $payloads[$alias] ?? [];

                $request = $pool->as($alias)->withOptions(['verify' => $this->verifySsl]);

                if ($requiresAuth && $token) {
                    $request = $request->withToken($token);
                }

                $url = $this->baseUrl . $endpointPath;

                if ($method === 'get') {
                    $pooledRequests[] = $request->get($url, $payload);
                } else if ($method === 'post') {
                    $pooledRequests[] = $request->post($url, $payload);
                } else if ($method === 'put') {
                    $pooledRequests[] = $request->put($url, $payload);
                } else if ($method === 'delete') {
                    $pooledRequests[] = $request->delete($url, $payload);
                }
            }

            return $pooledRequests;
        });
    }

    public function registration(array $payload)
    {
        return $this->makeRequest('post', self::ENDPOINTS['registration'], $payload);
    }

    public function login(array $payload)
    {
        return $this->makeRequest('post', self::ENDPOINTS['login'], $payload);
    }

    public function getProfile(string $token)
    {
        return $this->makeRequest('get', self::ENDPOINTS['profile'], [], $token);
    }

    public function updateProfile(array $payload, string $token)
    {
        return $this->makeRequest('put', self::ENDPOINTS['profile_update'], $payload, $token);
    }

    public function uploadImage(UploadedFile $payload, string $token)
    {
        return $this->makeRequest('put', self::ENDPOINTS['profile_image'], $payload, $token);
    }

    public function getBanner()
    {
        return $this->makeRequest('get', self::ENDPOINTS['banner']);
    }

    public function getService(string $token)
    {
        return $this->makeRequest('get', self::ENDPOINTS['services'], [], $token);
    }

    public function getBalance(string $token)
    {
        return $this->makeRequest('get', self::ENDPOINTS['balance'], [], $token);
    }

    public function topup(array $payload, string $token)
    {
        return $this->makeRequest('post', self::ENDPOINTS['topup'], $payload, $token);
    }

    public function transaction(array $payload, string $token)
    {
        return $this->makeRequest('post', self::ENDPOINTS['transaction'], $payload, $token);
    }

    public function getTransactionHistory(string $token, array $payload)
    {
        return $this->makeRequest('get', self::ENDPOINTS['transaction_history'], $payload, $token);
    }
}
