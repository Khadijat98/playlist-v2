<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Resources\PlaylistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaylistsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->id;

        return PlaylistResource::collection(
            Playlist::where('created_by', '=', $user)->get()
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
