<?php

namespace App\View\Components;

use App\Models\Portal;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $portal;

    public array $features;

    public function __construct($portal)
    {
        $this->portal = $portal;
        $this->features = $this->portalFeatures($portal);
    }

    public function portalFeatures(Portal $portal): array
    {
        return $portal->features()->pluck('enabled', 'feature')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.app-layout', ['portal' => $this->portal]);
    }
}
