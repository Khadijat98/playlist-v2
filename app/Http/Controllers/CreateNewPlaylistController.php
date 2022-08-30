<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Resources\PlaylistResource;

class CreateNewPlaylistController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'playlist_name' => 'required|max:255|string',
            // 'created_by' => 'required|max:255|string',
            'description' => 'required|max:500|string',
            'playlist_image' => 'required|max:255|url',
            'songs' => 'required|array|min:1|max:30',
            'songs.*' => 'string'
        ]);

        $validated['created_by'] = $request->user()->id;

        $playlist = Playlist::create($validated);
        $playlist->songs()->attach($validated['songs']);

        return PlaylistResource::make($playlist);
    }
}
