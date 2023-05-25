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
    <div id="loading-overlay">
        <div class="loader"></div>
    </div>

    <div class="container">
        <div class="row">
            @if (auth()->user()->role == 'admin')
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 fixed-h">
                    <div class="card card-psikotes">
                        <a href="{{ route('psikotes.create') }}" class="btn btn-secondary h-100 position-relative">
                            <i class="bi bi-pencil-square position-absolute top-50 start-50 translate-middle"
                                style="font-size: 50px; font-style: normal"> Kategori soal</i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 fixed-h">
                    <div class="card card-psikotes">
                        <a href="{{ route('soal.create') }}" class="btn btn-info h-100 position-relative">
                            <i class="bi bi-journal-plus position-absolute top-50 start-50 translate-middle"
                                style="font-size: 50px; font-style: normal"> Soal</i>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 fixed-h">
                <div class="card card-psikotes">
                    <a href="{{ route('tes.index') }}" class="btn btn-primary h-100 position-relative">
                        <i class="bi bi-pen position-absolute top-50 start-50 translate-middle"
                            style="font-size: 50px; font-style: normal"> Tes</i>
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
            $("#isi-modal").text('Apakah kategori soal ' + posisi + ' ingin di hapus ?');
        })

        // menambahkan attribut type yang bernilai 'submit' pada form di file modal untuk mengirim data ke controller
        $('#FormulirHapus [type="submit"]').click(function() {
            $('#FormulirHapus').submit();

        })

        // Menampilkan animasi loading
        function showLoading() {
            document.getElementById('loading-overlay').style.display = 'flex';
        }

        // Menghilangkan animasi loading
        function hideLoading() {
            document.getElementById('loading-overlay').style.display = 'none';
        }

        // Mengatur event untuk menyembunyikan animasi loading setelah halaman selesai dimuat
        window.addEventListener('load', function() {
            hideLoading();
        });
    </script>

    <style>
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }


        }

        .card-psikotes {
            width: 390, 4px;
            height: 545px;
        }
    </style>
@endsection
