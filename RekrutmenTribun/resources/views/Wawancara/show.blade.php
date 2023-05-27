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
            <div class="container mb-3">
                <div class="card p-2 font-weight-bold bg-opacity-10 bg-black">
                    Nama : {{ $nama[0]->name }}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table border table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>KTP</th>
                            <th>NPWP</th>
                            <th>CV</th>
                            <th>Lamaran</th>
                            <th>Data Pendukung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftars as $item)
                            <tr>
                                <td>
                                    <a href="{{ asset('storage/daftar/' . $item->ktp) }}"
                                        class="btn btn-outline-dark rounded-circle"type="button">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/daftar/' . $item->npwp) }}"
                                        class="btn btn-outline-dark rounded-circle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/daftar/' . $item->cv) }}"
                                        class="btn btn-outline-dark rounded-circle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/daftar/' . $item->surat_lamaran) }}"
                                        class="btn btn-outline-dark rounded-circle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    @if ($item->data_pendukung == '-')
                                        -
                                    @else
                                        <a href="{{ asset('storage/daftar/' . $item->data_pendukung) }}"
                                            class="btn btn-outline-dark rounded-circle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('wawancara.update', $wawancaras->id) }}" method="post">
                @csrf
                @method('PATCH')
                <textarea id="editor" name="catatan">{!! $wawancaras->catatan !!}</textarea>
                <button class="btn btn-outline-primary btn-block my-2" type="submit">
                    Simpan
                </button>
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
