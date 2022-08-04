<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaylistsController extends Controller
{
    public function __invoke()
    {
        return PlaylistResource::collection(
            Playlist::all()
        );
    }
}
