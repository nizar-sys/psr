<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);
        $users = [
            [
                'nik' => '3273456789',
                'name' => 'masyarakat',
                'email' => 'masyarakat@mail.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'no_telp' => '08356789',
                'alamat' => 'Jl. Masyarakat No. 1'
            ],
        ];

        User::insert($users);
        $this->call(PengaduanSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
