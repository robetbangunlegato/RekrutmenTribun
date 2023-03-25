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
    <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="FormulirHapus">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close bg-success" data-dismiss="modal" aria-label="Close"
                            style="border-radius: 30%;">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="isi-modal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            $("#isi-modal").text('Apakah lowongan ' + posisi + ' ingin di hapus?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })
    </script>
@endsection
