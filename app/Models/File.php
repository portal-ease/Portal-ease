<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'filename',
        'mime_type',
        'path',
        'id',
        'visibility'
    ];
    public function download()
    {
        return response($this->path)->header('Content-Type', $this->mime_type)
            ->header('Content-Disposition', 'attachment; filename="'.$this->filename.'"');
    }
    public function getUrlAttribute()
    {
        return asset('storage/profile-pictures/' . $this->filename);
    }
}
