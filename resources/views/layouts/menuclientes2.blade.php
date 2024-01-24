		
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title> Usuarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>	
    
    
  </head>
  <style>
    #sidebar-nav {
    width: 160px;
}
  </style>
  <body>
		
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto px-0">
                    <div id="sidebar" class="collapse collapse-horizontal show border-end">
                        <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-bootstrap"></i> <span>Item</span> </a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-film"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-heart"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-bricks"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-clock"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-archive"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-gear"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-calendar"></i> <span>Item</span></a>
                            <a href="#" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="bi bi-envelope"></i> <span>Item</span></a>
                        </div>
                    </div>
                </div>
                <main class="col ps-md-2 pt-2">
                    <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none"><i class="bi bi-list bi-lg py-2 p-1"></i> Menu</a>
                    @yield('content')
                </main>
            </div>
        </div>
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5" style="text-align: center;">
        
      </div>
	  </div>    
     <!-- Footer -->
    <div class="row bg-dark p-0 m-0 pt-4 px-5" id="footer" style="text-align: center;">
      <div class="col-12 col-md-3 p-2 m-0">
        <img src="{{ asset('storage/LOGO RGB_Icono full color (1).png') }}" style="width: 100px ;" alt="">
      </div>
      <div class="col-12 col-md-3 mt-3">
          <h2 class="mon-bold text-white text-uppercase fs-5 d-none">donde estamos</h2>
          <p class="mon-regular text-white fs-6 pt-3 d-none">{{ $footer->donde_estamos }}</p>
      </div>
      <div class="col-12 col-md-3 mt-3">
          <h4 class="mon-bold text-white text-uppercase fs-5">contactanos</h4>
          <img src="{{ asset('envelope-fill.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->email }}</span> <br/>
          <?php $url="whatsapp://send?phone=+584247089641&text=hola"; ?>
          <a href="<?=$url?>" style ="text-decoration:none;">
          <img src="{{ asset('whatsapp.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->whatsapp }}</span> 
          </a><br/>
          
      </div>
      <div class="col-12 col-md-3 mt-3">
        <h4 class="mon-bold text-white text-uppercase fs-5">siguenos</h4>
        <a class="mx-2" href="{{ $footer->instagram }}"><img src="{{ asset('instagram.svg') }}" alt=""></a>
        <a class="mx-2" href="{{ $footer->facebook }}"><img src="{{ asset('facebook.svg') }}" alt=""></a> 
        <a class="mx-2" href="{{ $footer->tiktok }}"><img src="{{ asset('tiktok.svg') }}" alt=""></a>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-white " style="font-size: 10px;">COTISEGUROS 	&copy; 2022 - Todos los derechos reservados </p>
        </div>
    </div>
    <!-- -->
    <script src="{{ asset('sidebar/js/jquery.min.js') }}"></script>
    <script src="{{ asset('sidebar/js/popper.js') }}"></script>
    <script src="{{ asset('sidebar/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sidebar/js/main.js') }}"></script>
    
  </body>
</html>
