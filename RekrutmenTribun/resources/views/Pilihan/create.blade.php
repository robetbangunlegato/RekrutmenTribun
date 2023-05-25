@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('pilihan.store') }}">
                @csrf

                <label for="">Pilih soal</label>
                <select class="form-select mb-3" name="kategori_soal_id">
                    <option selected value="">Pilih Soal</option>
                    @foreach ($soals as $item)
                        <option value="{{ $item->id }}">{!! $item->soal !!}</option>
                    @endforeach
                </select>
                @if ($errors->has('kategori_soal_id'))
                    <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                        {{ $errors->first('kategori_soal_id') }}
                    </div>
                @endif


                <label for="">Masukan pilihan</label>
                <textarea name="editor" id="" cols="30" rows="10"></textarea>

                <button type="submit" class="btn btn-primary col-12 my-3">Simpan</button>
            </form>
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
