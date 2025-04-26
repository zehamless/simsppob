<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('auth_api.url');
    }

    public function registration($payload)
    {
        $url = $this->baseUrl . '/registration';
        try {
            return Http::post($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function login($payload)
    {
        $url = $this->baseUrl . '/login';
        try {
            return Http::post($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function getProfile($payload, $token)
    {
        $url = $this->baseUrl . '/profile';
        try {
            return Http::withToken($token)->get($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function updateProfile($payload, $token)
    {
        $url = $this->baseUrl . '/profile';
        try {
            return Http::withToken($token)->put($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function uploadImage($payload, $token)
    {
        $url = $this->baseUrl . '/profile/image';
        try {
            return Http::withToken($token)->post($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function getBanner()
    {
        $url = $this->baseUrl . '/banner';
        try {
            return Http::get($url);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function getService($token)
    {
        $url = $this->baseUrl . '/services';
        try {
            return Http::withToken($token)->get($url);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function getBalance($token)
    {
        $url = $this->baseUrl . '/balance';
        try {
            return Http::withToken($token)->get($url);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function topup($payload, $token)
    {
        $url = $this->baseUrl . '/topup';
        try {
            return Http::withToken($token)->post($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function transaction($payload, $token)
    {
        $url = $this->baseUrl . '/transaction';
        try {
            return Http::withToken($token)->get($url, $payload);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }

    public function getTransactionHistory($token)
    {
        $url = $this->baseUrl . '/transaction/history';
        try {
            return Http::withToken($token)->get($url);
        } catch (ConnectionException $e) {
            return [
                'status' => false,
                'message' => 'Connection error: ' . $e->getMessage(),
            ];
        }
    }
}
