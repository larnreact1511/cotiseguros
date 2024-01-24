<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cotiseguros</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/cotiseguros.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/App.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pretty-checkbox/3.0.3/pretty-checkbox.min.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <div id="navbar"></div>
   
    @yield('content')
    <div class="position-fixed w-100 h-100 top-0" style="display: none;z-index:10000000;" id="menu" data-menu="0">
        <div class="w-100 h-100 bg-white shadow-sm d-flex flex-column pt-3">
            <div class="w-100 d-flex justify-content-center">
                <img class="logo" src="{{ asset('storage/LOGO RGB_Color.png') }}" alt="">
                <div class="position-absolute w-100 d-flex d-sm-flex d-md-none justify-content-start">
                    <img class="px-3 btn-menu" src="{{ asset('menu.svg') }}" height="40" alt="">
                </div>
            </div>
            <div class="w-100 px-5 py-3 mon-bold">Conócenos</div>
            <div class="w-100 px-5 py-3 mon-bold">¿Con quién trabajamos?</div>
            <div class="w-100 px-5 py-3 mon-bold">Contáctenos</div>
            <!--<div class="w-100 px-5 py-3 mon-bold">Iniciar Sesion</div>-->
            <div class="w-100 px-5 py-3 mon-bold">
                <a href="https://cotiseguros.com.ve/cotizador/salud" type="button" class="btn bg-pink text-white mon-bold rounded-pill">Cotiza Gratis</a>
                <!--<button type="button" class="btn bg-pink text-white mon-bold">Unete</button>-->
            </div>
        </div>
    </div>

        <!-- Footer -->
        @if ( isset($footer))
            <div class="row bg-dark p-0 m-0 pt-4 px-5" id="footer">
                <div class="col-12 col-md-3 p-2 m-0">
                <img src="{{ asset('storage/LOGO RGB_Icono full color (1).png') }}" style="width: 100px ;" alt="">
                </div>
                <div class="col-12 col-md-3 mt-3">
                <h2 class="mon-bold text-white text-uppercase fs-5 d-none">donde estamos</h2>
                <p class="mon-regular text-white fs-6 pt-3 d-none">{{ $footer->donde_estamos }}</p>
                </div>
                <div class="col-12 col-md-3 mt-3">
                <h2 class="mon-bold text-white text-uppercase fs-5">contactanos</h2>
                <img src="{{ asset('envelope-fill.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->email }}</span> <br/>
                <img src="{{ asset('whatsapp.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->whatsapp }}</span> <br/>
                </div>
                <div class="col-12 col-md-3 mt-3">
                <h2 class="mon-bold text-white text-uppercase fs-5">siguenos</h2>
                <a class="mx-2" href="{{ $footer->instagram }}"><img src="{{ asset('instagram.svg') }}" alt=""></a>
                <a class="mx-2" href="{{ $footer->facebook }}"><img src="{{ asset('facebook.svg') }}" alt=""></a> 
                <a class="mx-2" href="{{ $footer->tiktok }}"><img src="{{ asset('tiktok.svg') }}" alt=""></a>
                </div>
                <div class="col-12">
                <h3 class="text-white h5 my-5">COTISEGUROS 	&copy; 2022 - Todos los derechos reservados</h3>
                </div>
            </div>

        @endif
  <!-- Footer -->

    <a href="https://wa.me/584247089641"  target="_blank" class="position-fixed shadow-lg bottom-0 end-0 m-3 rounded-pill p-2 bg-white d-flex align-items-center" style="z-index: 20000">
        <img class="d-none" width="200" src="{{ asset('storage/LOGO RGB_Color - copia - copia.png') }}" alt="">
        <img width="30" height="30" class="" src="{{ asset('storage/Recurso 1.png') }}" alt="">
    </a>
    


    <script>
        $(function(){
            $(".btn-menu").on("click",function(){
                
                if( $("#menu").attr("data-menu") == "1" ){
                    $("#menu").css("display","none");
                    $("#menu").attr("data-menu",0);
                } else {
                    $("#menu").css("display","block");
                    $("#menu").attr("data-menu",1);
                }
            })
        })
    </script>
</body>
</html>
