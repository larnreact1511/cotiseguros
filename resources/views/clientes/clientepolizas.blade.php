@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:45vh;">
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/salud" style ="text-decoration:none; color:#fff;">
                <i class="bi-person-plus-fill bi--md"></i>
                Salud
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/auto" style ="text-decoration:none; color:#fff;">
                <i class=" bi-truck bi--md"></i>
                
                Autos
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/patrimonio" style ="text-decoration:none; color:#fff;">
                <i class=" bi-building bi--md"></i>
                Patrimonio
                </a>
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/usuarios" style ="text-decoration:none; color:#fff !important;">
                <i class=" bi-skip-start-fill bi--md"></i>
                Volver
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/logout" style ="text-decoration:none; color:#fff;">
                <i class=" bi bi-power bi--md"></i>
                Cerrar
                </a>
                
            </h6>     
        </div>
    </div>
</div>

@endsection
