@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/acordeon.css') }}">
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/adminstracionclientes.js') }}" defer></script>

<!-- -->
<?php
    
?>
   <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
   <input type="hidden" id="idcliente" name="idcliente" value ="<?=$idcliente; ?>">
   <input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="<?=auth()->id(); ?>"/>
    <div class="accordion" id ="divprincipal">
        <!-- informacion del cliente-->
        <input type="radio" name="toggle" class="accordion-toggle"  />
        <div class="accordion-header">
           Informacion del cliente
        </div>
        <div class="accordion-content ">
            <!-- -->
            <div class="m-0 row justify-content-center">
                
            </div>
            <!-- -->
        </div>
        <!-- polizas-->
        <input type="radio" name="toggle" class="accordion-toggle"  />
        <div class="accordion-header">
           Crear Polias
        </div>
        <div class="accordion-content">
            <div class="m-0 row justify-content-center">
                <!--cabezera , seguros, monto , tipo seguro -->  
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th><label> Monto </label></th>
                                <th><label> Seguro</label></th>
                                <th><label> Tipo seguro</label></th>
                            </tr>
                            <tr>
                                <td>
                                    <select 
                                        name="mnontocobertura" 
                                        id="mnontocobertura" 
                                        class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                        aria-label="Default select example" 
                                        required
                                        >
                                        <option value="0">Seleccione</option> 
                                        <?php  
                                            foreach ($coverages as $c )
                                            {
                                                ?>
                                                    <option value="{{ $c->id }}">{{ number_format( $c->coverage ) }} USD</option> 
                                                <?php  
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select 
                                
                                        name="segurocobertura" 
                                        id="segurocobertura" 
                                        class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                        aria-label="Default select example" 
                                        required
                                        >
                                            <option value="0">Seleccione</option> 
                                            <?php  
                                                foreach ($insurers as $i )
                                                {
                                                    ?>
                                                        <option value="{{ $i->id }}">{{  $i->name }} </option> 
                                                    <?php  
                                                }
                                            ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="radio" id="salud" name="tipopolizas" value="1" onclick="selectsalud();">
                                    <label for="salud">Salud</label>
                                    <input type="radio" id="auto" name="tipopolizas" value="2" onclick="selectauto();">
                                    <label for="auto">Auto</label>
                                    <input type="radio" id="empresa" name="tipopolizas" value="3" onclick="selectempresa();">
                                    <label for="empresa">Empresa</label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- formulario salud -->
                <div class="card" id="divsalud" style="display:none;">
                    <form action="polizassalud" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosalud"
                        name="formulariosalud"
                        class="container px-4 my-5">
                        @csrf
                        <!-- Beneficiarios poliza salud-->
                        <input type="hidden" id="tipopoliza" readonly name="tipopoliza" class="form-control" value =""/>
                        <div id="cotizador" class="row text-center "> 

                        </div>
                        <div class="row text-center ">
                            <div 
                                class="col-3 d-flex flex-column flex-md-row justify-content-center align-items-center my-5"
                                >
                                    <button onClick="addFamiliar()" type="button"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                    añadir integrante a mi poliza
                                        </span>        
                                    </button>
                            </div>                
                        </div>
                        <table id="tablasalud" name="tablasalud" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agrega documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentossalud[]" 
                                    accept="pdf,png,jpg" 
                                >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                    type="text" 
                                    class="custom-file-input" 
                                    name="nombredocumentosalud[]" 
                                    required
                                >
                                </th>
                                
                            </tr>
                        </table>
                        <!-- boton agregar documentos en polizas tipo salud-->
                        <div class="row text-center ">
                            <div 
                                class="col-3 d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                                    <div 
                                        class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded-pill"
                                        >
                                        <button onClick="addocument()" type="button"> 
                                            <span 
                                                    class="ms-3 mon-light">
                                                    Añadir documento
                                            </span>        
                                        </button>

                                    </div>
                            </div>                
                        </div>
                        <!-- btn guardar -->   
                        <div class="row text-center ">
                            <button type="button" onclick="guardarsalud()" >
                                Guardar
                            </button>
                        </div>         
                    </form>
                                       
                </div> 
                <!-- formmulario auto -->
                <div  class="card" id="divauto" style="display:none;">
                    <form action="polizasuato" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosaatuos"
                        name="formulariosaatuos"
                        class="container px-4 my-5">
                        @csrf
                            <input type="hidden" id="tipopoliza2" readonly name="tipopoliza2" class="form-control" value =""/>
                            <div class="row">
                                <div class="col-4 col-md-4 d-flex">
                                    <label>Nro  De placa </label>
                                    <input type="text" id="nroplaca" name="nroplaca"  value="">
                                </div>
                                <div class="col-4 col-md-4 d-flex">
                                    <label> Modelo</label>
                                    <input type="text" id="modelo" name="modelo"  value="">
                                </div>        
                            </div>    
                            <!-- pdf poliza auto-->
                            <table id="tablaautos" name="tablasalud" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agrega documento   </label>
                                    <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            name="documentosautos[]" 
                                            accept="pdf,png,jpg"  
                                            >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentosautos[]" 
                                            required
                                        >
                                    </th>
                                </tr>
                            </table>
                            <!-- --> 
                            <div class="row text-center ">
                                <div 
                                    class="col-3 d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                                        <div 
                                            class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded-pill"
                                            >
                                            <button onClick="addocument2()"  type="button"> 
                                                <span 
                                                        class="ms-3 mon-light">
                                                        Añadir documento
                                                </span>        
                                            </button>

                                        </div>
                                </div>                
                            </div>
                            <!-- -->         
                            <div class="row text-center ">
                                    <button type="button" onclick="guardarpolizaautos()" >
                                        Guardar
                                    </button>
                            </div>
                    </form>
                           
                </div>
                <!-- formulario empresa -->
                <div  class="card" id="divempresas" style="display:none;">
                    <form  action="polizaempresas" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosempresa"
                        name="formulariosempresa"
                        class="container px-4 my-5">
                        @csrf
                        <input type="hidden" id="tipopoliza3" readonly name="tipopoliza3" class="form-control" value =""/>
                        <div class="row">
                            <div class="col-4 col-md-4 d-flex">
                                <label>Nomre de la empresa</label>
                                <input type="text" id="nombreempresa" name="nombreempresa"  value="">
                            </div>
                            <div class="col-4 col-md-4 d-flex">
                                <label> Representante</label>
                                <input type="text" id="representante" name="representante"  value="">
                                
                            </div>        
                        </div>    
                        <!-- pdf poliza auto-->
                        <table id="tablaempresa" name="tablasalud" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agrega documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentosempresa[]" 
                                    accept="pdf" >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                        type="text" 
                                        class="custom-file-input" 
                                        name="nombredocumentosempresa[]" 
                                        required
                                    >
                                </th>
                            </tr>
                        </table>   
                        <!-- --> 
                        <div class="row text-center ">
                            <div 
                                class="col-3 d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                                    <div 
                                        class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded-pill"
                                        >
                                        <button onClick="addocument3()"  type="button"> 
                                            <span 
                                                    class="ms-3 mon-light">
                                                    Añadir documento
                                            </span>        
                                        </button>

                                    </div>
                            </div>                
                        </div> 
                        <!-- -->         
                        <div class="row text-center ">
                                    <button type="button" onclick="guardareempresas()">
                                        Guardar
                                    </button>
                        </div>
                    </form>
                                   
                </div>                    
                <!-- -->
            </div>
        </div>
        <!-- paogs -->
        <input type="radio" name="toggle" class="accordion-toggle" />
        <div class="accordion-header">
            Agregar fechas de pago 
        </div>
        <div class="accordion-content">
            <div class="m-0 row justify-content-center">
                <div class="row mt-2 p-2">
                    <div class="col-12 col-md-12 d-flex">
                        <?php  
                                        
                            foreach ($insurancepolicies as $i )
                                {
                                    $tipopoliza='';
                                    switch ($i->tipopoliza) {
                                        case 1:
                                            $tipopoliza =" Salud ";
                                            break;
                                        case 2:
                                            $tipopoliza =" Autos ";
                                            break;
                                        case 3:
                                            $tipopoliza =" Empresa ";
                                            break;
                                    }
                                    $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                                    ?>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input" 
                                                    type="radio" 
                                                    name="flexRadioDefault" 
                                                    id="flexRadioDefault2" 
                                                    onclick="buscarfrecuencias(<?=$i->id ?>,<?=$i->coverage?>,<?=$i->id_insurancepolicies ?>)">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{ $monto }}
                                                </label>
                                            </div>
                                        </div> 
                                    <?php  
                                }
                        ?>
                    </div>
                </div>                  
            </div>  
            <div class="m-0 row justify-content-center" id="div_frecuencias" style="display:none;">
                <div class="row mt-2 p-2">
                    <div class="col-6 col-md-6 d-flex p-2">
                        <?php foreach ($frequencies as $frequencie) { ?> 
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                        type="radio" name="frequencie" id="frequenciepagos" onclick="frecuencia(<?=$frequencie->frequency ?>)" ><br>
                                    <label class="form-check-label" for="frequenciepagos">
                                        <?php echo $frequencie->name; ?>
                                    </label>
                                </div>
                            </div> 
                        <?php } ?>  
                        <div class="col-md-3 p-2">
                            <div class="form-check">
                                <label>Fecha de Inicio pagos </label>
                                <input class="form-check-input"  
                                    type="date" name="fechainicio" id="fechainicio" value="<?= date('Y-m-d'); ?>">
                                
                            </div>
                        </div>  
                    </div>
                    <div class="col-3 col-md-6 d-flex p-2">
                        <button type="button" id="calcularpagos" name="calcularpagos"> Calcular</button>
                    </div> 
                </div>       
            </div>  
            <div class="m-0 row justify-content-center">
                <div class="col-12 col-md-12 d-flex">
                    <form  id ="formulariospagorealizar2" 
                        name="formulariospagorealizar2" 
                        method="POST"
                        class="container px-4 my-5"
                        action="frecuenciapagos" 
                    >
                        @csrf 
                        <div id="contenidoformuariopago2" class="row">
                            
                            
                        </div>
                        <div class="row" id="divbtnguardarpagos" style="display:none;">
                            <div class="offset-md-3 col-md-6">
                                <button type="button" id="guardarpagos" name="guardarpagos"> Guardar fechas</button>
                            </div>   
                        </div>
                    </form>
                </div>            
            </div>                      
        </div>
        <!-- Realizar pagos Polizas-->
        <input type="radio" name="toggle" class="accordion-toggle" checked />
        <div class="accordion-header">
            Realizar pagos Polizas
        </div> 
        <div class="accordion-content">
            <div class="m-0 row justify-content-center">
                <div class="row mt-2 p-2">
                    <div class="col-12 col-md-12 d-flex">
                        <?php           
                            foreach ($insurancepolicies as $i )
                                {
                                    $tipopoliza='';
                                    switch ($i->tipopoliza) {
                                        case 1:
                                            $tipopoliza =" Salud ";
                                            break;
                                        case 2:
                                            $tipopoliza =" Autos ";
                                            break;
                                        case 3:
                                            $tipopoliza =" Empresa ";
                                            break;
                                    }
                                    $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                                    ?>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input" 
                                                    type="radio" 
                                                    name="flexRadioDefault3" 
                                                    id="flexRadioDefault3" 
                                                    onclick="buscarfrecuencias2(<?=$i->id ?>,<?=$i->coverage?>,<?=$i->id_insurancepolicies ?>)">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    {{ $monto }}
                                                </label>
                                            </div>
                                        </div> 
                                    <?php  
                                }
                        ?>
                    </div>
                </div>  

                <div class="m-0 row justify-content-center">
                    <div class="col-12 col-md-12 d-flex">
                        <form  id ="realizarpagofrecuencia" 
                            name="realizarpagofrecuencia" 
                            method="POST"
                            class="container px-4 my-5"
                            action="adminpagos" 
                            enctype="multipart/form-data"
                        >
                            @csrf 
                            <div id="contenidoformuariopago3" class="row">
                                
                                
                            </div>
                            
                            <div class="row" id="divbtnguardarpagos2" style="display:none;">
                                <div class="offset-md-3 col-md-6">
                                    <button type="button" id="guardarpagpendiente" name="guardarpagpendiente"> Guardar Pago</button>
                                </div>   
                            </div>
                            
                        </form>
                    </div>            
                </div>                 
            </div>                       
        </div>                  
        <!-- sinieestros -->     
        <input type="radio" name="toggle" class="accordion-toggle" />
        <div class="accordion-header">
            Agregar siniestro 
        </div>
        <div class="accordion-content">
            <div class="m-0 row justify-content-center">
               <!-- formulario siniestro -->
               <div  class="card" id="divsiniestro" >
                    <form  action="gudardarsinisestro" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariossiniestros"
                        name="formulariossiniestros"
                        class="container px-4 my-5">
                        @csrf
                        <div class="row">
                            <div class="col-4 col-md-4 d-flex">
                                <label>Descripcion sobre el siniestro</label>
                                <input type="text" id="descripcionsiniestro" name="descripcionsiniestro"  value="">
                            </div>
                            <div class="col-4 col-md-4 d-flex">
                                <label> Monto del siniesro</label><br>
                                <input type="text" id="montosiniestro" name="montosiniestro"  value="">
                                
                            </div>        
                        </div>    
                        <!-- pdf poliza auto-->
                        <table id="tablasiniestros" name="tablasiniestros" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agrega documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentossiniestro[]" 
                                    accept="pdf" >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                        type="text" 
                                        class="custom-file-input" 
                                        name="nombredocumentossiniestro[]" 
                                        required
                                    >
                                </th>
                            </tr>
                        </table>   
                        <!-- --> 
                        <div class="row text-center ">
                            <div 
                                class="col-3 d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                                    <div 
                                        class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded-pill"
                                        >
                                        <button onClick="addocument4()"  type="button"> 
                                            <span 
                                                    class="ms-3 mon-light">
                                                    Añadir documento
                                            </span>        
                                        </button>

                                    </div>
                            </div>                
                        </div> 
                        <!-- -->         
                        <div class="row text-center ">
                                    <button type="button" onclick="guardarsiniestro()">
                                        Guardar
                                    </button>
                        </div>
                    </form>
                                   
                </div>                    
                <!-- -->                    
            </div>                        
        </div>           
    </div>
    
        
    <!-- -->
    <!-- -->
@endsection