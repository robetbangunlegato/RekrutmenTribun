@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="table-responsive">
                    <table class="table border mb-0 table-hover">
                        <thead class="table-light fw-semibold">
                            <tr class="text-center">
                                <td>No</td>
                                <td>Nama</td>
                                <td>Skor</td>
                                <td>Respon</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($hasil_totals as $item)
                                <tr class="text-center">
                                    <td>{{ $no }}</td>
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->total_poin }}</td>
                                    <td>
                                        <form action="{{ route('psikotes.create') }}" method="post">
                                            @method('POST')
                                            @csrf
                                            {{-- <input type="hidden" name="id" value="{{ $item->wawancara->id }}"> --}}
                                            <button class="btn btn-success" type="submit" name="status_wawancara"
                                                value="diterima">
                                                <i class="bi bi-check-circle">
                                                </i>
                                            </button>
                                            <button class="btn btn-danger" type="submit" name="status_wawancara"
                                                value="ditolak">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
