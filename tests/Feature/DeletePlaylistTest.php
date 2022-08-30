<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePlaylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;

    public function test_the_playlist_is_removed_from_the_database_when_deleted_by_the_user()
    {
        $user = User::create([
            'name' => 'Khadijat',
            'email' => 'khadijat@example.com',
            'password' => Hash::make('password'),
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com'
        ]);

        $response = $this->actingAs($user)->deleteJson('/api/playlist/' . $playlist->id);

        $this->assertDatabaseCount('playlists', 0);

        $response->assertStatus(204);
    }
}
