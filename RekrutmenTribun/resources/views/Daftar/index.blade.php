@extends('Navbar.index')
@section('content')
    <meta http-equiv="refresh" content="{{ $selisih }}">
    <div class="container">
        <div class="row">
            {{-- @dd($selisih) --}}
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <h1 class="text-center">Formulir Pendaftaran {{ $daftar->posisi }}</h1>
            </div>
            <form action="{{ route('daftar.store') }}" id="FormDataDaftar" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">KTP</label>
                    <input type="file" value="" id="ktp" name="ktp" class="form-control">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">NPWP</label>
                    <input type="file" value="" id="npwp" name="npwp" class="form-control">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">CV</label>
                    <input type="file" value="" id="cv" name="cv" class="form-control">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Lamaran</label>
                    <input type="file" value="" id="lamaran" name="lamaran" class="form-control">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Data Pendukung</label>
                    <input type="file" value="" id="data_pendukung" name="data_pendukung" class="form-control">
                </div>
                <input type="text" value="{{ $daftar->id }}" hidden id="id" name="id">
                <div class="cotainer">
                    <div class="row">
                        <div class="container">
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input col-lg-12 col-md-12" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Dengan melakukan centang
                                    anda
                                    dengan
                                    kesadaran penuh
                                    bertanggung jawab atas keaslian data yang di kirim.</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 mb-3">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var selisih = {{ $selisih }};
        setTimeout(function() {
            location.reload();
        }, selisih);
    </script>
@endsection
