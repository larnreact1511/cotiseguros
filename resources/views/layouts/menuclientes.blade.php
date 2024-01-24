<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cliente Cotiseguros</title>
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapicons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personales2.css') }}" rel="stylesheet">
    </head>
  <body>
    <?php $url='http://127.0.0.1:8000/';?>
    <!-- --> 
    <div class="offcanvas offcanvas-start w-25 " tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header colormenulateral">
            <img src="<?=$url;?>LOGORGBColor.png" class="imglogo"  data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="<?=$url;?>LOGORGBColormin.png" class="imglogo2"  data-bs-dismiss="offcanvas" aria-label="Close">
            <!--<i class="fs-4 bi bi-arrow-left-square-fill" data-bs-dismiss="offcanvas" aria-label="Close"></i>-->
        </div>
        <div class="offcanvas-body px-0 colormenulateral">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center " id="menu" style="color:red;">
                <li class="nav-item">
                    <a href="mispolizas" class="nav-link text-truncate">
                    <i class="fs-4 bi bi-bag-check-fill"></i><span class="ms-1 d-none d-sm-inline">Mis polizas</span>
                    </a>
                </li>
                <li>
                    <a href="missninestros" class="nav-link text-truncate">
                        <i class="fs-4 bi bi-exclamation-lg"></i><span class="ms-1 d-none d-sm-inline">Siniestros</span> </a>
                </li>
                
                <li>
                    <a href="mispagos" class="nav-link text-truncate">
                        <i class="fs-4 bi bi-wallet2"></i><span class="ms-1 d-none d-sm-inline">Pagos</span></a>
                </li>
                <li>
                    <a href="misdatos" class="nav-link text-truncate">
                    <i class="fs-4 bi bi-person-fill-check"></i><span class="ms-1 d-none d-sm-inline">Datos</span></a>
                </li>
                <li>
                    <a href="logout" class="nav-link text-truncate">
                    <i class="fs-4 bi bi-power"></i><span class="ms-1 d-none d-sm-inline">Salir</span>   
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- --> 
    <div class="container-fluid">
      
        <div class="row">
            <div class="col-md-3 p-1">
                <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                    <i class="fs-1  bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                </button>
            </div>
            <div class="col-md-3 p-1 opciones">
                <button type="button" class="btn"> 
                <!--<i class="fs-2 bi bi-person-fill-check"></i> -->
                <img src="<?=$url;?>user.png" alt="">
                <h5>
                Usuario <?=@$user[0]->nombre. ' '.@$user[0]->apellido;  ?>
                </h5>
                </button>
              
            </div>
            <div class="col-md-3 p-1 opciones">
                <button type="button" class="btn"> 
                    <a href="logout" class="nav-link text-truncate">
                    <!--<i class="fs-2 bi bi-power"></i><span class="ms-1 d-none d-sm-inline"></span>--> 
                    <img src="<?=$url;?>log-out.png" alt="">   
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