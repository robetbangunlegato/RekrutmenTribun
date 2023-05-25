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
            <form action="{{ route('soal.store') }}" method="post">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                    <label for="">Pilih kategori</label>
                    <select class="form-select mb-3" name="kategori_soal_id">
                        <option selected value="">Pilih Kategori Soal</option>
                        @foreach ($kategori_soal as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori_soal }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('kategori_soal_id'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('kategori_soal_id') }}
                        </div>
                    @endif
                    <label for="exampleFormControlInput1" class="form-label">Masukan Soal</label>
                    <textarea name="soal" id="editor" cols="30" rows="10"></textarea>
                    @if ($errors->has('soal'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                            {{ $errors->first('soal') }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <button class="btn btn-primary col-12 mb-3" type="submit">Simpan</button>
                </div>
            </form>
            <div class="container">
                <div class="container">
                    <table class="table border table-hover ">
                        <thead class="table-light">
                            <tr>
                                <td>
                                    No
                                </td>
                                <td class="text-center">
                                    Kategori
                                </td>
                                <td class="text-center">
                                    Soal
                                </td>
                                <td class="text-center">
                                    Kontrol
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($soals as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                    <td class="text-center">
                                        {{ $item->kategori_soals->kategori_soal }}
                                    </td>
                                    <td class="text-center" style="background-color: white">{!! $item->soal !!}</td>
                                    <td class="text-center">
                                        <a href="http://" class="btn btn-warning">Edit</a>
                                        <a href="http://" class="btn btn-danger">Hapus</a>
                                        <a href="{{ route('soal.show', $item->id) }}" class="btn btn-info">Buat plihan</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('editor', {
            toolbar: [{
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'SelectAll']
                },
                '/',
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks']
                }
            ]
        });
    </script>
@endsection
