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
    <div class="container">
        <div class="row">
            <form action="{{ route('psikotes.store') }}" method="post">
                @csrf
                <label for="exampleFormControlInput1" class="form-label">Kategori Soal</label>
                <input type="text" id="kategori_soal" class="form-control" name="kategori_soal"
                    placeholder="Masukan kategori soal..." value="{{ old('kategori_soal') }}">
                @error('kategori_soal')
                    <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                        {{ 'Kategori soal harus di isi!' }}
                    </div>
                @enderror
                <button type="submit" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 my-3">Simpan</button>
            </form>
            <div class="table-responsive">
                <table class="table border table-hover text-center">
                    <thead class="table-light">
                        <tr class="text-center">
                            <td><strong>No</strong></td>
                            <td><strong>Kategori Soal</strong></td>
                            <td><strong>Jumlah Soal</strong></td>
                            <td><strong>Kontrol</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kategori_soals as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                @php
                                    $no = $no + 1;
                                @endphp
                                <td>{{ $item->kategori_soal }}</td>
                                <td>{{ $item->soals_count }}</td>
                                <td>
                                    <a href="{{ route('psikotes.edit', [$item->id]) }}" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger btn-hapus" id-kategori-soal="{{ $item->id }}"
                                        kategori-soal="{{ $item->kategori_soal }}" data-toggle="modal"
                                        data-target="#HapusModal">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

    {{-- js hapus --}}
    <script>
        // mencari class button dengan nama 'btn-hapus dan menambahkan fungsi ketika tombol tersebut di klik'
        $('.btn-hapus').click(function() {

            // mengambil data id lowongan
            let id = $(this).attr('id-kategori-soal');

            // mengisi value atrribut 'action' pada tag form yang awalnya kosong menjadi berisi alamat lowongan yang akan di hapus
            $('#FormulirHapus').attr('action', '/psikotes/' + id);

            // mengambil data 'posisi' agar modal konfirmasi lebih dinamis
            let kategori_soal = $(this).attr('kategori-soal');

            // mengisi modal-body yang ada pada file modal
            $("#isi-modal").text('Apakah kategori soal ' + kategori_soal + ' ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })
    </script>
@endsection
