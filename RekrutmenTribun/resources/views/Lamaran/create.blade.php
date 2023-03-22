@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('lamaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Posisi</label>
                    <input type="email" class="form-control" id="posisi" placeholder="Masukan posisi/pekerjaan...">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="3"
                        placeholder="Masukan deskripsi singkat pekerjaan yang akan di lamar..."></textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="formFile" class="form-label">Masukan Thumbnail</label>
                    <input class="form-control" type="file" id="foto">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                    <button type="submit" class="btn btn-primary col-lg-12">Kirim</button>
                </div>

            </form>
        </div>
    </div>
@endsection
