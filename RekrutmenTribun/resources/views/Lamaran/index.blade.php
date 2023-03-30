@extends('Navbar.index')
@section('content')
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
                {{-- @dd($item->id) --}}
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
                            <a href="{{ route('lamaran.show', ['id' => $item->id]) }}" class="btn btn-primary">Daftar</a>
                            {{-- button edit --}}
                            <a href="{{ url('lamaran/' . $item->id . '/edit') }}" class="btn btn-warning">Edit</a>
                            {{-- button hapus --}}
                            <button class="btn btn-danger btn-hapus" id-lowongan="{{ $item->id }}"
                                posisi-lowongan="{{ $item->posisi }}" data-toggle="modal"
                                data-target="#HapusModal">Hapus</button>
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

    {{-- HTML modal hapus --}}
    @include('modal')
    {{-- javascript modal hapus --}}
    <script src="js/dinamisteksmodal.js"></script>

    {{-- script mengambil id card yang dipilih dan mengirimnya ke DaftarController --}}
    <script>
        $('.btn-kirimID').click(function() {
            var id = $(this).attr('id');
            window.location.href = '/daftar?id=' + $id;
        })
    </script>
@endsection
