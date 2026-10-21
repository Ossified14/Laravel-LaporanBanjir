<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporBanjirController extends Controller
{
    public function index(): View
    {
        $laporans = Laporan::all();

        return view('laporbanjir.index', compact('laporans'));
    }

    public function create(): View
    {
        return view('laporbanjir.form');
    }

    public function store(Request $request): View
    {
        $dataValid = $request->validate(
            [
                'nama'            => ['required', 'string', 'min:3', 'max:100'],
                'lokasi'          => ['required', 'string', 'max:150'],
                'tinggi_genangan' => ['required', 'numeric', 'min:1', 'max:500'],
            ],
            [
                'nama.required'            => 'Nama pelapor wajib diisi.',
                'nama.string'              => 'Nama pelapor harus berupa teks.',
                'nama.min'                 => 'Nama pelapor minimal :min karakter.',
                'nama.max'                 => 'Nama pelapor maksimal :max karakter.',
                'lokasi.required'          => 'Lokasi kejadian wajib diisi.',
                'lokasi.string'            => 'Lokasi kejadian harus berupa teks.',
                'lokasi.max'               => 'Lokasi kejadian maksimal :max karakter.',
                'tinggi_genangan.required' => 'Tinggi genangan air wajib diisi.',
                'tinggi_genangan.numeric'  => 'Tinggi genangan harus berupa angka.',
                'tinggi_genangan.min'      => 'Tinggi genangan minimal :min cm.',
                'tinggi_genangan.max'      => 'Tinggi genangan maksimal :max cm.',
            ]
        );

        $tinggi = (float) $dataValid['tinggi_genangan'];

        // Simpan ke database
        Laporan::create([
            'nama_pelapor'    => $dataValid['nama'],
            'lokasi'          => $dataValid['lokasi'],
            'tinggi_genangan' => $tinggi,
            'tanggal_kejadian'=> now()->toDateString(),
        ]);

        $tingkatBahaya = match (true) {
            $tinggi <= 30 => 'waspada',
            $tinggi <= 70 => 'siaga',
            default       => 'awas',
        };

        return view('laporbanjir.konfirmasi', [
            'nama'            => $dataValid['nama'],
            'lokasi'          => $dataValid['lokasi'],
            'tinggi_genangan' => $dataValid['tinggi_genangan'],
            'tingkat_bahaya'  => $tingkatBahaya,
        ]);
    }
}