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
                            <span aria-hidden="true">&times;

                            </span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- isi --}}
    <div class="container">
        <div class="row">
            @if (auth()->user()->role == 'admin')
                <div class="table-responsive">
                    <table class="table border mb-0 table-hover">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">Nama</th>
                                <th>Jadwal</th>
                                <th>WhatsApp</th>
                                <th>Wawancara</th>
                                <th>Lolos/Tidak</th>
                                <th>Respon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // menghitung jumlah kemunculan karakter '-'
                                $jumlah_kata = DB::table('lamarans')
                                    ->where('status_administrasi', 'LIKE', '%diterima%')
                                    ->count();
                                
                                $jumlah_karakter = DB::table('lamarans')
                                    ->leftJoin('wawancaras', 'lamarans.id', '=', 'wawancaras.lamarans_id')
                                    ->whereNull('wawancaras.lamarans_id')
                                    ->count();
                                
                            @endphp
                            @foreach ($daftars as $item)
                                @if ($item->status_administrasi == 'berkas diterima' && $item->wawancara == null)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            <div>{{ $item->user->name }}</div>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-dark btn-jadwal" id-daftars="{{ $item->id }}"
                                                data-toggle="modal" data-target="#JadwalModal">Atur Jadwal</button>
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @elseif(isset($item->wawancara) && $item->wawancara->status_wawancara == '-')
                                    <tr>
                                        <td class="text-center">
                                            <div>{{ $item->user->name }}</div>
                                        </td>
                                        <td>
                                            {{ $item->wawancara->waktu }}
                                        </td>
                                        @php
                                            $waktu = $item->wawancara->waktu;
                                            $pesan = 'Selamat, anda lolos ke tahap wawancara, jadwal wawancara mu tanggal ' . $waktu . '. Peserta diharuskan hadir 10 menit sebelum wawancara dimulai untuk persiapan.';
                                        @endphp
                                        <td>
                                            <a href="https://api.whatsapp.com/send?phone={{ $item->user->noWA }}&text={{ $pesan }}"
                                                class="btn btn-outline-success">Kirim</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('wawancara.show', $item->wawancara->id) }}"
                                                class="btn btn-outline-primary">
                                                Mulai Wawancara
                                            </a>
                                        </td>
                                        <td>
                                            {{ $item->wawancara->status_wawancara }}
                                        </td>
                                        <td>
                                            <form action="{{ route('wawancara.acc', [$item->wawancara->id]) }}"
                                                method="post">
                                                @method('POST')
                                                @csrf
                                                <input type="text" name="user_id" value="{{ $item->user->id }}" hidden>
                                                <input type="hidden" name="id" value="{{ $item->wawancara->id }}">
                                                <button class="btn btn-success" type="submit" name="status_wawancara"
                                                    value="wawancara diterima">
                                                    <i class="bi bi-check-circle">
                                                    </i>
                                                </button>
                                                <button class="btn btn-danger" type="submit" name="status_wawancara"
                                                    value="wawancara ditolak">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table border mb-0 table-hover">
                        <thead class="table-light fw-semibold">
                            <tr class="text-center">
                                <th>Status Wawancara</th>
                                <th>Jadwal Wawancara</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($wawancaras as $item)
                                <tr>
                                    <td>{{ $item->status_wawancara }}</td>
                                    <td>{{ $item->waktu }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- modal jadwal --}}
    <div class="modal fade" id="JadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('wawancara.store') }}" method="POST" id="form-jadwalkan">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Atur Jadwal Wawancara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center" id="isi-modal">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                        {{-- <p for="" style="color: red;" id="alert-tanggal"></p> --}}
                        <label for="" class="mt-3">Waktu</label>
                        <input type="time" class="form-control" name="waktu" id="waktu">
                        <p for="" style="color: red;" id="alert-waktu"></p>
                        <input type="text" hidden id="id_kirim" name="id_kirim">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-jadwalkan">Jadwalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- script js modal jadwal --}}
    <script>
        // modal jadwal
        $('.btn-jadwal').click(function() {

            // ambil data id daftars
            let id = $(this).attr('id-daftars');

            // set nilai pada input yang ber id 'id_kirim'
            let id_kirim1 = document.getElementById('id_kirim');
            id_kirim1.value = id;

        })

        // setting error saat input jadwal
        // const alert_tanggal = document.getElementById('alert-tanggal');
        // const alert_waktu = document.getElementById('alert-waktu');
        // let tanggal_sekarang = new Date();
        // $('.btn-jadwalkan').click(function() {
        //     const inputTanggal = document.getElementById('tanggal').value;

        //     const inputWaktu = document.getElementById('waktu').value;
        //     let inputTanggal_konversi = new Date(inputTanggal);

        //     const tanggal_sekarang_konversi1 = tanggal_sekarang.setHours(0, 0, 0, 0);
        //     const inputTanggal_konversi1 = inputTanggal_konversi.setHours(0, 0, 0, 0);

        //     if (inputTanggal === '' && inputWaktu === '') {
        //         alert_tanggal.textContent = 'Tanggal harus di isi!';
        //         alert_waktu.textContent = 'Waktu harus di isi!';

        //     } else if (inputWaktu === '') {
        //         alert_waktu.textContent = 'Waktu harus di isi!';

        //     } else if (inputTanggal === '') {
        //         alert_tanggal.textContent = 'Tanggal harus di isi!';

        //     } else if (inputTanggal_konversi1 === tanggal_sekarang_konversi1 || inputTanggal_konversi1 <
        //         tanggal_sekarang_konversi1) {
        //         alert_tanggal.textContent = 'Tanggal harus setelah hari ini!';
        //     }
        // })
        // const inputTanggal = document.getElementById('tanggal').value;

        // const inputWaktu = document.getElementById('waktu').value;
        // let inputTanggal_konversi = new Date(inputTanggal);

        // const tanggal_sekarang_konversi1 = tanggal_sekarang.setHours(0, 0, 0, 0);
        // const inputTanggal_konversi1 = inputTanggal_konversi.setHours(0, 0, 0, 0);

        // document.getElementById("form-jadwalkan").addEventListener("submit", function(event) {
        //     event.preventDefault();

        //     if (inputTanggal === '' && inputWaktu === '') {
        //         alert_tanggal.textContent = 'Tanggal harus di isi!';
        //         alert_waktu.textContent = 'Waktu harus di isi!';
        //         // event.preventDefault();

        //     } else if (inputWaktu === '') {
        //         alert_waktu.textContent = 'Waktu harus di isi!';
        //         // event.preventDefault();

        //     } else if (inputTanggal === '') {
        //         alert_tanggal.textContent = 'Tanggal harus di isi!';
        //         // event.preventDefault();

        //     } else if (inputTanggal_konversi1 === tanggal_sekarang_konversi1 || inputTanggal_konversi1 <
        //         tanggal_sekarang_konversi1) {
        //         alert_tanggal.textContent = 'Tanggal harus setelah hari ini!';
        //         // event.preventDefault();
        //     }
        // });
    </script>
@endsection
