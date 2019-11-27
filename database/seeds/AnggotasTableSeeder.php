<?php

use Illuminate\Database\Seeder;

class AnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Anggota::insert([
            [
              'id'  			=> 1,
              'user_id'  		=> 1,
              'id_number'				=> 69696969,
              'nama' 			=> 'Admin',
              'age'	=> '24',
              'date_created'		=> '2019-01-01',
              'jk'				=> 'L',
              'alamat'			=> 'Cirebon Indonesia',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'user_id'  		=> 2,
              'id_number'				=> 6669666,
              'nama' 			=> 'User',
              'age'	=> '24',
              'date_created'		=> '2019-01-01',
              'jk'				=> 'L',
              'alamat'			=> 'Cirebon Indonesia',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
