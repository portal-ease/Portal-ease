<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'user_id',
        'portal_id',
        'status',
        'start_date',
        'end_date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function portal()
    {
        return $this->belongsTo(Portal::class);
    }
}
