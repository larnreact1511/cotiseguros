@extends('layouts.app')

@section('content')

  <div id="navbar"></div>
    <!-- Primer Slider -->
    <div class="swiper primer-slider d-block w-100">
      <div class="swiper-wrapper h-100">
        @foreach ($primer_slider as $item)
          <div class="swiper-slide d-block h-100 bg-white">
            @include('components/banner-index',$item)
          </div>
        @endforeach
      </div>
      <div class="swiper-button-next" style="color: #212529 !important ;"></div>
      <div class="swiper-button-prev" style="color: #212529 !important ;"></div>
      <div class="swiper-pagination"></div>
    </div>
    <!-- Optavo Slide -->
    <div class="row justify-content-center p-2">
      <div class="col-md-2">
        <div class="w-100 align-items-center justify-content-center">
          <h5 id="trabajamos" class="mon-black text-uppercase text-center text-wine">Aliados Comerciales</h5>
        </div>
      </div>
      <div class="col-md-9">
        <div class="w-100 d-md-block ">
          <div class=" swiper sexto-slider-3 w-100">
            <div class="swiper-wrapper">
              @foreach ($insurers as $item)
              <div class="card  swiper-slide d-flex flex-column align-items-center">
                <img class="w-100" src="{{ asset('storage/' . $item->image) }}" alt="">
              </div>
              @endforeach
            </div>
            <!--
            <div class="swiper-button-next" style="color: #212529 !important ;"></div>
            <div class="swiper-button-prev" style="color: #212529 !important ;"></div>
            -->
          </div>
        </div>
      </div>
    </div>
    <!---->
    <!-- Segundo Slide 12221 -->
    <div class="container">
      <div class="w-100 d-flex flex-column flex-md-row align-items-center justify-content-center">
        @foreach ($typeInsurer as $type)
        <a href="#">
          <div 
            class="position-relative overflow-hidden card-v bg-light p-3 rounded d-flex flex-column align-items-center justify-content-center mb-5 m-3"
            onclick="location.href='{{ $type->link }}'">
            <img class="w-100" src='{{ asset("storage/$type->image") }}' alt="">
            <h3 class="w-100 text-center mon-bold m-1 mon-black text-uppercase text-wine">{{ $type->button }}</h3>
            
          </div>
        </a>
        
        @endforeach
      </div>
    </div>
    <!-- Segundo Slide --> 
    <!-- Septimo Slide -->
    <div class="w-100 bg-light">
      <div class="container">
        <div class="w-100 d-flex flex-column flex-md-row py-5 bg-light">
          <div class="w-100 h-100 px-3 mb-5">
            <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
              <h4 class="mon-black text-rojo text-center text-uppercase text-wine">estamos<br/>siempre contigo</h4>
              <p class="mon-regular text-center h6">Protegete a ti y a los tuyos contra todo riesgo. Ten siempre la proteccion de un seguro en tus manos</p>
            </div>
            <div class="row px-0 mx-0">
              <div class="col-12 col-md-4 px-3 mx-0 text-center">
                <img class="w-50 text-center" src="{{ asset('storage/mapa_de_venezuela_ai_mapa_de_venezuela_mapa_de_venezuela.png') }}" alt="">
                <h2 class="mon-light text-center text-uppercase fs-6">servimos a</h2>
                <h2 class="mon-black text-center text-uppercase fs-6 text-rojo">nivel nacional</h2>
              </div>
              <div class="col-12 col-md-4 px-3 mx-0 text-center">
                <img class="w-50" src="{{ asset('storage/grupo.png') }}" alt="">
                <h2 class="mon-light text-center text-uppercase fs-6">mas de 20</h2>
                <h2 class="mon-black text-center text-uppercase fs-6 text-rojo">aseguradoras</h2>
              </div>
              <div class="col-12 col-md-4 px-3 mx-0 text-center">
                <img class="w-50" src="{{ asset('storage/24.png') }}" alt="">
                <h2 class="mon-light text-center text-uppercase fs-6">te atendemos</h2>
                <h2 class="mon-black text-center text-uppercase fs-6 text-rojo">las 24hrs</h2>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Septimo Slide -->
    <!-- Quinto Slide -->
    <div id="concenos" class="w-100 bg-light justify-content-center">
      <div class="container bg-light py-3">
        <div id="conocenos" class="w-100 d-flex flex-column flex-md-row bg-light px-5">
          <div class="w-100  d-flex flex-column justify-content-center align-items-start">
            <img class="w-100 h-100" src="{{ asset('storage/young-couple-buying-car-in-car-showroom.png') }}" style="object-fit: cover ;" alt="">
          </div>
          <div class="w-100  p-2 m-2 justify-content-center text-center">
            <h3 class="mon-light fs-3 text-uppercase text-left">somos</h3>
            <h1 class="mon-bold fs-1 text-uppercase text-wine">cotiseguros</h1>
            <p class="mon-regular fs-5">Somos corretaje de seguros.</p>
            <p class="mon-regular fs-5 mt-5">Debido a nuestra amplia experiencia en seguros, brindamos para tu tranquilidad, el producto ideal que se adapta a tus necesidades.</p>
            <h3 class="mon-light fs-3 text-left mt-5">Tu seguridad es</h3>
            <h1 class="mon-bold fs-1 text-uppercase text-wine">nuestra prioridad</h1>
            <div class="w-100 d-flex justify-content-center mt-5">
              <a class="mon-light p-3 px-5 bg-pink rounded-pill text-decoration-none text-white fs-6" href="/cotizador/salud">cotiza tu póliza al momento</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Quinto Slide -->
    <!-- Tercero Slide -->
    <div class="container">
      <div class="w-100 pb-3 d-flex flex-column align-items-center justify-content-center mb-3 my-5">
        <h2 class="text-uppercase mon-black text-wine text-center">Combos a tu medida</h2>
        <!--<p class="mon-light text-center p-1">Dinos lo que esta pasando, para ayudarte</p>-->
      </div>
      <div class="w-100 mb-5 pb-5 d-flex flex-column flex-md-row align-items-center justify-content-center">
        @foreach ($packages as $p)
        <div class="position-relative overflow-hidden card-v bg-light p-3 rounded d-flex flex-column align-items-center justify-content-center mb-5 mx-3">
          <img class="w-50" src='{{ asset("storage/$p->banner_image") }}' alt="">
          <h3 class="w-100 text-center mon-bold my-3">{{ $p->name }}</h3>
          <p class="w-100 mon-light text-center">{{ $p->description }}</p>
          <a class="rounded-pill p-3 bg-pink text-white text-decoration-none" href="{{ $p->link }}">{{ $p->button }}</a>
          <div class="position-absolute bg-white w-100 h-100 rounded banner-v d-flex flex-column">
            <img class="w-100 h-75 object-fit" src='{{ asset("storage/$p->banner_image") }}' alt="">
            <div class="w-100 h-25 bg-dark p-3 position-relative d-flex align-items-center ">
              <h4 class="text-center text-white mon-black m-0 p-0 w-100">{{ $p->banner_title }}</h4>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- Tercero Slide -->
    <!-- Sexto Slide -->
    <div class="w-100 bg-light py-5">
      <div class="container-fluid bg-light">
        <div class="w-100 bg-light d-flex flex-column align-items-center justify-content-center mb-3 pt-5">
          <h2 class="text-uppercase mon-black text-wine text-center">¿contra que te protegemos?</h2>
          <p class="mon-light text-center p-1">Siempre encontramos la mejor poliza para tu necesidad</p>
        </div>
        <div class="w-100 px-5 bg-light py-5 d-none d-md-block ">
          <div class=" swiper sexto-slider-1 w-100">
            <div class="swiper-wrapper">
              @foreach ($sexto_slider as $item)
                <div class="card  swiper-slide d-flex flex-column align-items-center">
                  <div class="w-50 p-2">
                    <img src="{{ asset('storage/' . $item->imagen) }}" alt="">
                      <h3 class="mon-bold my-3 text-center">{{ $item->titulo }}</h3>
                      <p class="mon-light text-center p-3">{{ $item->descripcion }}</p>
                      <div 
                        onClick="openModalSmall('{{$item->imagen_modal}}','{{ $item->link }}')" 
                        data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" 
                        class="p-3 bg-pink rounded-pill text-decoration-none text-white mt-3">{{ $item->boton }}
                      </div>
                  </div>
                  
                </div>
              @endforeach
            </div>
            <div class="swiper-button-next" style="color: #212529 !important ;"></div>
            <div class="swiper-button-prev" style="color: #212529 !important ;"></div>
          </div>
        </div>
        <div class="w-100 bg-light py-5 d-block d-md-none">
          <div class="swiper sexto-slider-2 w-100">
            <div class="swiper-wrapper">
              @foreach ($sexto_slider as $item)
              <div class="swiper-slide px-5 d-flex flex-column align-items-center">
                <img src="{{ asset('storage/' . $item->imagen) }}" alt="">
                <h3 class="mon-bold my-3 text-center">{{ $item->titulo }}</h3>
                <p class="mon-light text-center">{{ $item->descripcion }}</p>
                <div onClick="openModalSmall('{{$item->imagen_modal}}','{{ $item->link }}')" class="p-3 bg-pink rounded-pill text-decoration-none text-white mt-3">{{ $item->boton }}</div>
              </div>
              @endforeach
            </div>
            <div class="swiper-button-next" style="color: #212529 !important ;"></div>
            <div class="swiper-button-prev" style="color: #212529 !important ;"></div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- Sexto Slide -->
    <div class="w-100 panel-4-desk d-block d-md-none position-relative">
      <img class="w-100 panel-4-desk" src="{{ asset('storage/head-1Mesa-de-trabajo-2-copia-4.png') }}" style="z-index: -1000;" alt="">
      <div class="container position-absolute w-100 h-100 top-0" style="z-index: 1000000">
        <div class="row">
          <div class="col-12">
            <div class="d-flex d-lg-none w-100 h-100 flex-column align-items-center justify-content-center">
              <h3 class="h5 mon-black text-white mt-5 mb-0">Si ya eres...</h3>
              <h4 class="display-6 mon-black text-white mb-3">CLIENTE</h4>
              <a class="rounded-pill bg-pink p-3 px-5 mon-black h4 text-white text-decoration-none" href="https://dev.cotiseguros.com.ve/cotizador/salud">cotiza gratis</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container panel-4-desk d-flex d-md-none justify-content-center position-relative">
      <div class="row">
        <div class="col-12 ">
          <div class="swiper cuarto-slider content-4-slide border-10 start-0" style="top: -40px ;">
            <div class="swiper-wrapper border-10">
              @foreach ($cuarto_slider as $item)
              <div class="swiper-slide w-100 h-100 border-10">
                <img class="w-100" src="{{ asset('storage/' . $item->imagen) }}" alt="">
              </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Cuarto Slide -->
    <div class="row w-100 justify-content-center p-5 m-5">
      <div class="row">
      <div class="col-md-6 justify-content-center">
        <button href="#" class="btn btn-primary btn-phone btn-block"><i class="fa fa-lg fa fa-phone mr-2"></i>LLamanos</button>
      </div>
      <div class="col-md-6 justify-content-center">
        <button href="https://wa.me/584247089641" target="_blank"  class="btn btn-whatsapp btn-block"><i class="fa fa-lg fa fa-phone mr-2"></i>whatsapp</button>
      </div>
      </div>
    </div>
    <!-- Noveno Slide -->
    @if ( count( $noveno_slider ) > 0 )
      @include('components/banner-index', [ "item" => $noveno_slider[0]] )
    @endif
    <!-- Noveno Slide -->
    <div id="panel-small" style="display: none ;z-index: 1000000 ;" class="position-fixed w-100 h-100 start-0 top-0 justify-content-center align-items-center">
      <div class="modal-small bg-white shadow rounded position-relative">
        <img id="modal-small-image" class="position-absolute top-0 start-0 w-100 h-100" src="" alt="">
        <div onClick="closeModalSmall()" class="position-absolute text-dark top-0 start-0 w-100 p-2 d-flex justify-content-end align-items-center">
          x
        </div>
        <div class="position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-center align-items-center">
          <a id="modal-link" target="_blank" class="btn rounded-pill bg-pink text-white"> <img src="/storage/Recurso 1.png" width="20" height="20" alt=""> Pregunta a un experto</a>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script>
        var swiper = new Swiper(".primer-slider", {
          pagination: {
          el: ".swiper-pagination",
        },
            loop: true,
            autoplay: {
                delay: 10000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
      });

      var swiper4 = new Swiper(".cuarto-slider", {
        pagination: {
          el: ".swiper-pagination",
        },
            loop: true,
            autoplay: {
                delay: 3000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
      });

      var swiper6_1 = new Swiper(".sexto-slider-1", {
        pagination: {
          el: ".swiper-pagination",
        },
            slidesPerView: 3,
            spaceBetween: 10,
            loop: true,
            
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
      });
      var swiper6_1 = new Swiper(".sexto-slider-3", {
        pagination: {
          el: ".swiper-pagination",
        },
            slidesPerView: 5,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
      });

      var swiper6_2 = new Swiper(".sexto-slider-2", {
        pagination: {
          el: ".swiper-pagination",
        },
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
      });

      function openModalSmall(image,link){
        $("#modal-link").attr("href",`${link}`);
        $("#modal-small-image").attr("src",`storage/${image}`);
        $("#panel-small").css("display","flex");
      }

      function closeModalSmall(){
        $("#panel-small").css("display","none");
      }
    </script>
    <!-- Scripts -->
@endsection
