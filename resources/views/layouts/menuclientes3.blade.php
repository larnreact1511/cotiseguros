
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
   .sidebar {
    height: 80%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #f8f9fa;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top:0px;
}

.sidebar a {
  padding-left: 15px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
  min-height: 80vh!important;
}
.cabezera{

  background-color:aqua!important;
  height: 20%;
  background-image: url('https://picsum.photos/200/300');
}
.lista{
 
}
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}

  </style>
  <body>
    <div id="mySidebar" class="sidebar">
      <div class="cabezera" onclick="closeNav()"></div>
      <div class="lista">
        <a href="mispolizas"><span class="fa fa-home mr-3"></span> Mis polizas</a><hr>
        <a href="missninestros"><span class="fa fa-home mr-3"></span> Siniestros</a><hr>
        <a href="mispagos"><span class="fa fa-home mr-3"></span> Pagos</a><hr>
        <a href="misdatos"><span class="fa fa-home mr-3"></span> Datos</a><hr>
        <a href="logout"><span class="fa fa-download mr-3 notif"></span> Salir</a><hr>
      </div>
    </div>
    <!-- -->
    <div id="main">
      <!-- -->
      <div class="row">
        <div class="col-md-3">
          <button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>  
        </div>
      </div>
      <!-- -->
      @yield('content')
      <!-- -->
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
    <script>
      openNav()
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }
    </script>
  </body>
</html>