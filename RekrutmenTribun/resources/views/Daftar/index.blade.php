@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <h1 class="text-center">Formulir Pendaftaran</h1>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label for="" class="form-label">KTP</label>
                <input type="file" value="" name="ktp" placeholder="Masukan file KTP..." class="form-control">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label for="" class="form-label">NPWP</label>
                <input type="file" value="" name="ktp" placeholder="Masukan file NPWP..." class="form-control">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label for="" class="form-label">CV</label>
                <input type="file" value="" name="ktp" placeholder="Masukan file CV..." class="form-control">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label for="" class="form-label">Lamaran</label>
                <input type="file" value="" name="ktp" placeholder="Masukan file KTP..." class="form-control">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label for="" class="form-label">Data Pendukung</label>
                <input type="file" value="" name="ktp" placeholder="Masukan file KTP..." class="form-control">
            </div>
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
        </div>
    </div>
@endsection
