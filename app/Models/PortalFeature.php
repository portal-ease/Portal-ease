<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortalFeature extends Model
{
    protected $table = 'portal_features';

    protected $fillable = [
        'portal_id',
        'feature',
        'enabled',
    ];

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
        ];
    }

    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
}
