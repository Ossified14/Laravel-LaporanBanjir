<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Faker\Factory as Faker;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        $kecamatans = [
            'Dayeuhkolot',
            'Baleendah',
            'Bojongsoang',
            'Rancaekek',
            'Majalaya',
        ];
 
        for ($i = 0; $i < 15; $i++) {
            Laporan::create([
                'nama_pelapor'    => $faker->name(),
                'lokasi'          => $faker->randomElement($kecamatans),
                'tinggi_genangan' => $faker->numberBetween(10, 150),
                'tanggal_kejadian'=> $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
