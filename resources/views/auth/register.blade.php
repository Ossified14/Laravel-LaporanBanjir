@extends('layouts.app')

@section('title', 'Daftar Akun Petugas')

@section('content')
<div class="card auth-card">

    <div class="card-header">
        <h1 class="card-title">Daftar Akun Petugas</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
        <p class="card-desc">Buat akun untuk mengakses sistem pengelolaan laporan banjir.</p>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAMA --}}
            <div class="form-group @error('name') has-error @enderror">
                <label class="form-label" for="name">
                    Nama Lengkap <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Contoh: Budi Santoso"
                    value="{{ old('name') }}"
                    maxlength="100"
                    autocomplete="name"
                    aria-required="true"
                >
                @error('name')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="form-group @error('email') has-error @enderror">
                <label class="form-label" for="email">
                    Email <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Contoh: petugas@bpbd.go.id"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    aria-required="true"
                >
                @error('email')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="form-group @error('password') has-error @enderror">
                <label class="form-label" for="password">
                    Password <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    aria-required="true"
                >
                @error('password')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">
                    Konfirmasi Password <span class="required-mark" aria-hidden="true">*</span>
                </label>
                <input
                    class="form-input"
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    aria-required="true"
                >
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Daftar</button>
                <a class="btn btn-secondary" href="{{ route('login.form') }}">Sudah punya akun</a>
            </div>
        </form>
    </div>
</div>
@endsection