<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cliente Cotiseguros</title>
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapicons/font/bootstrap-icons.min.css') }}" rel="stylesheet"><!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleclient.css') }}" rel="stylesheet">
    <script  src="{{ asset('js/bootstrap.bundle.min.js') }}"> </script>
    </head>
  <body>
   
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-3 p-1 opciones">
                <button type="button" class="btn"> 
                <!--<i class="fs-2 bi bi-person-fill-check"></i> -->
                <img src="{{env('APP_URL')}}/user.png" alt="">
                <h5>
                Usuario <?=@$user[0]->nombre. ' '.@$user[0]->apellido;  ?>
                </h5>
                </button>
              
            </div>
            <div class="col-md-3 p-1 opciones">
                <button type="button" class="btn"> 
                    <a href="{{env('APP_URL')}}/logout" class="nav-link text-truncate">
                    <!--<i class="fs-2 bi bi-power"></i><span class="ms-1 d-none d-sm-inline"></span>--> 
                    <img src="{{env('APP_URL')}}/log-out.png" alt="">   
                    <h5>
                    Salir
                    </h5>
                    </a>
                </button>
            </div>
        </div>
        @yield('content')
      
    </div>
   <!-- Footer -->
    <div class="row bg-dark p-0 m-0 pt-4 px-5" id="footer">
        <div class="col-12 col-md-3 p-2 m-0">
            <img src="https://cotiseguros.com.ve/storage/LOGO RGB_Icono full color (1).png" style="width: 100px ;" alt="">
        </div>
        <div class="col-12 col-md-3 mt-3">
            <h2 class="mon-bold text-white text-uppercase fs-4 d-none">donde estamos</h2>
            <p class="mon-regular text-white fs-6 pt-3 d-none">sgfsgfsg</p>
        </div>
        <div class="col-12 col-md-3 mt-3">
            <h2 class="mon-bold text-white text-uppercase fs-5">contactanos</h2>
            <img src="https://cotiseguros.com.ve/envelope-fill.svg" alt=""> <span class="text-white mon-regular">somos.cotiseguros@gmail.com</span> <br>
            <img src="https://cotiseguros.com.ve/whatsapp.svg" alt=""> <span class="text-white mon-regular">+58 424 7089641</span> <br>
        </div>
        <div class="col-12 col-md-3 mt-3">
            <h2 class="mon-bold text-white text-uppercase fs-5">siguenos</h2>
            <a class="mx-2" href="https://www.instagram.com/cotiseguros/?hl=es"><img src="https://cotiseguros.com.ve/instagram.svg" alt=""></a>
            <a class="mx-2" href="https://www.facebook.com/cotisegurosweb"><img src="https://cotiseguros.com.ve/facebook.svg" alt=""></a> 
            <a class="mx-2" href="https://www.tiktok.com/@cotiseguros"><img src="https://cotiseguros.com.ve/tiktok.svg" alt=""></a>
        </div>
        <div class="col-12">
            <h3 class="text-white h5 my-5">COTISEGUROS 	© 2022 - Todos los derechos reservados</h3>
        </div>
    </div>
    <!-- Footer -->
  
    <!-- --> 
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>