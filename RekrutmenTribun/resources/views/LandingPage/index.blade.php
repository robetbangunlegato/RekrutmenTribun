<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>

<body class="p-3">
    <div class="container-fluid">
        <div class="row col-lg-12 col-md-12 col-sm-12" style="background-color: beige; border-radius: 5px;">
            <div class="col-lg-2 col-md-2 col-sm-4 pb-1 mt-2"><a href="https://www.instagram.com/tribunsumsel/"
                    class="text-decoration-none" style="font-style: normal; color: black;">Instagram
                    <i class="bi bi-instagram bi-100">
                    </i>
                </a></div>
            <div class="col-lg-2 col-md-2 col-sm-4 pb-1 mt-2"><a href="https://twitter.com/tribun_sumsel"
                    class="text-decoration-none" style="font-style: normal; color: black;">Twitter
                    <i class="bi bi-twitter bi-100">
                    </i>
                </a></div>
            <div class="col-lg-2 col-md-2 col-sm-4 pb-1 mt-2"><a
                    href="https://web.facebook.com/harian.tribun.sumsel/?_rdc=1&_rdr" class="text-decoration-none"
                    style="font-style: normal; color: black;">Twitter
                    <i class="bi bi-facebook bi-100">
                    </i>
                </a>
            </div>
            <div class="col-lg-3 col-md-3"><img src="logo_sripo.png" class="img-fluid d-none d-md-block m-2"
                    alt="sripo_logo" style="float: right;" width="45%" height="45%"></div>
            <div class="col-lg-3 col-md-3"><img src="logo_tribun.png" class="img-fluid d-none d-md-block"
                    alt="tribun_logo" style="float: right;" width="45%" height="45%"></div>
        </div>
    </div>

    <div class="container-fluid p-2">
        <div class="row text-center">
            <div class="col-lg-4 col-md-12 col-sm-12 ">
                <i class="bi bi-geo-alt" style="font-style: normal;"> Jln
                    Alamsyah Ratu Prawira Negara
                    No.123</i>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 text-center " style="">
                <div class="" style="">
                    <i class="bi bi-whatsapp" style="font-style: normal"> 08153857185</i>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 ">
                <i class="bi bi-envelope-at" style="font-style: normal"> tribunxsripo@gmail.com</i>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row text-center m-5">
            <div class="col-lg-6 ">
                <div class="row">
                    <h1 class="justify-content-center align-self-start py-5">Ayo Bergabung!</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">

                        <a href="{{ url('lamaran/') }}" class="btn btn-primary" id="loading-page">Daftar</a>
                        {{-- <button class="btn btn-primary mt-2">Daftar</button> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="/office.png" class="d-none d-md-block" alt="" style="" width="100%"
                    height="100%">
            </div>

        </div>
    </div>
</body>

</html>
<script>
    document.getElementById("loading-page").addEventListener("click", function() {
        window.location.href = "/loading";
    });
</script>
