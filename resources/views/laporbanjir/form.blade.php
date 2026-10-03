@extends('layouts.app')

@section('title', 'Form Pelaporan Banjir')

@section('content')
<div class="card">

    <div class="card-header">
        <h1 class="card-title">LaporBanjir</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
        <p class="card-desc">
            Isi formulir berikut untuk melaporkan kejadian banjir di sekitar Anda.
        </p>
    </div>

    <div class="card-body">
        <form
            id="form-laporan"
            method="POST"
            action="{{ route('laporbanjir.store') }}"
            novalidate
        >
            @csrf

            {{-- ===== NAMA PELAPOR ===== --}}
            <div class="form-group @error('nama') has-error @enderror">
                <label class="form-label" for="nama">
                    Nama Pelapor <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="text"
                    id="nama"
                    name="nama"
                    placeholder="Contoh: Budi Santoso"
                    value="{{ old('nama') }}"
                    maxlength="100"
                    autocomplete="name"
                    aria-describedby="nama-error"
                    aria-required="true"
                >
                {{-- Pesan error validasi untuk field nama --}}
                @error('nama')
                    <p class="form-error" id="nama-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===== LOKASI KEJADIAN ===== --}}
            <div class="form-group @error('lokasi') has-error @enderror">
                <label class="form-label" for="lokasi">
                    Lokasi Kejadian (Kecamatan/Desa) <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="text"
                    id="lokasi"
                    name="lokasi"
                    placeholder="Contoh: Kec. Baleendah, Desa Andir"
                    value="{{ old('lokasi') }}"
                    maxlength="150"
                    aria-describedby="lokasi-error"
                    aria-required="true"
                >
                {{-- Pesan error validasi untuk field lokasi --}}
                @error('lokasi')
                    <p class="form-error" id="lokasi-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===== TINGGI GENANGAN ===== --}}
            <div class="form-group @error('tinggi_genangan') has-error @enderror">
                <label class="form-label" for="tinggi_genangan">
                    Tinggi Genangan Air <span class="required-mark" aria-hidden="true">*</span>
                </label>

                {{-- Input + satuan berdampingan --}}
                <div class="input-with-unit">
                    <input
                        class="form-input"
                        type="number"
                        id="tinggi_genangan"
                        name="tinggi_genangan"
                        placeholder="Contoh: 45"
                        value="{{ old('tinggi_genangan') }}"
                        min="1"
                        max="500"
                        step="0.5"
                        aria-describedby="tinggi-error tinggi-hint"
                        aria-required="true"
                    >
                    <span class="unit-label">cm</span>
                </div>

                {{-- Indikator bahaya real-time — diisi oleh JS, berupa teks berwarna --}}
                <div id="indikator-bahaya" class="bahaya-badge bahaya-hidden" aria-live="polite"></div>

                <p class="form-hint" id="tinggi-hint">
                    Skala: &lt;30 cm = Rendah &bull; 30&ndash;100 cm = Sedang &bull; &gt;100 cm = Tinggi
                </p>

                {{-- Pesan error validasi untuk field tinggi_genangan --}}
                @error('tinggi_genangan')
                    <p class="form-error" id="tinggi-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===== TOMBOL KIRIM ===== --}}
            <div class="form-actions">
                <button class="btn btn-primary" type="submit" id="btn-kirim">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


