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
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Soal : {{ $kategori_soal }}</h5>
                        <p class="card-text">{!! $soal->soal !!}</p>
                    </div>
                </div>
            </div>
            <div class="container my-3">
                <form action="{{ route('pilihan.store') }}" method="post">
                    @csrf
                    <label for="">Masukan pilihan</label>
                    <textarea name="pilihan" id="editor" cols="30" rows="10" class=""></textarea>
                    @if ($errors->has('pilihan'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ $errors->first('pilihan') }}
                        </div>
                    @endif
                    {{-- input poin --}}
                    <label for="" class="mt-3">Poin</label>
                    <input type="text" name="poin" class="form-control" placeholder="Masukan poin pilihan...">
                    @if ($errors->has('poin'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ $errors->first('poin') }}
                        </div>
                    @endif
                    {{-- id soal --}}
                    <input type="text" value="{{ $soal->id }}" name="soal_id" hidden>
                    <button type="submit" class="btn btn-primary col-12 mt-3">Simpan</button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table class="table border table-hover text-center">
                    <thead class="table-light">
                        @php
                            $no = 1;
                        @endphp
                        <tr>
                            <td>No</td>
                            <td>Pilihan</td>
                            <td>Poin</td>
                            <td>Kontrol</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pilihans as $item)
                            <tr>
                                <td>
                                    {{ $no }}
                                </td>
                                @php
                                    $no = $no + 1;
                                @endphp
                                <td style="background-color: white">
                                    {!! $item->pilihan !!}
                                </td>
                                <td>
                                    {{ $item->poin }}
                                </td>
                                <td>
                                    <a href="{{ route('pilihan.edit', [$item->id]) }}" class="btn btn-warning">Edit</a>

                                    <button class="btn btn-danger btn-hapus" id-pilihan-soal="{{ $item->id }}"
                                        pilihan-soal="{{ $item->pilihan }}" data-toggle="modal"
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
    <script>
        // script editor text
        CKEDITOR.replace('editor', {
            toolbar: [{
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'SelectAll']
                },
                '/',
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks']
                }
            ]
        });

        // script modal dinamis
        // mencari class button dengan nama 'btn-hapus dan menambahkan fungsi ketika tombol tersebut di klik'
        $('.btn-hapus').click(function() {

            // mengambil data id lowongan
            let id = $(this).attr('id-pilihan-soal');

            // mengisi value atrribut 'action' pada tag form yang awalnya kosong menjadi berisi alamat lowongan yang akan di hapus
            $('#FormulirHapus').attr('action', '/pilihan/' + id);

            // mengambil data 'posisi' agar modal konfirmasi lebih dinamis
            // let pilihan_soal = $(this).attr('pilihan-soal');

            // mengisi modal-body yang ada pada file modal
            $("#isi-modal").text('Apakah pilihan soal ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })
    </script>
@endsection
