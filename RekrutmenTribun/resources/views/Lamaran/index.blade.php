@extends('Navbar.index')
@section('content')
    {{-- membuat ukuran lamaran fix --}}
    <style>
        .tambah-lamaran {
            width: 390, 4px;
            height: 545px;
        }
    </style>

    {{-- alert --}}
    <div class="container">
        <div class="row">
            <div class="container">
                @if (session()->has('info'))
                    <div class="alert alert-success alert-dismissible fade show col-lg-12 col-md-12 col-sm-12" role="alert">
                        {{ session()->get('info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>



    {{-- body --}}
    <div class="container">
        <div class="row">
            @foreach ($lamarans as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="..." width="401px"
                            height="401px" style="object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->posisi }}</h5>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-footer">
                            {{-- buttton daftar --}}
                            @if (auth()->user()->role == 'non-admin')
                                <a href="{{ route('lamaran.show', ['id' => $item->id]) }}"
                                    class="btn btn-primary col-12">Daftar</a>
                            @endif

                            <div class="row">

                                @if (auth()->user()->role == 'admin')
                                    <div class="col-4">
                                        {{-- button daftar/buka --}}
                                        <a href="{{ route('lamaran.show', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-block">Buka</a>
                                    </div>
                                    <div class="col-4">
                                        {{-- button edit --}}
                                        <a href="{{ url('lamaran/' . $item->id . '/edit') }}"
                                            class="btn btn-warning btn-block">Edit</a>
                                    </div>
                                    <div class="col-4">
                                        {{-- button hapus --}}
                                        <button class="btn btn-danger btn-hapus btn-block" id-lowongan="{{ $item->id }}"
                                            posisi-lowongan="{{ $item->posisi }}" data-toggle="modal"
                                            data-target="#HapusModal">Hapus</button>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            @if (auth()->user()->role == 'admin')
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 fixed-h">
                    <div class="card tambah-lamaran">
                        <a href="{{ url('lamaran/create') }}" class="btn btn-secondary h-100 position-relative">
                            <i class="bi bi-plus text-dark position-absolute top-50 start-50 translate-middle text-white"
                                style="font-size: 70px"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
    {{-- HTML modal hapus --}}
    @include('modal')
    {{-- javascript modal hapus --}}
    <script src="js/dinamisteksmodal.js"></script>
@endsection
