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
        $songs = file_get_contents('https://gist.githubusercontent.com/danjohnson95/2d71a6ea8a03598235de94448971f2b8/raw/aab7fbbe052d2b86dc7fd4724e2a728608ba3f83/BTS-Songs');

        $songsArray = explode("\n", $songs);

        foreach ($songsArray as $song) {
            list($name, $image) = explode(',', $song);
            DB::table('songs')-> insert([
                'song_name' => $name,
                'song_image' => $image,
            ]);
        }
    }
}
