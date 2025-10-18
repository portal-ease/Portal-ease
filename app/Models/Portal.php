<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    protected $table = 'portals';
    protected $fillable = [
        "name",
        "email",
        "branding_color",
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
