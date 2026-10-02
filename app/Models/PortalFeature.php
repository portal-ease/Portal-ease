<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class PortalFeature extends Model
{
    protected $table = 'portal_features';

    protected $fillable = [
        'portal_id',
        'feature',
        'enabled',
    ];

    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
}
