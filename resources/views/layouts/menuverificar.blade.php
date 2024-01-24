
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title> Usuarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
    <link href="{{ asset('sidebar/css/style.css') }}" rel="stylesheet">
    
    <!-- para el acordeon --> 
    <link href="{{ asset('asegurado/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asegurado/personal.css') }}" rel="stylesheet">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch" style="height:80vh" >
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	        </button>
        </div>
	  		<div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
	  			<div class="user-logo">
	  				<div class="img" style="background-image: url( {{ asset('sidebar/images/logos.png') }} )"></div>
	  				<h3>Cotiseguros</h3>
	  			</div>
	  		</div>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="adminclientes"><span class="fa fa-home mr-3"></span> Inicio</a>
          </li>
          <li>
              <a href="logout"><span class="fa fa-download mr-3 notif"></span> Salir</a>
          </li> 
        </ul>

    	</nav>
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5" style="text-align: center;">
        @yield('content')
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