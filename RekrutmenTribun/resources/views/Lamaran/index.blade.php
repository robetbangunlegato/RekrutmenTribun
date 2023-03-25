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
            </div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="row">
            {{-- body --}}
            @foreach ($lamarans as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->posisi }}</h5>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-footer">
                            {{-- buttton daftar --}}
                            <a href="" class="btn btn-primary">Daftar</a>
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

    {{-- modal hapus --}}
    @include('modal')

    <script>
        // mencari class button dengan nama 'btn-hapus dan menambahkan fungsi ketika tombol tersebut di klik'
        $('.btn-hapus').click(function() {

            // mengambil data id lowongan
            let id = $(this).attr('id-lowongan');

            // mengisi value atrribut 'action' pada tag form yang awalnya kosong menjadi berisi alamat lowongan yang akan di hapus
            $('#FormulirHapus').attr('action', '/lamaran/' + id);

            // mengambil data 'posisi' agar modal konfirmasi lebih dinamis
            let posisi = $(this).attr('posisi-lowongan');

            // mengisi modal-body yang ada pada file modal
            $("#isi-modal").text('Apakah lowongan ' + posisi + ' ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })
    </script>
@endsection
