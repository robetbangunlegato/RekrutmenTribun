@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table border table-hover">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th scope="col">No</th>
                            @if (auth()->user()->role == 'admin')
                                <th scope="col">Nama</th>
                                <th scope="col">ID</th>
                            @endif
                            <th>Posisi</th>
                            <th scope="col">KTP</th>
                            <th scope="col">NPWP</th>
                            <th scope="col">CV</th>
                            <th scope="col">Lamaran</th>
                            <th scope="col">Data Pendukung</th>
                            <th scope="col">Tanggal</th>
                            @if (auth()->user()->role == 'admin')
                                <th scope="col">Terima/Tolak</th>
                            @endif
                            <th scope="col">Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if (auth()->user()->role == 'non-admin')
                            @if ($daftars == 'Tidak ada data')
                                <td colspan="9" align="center">Tidak ada data</td>
                            @else
                                @foreach ($daftars as $item)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        @php
                                            $no = $no + 1;
                                        @endphp
                                        <td>{{ $item->posisi }}</td>
                                        <td>
                                            <a href="storage/daftar/{{ $item->ktp }}" class="btn btn-outline-dark"
                                                type="button"><i class="bi bi-eye"></i></a>
                                        </td>
                                        <td><a href="storage/daftar/{{ $item->npwp }}" class="btn btn-outline-dark"
                                                type="button"><i class="bi bi-eye"></i></a>
                                        </td>
                                        <td><a href="storage/daftar/{{ $item->cv }}" class="btn btn-outline-dark"
                                                type="button"><i class="bi bi-eye"></i></a>
                                        </td>
                                        <td><a href="storage/daftar/{{ $item->surat_lamaran }}" class="btn btn-outline-dark"
                                                type="button"><i class="bi bi-eye"></i></a>
                                        </td>
                                        <td>
                                            @if ($item->data_pendukung == '-')
                                                -
                                            @else
                                                <a href="storage/daftar/{{ $item->data_pendukung }}"
                                                    class="btn btn-outline-dark" type="button"><i
                                                        class="bi bi-eye"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $item->waktu_kirim }}</td>
                                        <td>{{ $item->status_administrasi }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @elseif(auth()->user()->role == 'admin')
                            @php
                                // menghitung jumlah kemunculan karakter '-'
                                $jumlah_karakter = DB::table('lamarans')
                                    ->where('status_administrasi', '=', '-')
                                    ->sum(DB::raw('LENGTH(status_administrasi)'));
                            @endphp
                            @if ($jumlah_karakter == 0)
                                <td colspan="12" align="center">Tidak ada data</td>
                            @else
                                @foreach ($daftars as $item)
                                    @if ($item->status_administrasi == '-')
                                        <tr>
                                            <td>{{ $no }}</td>
                                            @php
                                                $no = $no + 1;
                                            @endphp
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->id }}</td>
                                            <td>{{ $item->lamaran->posisi }}</td>
                                            <td><a href="storage/daftar/{{ $item->ktp }}"
                                                    class="btn btn-outline-dark"type="button">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                            <td><a href="storage/daftar/{{ $item->npwp }}" class="btn btn-outline-dark"
                                                    type="button"><i class="bi bi-eye"></i></a></td>
                                            <td><a href="storage/daftar/{{ $item->cv }}" class="btn btn-outline-dark"
                                                    type="button"><i class="bi bi-eye"></i></a></td>
                                            <td><a href="storage/daftar/{{ $item->surat_lamaran }}"
                                                    class="btn btn-outline-dark" type="button"><i
                                                        class="bi bi-eye"></i></a></td>
                                            <td>
                                                @if ($item->data_pendukung == '-')
                                                    -
                                                @else
                                                    <a href="storage/daftar/{{ $item->data_pendukung }}"
                                                        class="btn btn-outline-dark" type="button"><i
                                                            class="bi bi-eye"></i></a>
                                                @endif
                                            </td>
                                            <td>{{ $item->waktu_kirim }}</td>
                                            <td>{{ $item->status_administrasi }}</td>
                                            <td>
                                                <form action="{{ route('rekapitulasiadministrasi.update', [$item->id]) }}"
                                                    method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-success" type="submit" id="btn-wa"
                                                        name="status_administrasi" value="berkas diterima">
                                                        <i class="bi bi-check-circle">
                                                        </i>
                                                    </button>
                                                    <button class="btn btn-danger" type="submit" name="status_administrasi"
                                                        value="berkas ditolak">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
