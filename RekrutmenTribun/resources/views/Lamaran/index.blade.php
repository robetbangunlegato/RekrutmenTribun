@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            @if (session()->get('info') === 'sukses')
                <div class="col-lg-12 col-md-12 col-sm-12 ml-3 mr-2 alert alert-success waktu-tampil" role="waktu-tampil">
                    {{ 'Lowongan berhasil di tambahkan!' }}
                </div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($lamarans as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->posisi }}</h5>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-primary">Daftar</a>
                            <a href="{{ url('lamaran/' . $item->id . '/edit') }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card h-100">
                    <a href="{{ url('lamaran/create') }}" class="btn btn-primary h-100 position-relative"
                        style="background-color: rgb(199, 199, 199); ">
                        <i class="bi bi-plus text-dark position-absolute top-50 start-50 translate-middle fs-5"
                            style=""></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
