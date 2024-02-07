@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:45vh;">
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/cliente/salud" style ="text-decoration:none; color:#596475;">
                
                <img 
                    class="w-10" 
                    height="30"  
                    width ="30" 
                    src="{{env('APP_URL')}}/imqr/latido_del_corazon.png"
                    >
                <strong>Pólizas de Salud</strong>
                
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/cliente/auto" style ="text-decoration:none; color:#596475;">
                <img 
                    class="w-10" 
                    height="30"  
                    width ="30" 
                    src="{{env('APP_URL')}}/imqr/coche_electrico.png"
                    >
                
                <strong>Pólizas de Autos</strong>
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/cliente/patrimonio" style ="text-decoration:none; color:#596475;">
                <img 
                    class="w-10" 
                    height="30"  
                    width ="30" 
                    src="{{env('APP_URL')}}/imqr/casa.png"
                    >
                <strong>Pólizas Patrimonniales</strong>
                </a>
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/usuarios" style ="text-decoration:none; color:#596475 !important;">
                <i class=" bi-skip-start-fill bi--md"></i>
                <strong>Volver</strong>
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/logout" style ="text-decoration:none; color:#596475;">
                <i class=" bi bi-power bi--md"></i>
                <strong>Cerrar</strong>
                </a>
                
            </h6>     
        </div>
    </div>
</div>

@endsection
