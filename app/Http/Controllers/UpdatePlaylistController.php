<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePlaylistRequest;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Resources\PlaylistResource;

class UpdatePlaylistController extends Controller
{
    public function update(UpdatePlaylistRequest $request, Playlist $playlist)
    {
        $validated = $request->validated();

        $playlist->songs()->detach();
        $playlist->songs()->attach($validated['songs']);
        $playlist->fill($validated)->save();

        return PlaylistResource::make($playlist);
    }
}
