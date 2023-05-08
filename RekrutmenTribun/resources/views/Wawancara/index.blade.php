@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            @if (auth()->user()->role == 'admin')
                <div class="table-responsive">
                    <table class="table border mb-0 table-hover">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">Nama</th>
                                <th>KTP</th>
                                <th>NPWP</th>
                                <th>CV</th>
                                <th>Lamaran</th>
                                <th>Data Pendukung</th>
                                <th>Jadwal</th>
                                <th>WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // menghitung jumlah kemunculan karakter '-'
                                $jumlah_karakter = DB::table('daftars')
                                    ->where('status_administrasi', '=', 'diterima')
                                    ->sum(DB::raw('LENGTH(status_administrasi)'));
                            @endphp

                            @if ($jumlah_karakter == 0)
                                <td colspan="7" align="center">Tidak ada data</td>
                            @else
                                @foreach ($daftars as $item)
                                    @if ($item->status_administrasi == 'diterima')
                                        <tr class="align-middle">
                                            <td class="text-center">
                                                <div>{{ $item->user->name }}</div>
                                            </td>
                                            <td>
                                                <a href="storage/daftar/{{ $item->ktp }}"
                                                    class="btn btn-outline-dark rounded-circle" type="button"><i
                                                        class="bi bi-eye"></i></a>

                                            </td>
                                            <td>
                                                <a href="storage/daftar/{{ $item->npwp }}"
                                                    class="btn btn-outline-dark rounded-circle" type="button"><i
                                                        class="bi bi-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="storage/daftar/{{ $item->cv }}"
                                                    class="btn btn-outline-dark rounded-circle" type="button"><i
                                                        class="bi bi-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="storage/daftar/{{ $item->lamaran }}"
                                                    class="btn btn-outline-dark rounded-circle" type="button"><i
                                                        class="bi bi-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="storage/daftar/{{ $item->data_pendukung }}"
                                                    class="btn btn-outline-dark rounded-circle" type="button"><i
                                                        class="bi bi-eye"></i></a>
                                            </td>
                                            @php
                                                $query = DB::table('daftars')
                                                    ->select('daftars.id')
                                                    ->join('wawancaras', 'daftars.id', '=', 'wawancaras.daftar_id')
                                                    ->where('daftars.id', '=', $item->id)
                                                    ->get();
                                            @endphp
                                            @if ($query->isEmpty())
                                                {{-- button atur jadwal --}}
                                                <td>
                                                    <button class="btn btn-outline-dark btn-jadwal"
                                                        id-daftars="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#JadwalModal">Atur Jadwal</button>
                                                </td>
                                                <td>-</td>
                                            @else
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
                                            @endif

                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            @else
            @endif
            {{-- modal --}}
            <div class="modal fade" id="JadwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('wawancara.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Atur Jadwal Wawancara</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center" id="isi-modal">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                                <label for="" class="mt-3">Waktu</label>
                                <input type="time" class="form-control" name="waktu">
                                <input type="text" hidden id="id_kirim" name="id_kirim">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Jadwalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- script --}}
            <script>
                $('.btn-jadwal').click(function() {

                    // ambil data id daftars
                    let id = $(this).attr('id-daftars');


                    // set nilai pada input yang ber id 'id_kirim'
                    let id_kirim1 = document.getElementById('id_kirim');
                    id_kirim1.value = id;

                    // console.log(id_kirim1);

                })
            </script>
        </div>
    </div>
@endsection
