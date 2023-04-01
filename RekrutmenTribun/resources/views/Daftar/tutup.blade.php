@extends('Navbar.index')
@section('content')
    <style>
        #modaltutupform {
            display: block;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="modal fade" id="staticBackdrop" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        </div>
                        <div class="modal-body">
                            Rekrutmen belum dibuka, silahkan tunggu rekrutmen berikutnya.
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button> --}}
                            <a href="http://" class="btn btn-primary" type="button">Buka Formulir</a>
                            {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                            <a href="{{ url('lamaran') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false,
                backdrop: 'static'
            });
            myModal.show();
        });
    </script>
@endsection
