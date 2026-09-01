<?php

namespace App\Context;

use App\Models\Portal;

class CurrentPortal
{
    private ?Portal $portal = null;

    public function set(Portal $portal): void
    {
        $this->portal = $portal;
    }

    public function get(): Portal
    {
        return $this->portal;
    }
}
