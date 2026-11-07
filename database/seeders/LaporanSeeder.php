<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;
use Faker\Factory as Faker;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kecamatans = [
            'Dayeuhkolot',
            'Baleendah',
            'Bojongsoang',
            'Rancaekek',
            'Majalaya',
            'Ciparay',
            'Pacet',
            'Ibun',
            'Paseh',
            'Cikancung',
        ];

        for ($i = 0; $i < 15; $i++) {
            Laporan::create([
                'nama_pelapor' => $faker->name(),
                'no_hp'        => $faker->numerify('08##########'),
                'lokasi'       => 'Jl. ' . $faker->streetName(),
                'kecamatan'    => $faker->randomElement($kecamatans),
                'tinggi_air'   => $faker->numberBetween(10, 150),
                'keterangan'   => $faker->sentence(),
                'foto'         => null,
                'status'       => $faker->randomElement(['Menunggu', 'Diproses', 'Selesai']),
            ]);
        }
    }
}