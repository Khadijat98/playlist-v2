<?php

namespace Tests\Feature;

use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

// When we make a valid request, it stores a playlist in the database.
// When we make a valid request, it returns our new playlist
// When required data is missing, it returns a 422
// When required data is missing, it doesn't store anything in the database

class CreatePlaylistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_when_we_make_a_valid_request_it_stores_a_playlist_in_the_database()
    {
        $user = User::create([
            'name' => 'Dan',
            'email' => 'dan@example.com',
            'password' => Hash::make('password'),
        ]);

        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $response = $this->actingAs($user)->post('/api/playlist', [
            'playlist_name' => 'My favourite songs',
            'created_by' => 'Dan',
            'description' => 'These are all my faves',
            'playlist_image' => 'https://google.com',
            'songs' => [
               (string) $song->id,
            ],
        ]);

        $this->assertDatabaseHas('playlists', [
            'playlist_name' => 'My favourite songs',
            'description' => 'These are all my faves',
            'playlist_image' => 'https://google.com',
        ]);

        $this->assertDatabaseCount('playlist_songs', 1);
    }

    public function test_when_we_make_a_valid_request_it_returns_the_playlist()
    {
        $user = User::create([
            'name' => 'Dan',
            'email' => 'dan@example.com',
            'password' => Hash::make('password'),
        ]);

        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $response = $this->actingAs($user)->postJson('/api/playlist', [
            'playlist_name' => 'My favourite songs',
            'description' => 'These are all my faves',
            'playlist_image' => 'https://google.com',
            'songs' => [
               (string) $song->id,
            ],
        ]);

        $response->assertJson([
            'data' => [
                'playlist_name' => 'My favourite songs',
                'created_by' => $user->id,
                'description' => 'These are all my faves',
                'playlist_image' => 'https://google.com',
                'songs' => [
                    [
                        'id' => $song->id,
                        'song_name' => 'Song A',
                        'song_image' => 'A'
                    ]
                ]
            ],
        ]);
    }

    public function test_when_required_data_is_missing_a_422_is_returned()
    {
        $user = User::create([
            'name' => 'Dan',
            'email' => 'dan@example.com',
            'password' => Hash::make('password'),
        ]);

        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $response = $this->actingAs($user)->postJson('/api/playlist', [
            'created_by' => 'Dan',
            'description' => 'These are all my faves',
            'playlist_image' => 'https://google.com',
            'songs' => [
            (string) $song->id,
            ],
        ]);

        $response->assertStatus(422);
    }

    public function test_when_required_data_is_missing_nothing_is_stored_in_the_database()
    {
        $user = User::create([
            'name' => 'Dan',
            'email' => 'dan@example.com',
            'password' => Hash::make('password'),
        ]);

        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $response = $this->actingAs($user)->post('/api/playlist', [
            'description' => 'These are all my faves',
            'playlist_image' => 'https://google.com',
            'songs' => [
               (string) $song->id,
            ],
        ]);

        $this->assertDatabaseCount('playlist_songs', 0);

        $this->assertDatabaseCount('playlists', 0);
    }
}
