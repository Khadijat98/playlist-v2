<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = file_get_contents('https://gist.githubusercontent.com/danjohnson95/2d71a6ea8a03598235de94448971f2b8/raw/97e2ad3c86c54fb69f2a6b0003fa885401c38db1/BTS-Songs');

        $songsArray = explode("\n", $songs);

        foreach ($songsArray as $song) {
            DB::table('songs')-> insert([
                'song_name' => $song,
                'song_image' => Str::random(10),
            ]);
        }
    }
}
