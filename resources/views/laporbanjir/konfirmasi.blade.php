@extends('layouts.app')

@section('title', 'Konfirmasi Laporan')

@section('content')
<div class="card">

    <div class="card-header card-header--success">
        <h1 class="card-title">Laporan Terkirim</h1>
        <p class="card-subtitle">
            Laporan banjir Anda telah diterima dan akan ditindaklanjuti
            oleh petugas BPBD Kabupaten Bandung.
        </p>
    </div>

    <div class="card-body">
        <h2 class="section-title">Ringkasan Laporan</h2>

        <dl class="data-list">
            <div class="data-row">
                <dt class="data-label">Nama Pelapor</dt>
                <dd class="data-value">{{ $nama }}</dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Lokasi Kejadian</dt>
                <dd class="data-value">{{ $lokasi }}</dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Tinggi Genangan</dt>
                <dd class="data-value"><strong>{{ $tinggi_genangan }} cm</strong></dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Tingkat Bahaya</dt>
                <dd class="data-value">
                    {{--
                        Badge teks tingkat bahaya.
                        Kelas CSS (bahaya-rendah / bahaya-sedang / bahaya-tinggi)
                        mengontrol warna latar dan teks — tanpa emoji.
                    --}}
                    <span class="bahaya-badge bahaya-{{ $tingkat_bahaya }}">
                        @switch($tingkat_bahaya)
                            @case('waspada')  Waspada (&lt;= 30 cm)       @break
                            @case('siaga')  Siaga (31 &ndash; 70 cm) @break
                            @case('awas')  Awas (&gt; 70 cm)      @break
                        @endswitch
                    </span>
                </dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Waktu Pelaporan</dt>
                <dd class="data-value">
                    {{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB
                </dd>
            </div>
        </dl>

        {{-- Tombol kembali ke form --}}
        <div class="form-actions">
            <a class="btn btn-secondary" href="{{ route('laporbanjir.create') }}">
                Buat Laporan Baru
            </a>
        </div>
    </div>
</div>
@endsection
