@extends('layouts.app')

@section('title', 'Form Pelaporan Banjir')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">LaporBanjir</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
        <p class="card-desc">Isi formulir berikut untuk melaporkan kejadian banjir di sekitar Anda.</p>
    </div>

    <div class="card-body">

        @if (session('success'))
            @include('partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <form method="POST" action="{{ route('laporbanjir.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- NAMA PELAPOR --}}
            <div class="form-group @error('nama_pelapor') has-error @enderror">
                <label class="form-label" for="nama_pelapor">
                    Nama Pelapor <span class="required-mark">*</span>
                </label>
                <input class="form-input" type="text" id="nama_pelapor" name="nama_pelapor"
                    placeholder="Contoh: Budi Santoso"
                    value="{{ old('nama_pelapor') }}" maxlength="100" autocomplete="name">
                @error('nama_pelapor')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- NOMOR HP --}}
            <div class="form-group @error('no_hp') has-error @enderror">
                <label class="form-label" for="no_hp">
                    Nomor HP <span class="required-mark">*</span>
                </label>
                <input class="form-input" type="text" id="no_hp" name="no_hp"
                    placeholder="Contoh: 08123456789"
                    value="{{ old('no_hp') }}" maxlength="20">
                @error('no_hp')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- LOKASI --}}
            <div class="form-group @error('lokasi') has-error @enderror">
                <label class="form-label" for="lokasi">
                    Lokasi Kejadian <span class="required-mark">*</span>
                </label>
                <input class="form-input" type="text" id="lokasi" name="lokasi"
                    placeholder="Contoh: Jl. Raya Baleendah No. 10"
                    value="{{ old('lokasi') }}" maxlength="150">
                @error('lokasi')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- KECAMATAN --}}
            <div class="form-group @error('kecamatan') has-error @enderror">
                <label class="form-label" for="kecamatan">
                    Kecamatan <span class="required-mark">*</span>
                </label>
                <select class="form-input" id="kecamatan" name="kecamatan">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach (['Dayeuhkolot','Baleendah','Bojongsoang','Rancaekek','Majalaya','Ciparay','Pacet','Ibun','Paseh','Cikancung'] as $kec)
                        <option value="{{ $kec }}" {{ old('kecamatan') == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- TINGGI AIR --}}
            <div class="form-group @error('tinggi_air') has-error @enderror">
                <label class="form-label" for="tinggi_air">
                    Tinggi Air <span class="required-mark">*</span>
                </label>
                <div class="input-with-unit">
                    <input class="form-input" type="number" id="tinggi_air" name="tinggi_air"
                        placeholder="Contoh: 45" value="{{ old('tinggi_air') }}"
                        min="1" max="500" step="0.5">
                    <span class="unit-label">cm</span>
                </div>
                @error('tinggi_air')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- KETERANGAN --}}
            <div class="form-group @error('keterangan') has-error @enderror">
                <label class="form-label" for="keterangan">Keterangan Tambahan</label>
                <textarea class="form-input" id="keterangan" name="keterangan"
                    rows="3" placeholder="Deskripsikan kondisi banjir..." maxlength="1000">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- FOTO --}}
            <div class="form-group @error('foto') has-error @enderror">
                <label class="form-label" for="foto">
                    Foto Bukti <span class="required-mark">*</span>
                </label>
                <input class="form-input" type="file" id="foto" name="foto"
                    accept="image/jpg,image/jpeg,image/png">
                <p class="form-hint">Format: JPG/JPEG/PNG. Maksimal 2 MB.</p>
                @error('foto')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>
@endsection