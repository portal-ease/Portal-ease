<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';
    protected $fillable = [
        'title',
        'type',
    ];
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user');
    }
    public function portal()
    {
       return $this->belongsTo(Portal::class, 'portal_id');
    }

    public function otherUsers()
    {
        return $this->users()->where('users.id', '!=', auth()->id())->get();
    }
}
