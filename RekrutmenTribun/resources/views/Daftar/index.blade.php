@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1 class="text-center">Formulir Pendaftaran {{ $daftar->posisi }}</h1>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="text-center text-muted" id="waktu_sisa"></p>
            </div>
            <form action="{{ route('daftar.store') }}" id="FormDataDaftar" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">KTP</label>
                    <input type="file" value="" id="ktp" name="ktp" class="form-control">
                    <p class="text-danger">| JPG | Max 800KB |</p>
                    @if ($errors->has('ktp'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('ktp') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">NPWP</label>
                    <input type="file" value="" id="npwp" name="npwp" class="form-control">
                    <p class="text-danger">| JPG | Max 800KB |</p>
                    @if ($errors->has('npwp'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('npwp') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">CV</label>
                    <input type="file" value="" id="cv" name="cv" class="form-control">
                    <p class="text-danger">| JPG | Max 800KB |</p>
                    @if ($errors->has('cv'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('cv') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Lamaran</label>
                    <input type="file" value="" id="lamaran" name="lamaran" class="form-control">
                    <p class="text-danger">| JPG | Max 800KB |</p>
                    @if ($errors->has('lamaran'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('lamaran') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="" class="form-label">Data Pendukung</label>
                    <input type="file" value="" id="data_pendukung" name="data_pendukung" class="form-control">
                    <p class="text-danger">| PDF | Max 2MB | Opsional |</p>
                    @if ($errors->has('data_pendukung'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('data_pendukung') }}
                        </div>
                    @endif
                </div>
                <input type="text" value="{{ $daftar->id }}" hidden id="id" name="id">
                <div class="cotainer">
                    <div class="row">
                        <div class="container">
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input col-lg-12 col-md-12" id="exampleCheck1"
                                    required>
                                <label class="form-check-label" for="exampleCheck1">Dengan melakukan centang
                                    anda
                                    dengan
                                    kesadaran penuh
                                    bertanggung jawab atas keaslian data yang di kirim.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="text-danger">*Semua file yang dikirim tidak dapat di ubah!</p>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 mb-3">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var waktu_tutup = new Date('{{ $waktu_tutup }}');
        var sekarang = new Date();

        var periksa = setInterval(function() {
            var sekarang = new Date();

            if (sekarang >= waktu_tutup) {
                location.reload();
                clearInterval(periksa);
            }

        }, 1000);

        function tampilsisa() {
            var waktu_tutup = new Date('{{ $waktu_tutup }}');
            var sekarang = new Date();
            // menghitung selisih waktu dalam milisecond
            var diffInMs = waktu_tutup.getTime() - sekarang.getTime();

            // menghitung selisih waktu dalam hari
            var diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
            diffInMs -= diffInDays * 1000 * 60 * 60 * 24;

            // menghitung selisih waktu dalam jam
            var diffInHours = Math.floor(diffInMs / (1000 * 60 * 60));
            diffInMs -= diffInHours * 1000 * 60 * 60;

            // menghitung selisih waktu dalam menit
            var diffInMin = Math.floor(diffInMs / (1000 * 60));

            // menghitung selisih waktu dalam detik
            var diffInSec = Math.floor()

            // console.log('form akan di tutup ' + diffInDays + ' hari ' + diffInHours + ' jam ' + diffInMin + ' menit lagi');
            document.getElementById('waktu_sisa').innerHTML = 'form akan di tutup dalam waktu ' + diffInDays + ' hari ' +
                diffInHours +
                ' jam ' + diffInMin + ' menit lagi '
        }

        window.onload = function() {
            tampilsisa();
            setInterval(tampilsisa, 60000);
        }
    </script>
@endsection
