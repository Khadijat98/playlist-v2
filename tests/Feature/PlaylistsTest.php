<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaylistsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;

    public function test_the_user_can_see_all_playlists()
    {
        // Some tests that could be run
            // can the user view all playlists?
            // does it output each song?

        $playlist = Playlist::create([
            'playlist_name' => 'Happy Hits',
            'created_by' => "Khadijat",
            'description' => "Songs to put a smile on your face!",
            'playlist_image' => "https://google.com"
        ]);

        $response = $this->getJson('/api/playlists');

        $response->assertJson([
            "data" => [
                [
                    'playlist_name' => 'Happy Hits',
                    'created_by' => "Khadijat",
                    'description' => "Songs to put a smile on your face!",
                    'playlist_image' => "https://google.com"
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_the_user_can_see_their_selected_songs()
    {
        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'https://google.com'
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'Happy Hits',
            'created_by' => "Khadijat",
            'description' => "Songs to put a smile on your face!",
            'playlist_image' => "https://google.com"
        ]);

        $playlist->songs()->attach($song->id);

        $response = $this->getJson('/api/playlists');

        $response->assertStatus(200);

        // just checking it contains the things we say - not everything (use assertJsonExact for this)
        $response->assertJson([
            'data' => [
                [
                    'songs' => [
                        [
                            'id' => $song->id,
                        ]
                    ]
                ]
            ]
        ]);

    }
}
