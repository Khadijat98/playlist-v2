<?php

use App\Http\Controllers\CreateNewPlaylistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\SongsController;

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
