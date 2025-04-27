<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ApiService
{
    private const ENDPOINTS = [
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

    private const METHODS = [
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

    /**
     * @param string $endpoint
     * @return string
     */
    private function getMethod(string $endpoint): string
    {
        return self::METHODS[$endpoint] ?? 'get';
    }

    /**
     * @param string $endpoint
     * @return bool
     */
    private function isAuthRequired(string $endpoint): bool
    {
        return !in_array($endpoint, self::PUBLIC_ENDPOINTS);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array|UploadedFile $payload
     * @param string|null $token
     * @return array|null
     */
    private function makeRequest(string $method, string $endpoint, array|UploadedFile $payload = [], ?string $token = null): ?array
    {
        $url = $this->baseUrl . $endpoint;

        try {
            $request = Http::withOptions(['verify' => $this->verifySsl]);

            if ($token) {
                $request = $request->withToken($token);
            }

            if ($payload instanceof UploadedFile) {
                $response = $request->attach('file', file_get_contents($payload->getRealPath()), $payload->getClientOriginalName())
                    ->{$method}($url);
            } else {
                $response = $request->$method($url, $payload);
            }

            if ($response->unauthorized()) {
                session()?->invalidate();
                session()?->regenerate();
                return ['status' => false, 'message' => 'Unauthorized'];
            }

            return [
                'status' => true,
                'data' => $response->json('data'),
                'message' => $response->json('message'),
            ];
        } catch (ConnectionException $e) {
            return ['status' => false, 'message' => 'Connection error: ' . $e->getMessage()];
        }
    }

    /**
     * @param array $endpoints
     * @param string|null $token
     * @param array $payloads
     * @return array
     */
    public function makePooledRequests(array $endpoints, ?string $token = null, array $payloads = []): array
    {
        $responses = Http::pool(function (Pool $pool) use ($endpoints, $token, $payloads) {
            foreach ($endpoints as $alias => $endpoint) {
                $alias = is_numeric($alias) ? basename($endpoint) : $alias;
                $endpointPath = self::ENDPOINTS[$endpoint] ?? $endpoint;
                $method = $this->getMethod($endpointPath);
                $requiresAuth = $this->isAuthRequired($endpointPath);
                $payload = $payloads[$alias] ?? [];
                $url = $this->baseUrl . $endpointPath;

                $request = $pool->as($alias)->withOptions(['verify' => $this->verifySsl]);
                if ($requiresAuth && $token) {
                    $request = $request->withToken($token);
                }

                $request->$method($url, $payload);
            }
        });
        foreach ($responses as $response) {
            if ($response->unauthorized()) {
                session()?->invalidate();
                session()?->regenerate();
            }
        }

        return $responses;

    }

    /**
     * @param array $payload
     * @return array|null
     */
    public function registration(array $payload): ?array
    {
        return $this->makeRequest('post', self::ENDPOINTS['registration'], $payload);
    }

    /**
     * @param array $payload
     * @return array|null
     */
    public function login(array $payload): ?array
    {
        return $this->makeRequest('post', self::ENDPOINTS['login'], $payload);
    }

    /**
     * @param string $token
     * @return array|null
     */
    public function getProfile(string $token): ?array
    {
        return $this->makeRequest('get', self::ENDPOINTS['profile'], [], $token);
    }

    /**
     * @param array $payload
     * @param string $token
     * @return array|null
     */
    public function updateProfile(array $payload, string $token): ?array
    {
        return $this->makeRequest('put', self::ENDPOINTS['profile_update'], $payload, $token);
    }

    /**
     * @param UploadedFile $payload
     * @param string $token
     * @return array|null
     */
    public function uploadImage(UploadedFile $payload, string $token): ?array
    {
        return $this->makeRequest('put', self::ENDPOINTS['profile_image'], $payload, $token);
    }

    /**
     * @param array $payload
     * @param string $token
     * @return array|null
     */
    public function topup(array $payload, string $token): ?array
    {
        return $this->makeRequest('post', self::ENDPOINTS['topup'], $payload, $token);
    }

    /**
     * @param array $payload
     * @param string $token
     * @return array|null
     */
    public function transaction(array $payload, string $token): ?array
    {
        return $this->makeRequest('post', self::ENDPOINTS['transaction'], $payload, $token);
    }

    /**
     * @param string $token
     * @param array $payload
     * @return array|null
     */
    public function getTransactionHistory(string $token, array $payload): ?array
    {
        return $this->makeRequest('get', self::ENDPOINTS['transaction_history'], $payload, $token);
    }
}
