@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <td>No</td>
                            <td>ID User</td>
                            <td>Nama</td>
                            {{-- <td>Posisi</td> --}}
                            <td>Nomor WhatsApp</td>
                            <td>Status Akhir</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil_totals as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                @php
                                    $no = $no + 1;
                                @endphp
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                @php
                                    $pesan = 'Selamat, anda lolos semua tahapan rekrutmen. Mengenai panggilan kerja akan di informasikan kembali.';
                                @endphp
                                <td>
                                    <a href="https://api.whatsapp.com/send?phone={{ $item->user->noWA }}&text={{ $pesan }}"
                                        class="btn btn-outline-success">Kirim</a>
                                </td>
                                <td>{{ $item->status_akhir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
