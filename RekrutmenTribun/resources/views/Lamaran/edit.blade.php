@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            {{-- @dd($lamarans->foto) --}}
            <form action="{{ route('lamaran.update', [$lamarans->id]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Posisi</label>
                    <input type="text" id="posisi" class="form-control" name="posisi"
                        placeholder="Masukan posisi/pekerjaan..." value="{{ $lamarans->posisi }}">
                    @error('posisi')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Posisi Lowongan Harus di Isi!' }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea type="text"class="form-control" name="deskripsi" rows="3" placeholder="Masukan Deskripsi...">{{ old('deskripsi') ?? $lamarans->deskripsi }}</textarea>
                    @error('deskripsi')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Deskripsi Lowongan Harus di Isi!' }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Masukan Thumbnail</label>
                    <input class="form-control" type="file" name="foto" id="foto" onchange="PratinjauGambar()">
                    <img src="{{ asset('storage/' . $lamarans->foto) }}" class="pratinjau-gambar my-3 img-fluid"
                        alt="">
                    @error('foto')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Foto Thumbnail Harus di Isi!' }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                    <button type="submit" class="btn btn-primary col-lg-12">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- script preview image --}}
    <script src="{{ asset('js/pratinjaugambar.js') }}"></script>
@endsection
