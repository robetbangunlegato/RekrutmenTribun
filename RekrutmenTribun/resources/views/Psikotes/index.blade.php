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
            <div class="container mb-3">
                <a href="{{ route('psikotes.create') }}" class="btn btn-outline-primary col-12">Buat Kategori Soal</a>
            </div>
            <div class="container">
                <table class="table border mb-0 table-hover">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <td>
                                Kategori Soal
                            </td>
                            <td>
                                Waktu Pengerjaan
                            </td>
                            <td class="text-center">Kontrol</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($psikotes as $item)
                            <tr>
                                <td>{{ $item->kategori_soal }}</td>
                                <td>{{ $item->waktu_pengerjaan }}</td>
                                <td class="text-center">
                                    <a href="{{ url('psikotes/' . $item->id . '/edit') }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('soal.index') }}" class="btn btn-secondary">Buat Soal</a>
                                    <Button class="btn btn-danger btn-hapus" id-psikotes="{{ $item->id }}"
                                        kategori-soal="{{ $item->kategori_soal }}" data-toggle="modal"
                                        data-target="#HapusModal">Hapus</Button>
                                    <a href="http://" class="btn btn-primary">Kerjakan</a>
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

        $('.btn-hapus').click(function() {

            // mengambil data id lowongan
            let id = $(this).attr('id-psikotes');

            // mengisi value atrribut 'action' pada tag form yang awalnya kosong menjadi berisi alamat lowongan yang akan di hapus
            $('#FormulirHapus').attr('action', '/psikotes/' + id);

            // mengambil data 'posisi' agar modal konfirmasi lebih dinamis
            let posisi = $(this).attr('kategori-soal');

            // mengisi modal-body yang ada pada file modal
            $("#isi-modal").text('Apakah kategori soal "' + posisi + '" ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })
    </script>
@endsection
