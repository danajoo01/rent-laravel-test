<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Film::insert([
            [
              'id'  			=> 1,
              'judul'  			=> 'Avengers: Endgame',
              'movie_id'			=> '9920392749',
              'filmby' 		=> 'Stan Lee',
              'studio'		=> 'Marvel Studios',
              'tahun'	=> '2019-04-24',
              'stok'		=> 10,
              'deskripsi'		=> 'After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.',
              'lokasi'			=> 'rak1',
              'cover'			=> '77310-2019-11-27-16-27-59.jpeg',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'judul'  			=> 'Joker',
              'movie_id'			=> '9920392749',
              'filmby' 		=> 'Todd Phillips',
              'studio'		=> 'Warner Bros. Pictures',
              'tahun'	=> '2019-10-02',
              'stok'		=> 5,
              'deskripsi'		=> 'Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Arthur wears two masks -- the one he paints for his day job as a clown, and the guise he projects in a futile attempt to feel like he s part of the world around him. Isolated, bullied and disregarded by society, Fleck begins a slow descent into madness as he transforms into the criminal mastermind known as the Joker.',
              'lokasi'			=> 'rak1',
              'cover'			=> '90854-2019-11-27-16-29-29.jpeg',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 3,
              'judul'  			=> 'Android Application',
              'movie_id'			=> '9920392749',
              'filmby' 		=> 'Eiichiro Oda',
              'studio'		=> 'Toei Animation',
              'tahun'	=> '2019-09-18',
              'stok'		=> 12,
              'deskripsi'		=> 'The world s boldest buccaneers set sail for the great Pirate Festival, where the Straw Hats join a mad-dash race to find Gol D.Roger s treasure. There s just one little problem. An old member of Roger s crew has a sinister score to settle. All bets are off when the most iconic pirates of One Piece history band together for a swashbuckling showdown, the likes of which have never been seen!.',
              'lokasi'			=> 'rak3',
              'cover'			=> '76193-2019-11-27-16-31-19.jpg',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
