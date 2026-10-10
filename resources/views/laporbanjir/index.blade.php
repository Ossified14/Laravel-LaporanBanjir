@extends('layouts.app')

@section('title', 'Daftar Laporan Banjir')

@section('content')
<div class="container-laporan">
    <div class="laporan-grid">
        {{-- Loop data laporan menggunakan @forelse --}}
        @forelse ($laporans as $laporan)
            
            {{-- Menggunakan partial view dengan @include --}}
            @include('partials.laporan-card', ['laporan' => $laporan])
            
        @empty
            <div class="laporan-empty">
                <p>Belum ada laporan banjir yang masuk saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection