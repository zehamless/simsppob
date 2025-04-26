<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\ApiService
 */
class ApiService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\ApiService::class;
    }
}
