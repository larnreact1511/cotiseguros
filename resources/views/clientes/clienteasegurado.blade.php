@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:45vh;">
    <!--
    <img src="https://cotiseguros.com.ve/saludo.png" style="width: 80%;">
    -->
    <!-- --> 
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
        
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-polizas" style ="text-decoration:none; color:#fff;">
                <i class="bi-bag-check-fill bi--md"></i>
                Mis polizas !!!!
                </a>
                
            </h6>     
        </div>
        
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-siniestros" style ="text-decoration:none; color:#fff;">
                <i class="bi-exclamation bi--md"></i>
                Mis siniestros
                </a>
                
            </h6>     
        </div>

        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-pagos" style ="text-decoration:none; color:#fff;">
                <i class="bi-wallet2 bi--md"></i>
                Mis pagos
                </a>
                
            </h6>     
        </div>

        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-datos" style ="text-decoration:none; color:#fff;">
                <i class="bi-person-fill-check bi--md"></i>
                Mis datos
                </a>
                
            </h6>     
        </div>

        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/logout" style ="text-decoration:none; color:#fff;">
                <i class="bi-power bi--md"></i>
                Cerrar
                </a>
                
            </h6>     
        </div>
    </div>
</div>
@endsection
