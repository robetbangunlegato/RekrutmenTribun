@extends('Navbar.index')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($daftars as $item)
            @endforeach
        </div>
    </div>
@endsection
