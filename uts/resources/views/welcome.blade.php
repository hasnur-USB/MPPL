@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="display-4 fw-bold">Workshop Laravel untuk Pemula</h1>
        <h2 class="text-muted">Batch April 2026</h2>
        <p class="lead">Kuota terbatas! Daftar sekarang sebelum penuh.</p>

        <div class="d-grid gap-3 col-8 mx-auto mt-5" style="max-width: 400px;">
            <a href="{{ route('daftar') }}" class="btn btn-success btn-lg py-3">
                📝 DAFTAR SEKARANG
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg py-3">
                🔑 ADMIN LOGIN
            </a>
        </div>
    </div>
</div>
@endsection