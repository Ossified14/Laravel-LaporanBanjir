<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    // Publik: form laporan warga
    public function create()
    {
        return view('laporbanjir.form');
    }

    // Publik: simpan laporan warga
    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'nama_pelapor' => ['required', 'string', 'min:3', 'max:100'],
            'no_hp'        => ['required', 'string', 'max:20'],
            'lokasi'       => ['required', 'string', 'max:150'],
            'kecamatan'    => ['required', 'string', 'max:100'],
            'tinggi_air'   => ['required', 'numeric', 'min:1', 'max:500'],
            'keterangan'   => ['nullable', 'string', 'max:1000'],
            'foto'         => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'nama_pelapor.min'      => 'Nama pelapor minimal :min karakter.',
            'no_hp.required'        => 'Nomor HP wajib diisi.',
            'lokasi.required'       => 'Lokasi kejadian wajib diisi.',
            'kecamatan.required'    => 'Kecamatan wajib diisi.',
            'tinggi_air.required'   => 'Tinggi air wajib diisi.',
            'tinggi_air.numeric'    => 'Tinggi air harus berupa angka.',
            'tinggi_air.min'        => 'Tinggi air minimal :min cm.',
            'foto.required'         => 'Foto bukti wajib diunggah.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Format foto harus jpg, jpeg, atau png.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ]);

        $fotoPath = $request->file('foto')->store('laporan', 'public');

        Laporan::create([
            'nama_pelapor' => $dataValid['nama_pelapor'],
            'no_hp'        => $dataValid['no_hp'],
            'lokasi'       => $dataValid['lokasi'],
            'kecamatan'    => $dataValid['kecamatan'],
            'tinggi_air'   => $dataValid['tinggi_air'],
            'keterangan'   => $dataValid['keterangan'] ?? null,
            'foto'         => $fotoPath,
            'status'       => 'Menunggu',
        ]);

        return redirect()->route('laporbanjir.create')
            ->with('success', 'Laporan banjir berhasil dikirim. Terima kasih!');
    }
}