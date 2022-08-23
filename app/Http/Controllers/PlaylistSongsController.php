<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Resources\SongResource;

class PlaylistSongsController extends Controller
{
    public function __invoke(Playlist $playlist)
    {
        // looking at the songs relatonship of a playlist - getting all the songs for a playlist
        // more efficient because it does this in a single database query - not one by one
        return SongResource::collection($playlist->songs);
    }

    // Aug 9th Summary
    // created playlist songs controller - fetched songs for each playlist in a single database query using pivot table
        // and created endpoint for this
    // created songs resource - had to wrap api in data array and return this
    // controlled react components - added values to form inputs
    // react router navigate - instead of reloading, re-routed to page - moved useEffect in dashboard to view playlists

    // To-do
    // set up react query for getting playlists - tomorrow by myself
    // react mutations - post, patch, delete
    // hook up delete
    // feedback - toasts, notfications, alerts
    // backend tests - with Dan
    // rewrite styles in tailwind css
    // view playlists individually (view details and redirect to page for single playlist rather than show songs)
    // edit playlists - on the view page
}
