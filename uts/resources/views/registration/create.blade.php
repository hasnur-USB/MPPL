@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Form Pendaftaran Workshop Laravel</div>
                    <div class="card-body">
                        <form action="{{ route('daftar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Isi form sesuai validation di controller -->
                            @include('registrations.form-fields') <!-- kita buat partial nanti -->
                            <button type="submit" class="btn btn-success w-100">Kirim Pendaftaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
