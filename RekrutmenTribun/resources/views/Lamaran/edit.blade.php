@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            {{-- @dd($lamaran) --}}
            <form action="{{ route('lamaran.update', [$lamarans->id]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Posisi</label>
                    <input type="text" id="posisi" class="form-control" name="posisi"
                        placeholder="Masukan posisi/pekerjaan..." value="{{ old('posisi') ?? $lamarans->posisi }}">
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
                    @if ($lamarans->foto)
                        <img src="{{ asset('storage/' . $lamarans->foto) }}" class="pratinjau-gambar my-3" alt="">
                    @else
                        <img src="" class="pratinjau-gambar my-3" alt="">
                    @endif
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
    <script>
        function PratinjauGambar() {
            // 1.mencari input file dengan ID 'foto'
            const input_foto = document.querySelector('#foto');

            // 2.mencari sebuah tag <img> yang memiliki class 'pratinjau-gambar'
            const buka_foto = document.querySelector('.pratinjau-gambar');

            if (input_foto.files && input_foto.files[0]) {
                // 3.melakukan un-hide tag <img> yang sebelumnya di hide agar tidak terlihat ketika user belum memilih file menjadi terlihat ketika file sudah dipilih.
                buka_foto.style.display = 'block';

                // 4.membuat variabel untuk memanggil fungsi constructor 'FileReader()' pada constructor agar fungsi 'readAsDataURL()' dapat digunakan.
                const Reader = new FileReader();

                // 5.pada saat user memilih banyak foto maka indeks ke 0 atau foto pertama yang akan dibaca pada pratinjau ini
                Reader.readAsDataURL(input_foto.files[0]);

                // 6.setelah file di baca, file ditampilkan ke dalam halaman web agar bisa di lihat oleh user.
                Reader.onload = function(oFREvent) {
                    buka_foto.src = oFREvent.target.result;
                }
            } else {
                buka_foto.style.display = 'none';
                buka_foto.src = '';
            }
        }
    </script>
@endsection
