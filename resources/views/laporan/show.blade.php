@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Detail Laporan</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
    </div>
    <div class="card-body">

        @if ($laporan->foto)
            <div style="margin-bottom: 1.5rem;">
                <img src="{{ asset('storage/' . $laporan->foto) }}"
                     alt="Foto laporan" style="max-width: 100%; border-radius: 8px; max-height: 400px;">
            </div>
        @endif

        <dl class="data-list">
            <div class="data-row">
                <dt class="data-label">Nama Pelapor</dt>
                <dd class="data-value">{{ $laporan->nama_pelapor }}</dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Nomor HP</dt>
                <dd class="data-value">{{ $laporan->no_hp }}</dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Lokasi</dt>
                <dd class="data-value">{{ $laporan->lokasi }}</dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Kecamatan</dt>
                <dd class="data-value">{{ $laporan->kecamatan }}</dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Tinggi Air</dt>
                <dd class="data-value"><strong>{{ $laporan->tinggi_air }} cm</strong></dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Keterangan</dt>
                <dd class="data-value">{{ $laporan->keterangan ?? '-' }}</dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Status</dt>
                <dd class="data-value">
                    <span class="status-badge status-{{ Str::slug($laporan->status) }}">
                        {{ $laporan->status }}
                    </span>
                </dd>
            </div>
            <div class="data-row">
                <dt class="data-label">Waktu Laporan</dt>
                <dd class="data-value">
                    {{ \Carbon\Carbon::parse($laporan->created_at)->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB
                </dd>
            </div>
        </dl>

        <div class="form-actions">
            <a href="{{ route('laporan.edit', $laporan) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </div>
</div>
@endsection