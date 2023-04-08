@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="container">
            <div class="row mb-3 text-center">
                <table class="table table-hover border-dark">
                    <thead class="border-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">ID</th>
                            <th scope="col">KTP</th>
                            <th scope="col">NPWP</th>
                            <th scope="col">CV</th>
                            <th scope="col">Lamaran</th>
                            <th scope="col">Data Pendukung</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Terima/Tolak</th>
                            <th scope="col">Respon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($daftars as $item)
                            <tr>
                                {{-- <th scope="row">No.{{ $no }}</th> --}}

                                <td>{{ $no }}</td>
                                @php
                                    $no = $no + 1;
                                @endphp
                                <td>{{ $item->user->name }}</td>
                                <td><button class="btn btn-outline-dark"><i class="bi bi-eye"></i></button></td>
                                <td><button class="btn btn-outline-dark"><i class="bi bi-eye"></i></button></td>
                                <td><button class="btn btn-outline-dark"><i class="bi bi-eye"></i></button></td>
                                <td><button class="btn btn-outline-dark"><i class="bi bi-eye"></i></button></td>
                                <td><button class="btn btn-outline-dark"><i class="bi bi-eye"></i></button></td>
                                <td>-</td>
                                <td>7 April 2023</td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-success">
                                        <i class="bi bi-check-circle">
                                        </i>
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
