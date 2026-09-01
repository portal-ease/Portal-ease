<?php

namespace App\Observers;

use App\Models\Portal;
use Illuminate\Support\Facades\Cache;

class PortalObserver
{
    /**
     * Handle the Portal "created" event.
     */
    public function created(Portal $portal): void
    {
        Cache::forget("portal:{$portal->id}");
    }

    /**
     * Handle the Portal "updated" event.
     */
    public function updated(Portal $portal): void
    {
        Cache::forget("portal:{$portal->id}");
    }

    /**
     * Handle the Portal "deleted" event.
     */
    public function deleted(Portal $portal): void
    {
        Cache::forget("portal:{$portal->id}");
    }
}
