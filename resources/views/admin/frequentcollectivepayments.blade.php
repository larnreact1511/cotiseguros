@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/frequentcollectivepayments.js') }}" defer></script>
<div class="container">

    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
    
    <div class="row" id ="divprincipal">
        <div class="col-12" id="">
            <h3>
                Agrega frecuencia de pagos ha : {{$company[0]->companyname}}
            </h3>
            <!-- --> 
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
                <!-- -->
                <div class="m-0 row justify-content-center ocultardiv" id="div_frecuencias" style='display:none;'>
                    <?php 
                        foreach ($frequencies as $frequencie) 
                        { 
                            ?> 
                                <input 
                                    
                                    style="padding:5px;"
                                    type="radio" 
                                    name="frequencie" 
                                    id="frequenciepagos" 
                                    onclick="frecuencia(<?=$frequencie->frequency ?>)"
                                >
                                    
                                    <label class="form-check-label" for="frequenciepagos">
                                        <?php echo $frequencie->name; ?>
                                    </label>
                            <?php 
                        } 
                    ?>  
                    <label>Fecha de Inicio pagos </label>
                    <input 
                        class="form-check-input"  
                        type="date" 
                        name="fechainicio" 
                        id="fechainicio" value="<?= date('Y-m-d'); ?>"
                        >
                        <button type="button" id="calcularpagos" name="calcularpagos"> Calcular</button>     
                </div>  
                <div  style="border: 1px solid #fff; display:none;">
                    
                        <form  id ="formulariospagorealizar2" 
                            name="formulariospagorealizar2" 
                            method="POST"
                            class=""
                            action="frecuenciapagos" 
                            
                        >
                            @csrf 
                            <table id="tablacontenidoformuariopago2" class="table">
                                   
                            </table>
                            <br>
                            <button 
                                type="button" 
                                id="guardarpagos" 
                                name="guardarpagos" 
                                class="btn btn-primary mt-2" 
                                style="display:none;"> 
                                    Guardar fechas
                            </button>
                        </form>           
                </div> 
                <!-- -->
        </div>
    </div>
</div>



@endsection