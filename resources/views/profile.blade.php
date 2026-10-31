@extends('layouts.app')

@section('title', 'Profil Petugas')

@section('content')
<div class="card">

    <div class="card-header">
        <h1 class="card-title">Profil Petugas</h1>
        <p class="card-subtitle">BPBD Kabupaten Bandung</p>
    </div>

    <div class="card-body">
        <h2 class="section-title">Informasi Akun</h2>

        <dl class="data-list">
            <div class="data-row">
                <dt class="data-label">Nama</dt>
                <dd class="data-value">{{ Auth::user()->name }}</dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Email</dt>
                <dd class="data-value">{{ Auth::user()->email }}</dd>
            </div>

            <div class="data-row">
                <dt class="data-label">Akun Dibuat</dt>
                <dd class="data-value">
                    {{ \Carbon\Carbon::parse(Auth::user()->created_at)
                        ->locale('id')
                        ->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB
                </dd>
            </div>
        </dl>

        <div class="form-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection