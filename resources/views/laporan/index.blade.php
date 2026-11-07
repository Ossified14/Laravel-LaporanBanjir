@extends('layouts.app')

@section('title', 'Daftar Laporan — Petugas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Daftar Laporan Banjir</h1>
            <p class="card-subtitle">BPBD Kabupaten Bandung</p>
        </div>
        <div class="card-body">

            @if (session('success'))
                @include('components.alert', ['type' => 'success', 'message' => session('success')])
            @endif

            <div style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Pelapor</th>
                            <th>Kecamatan</th>
                            <th>Tinggi Air</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $laporan)
                            <tr>
                                <td>{{ $laporans->firstItem() + $loop->index }}</td>
                                <td>
                                    @if ($laporan->foto)
                                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto laporan"
                                            class="thumbnail">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $laporan->nama_pelapor }}</td>
                                <td>{{ $laporan->kecamatan }}</td>
                                <td>{{ $laporan->tinggi_air }} cm</td>
                                <td>
                                    <span class="status-badge status-{{ Str::slug($laporan->status) }}">
                                        {{ $laporan->status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="aksi-group">
                                        <a href="{{ route('laporan.show', $laporan) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('laporan.edit', $laporan) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('laporan.destroy', $laporan) }}"
                                            onsubmit="return confirm('Hapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $laporans->links() }}
            </div>

        </div>
    </div>
@endsection
