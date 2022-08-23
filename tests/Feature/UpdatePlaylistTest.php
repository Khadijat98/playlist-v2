<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditPlaylistTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_when_a_user_updates_their_playlist_this_overwrites_the_same_entry_in_the_database()
    {
        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com',
            'songs' => [
               (string) $song->id,
            ],
        ]);

        $this->putJson('/api/playlist/'.$playlist->id, [
            'playlist_name' =>'Another playlist',
            'created_by' =>'Me again',
            'description' =>'Another description',
            'playlist_image' => 'https://netflix.co.uk',
            'songs' => [
                (string)  $song->id,
            ]
        ]);

        $this->assertDatabaseHas('playlists', [
            'playlist_name' => 'Another playlist',
            'created_by' => 'Me again',
            'description' => 'Another description',
            'playlist_image' => 'https://netflix.co.uk',
        ]);
    }

    public function test_the_response_received_is_the_updated_playlist()
    {
        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com',
            'songs' => [
              (string)  $song->id,
            ],
        ]);

        $songB = Song::create([
            'song_name' => 'Song B',
            'song_image' => 'B',
        ]);

        $response = $this->putJson('/api/playlist/'.$playlist->id, [
            'playlist_name' =>'Another playlist',
            'created_by' =>'Me again',
            'description' =>'Another description',
            'playlist_image' => 'https://netflix.co.uk',
            'songs' =>
                [
                  (string)  $songB->id,
                ]

        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'playlist_name' => 'Another playlist',
                'created_by' => 'Me again',
                'description' => 'Another description',
                'playlist_image' => 'https://netflix.co.uk',
                'songs' => [
                    [
                        'id' => $songB->id,
                        'song_name' => 'Song B',
                        'song_image' => 'B'
                    ]
                ]
            ]
        ]);
    }

    public function test_it_throws_a_validation_error_if_songs_is_not_formatted_correctly()
    {
        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com',
            'songs' => [
               (string) $song->id,
            ],
        ]);

        $songB = Song::create([
            'song_name' => 'Song B',
            'song_image' => 'B',
        ]);

        $response = $this->putJson('/api/playlist/'.$playlist->id, [
            'playlist_name' =>'Another playlist',
            'created_by' =>'Me again',
            'description' =>'Another description',
            'playlist_image' => 'https://netflix.co.uk',
            'songs' => [
                [
                    'id' => 1,
                    'name' => 'song'
                 ]
            ]
        ]);

        $response->assertStatus(422);
    }

    public function test_songs_can_be_added()
    {
        $song = Song::create([
            'song_name' => 'Song A',
            'song_image' => 'A',
        ]);

        $playlist = Playlist::create([
            'playlist_name' => 'A playlist',
            'created_by' => 'Me',
            'description' => 'A description',
            'playlist_image' => 'https://google.com',
            'songs' => [
            ],
        ]);

        $response = $this->putJson('/api/playlist/'.$playlist->id, [
            'playlist_name' =>'Another playlist',
            'created_by' =>'Me again',
            'description' =>'Another description',
            'playlist_image' => 'https://netflix.co.uk',
            'songs' =>
                [
                  (string) $song->id,
                ]

        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'playlist_name' => 'Another playlist',
                'created_by' => 'Me again',
                'description' => 'Another description',
                'playlist_image' => 'https://netflix.co.uk',
                'songs' => [
                    [
                        'id' => $song->id,
                        'song_name' => 'Song A',
                        'song_image' => 'A'
                    ]
                ]
            ]
        ]);
    }
}
