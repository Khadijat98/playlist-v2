<?php

namespace Tests\Feature;

use App\Models\Playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com'
        ]);

        $response = $this->deleteJson('/api/playlist/' . $playlist->id);

        $this->assertDatabaseCount('playlists', 0);

        $response->assertStatus(204);
    }
}
