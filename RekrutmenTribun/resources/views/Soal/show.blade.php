@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori Soal : {{ $kategori_soal }}</h5>
                        <p class="card-text">{!! $soal->soal !!}</p>
                    </div>
                </div>
            </div>
            <div class="container my-3">
                <form action="{{ route('pilihan.store') }}" method="post">
                    @csrf
                    <label for="">Masukan pilihan</label>
                    <textarea name="pilihan" id="editor" cols="30" rows="10" class=""></textarea>
                    @if ($errors->has('pilihan'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ $errors->first('pilihan') }}
                        </div>
                    @endif
                    {{-- input poin --}}
                    <label for="" class="mt-3">Poin</label>
                    <input type="text" name="poin" class="form-control" placeholder="Masukan poin pilihan...">
                    @if ($errors->has('poin'))
                        <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3" role="alert">
                            {{ $errors->first('poin') }}
                        </div>
                    @endif
                    {{-- id soal --}}
                    <input type="text" value="{{ $soal->id }}" name="soal_id" hidden>
                    <button type="submit" class="btn btn-primary col-12 mt-3">Simpan</button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table class="table border table-hover">
                    <thead class="table-light text-center">
                        @php
                            $no = 1;
                        @endphp
                        <tr>
                            <td>No</td>
                            <td class="text-center">Pilihan</td>
                            <td>Poin</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pilihans as $item)
                            <tr class="text-center">
                                <td>
                                    {{ $no }}
                                </td>
                                @php
                                    $no = $no + 1;
                                @endphp
                                <td style="background-color: white">
                                    {!! $item->pilihan !!}
                                </td>
                                <td>
                                    {{ $item->poin }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
