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

    <div class="align-items-end col-12 justify-content-end">
        <p class="text-danger" style="position: fixed; z-index: 1" id="waktu_sisa"></p>
    </div>


    @if ($status_administrasi == 'diterima' && $status_wawancara == 'diterima')
        <div class="container mt-2">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Psikotes</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('tes.store') }}">
                                @csrf
                                {{-- perulangan kategori soal --}}
                                @foreach ($kategori_soals as $kategori_soal_item)
                                    <div class="card mb-5">

                                        <div class="card-header"><strong>
                                                {{ $kategori_soal_item->kategori_soal }}</strong></div>

                                        <div class="card-body">
                                            {{-- perulangan soal --}}
                                            @foreach ($kategori_soal_item->soals as $soals_item)
                                                <div class="card @if (!$loop->last) mb-3 @endif">
                                                    <div class="card-header">{!! $soals_item->soal !!}</div>
                                                    <div class="card-body">
                                                        <input type="hidden" name="soal[{{ $soals_item->id }}]"
                                                            value="">
                                                        {{-- perulangan pilihan --}}
                                                        @foreach ($soals_item->pilihans as $pilihan_item)
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    name="soal[{{ $soals_item->id }}]"
                                                                    value="{{ $pilihan_item->id }}"
                                                                    id="pilihan-{{ $pilihan_item->id }}">
                                                                <label for="" id="pilihan-{{ $pilihan_item->id }}">
                                                                    {!! $pilihan_item->pilihan !!}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        {{-- pesan error --}}
                                                        @if ($errors->has("soal.$soals_item->id"))
                                                            <span
                                                                style="margin-top: .25rem; font-size: 80%; color: #e3342f;"
                                                                role="alert">
                                                                <strong>{{ 'Wajib di isi' }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                {{-- button submit --}}
                                <button type="submit " class="btn btn-primary col-12">
                                    Kumpulkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role == 'admin')
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center justify-content-center" style="margin-top: 20%">
            <div class="text-center">
                <p class="text-muted">sisa waktu akses </p>
                <p class="text-muted text-center align-items-center" id="waktu_sisa"></p>
            </div>
        </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex align-items-center justify-content-center" style="margin-top: 20%">
            <div class="text-center">
                <h4 class="text-center align-items-center" style="color: #e3342f">Kamu belum lulus tahap wawancara dan/atau
                    wawancara dan tidak bisa
                    mengikuti tahap
                    psikotes!</h4>
            </div>
        </div>
    @endif

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
            var diffInSec = Math.floor(diffInMs / 1000) % 60;

            // console.log('form akan di tutup ' + diffInDays + ' hari ' + diffInHours + ' jam ' + diffInMin + ' menit lagi');
            document.getElementById('waktu_sisa').innerHTML = diffInHours +
                ' jam ' + diffInMin + ' menit ' + diffInSec + ' detik'
        }

        window.onload = function() {
            tampilsisa();
            setInterval(tampilsisa, 1000);
        }
    </script>
@endsection
