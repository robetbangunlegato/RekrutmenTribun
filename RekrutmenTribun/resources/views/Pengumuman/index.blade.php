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
                @if (auth()->user()->role == 'admin')
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead class="table-light fw-semibold">
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Detail</th>
                                    <th>Respon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil_totals as $item)
                                    @if ($item->status_akhir == '-')
                                        <tr class="text-center">
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->total_poin }}</td>
                                            <td>
                                                <a href="{{ route('pengumuman.show', [$item->user_id]) }}"
                                                    class="btn btn-primary">Lihat</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('pengumuman.update', [$item->id]) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-success" type="submit" id="btn-wa"
                                                        name="hasil_akhir" value="diterima">
                                                        <i class="bi bi-check-circle">
                                                        </i>
                                                    </button>
                                                    <button class="btn btn-danger" type="submit" name="hasil_akhir"
                                                        value="ditolak">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif(auth()->user()->role == 'non-admin')
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead class="table-light fw-semibold">
                                <tr class="text-center">
                                    <th>Tanggal</th>
                                    <th>Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil_totals as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->status_akhir }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
