@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
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
                Mis polizas
                </a>
                
            </h6>     
        </div>
        
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-siniestros" style ="text-decoration:none; color:#fff;">
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
                Mis datos
                </a>
                
            </h6>     
        </div>

        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/mis-datos" style ="text-decoration:none; color:#fff;">
                Cerrar
                </a>
                
            </h6>     
        </div>

    </div>

</div>
@endsection
