@extends('Navbar.index')
@section('content')
    <style>
        #modaltutupform {
            display: block;
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
    <div class="container">
        <div class="row">
            <div class="modal fade bg-secondary" id="staticBackdrop" data-coreui-backdrop="static"
                data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Info</h5>
                        </div>
                        <div class="modal-body">
                            Sesi telah habis, silahkan tunggu rekrutmen berikutnya.
                        </div>
                        <div class="modal-footer">
                            @if (auth()->user()->role == 'admin')
                                <button type="button" class="btn btn-primary btn-tutup" data-coreui-dismiss="modal">Buka
                                    Formulir</button>
                            @endif

                            <a href="{{ url('lamaran') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- form ubah waktu lamaran --}}
        <form action="{{ route('daftar.update', [$id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <h1 class="text-center">Waktu Buka</h1>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal_buka">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="waktu">Waktu</label>
                    <input type="time" class="form-control" name="waktu_buka">
                </div>
                <h1 class="text-center">Waktu Tutup</h1>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal_tutup">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="waktu">Waktu</label>
                    <input type="time" class="form-control" name="waktu_tutup">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Atur Jadwal</button>
                </div>
            </div>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                    keyboard: false,
                    backdrop: 'static'
                });
                myModal.show();
                document.querySelector('.btn-tutup').addEventListener('click', function() {
                    myModal.hide(); // Menyembunyikan modal
                });
            });
        </script>
    @endsection
