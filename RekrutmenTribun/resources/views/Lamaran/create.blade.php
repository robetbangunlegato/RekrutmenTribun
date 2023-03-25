@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('lamaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- posisi --}}
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Posisi</label>
                    <input type="text" id="posisi" class="form-control" name="posisi"
                        placeholder="Masukan posisi/pekerjaan..." value="{{ old('posisi') }}">
                    @error('posisi')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Posisi lowongan harus di isi!' }}
                        </div>
                    @enderror
                </div>
                {{-- deskripsi --}}
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukan Deskripsi...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ 'Deskripsi lowongan harus di isi!' }}
                        </div>
                    @enderror
                </div>
                {{-- foto thumbnail --}}
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Masukan Thumbnail</label>
                    <input class="form-control" type="file" name="foto" id="foto" onchange="PratinjauGambar()"
                        value="{{ old('foto') }}">
                    <p style="color: red">*rasio gambar sama sisi | kurang dari 800KB | JPG</p>
                    @if ($errors->has('foto'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12">
                            {{ $errors->first('foto') }}
                        </div>
                    @endif
                </div>
                <img src="" class="pratinjau-gambar col-lg-4 col-md-4 col-sm-4 mb-3" alt="">
                <button type="submit" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 mb-3">Tambahkan</button>

            </form>
        </div>
    </div>

    {{-- script pratinjaugambar --}}
    <script src="{{ asset('js/pratinjaugambar.js') }}"></script>
@endsection
