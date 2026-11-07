<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::latest()->paginate(10);
        return view('laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'status'       => ['required', 'in:Menunggu,Diproses,Selesai'],
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'nama_pelapor.min'      => 'Nama pelapor minimal :min karakter.',
            'no_hp.required'        => 'Nomor HP wajib diisi.',
            'lokasi.required'       => 'Lokasi kejadian wajib diisi.',
            'kecamatan.required'    => 'Kecamatan wajib diisi.',
            'tinggi_air.required'   => 'Tinggi air wajib diisi.',
            'tinggi_air.numeric'    => 'Tinggi air harus berupa angka.',
            'foto.required'         => 'Foto bukti wajib diunggah.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Format foto harus jpg, jpeg, atau png.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
            'status.required'       => 'Status wajib dipilih.',
            'status.in'             => 'Status tidak valid.',
        ]);

        $dataValid['foto'] = $request->file('foto')->store('laporan', 'public');

        Laporan::create($dataValid);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        $dataValid = $request->validate([
            'nama_pelapor' => ['required', 'string', 'min:3', 'max:100'],
            'no_hp'        => ['required', 'string', 'max:20'],
            'lokasi'       => ['required', 'string', 'max:150'],
            'kecamatan'    => ['required', 'string', 'max:100'],
            'tinggi_air'   => ['required', 'numeric', 'min:1', 'max:500'],
            'keterangan'   => ['nullable', 'string', 'max:1000'],
            'status'       => ['required', 'in:Menunggu,Diproses,Selesai'],
            'foto'         => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'nama_pelapor.min'      => 'Nama pelapor minimal :min karakter.',
            'no_hp.required'        => 'Nomor HP wajib diisi.',
            'lokasi.required'       => 'Lokasi kejadian wajib diisi.',
            'kecamatan.required'    => 'Kecamatan wajib diisi.',
            'tinggi_air.required'   => 'Tinggi air wajib diisi.',
            'tinggi_air.numeric'    => 'Tinggi air harus berupa angka.',
            'status.required'       => 'Status wajib dipilih.',
            'status.in'             => 'Status tidak valid.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Format foto harus jpg, jpeg, atau png.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $dataValid['foto'] = $request->file('foto')->store('laporan', 'public');
        } else {
            unset($dataValid['foto']);
        }

        $laporan->update($dataValid);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
