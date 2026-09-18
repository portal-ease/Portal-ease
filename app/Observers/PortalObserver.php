<?php

namespace App\Observers;

use App\Models\Portal;
use App\Services\RedisCacheService;

class PortalObserver
{
    public function __construct(
        private readonly RedisCacheService $cache
    ) {}

    /**
     * Handle the Portal "created" event.
     */
    public function created(Portal $portal): void
    {
        $this->cache->forget("portal:{$portal->id}");
    }

    /**
     * Handle the Portal "updated" event.
     */
    public function updated(Portal $portal): void
    {
        $this->cache->forget("portal:{$portal->id}");
    }

    /**
     * Handle the Portal "deleted" event.
     */
    public function deleted(Portal $portal): void
    {
        $this->cache->forget("portal:{$portal->id}");
    }
}
