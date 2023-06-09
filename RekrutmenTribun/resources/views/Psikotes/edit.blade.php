@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('psikotes.update', [$kategori_soals->id]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kategori Soal</label>
                    <input type="text" id="kategori_soal" class="form-control" name="kategori_soal"
                        placeholder="Masukan kategori soal..." value="{{ $kategori_soals->kategori_soal }}">
                    @error('kategori_soal')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Kategori soal harus di isi!' }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 mb-3">Simpan</button>
            </form>
        </div>
    </div>
@endsection
