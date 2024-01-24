@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/acordeon.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/documentosclientesadmin.js') }}" defer></script>
<!-- -->
<?php
    //echo "<pre>"; print_r($documentos); die;
    if (@$info[0]->numerotelefono)
    {
        $c=strlen(@$info[0]->numerotelefono); 
        @$info[0]->numerotelefono = substr(@$info[0]->numerotelefono,3,floatval($c) );
       $code =substr(@$info[0]->numerotelefono,0,3 );
    }
?>
<div class="accordion">
  <input type="radio" name="toggle" class="accordion-toggle" checked />
  <div class="accordion-header">
    Documentos Personales
  </div>
  <div class="accordion-content ">
    <!-- -->
    <div class="m-0 row justify-content-center">
        @if (session()->has('error_documentos'))
            <div class="alert alert-danger">
                {{ session('error_documentos') }}
            </div>
        @endif
        <div class="col-md-12">
            <form 
                action="adminfiles2" 
                method="POST"
                enctype="multipart/form-data"
                class="container px-4 my-5">
                @csrf
                <input type="hidden" id="idcliente" readonly name="idcliente" class="form-control" value ="<?=$idcliente; ?>"/>
                <div class="row">
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento1" 
                          id="documento1"
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega Cedula </label>
                        <?php 
                            if (@$documentos[0]->tipodocumento =='Cedula')
                            {
                                $imm= '"'.$documentos[0]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?>
                  </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento2" 
                          id="documento2"
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento  2 </label>
                      <?php 
                            if (@$documentos[1]->tipodocumento =='documento2')
                            {
                                $imm= '"'.$documentos[1]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?>      
                    </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento3" 
                          id="documento3" 
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento 3 </label>
                      <?php 
                            if (@$documentos[2]->tipodocumento =='documento3')
                            {
                                $imm= '"'.$documentos[2]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?> 
                  </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento4" 
                          id="documento4" 
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento 4 </label>
                      <?php 
                            if (@$documentos[3]->tipodocumento =='documento4')
                            {
                                $imm= '"'.$documentos[3]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?> 
                  </div>
                </div>
                <div class="custom-file col-md-6">
                    <button type="submit"> Guardar documentos </button>
                </div>
                
            </form>
        </div>
        
    </div>
    <!-- -->
  </div>
  <!-- -->
  <input type="radio" name="toggle" class="accordion-toggle" checked />
  <div class="accordion-header">
    Documentos / Contratos
  </div>
  <div class="accordion-content ">
    <!-- -->
    <div class="m-0 row justify-content-center">
        @if (session()->has('error_documentos'))
            <div class="alert alert-danger">
                {{ session('error_documentos') }}
            </div>
        @endif
        <div class="col-md-12">
            <form 
                action="adminfiles3" 
                method="POST"
                enctype="multipart/form-data"
                class="container px-4 my-5">
                @csrf
                <input type="hidden" id="idcliente" readonly name="idcliente" class="form-control" value ="<?=$idcliente; ?>"/>
                <div class="row">
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="contrato1" 
                          id="contrato1"
                          accept="pdf" 
                      >
                      <label class="custom-file-label" for="customFile">Contrato 1 </label>
                        <?php 
                            if (@$contrato[0]->tipodocumento =='contrato1')
                            {
                                $imm= '"'.$contrato[0]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?>
                  </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="contrato2" 
                          id="contrato2"
                          accept="pdf" 
                      >
                      <label class="custom-file-label" for="customFile">Contrato 2 </label>
                      <?php 
                            if (@$contrato[1]->tipodocumento =='contrato2')
                            {
                                $imm= '"'.$contrato[1]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?>      
                    </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="contrato3" 
                          id="contrato3" 
                          accept="pdf" 
                      >
                      <label class="custom-file-label" for="customFile">Contrato 3 </label>
                      <?php 
                            if (@$contrato[2]->tipodocumento =='contrato3')
                            {
                                $imm= '"'.$contrato[2]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?> 
                  </div>
                  <div class="custom-file col-md-6">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="contrato4" 
                          id="contrato4" 
                          accept="pdf" 
                      >
                      <label class="custom-file-label" for="customFile">Contrato 4 </label>
                      <?php 
                            if (@$contrato[3]->tipodocumento =='contrato4')
                            {
                                $imm= '"'.$contrato[3]->documentonombre.'"';
                                $img ="<span  class='icon voyager-eye' title='ver documento' onclick='verfoto(".$imm.")'></span>";
                                echo  $img;
                            }
                        ?> 
                  </div>
                </div>
                <div class="custom-file col-md-6">
                    <button type="submit"> Guardar documentos </button>
                </div>
                
            </form>
        </div>
        
    </div>
    <!-- -->
  </div>
  <!-- -->

  <input type="radio" name="toggle" class="accordion-toggle" />
  <div class="accordion-header">
      Informacion Personal
  </div>
  <div class="accordion-content text-center">
    <!-- -->
    <div class="m-0 row justify-content-center">
        @if (session()->has('error_datos'))
            <div class="alert alert-danger">
                {{ session('error_datos') }}
            </div>
        @endif
        <div class="col-md-12">
            <form 
                id="form-cot" 
                class="container px-4 my-5"
                action="actualizardatos" 
                method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="idcliente2" readonly name="idcliente2" class="form-control" value ="<?=$idcliente; ?>"/>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <label> Nombre</label>
                            <input 
                                name="nombre" 
                                id="nombre"
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey"
                                placeholder="Nombre" required
                                value="<?= @$info[0]->nombre; ?>"
                            >
                            
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <label> Apellido</label>
                            <input 
                
                                name="apellido" 
                                id="apellido" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                required
                                placeholder="Apellido" 
                                value="<?= @$info[0]->apellido; ?>"
                            >
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <div class="col-2 col-md-2 d-flex">
                            <label>Cod.</label>
                            <select 
                                name="code" 
                                id="code" 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                aria-label="Default select example" 
                                required
                                >
                                <option  selected value="+58">+58 </option>
                            </select>
                        </div>
                        <div class="col-10 col-md-6 d-flex">
                            
                            <label> Nro de telefono </label>
                                <input 
                                    name="numerotelefono" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="numerotelefono" 
                                    required
                                    placeholder="Nro de telefono" 
                                    value="<?= @$info[0]->numerotelefono; ?>"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <label> Cedula </label>
                            <input 
                                name="cedula" 
                                type="number" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="cedula" 
                                required
                                placeholder="Cedula" 
                                value="<?= @$info[0]->cedula; ?>"
                                >
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <div class="form-floating mb-3">
                            <label> Rif </label>
                            <input 
                                name="rif" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="cedula" 
                                required
                                placeholder="rif" 
                                value="<?= @$info[0]->rif; ?>"
                                >
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <label> Estado </label><br>
                        <select 
                            name="province" 
                            id="province" 
                            class="form-select w-100 shadow-none border-0 bg-grey w-25 align-self-start"  
                            aria-label="Default select example" required >

                            @foreach ($provinces as $p)
                                <option @if( $p["estado"] == 'Táchira' ) selected @endif  value="{{ $p["estado"] }}">{{ $p["estado"] }}</option>
                            @endforeach 
                            
                        </select>
                    </div>
                </div>
                <div class="custom-file col-md-6">
                    <button type="submit"> Actualizar Datos persoanles </button>
                </div>  
            </form>
        </div>
    </div>    
    <!-- -->
    <input type="radio" name="toggle" class="accordion-toggle" />
    <div class="accordion-header">
       Frecuencia de Pagos
    </div>
    <div class="accordion-content text-center">
        <div class="m-0 row justify-content-center">
            <div class="col-md-12">
                <form 
                    
                    id ="formfrecuenciapagos"
                    name ="formfrecuenciapagos"
                    method="POST"
                    class="container px-4 my-5"
                    >
                    @csrf        
                    <div class="row">
                        <?php 
                            //print_r($quotes2);
                            if (count(@$quotes2) >0)
                            {
                                foreach ($quotes2 as $quote) 
                                { 
                                    $vec= $quote;
                                ?> 
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="flexRadioDefault" 
                                                id="flexRadioDefault2" 
                                                onclick="cotiazacionfrecuencia(<?=$vec['id'] ?>,<?=$vec['coverage']?>,<?=$vec['id_insurancepolicies']?>)">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <?php echo number_format($vec['coverage'], 2, ',', '.') .' - '.$vec['name']; ?>
                                            </label>
                                        </div>
                                    </div> 
                        <?php }} ?>    
                    </div>
                    <div class="row">
                        <?php foreach ($frequencies as $frequencie) { ?> 
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                        type="radio" name="frequencie" id="frequenciepagos" onclick="frecuencia(<?=$frequencie->frequency ?>)" >
                                    <label class="form-check-label" for="frequenciepagos">
                                        <?php echo $frequencie->name; ?>
                                    </label>
                                </div>
                            </div> 
                        <?php } ?>  
                        <div class="col-md-3">
                            <div class="form-check">
                                <label>Fecha de Inicio pagos </label>
                                <input class="form-check-input"  
                                    type="date" name="fechainicio" id="fechainicio" value="<?= date('Y-m-d'); ?>">
                                
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="offset-md-3 col-md-2">
                            <button type="button" id="calcularpagos" name="calcularpagos"> Calcular</button>
                        </div>
                            
                    </div>
                </form>
                <br>
                <div class="row">
                    <form 
                        id ="formulariospagorealizar" 
                        name="formulariospagorealizar" 
                        method="POST"
                        class="container px-4 my-5"
                        action="frecuenciapagos" 
                    >
                        @csrf    
                        <input type="hidden" id="idusuario" readonly name="idusuario" class="form-control" value ="<?= @$info[0]->idusuario; ?>"/>
                        <input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="<?=auth()->id(); ?>"/>
                        <input type="hidden" id="idquote"  name="idquote" class="form-control" value =""/>
                        <input type="hidden" id="id_insurancepolicies"  name="id_insurancepolicies" class="form-control" value =""/>
                        <div id="contenidoformuariopago" class="row">
                            
                            
                        </div>
                        <div class="row">
                            <div class="offset-md-3 col-md-6">
                                <button type="subtmit" id="guardarpagos" name="guardarpagos"> Generar Fechas de pago</button>
                            </div>   
                        </div>
                    </form>          
                </div>
            </div>
        </div>
    </div> 
    <!-- -->
    <input type="radio" name="toggle" class="accordion-toggle" />
    <div class="accordion-header">
        Pagos
    </div>
    <div class="accordion-content text-center">
        <div class="m-0 row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <?php 
                        if (count(@$quotes2) >0)
                        {
                            foreach ($quotes2 as $quote) 
                            { 
                                $vec= $quote;
                                ?> 
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="flexRadioDefault" 
                                                id="flexRadioDefault1" 
                                                onclick="cotizacion(<?=$vec['id'] ?>,<?=$vec['coverage']?>,<?=$vec['id_insurancepolicies']?>)">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <?php echo number_format($vec['coverage'], 2, ',', '.'); ?>
                                                </label>
                                        </div>
                                    </div> 
                    <?php }} ?>    
                </div>
                <br>
                
                <form 
                    action="adminpagos" 
                    id ="formulariopagos"
                    name ="formulariopagos"
                    method="POST"
                    enctype="multipart/form-data"
                    class="container px-4 my-5">
                    @csrf
                    <input type="hidden" id="idcliente3" readonly name="idcliente3" class="form-control" value ="<?=$idcliente; ?>"/>  
                    <input type="hidden" id="idusuario" readonly name="idusuario" class="form-control" value ="<?= @$info[0]->idusuario; ?>"/>
                    <input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="<?=auth()->id(); ?>"/>
                    <input type="hidden" id="idfrecuenciapagar" readonly name="idfrecuenciapagar" class="form-control" value ="<?=auth()->id(); ?>"/>
                    <input type="hidden" id="idquote2" readonly name="idquote2" class="form-control"/>
                    <input type="hidden" id="pagoeditar" readonly name="pagoeditar" class="form-control"/>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-floating mb-3">
                                <label> Fecha pago</label>
                                <input 
                                    name="fechapago" 
                                    id="fechapago"
                                    type="date" 
                                    class="form-control shadow-none border-0 bg-grey"
                                    placeholder="fecha pago" required
                                    value=""
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating mb-3">
                                <label> Monto</label>
                                <input 
                                    name="montopago" 
                                    id="montopago"
                                    type="numeric" 
                                    class="form-control shadow-none border-0 bg-grey"
                                    placeholder="Monto" required
                                    value=""
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating mb-3">
                                <label class="custom-file-label" for="customFile">Comprobante de pago</label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="photo_payment" 
                                    id="photo_payment"
                                    accept="png,jpeg" 
                                >
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="custom-file col-md-2">
                        <button type="button" id ="btnpagos" name ="btnpagos"> Guardar </button>
                        <button type="button" id ="btneditarpago" name ="btneditarpago" style="display: none;"> Actualizar </button> <br>
                        <button type="button" id ="rcambio" name ="rcambio" style="display: none;"  onclick="agregarpago()" > 
                            <span 
                                class='icon voyager-refresh p-3'   
                                title='Agregar nuevo pago' 
                                ></span> 
                        </button>
                        
                    </div>
                    <div class="col-md-10">
                        <div class="container my-5 mt-2" id="divpagos">
                            <div class="m-0 row justify-content-center">
                                <div class="col-md-12">
                                    <div class="list-group" id="divlistapagos">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>  
    <!-- -->
    <input type="radio" name="toggle" class="accordion-toggle" />
    <div class="accordion-header">
        QR
    </div>
    <div class="accordion-content text-center ">
        <div class="m-0 row justify-content-center">
            <div>
                <form 
                    action="generateqr" 
                    id ="forgenerate"
                    name ="forgenerate"
                    method="POST"
                    class="container px-4 my-5">
                    <input type="hidden" id="idcliente4" readonly name="idcliente4" class="form-control" value ="<?=$idcliente; ?>"/>  
                    <input type="hidden" id="idadmin3" readonly name="idadmin3" class="form-control" value ="<?=auth()->id(); ?>"/>
                    <input type="hidden" id="keyqrrandon" readonly name="keyqrrandon" class="form-control" value ="<?=$keyqrrandon; ?>"/>  
                    @csrf         
                    <?php 
                        
                        if ($codeqr)
                        {
                            ?>
                                
                                <div class="col-md-12">
                                <div class="row">
                                {!! QrCode::size(300)->generate('http://dev.cotiseguros.com.ve/asegurado/'.$codeqr) !!}
                                </div>
                                
                            </div>
                            <?php 
                        }
                        else
                        {
                            ?>
                            <div class="row">
                                    <div class="offset-md-3 col-md-2">
                                        <button type="submit" id="btngnerarqr" name="btngnerarqr"> Generar QR</button>
                                    </div>
                                </div>
                            <?php 
                        }
                    ?>
                </form>
            </div>                  
        </div>
    </div>  
</div>
<!-- -->
@endsection