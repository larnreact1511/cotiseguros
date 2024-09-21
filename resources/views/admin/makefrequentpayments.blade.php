@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/generaladmin.js') }}" defer></script>
<script src="{{ asset('js/makefrequentpayments.js') }}" defer></script>
<div class="container">

    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
    
    <div class="row" id ="divprincipal">
        <div class="col-12" id="">
            <h3>
                Realiza pago de : {{$company[0]->companyname}}
            </h3>
                <!-- --> 
                <div class="m-0 row justify-content-center mb-2">
                    <?php           
                        foreach ($insurancepolicies as $i )
                        {
                            $tipopoliza='Salud';
                            $monto = number_format($i->idcoverages) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                            ?>
                                <input 
                                            class="form-check-input" 
                                            type="radio" 
                                            name="flexRadioDefault3" 
                                            id="flexRadioDefault3" 
                                            onclick="buscarfrecuencias2(0,<?=$i->idcoverages?>,<?=$i->companyid?>)">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            {{ $monto }}
                                        </label>
                            <?php  
                        }
                    ?>

                </div>
                
                <!-- -->
                <div class="m-0 row justify-content-center ocultardiv mb-2">
                    <form  id ="realizarpagofrecuencia" 
                            name="realizarpagofrecuencia" 
                            method="POST"
                            class="container px-4 my-5"
                            action="pago-colectivo" 
                            enctype="multipart/form-data"
                        >
                        @csrf 
                        <br>
                        <input type="hidden" name="idcompany" id='idcompany' value="{{$id}}">
                        <table id ="tablecontenidoformuariopago3" class="table">

                        </table>    
                        <div class="ocultardiv" id="divbtnguardarpagos2" style=" border: 1px solid #fff; display:none;">
                            <button type="button" id="guardarpagpendiente" name="guardarpagpendiente" class="btn btn-primary mt-2"> Guardar Pagos </button>
                        </div>
                        
                    </form>   
                   
                </div>  
                
        </div>
    </div>
</div>



@endsection