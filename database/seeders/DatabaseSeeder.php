<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\datapengguna::create([
            'nama_pengguna' => 'vito',
            'email' => 'vito@email.com',
            'password' => Hash::make('Vito12'),
            'role' => 'admin'
        ]);
    }
}
