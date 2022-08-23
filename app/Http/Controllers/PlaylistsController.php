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

    public function delete(Playlist $playlist)
    {
        $playlist->delete();

        return response(null, 204);
    }

    public function show(Playlist $playlist)
    {
        return Playlist::with(['songs'])->findOrFail($playlist->id);
    }

    public function edit(Playlist $playlist)
    {
        return Playlist::with(['songs'])->find($playlist->id);
    }
}
