<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\PlaylistSongsController;
use App\Http\Controllers\UpdatePlaylistController;
use App\Http\Controllers\CreateNewPlaylistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello', HelloController::class);

Route::get('/songs', SongsController::class);

Route::get('/playlists', PlaylistsController::class);

Route::post('/playlist', CreateNewPlaylistController::class);

Route::get('/playlist/{playlist}/songs', PlaylistSongsController::class);

// show the individual playlist
Route::get('/playlist/{playlist}', [PlaylistsController::class, 'show']);

// edit the individual playlist - do i need a new controller for this?
Route::get('playlist/{playlist}/edit', [PlaylistsController::class, 'edit']);

// update the individual playlist
Route::put('/playlist/{playlist}', [UpdatePlaylistController::class, 'update']);

Route::delete('/playlist/{playlist}', [PlaylistsController::class, 'delete']);
