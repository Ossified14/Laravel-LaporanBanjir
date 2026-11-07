@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Edit Laporan</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('laporan.update', $laporan) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            {{-- NAMA PELAPOR --}}
            <div class="form-group @error('nama_pelapor') has-error @enderror">
                <label class="form-label" for="nama_pelapor">Nama Pelapor <span class="required-mark">*</span></label>
                <input class="form-input" type="text" id="nama_pelapor" name="nama_pelapor"
                    value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}" maxlength="100">
                @error('nama_pelapor') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- NOMOR HP --}}
            <div class="form-group @error('no_hp') has-error @enderror">
                <label class="form-label" for="no_hp">Nomor HP <span class="required-mark">*</span></label>
                <input class="form-input" type="text" id="no_hp" name="no_hp"
                    value="{{ old('no_hp', $laporan->no_hp) }}" maxlength="20">
                @error('no_hp') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- LOKASI --}}
            <div class="form-group @error('lokasi') has-error @enderror">
                <label class="form-label" for="lokasi">Lokasi Kejadian <span class="required-mark">*</span></label>
                <input class="form-input" type="text" id="lokasi" name="lokasi"
                    value="{{ old('lokasi', $laporan->lokasi) }}" maxlength="150">
                @error('lokasi') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- KECAMATAN --}}
            <div class="form-group @error('kecamatan') has-error @enderror">
                <label class="form-label" for="kecamatan">Kecamatan <span class="required-mark">*</span></label>
                <select class="form-input" id="kecamatan" name="kecamatan">
                    @foreach (['Dayeuhkolot','Baleendah','Bojongsoang','Rancaekek','Majalaya','Ciparay','Pacet','Ibun','Paseh','Cikancung'] as $kec)
                        <option value="{{ $kec }}" {{ old('kecamatan', $laporan->kecamatan) == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- TINGGI AIR --}}
            <div class="form-group @error('tinggi_air') has-error @enderror">
                <label class="form-label" for="tinggi_air">Tinggi Air <span class="required-mark">*</span></label>
                <div class="input-with-unit">
                    <input class="form-input" type="number" id="tinggi_air" name="tinggi_air"
                        value="{{ old('tinggi_air', $laporan->tinggi_air) }}" min="1" max="500" step="0.5">
                    <span class="unit-label">cm</span>
                </div>
                @error('tinggi_air') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- KETERANGAN --}}
            <div class="form-group @error('keterangan') has-error @enderror">
                <label class="form-label" for="keterangan">Keterangan</label>
                <textarea class="form-input" id="keterangan" name="keterangan" rows="3"
                    maxlength="1000">{{ old('keterangan', $laporan->keterangan) }}</textarea>
                @error('keterangan') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- STATUS --}}
            <div class="form-group @error('status') has-error @enderror">
                <label class="form-label" for="status">Status Penanganan <span class="required-mark">*</span></label>
                <select class="form-input" id="status" name="status">
                    @foreach (['Menunggu', 'Diproses', 'Selesai'] as $s)
                        <option value="{{ $s }}" {{ old('status', $laporan->status) == $s ? 'selected' : '' }}>
                            {{ $s }}
                        </option>
                    @endforeach
                </select>
                @error('status') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- FOTO --}}
            <div class="form-group @error('foto') has-error @enderror">
                <label class="form-label" for="foto">Ganti Foto</label>
                @if ($laporan->foto)
                    <div style="margin-bottom: 0.5rem;">
                        <img src="{{ asset('storage/' . $laporan->foto) }}"
                             alt="Foto saat ini" style="height: 120px; border-radius: 6px;">
                        <p class="form-hint">Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</p>
                    </div>
                @endif
                <input class="form-input" type="file" id="foto" name="foto"
                    accept="image/jpg,image/jpeg,image/png">
                <p class="form-hint">Format: JPG/JPEG/PNG. Maksimal 2 MB.</p>
                @error('foto') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

    </div>
</div>
@endsection