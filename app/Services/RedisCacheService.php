<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Redis;

class RedisCacheService
{
    private function get(string $key): mixed
    {
        $value = Redis::get($key);

        return $value !== null ? json_decode($value, true) : null;
    }

    public function put(string $key, mixed $value, int $ttl): void
    {
        Redis::setex($key, $ttl, json_encode($value));
    }

    public function forget(string $key): void
    {
        Redis::del($key);
    }

    public function has(string $key): bool
    {
       return Redis::exists($key) > 0;
    }

    public function remember(string $key, Closure $callback, int $ttl = 1800): mixed
    {
        $cached = $this->get($key);

        if ($cached !== null) {
            return $cached;
        }

        $value = $callback();

        $this->put($key, $value, $ttl);

        return $value;
    }
}
