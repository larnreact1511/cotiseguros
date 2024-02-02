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
                <i class="bi-person-plus-fill bi--md"></i>
                
                <strong>Salud</strong>
                
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/cliente/auto" style ="text-decoration:none; color:#596475;">
                <i class=" bi-truck bi--md"></i>
                
                <strong>Autos</strong>
                </a>
                
            </h6>     
        </div>
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear-4"
                >
                <a href="{{env('APP_URL')}}/cliente/patrimonio" style ="text-decoration:none; color:#596475;">
                <i class=" bi-building bi--md"></i>
                <strong>Patrimonio</strong>
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
