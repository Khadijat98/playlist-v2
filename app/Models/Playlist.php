<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_name',
        'created_by',
        'description',
        'playlist_image'
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_songs');
    }
}
