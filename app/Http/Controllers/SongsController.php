<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Resources\SongResource;

class SongsController extends Controller
{
    public function __invoke()
    {
        return SongResource::collection(
            Song::all()
        );
    }
}
