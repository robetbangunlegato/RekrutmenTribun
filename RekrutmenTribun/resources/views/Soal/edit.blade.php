@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('soal.update', [$soals->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <textarea name="soal" id="editor" cols="30" rows="10">{{ $soals->soal }}</textarea>
                @if ($errors->has('soal'))
                    <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 my-3">
                        {{ $errors->first('soal') }}
                    </div>
                @endif
                <button class="btn btn-primary col-12 my-3" type="submit">Simpan</button>
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
