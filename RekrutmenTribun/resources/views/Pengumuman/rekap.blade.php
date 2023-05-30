@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <td>Nama</td>
                            {{-- <td>Posisi</td> --}}
                            <td>Nomor WhatsApp</td>
                            <td>Status Akhir</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil_totals as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                {{-- <td>{{ $item->user->daftar->lamaran }}</td> --}}
                                <td>{{ $item->user->noWA }}</td>
                                <td>{{ $item->status_akhir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
