@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <label for="">Nama</label>
                <input type="text" class="form-control" value="{{ $users->name }}" readonly>
                <form action="{{ route('setting.update', [$users->id]) }}" method="post">

                    @method('PATCH')
                    @csrf
                    <div class="mt-3">
                        <label class="" for="inputGroupSelect01">Pilih Peran</label>
                        <div class="input-group">
                            <select class="form-select col-12" id="inputGroupSelect01" name="peran">
                                <option value="" selected>Peran saat ini : {{ $users->role }}</option>
                                <option value="non-admin">Non-admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <p class="text-danger">| Opsional |</p>
                    </div>
                    <div class="mt-3">
                        <label for="">Masukan kata sandi baru</label>
                        <input type="password" name="kata_sandi" class="form-control">
                        <p class="text-danger">| Opsional |</p>
                    </div>
                    <button class="btn btn-primary col-12" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
