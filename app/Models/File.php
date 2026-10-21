<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'filename',
        'mime_type',
        'path',
        'id',
        'visibility',
        'disk',
        'shared_by',
    ];

    public function download()
    {
        return response($this->path)->header('Content-Type', $this->mime_type)
            ->header('Content-Disposition', 'attachment; filename="'.$this->filename.'"');
    }

    public function getUrlAttribute()
    {
        return asset('storage/profile-pictures/'.$this->filename);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'file_user');
    }

    public function sharedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shared_by');
    }
}
