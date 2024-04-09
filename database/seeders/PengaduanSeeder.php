<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengaduans = [
            [
                'masyarakat_id' => 3,
                'isi_laporan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.',
                'created_at' => now(),
            ],
        ];

        Pengaduan::insert($pengaduans);
    }
}
