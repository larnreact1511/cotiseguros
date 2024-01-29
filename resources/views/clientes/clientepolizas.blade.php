@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
        <div class="accordion-item m-2">
            <h6  
                id=""
                class="accordion-header collapsed redondear"
                >
                <a href="{{env('APP_URL')}}/cliente/salud" style ="text-decoration:none; color:#fff;">
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
                Patrimonio
                </a>
            </h6>     
        </div>

    </div>
</div>

@endsection
