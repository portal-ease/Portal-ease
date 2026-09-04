<?php

namespace App\Models;

use App\Observers\PortalObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([PortalObserver::class])]
class Portal extends Model
{
    protected $table = 'portals';

    protected $fillable = [
        'name',
        'email',
        'branding_color',
        'primary_text_color',
        'secondary_text_color',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
