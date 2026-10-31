@extends('layouts.app')

@section('title', 'Login Petugas')

@section('content')
<div class="card auth-card">

    <div class="card-header">
        <h1 class="card-title">Login Petugas</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
        <p class="card-desc">Masuk menggunakan akun petugas yang terdaftar.</p>
    </div>

    <div class="card-body">

        @if (session('success'))
            @include('partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    aria-required="true"
                >
                @error('password')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>

            {{-- REMEMBER ME --}}
            <div class="form-group form-group--inline">
                <label class="form-check-label">
                    <input type="checkbox" name="remember" value="1"> Ingat saya
                </label>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Masuk</button>
                <a class="btn btn-secondary" href="{{ route('register.form') }}">Daftar Akun</a>
            </div>
        </form>
    </div>
</div>
@endsection