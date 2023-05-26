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
    <div class="container">
        <div class="row">
            <div class="container">

                <div class="table-responsive">
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Kategori Soal</th>
                                <th>Total Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $prevName = null;
                                $rowspan = $rowspan;
                                $id = $rowspan - 1;
                            @endphp
                            @foreach ($hasil_totals_soals as $hasil)
                                @if ($prevName !== $hasil->name)
                                    @if ($prevName !== null)
                                        </tr>
                                    @endif
                                    <tr class="text-center">
                                        <td rowspan="{{ $rowspan }}">{{ $hasil->name }}</td>
                                        <td>{{ $hasil->kategori_soal }}</td>
                                        <td>{{ $hasil->total_poin }}</td>
                                    </tr>
                                    @php
                                        $prevName = $hasil->name;
                                        $rowspan = 1;
                                    @endphp
                                @else
                                    <tr class="text-center">
                                        <td>{{ $hasil->kategori_soal }}</td>
                                        <td>{{ $hasil->total_poin }}</td>
                                    </tr>
                                    @php
                                        $rowspan = $rowspan + 1;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
