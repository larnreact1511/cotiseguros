<?php 
use Illuminate\Support\Facades\DB;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cotiseguros</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapicons/font/bootstrap-icons.min.css') }}" rel="stylesheet"><!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/global.css') }}" rel="stylesheet">
  <style>
    .btn-secondary 
    {
        --bs-btn-color: #fff;
        --bs-btn-bg: #911d1b;
        --bs-btn-border-color: #911d1b;
        --bs-btn-hover-color: #fff;
        --bs-btn-hover-bg: #7b1917;
        --bs-btn-hover-border-color: #741716;
        --bs-btn-focus-shadow-rgb: 162, 63, 61;
        --bs-btn-active-color: #fff;
        --bs-btn-active-bg: #741716;
        --bs-btn-active-border-color: #6d1614;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #fff;
        --bs-btn-disabled-bg: #911d1b;
        --bs-btn-disabled-border-color: #911d1b;
    }
    .accordion {
        --bs-accordion-color: #0d6efd;
        --bs-accordion-bg: var(--bs-body-bg);
        --bs-accordion-transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,border-radius 0.15s ease;
        --bs-accordion-border-color: #fff;
        --bs-accordion-border-width: var(--bs-border-width);
        --bs-accordion-border-radius: var(--bs-border-radius);
        --bs-accordion-inner-border-radius: calc(var(--bs-border-radius) - (var(--bs-border-width)));
        --bs-accordion-btn-padding-x: 1.25rem;
        --bs-accordion-btn-padding-y: 1rem;
        --bs-accordion-btn-color: var(--bs-body-color);
        --bs-accordion-btn-bg: var(--bs-accordion-bg);
        --bs-accordion-btn-icon: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
        --bs-accordion-btn-icon-width: 1.25rem;
        --bs-accordion-btn-icon-transform: rotate(-180deg);
        --bs-accordion-btn-icon-transition: transform 0.2s ease-in-out;
        --bs-accordion-btn-active-icon: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23052c65'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
        --bs-accordion-btn-focus-border-color: #86b7fe;
        --bs-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        --bs-accordion-body-padding-x: 1.25rem;
        --bs-accordion-body-padding-y: 1rem;
        --bs-accordion-active-color: var(--bs-primary-text-emphasis);
        --bs-accordion-active-bg: var(--bs-primary-bg-subtle);
    }
    .redondear{
      border: 2px solid red;
      padding: 10px;
      border-radius: 25px;
      background-color: #596475 !important;
      border-color:#596475;
      color: #fff;
      font-family: "mon-regular";
    }
    .colorbtn
    {
      background-color: #cccccc;
      border-color: #cccccc;
      color:black;
    }
  </style>
  <script 
    src="{{ asset('js/bootstrap.bundle.min.js') }}" 
  ></script>
  
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color:#911d1b !important;;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <?=$datacliente[0]->nombre.' '.$datacliente[0]->apellido?>
    </a>
  </div>
</nav>


<div class="container-fluid mt-3">
  
  <!-- acordeon -->  
  <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
      <!-- informacion personal-->
      <div class="accordion-item m-2 ">
        <h6 
          id="flush-headinginforperson"
          class="accordion-header collapsed redondear"
          data-bs-toggle="collapse" data-bs-target="#flush-collapseinforp" aria-expanded="false" aria-controls="flush-collapseinforp"
          >
          Información personal
        </h6>
        <div id="flush-collapseinforp" class="accordion-collapse collapse" aria-labelledby="flush-headinginforperson" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body row">
            <!--  --> 
            <div class="col-md-12 card " style="text-align: center;">
              <h6> Datos del asegurado</h6>
              <?php 
                if ( @$datacliente[0]->cedula)
                {
                  ?> 
                  <div class="col-auto">
                    <h7 style="color:black;">Cedula : <?=$datacliente[0]->cedula?></h7>
                  </div>
                  <?php
                }
                if ( @$datacliente[0]->rif)
                {
                  ?> 
                  <div class="col-auto">
                    <h7 style="color:black;">Rif : <?=$datacliente[0]->rif?></h7>
                  </div>
                  <?php
                }
                if ( @$datacliente[0]->rif)
                {
                  ?> 
                  <div class="col-auto">
                    <h7 style="color:black;">Nombre : <?=$datacliente[0]->nombre?></h7>
                  </div>
                  <?php
                }
                if ( @$datacliente[0]->rif)
                {
                  ?> 
                  <div class="col-auto">
                    <h7 style="color:black;">Apellido : <?=$datacliente[0]->apellido?></h7>
                  </div>
                  <?php
                }
                
              ?> 
            </div>
            <div class="col-md-12 card " style="text-align: center;">
              <h6> Documentos del asegurado</h6>
              <?php 
                
                if ( count( @$documentos) > 0)
                {
                  foreach($documentos as $d)
                  {
                    ?> 
                    <h7 style="color:black;"><?=$d->tipodocumento?> </h7>
                    <a href='https://cotiseguros.com.ve/<?=$d->documentonombre ?>' class='' target='_blank'> 
                    
                    <i class='bi bi-eye-fill'></i></a>
                    <?php
                  }
                  
                }
              ?> 
            </div>
            <!--  -->
          </div>
        </div>
      </div>
      <!--polizas salud --> 
      <div class="accordion-item m-2">
        <h6 
          id="flush-headingTwo"
          class="accordion-header collapsed redondear"
          data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"
          >
          Polizas Salud 
        </h6>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body row">
            <!-- -->
            <?php 
              if ( count($salud) > 0) 
              {
                foreach ($salud as $poliza)
                {
                  $vec=array('id_insurancepolicies'=>$poliza->id_insurancepolicies,'quote_id'=>0);
                  $member_quotes =DB::table('member_quotes')->where($vec)->get();
                  $frequencyofpayments =DB::table('frequencyofpayments')
                  ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
                  ->where('frequencyofpayments.id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();
                  //echo "<pre>"; print_r($frequencyofpayments);
                  $accidents =  DB::table('accidents')
                  ->where('id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->where('estado','<',5)->get();
                  $vec2=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vec2)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage).' USD '; ?></h5>
                              <h6 class="card-title">Nota : <?=@$poliza->comentario?></h6>
                              <?php 
                              if ( count($documentos) >0 )
                              {
                                ?>
                                <button type="button" 
                                  class="btn btn-primary m-2 colorbtn" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#modaldocumentopoliza_<?=$poliza->id_poliza ?>">
                                  Documentos Poliza 
                                </button>
                                  <?php  generamoaldocumentos($poliza->id_poliza,$documentos) ?>
                                
                                <?php 
                              }
                              if ( count($member_quotes) >0 )
                              {
                                ?>

                                  <button type="button" 
                                    class="btn btn-primary m-2 colorbtn" 
                                    data-bs-toggle="modal" data-bs-target="#modalbeneficiariso_<?=$poliza->id_poliza ?>">
                                    Beneficiarios 
                                  </button>
                                  <?php  generarmodalbenficiarios($poliza->id_poliza,$member_quotes) ?>
                              
                                <?php 
                              }
                              if ( count($frequencyofpayments) > 0)
                              {
                                ?>
                                  <button type="button" class="btn btn-primary m-2 colorbtn" data-bs-toggle="modal" data-bs-target="#pagospolizas_<?=$poliza->id_poliza ?>">
                                    Pagos de la poliza
                                  </button>
                                  <?php  generamodalpagospolizas($poliza->id_poliza,$frequencyofpayments) ?>
                                
                                <?php 
                              }
                              if ( count($accidents) > 0)
                              {
                                ?>
                                <div 
                                  class="accordion accordion-flush" 
                                  id="accordionFlushExample2" 
                                  style="text-align: center;">  
                                    <div class="accordion-item">
                                      <button 
                                        type="button" 
                                        class="btn btn-primary m-2 colorbtn" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#flush-collapseTwo2" 
                                        aria-expanded="false" 
                                        aria-controls="flush-collapseTwo2"
                                        id ="flush-headingTwo2">
                                        Siniestros
                                      </button>
                                      <div 
                                        id="flush-collapseTwo2" 
                                        class="accordion-collapse collapse" 
                                        aria-labelledby="flush-headingTwo2" 
                                        data-bs-parent="#accordionFlushExample2"
                                        >
                                        <?php 
                                          foreach($accidents as $a)
                                          {
                                            switch ($a->estado) {
                                              case 0:
                                                $a->estado ='';
                                                break;
                                              case 1:
                                                  $a->estado ='Alerta de Siniestro';
                                                  break;
                                              case 2:
                                                  $a->estado ='Reportado';
                                                  break;
                                              case 3:
                                                    $a->estado ='En Proceso';
                                                    break;
                                              case 4:
                                                    $a->estado ='Tramitado';
                                                    break;
                                              case 5:
                                                    $a->estado ='Finalizado';
                                                    break;
                                              default :
                                                $a->estado ='';
                                                break;
                                            }
                                            ?>
                                              <h4 class="card-title" style="color: black;"> <?=$a->descripcion; ?> </h4>
                                              <h6 class="card-title" style="color: black;"> <?=' Estado : '.$a->estado; ?> </h6>
                                              <h6 class="card-title" style="color: black;"> <?=' Monto del Siniestro '.number_format($a->monto).' USD' ?> </h6>
                                              <h6 class="card-title" style="color: black;"> <?=' Monto del Pagado '.number_format($a->montopagado).' USD' ?> </h6>
                                            <?php
                                            $doc = DB::table('docuemntos')->where('id_accidente',$a->id)->get();
                                            //generamodalsiniestros($a->id,$doc); 
                                            foreach ($doc as $d)
                                            {
                                              
                                              ?>
                                              <a 
                                                href="https://cotiseguros.com.ve/<?=$d->documentonombre?>" 
                                                class='btn btn-secondary colorbtn' target='_blank'>
                                                <?=$d->tipodocumento?>
                                                </a> &nbsp;
                                              <?php
                                            }
                                          }
                                        ?>
                                        
                                      </div>
                                    </div>
                                    

                                </div>
                                <?php 
                              }
                              ?>
                            </div>
                            
                          </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              else
                echo "<h3 style='color:black;'> No tiene pólizas registradas <h3>";
            ?>
            <!-- -->
          </div>
        </div>
      </div>
      <!-- polizas auto--> 
      <div class="accordion-item m-2">
        <h6 id="flush-headingThree"
            class="accordion-header collapsed redondear"
            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree"
          >
          Polizas Auto 
        </h6>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body row">
          <?php 
              if ( count($autos) > 0) 
              {
                //echo "<pre>"; print_r($salud);
                foreach ($autos as $poliza)
                {
                  $frequencyofpayments2 =DB::table('frequencyofpayments')
                  ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
                  ->where('frequencyofpayments.id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();
                  $accidents =  DB::table('accidents')
                  ->where('id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->where('estado','<',5)->get();
                  $vecd=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vecd)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                      <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage); ?></h5>
                              <h5 class="card-title"> <?=$poliza->descripcionpoliza; ?></h5>
                              <h6 class="card-title">Nota : <?=@$poliza->comentario?></h6>
                              <?php 
                                if ( count($documentos) >0 )
                                {
                                  ?>
                                  <button type="button" class="btn btn-primary m-2 colorbtn" data-bs-toggle="modal" data-bs-target="#modaldocumentopoliza_<?=$poliza->id_poliza ?>">
                                    Documentos Poliza 
                                  </button>
                                    <?php  generamoaldocumentos($poliza->id_poliza,$documentos) ?>
                                  
                                  <?php 
                                }
                                if ( count($frequencyofpayments2) > 0)
                                {
                                  ?>
                                    <button type="button" class="btn btn-primary m-2 colorbtn" data-bs-toggle="modal" data-bs-target="#pagospolizas_<?=$poliza->id_poliza ?>">
                                      Pagos de la poliza
                                    </button>
                                    <?php  generamodalpagospolizas($poliza->id_poliza,$frequencyofpayments2) ?>
                                  
                                  <?php 
                                }
                                if ( count($accidents) > 0)
                                {
                                  ?>
                                  <div 
                                    class="accordion accordion-flush" 
                                    id="accordionFlushExample2" 
                                    style="text-align: center;">  
                                      <div class="accordion-item">
                                        <button 
                                          type="button" 
                                          class="btn btn-primary m-2 colorbtn colorbtn" 
                                          data-bs-toggle="collapse" 
                                          data-bs-target="#flush-collapseTwo2" 
                                          aria-expanded="false" 
                                          aria-controls="flush-collapseTwo2"
                                          id ="flush-headingTwo2">
                                          Siniestros
                                        </button>
                                        <div 
                                          id="flush-collapseTwo2" 
                                          class="accordion-collapse collapse" 
                                          aria-labelledby="flush-headingTwo2" 
                                          data-bs-parent="#accordionFlushExample2"
                                          >
                                          <?php 
                                            foreach($accidents as $a)
                                            {
                                              switch ($a->estado) {
                                                case 0:
                                                    $a->estado ='';
                                                    break;
                                                case 1:
                                                    $a->estado ='Alerta de Siniestro';
                                                    break;
                                                case 2:
                                                    $a->estado ='Reportado';
                                                    break;
                                                case 3:
                                                      $a->estado ='En Proceso';
                                                      break;
                                                case 4:
                                                      $a->estado ='Tramitado';
                                                      break;
                                                case 5:
                                                      $a->estado ='Finalizado';
                                                      break;
                                                default :
                                                  $a->estado ='';
                                                  break;
                                              }
                                              ?>
                                                <h4 class="card-title" style="color: black;"> <?=$a->descripcion; ?> </h4>
                                                <h6 class="card-title" style="color: black;"> <?=' Estado : '.$a->estado; ?> </h6>
                                                <h6 class="card-title" style="color: black;"> <?=' Monto del Siniestro '.number_format($a->monto).' USD' ?> </h6>
                                                <h6 class="card-title" style="color: black;"> <?=' Monto del Pagado '.number_format($a->montopagado).' USD' ?> </h6>
                                              <?php
                                              $doc = DB::table('docuemntos')->where('id_accidente',$a->id)->get();
                                              //generamodalsiniestros($a->id,$doc); 
                                              foreach ($doc as $d)
                                              {
                                                
                                                ?>
                                                <a 
                                                  href="https://cotiseguros.com.ve/<?=$d->documentonombre?>" 
                                                  class='btn btn-secondary colorbtn' target='_blank'>
                                                  <?=$d->tipodocumento?>
                                                  </a> &nbsp;
                                                <?php
                                              }
                                            }
                                          ?>
                                          
                                        </div>
                                      </div>
                                      

                                  </div>
                                  <?php 
                                }
                              ?>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                }
              }
              else
                echo "<h3 style='color:black;'> No tiene pólizas registradas <h3>";
            ?>
          </div>
        </div>
      </div>
      <!--polizas empresa --> 
      <div class="accordion-item m-2">
        <h6  
          id="flush-headingfour"
          class="accordion-header collapsed redondear"
          data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour"
          >
          Polizas  Patrimonio
        </h6>
        <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body row">
          <?php 
              if ( count($empresa) > 0) 
              {
                //echo "<pre>"; print_r($salud);
                foreach ($empresa as $poliza)
                {
                  $vec4=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $frequencyofpayments3 =DB::table('frequencyofpayments')
                  ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
                  ->where('frequencyofpayments.id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();
                  $accidents =  DB::table('accidents')
                  ->where('id_insurancepolicies',$poliza->id_insurancepolicies)
                  ->where('estado','<',5)->get();
                  $vecd2=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vecd2)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                      <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage); ?></h5>
                              <h5 class="card-title"> <?=$poliza->descripcionpoliza; ?></h5>
                              <h6 class="card-title">Nota : <?=@$poliza->comentario?></h6>
                              <?php 
                              if ( count($documentos) >0 )
                              {
                                ?>
                                <button type="button" class="btn btn-primary m-2 colorbtn" data-bs-toggle="modal" data-bs-target="#modaldocumentopoliza_<?=$poliza->id_poliza ?>">
                                  Documentos Poliza 
                                </button>
                                  <?php  generamoaldocumentos($poliza->id_poliza,$documentos) ?>
                                
                                <?php 
                              }
                              if ( count($frequencyofpayments3) > 0)
                              {
                                ?>
                                  <button type="button" class="btn btn-primary m-2 colorbtn" data-bs-toggle="modal" data-bs-target="#pagospolizas_<?=$poliza->id_poliza ?>">
                                    Pagos de la poliza
                                  </button>
                                  <?php  generamodalpagospolizas($poliza->id_poliza,$frequencyofpayments3) ?>

                                  <?php     
                              }
                              if ( count($accidents) > 0)
                              {
                                ?>
                                <div 
                                  class="accordion accordion-flush" 
                                  id="accordionFlushExample2" 
                                  style="text-align: center;">  
                                    <div class="accordion-item">
                                      <button 
                                        type="button" 
                                        class="btn btn-primary m-2 colorbtn" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#flush-collapseTwo2" 
                                        aria-expanded="false" 
                                        aria-controls="flush-collapseTwo2"
                                        id ="flush-headingTwo2">
                                        Siniestros
                                      </button>
                                      <div 
                                        id="flush-collapseTwo2" 
                                        class="accordion-collapse collapse" 
                                        aria-labelledby="flush-headingTwo2" 
                                        data-bs-parent="#accordionFlushExample2"
                                        >
                                        <?php 
                                          foreach($accidents as $a)
                                          {
                                            switch ($a->estado) {
                                                case 0:
                                                    $a->estado ='';
                                                    break;
                                                case 1:
                                                    $a->estado ='Alerta de Siniestro';
                                                    break;
                                                case 2:
                                                    $a->estado ='Reportado';
                                                    break;
                                                case 3:
                                                      $a->estado ='En Proceso';
                                                      break;
                                                case 4:
                                                      $a->estado ='Tramitado';
                                                      break;
                                                case 5:
                                                      $a->estado ='Finalizado';
                                                      break;
                                                default :
                                                  $a->estado ='';
                                                  break;
                                            }
                                            ?>
                                              <h4 class="card-title" style="color: black;"> <?=$a->descripcion; ?> </h4>
                                              <h6 class="card-title" style="color: black;"> <?=' Estado : '.$a->estado; ?> </h6>
                                              <h6 class="card-title" style="color: black;"> <?=' Monto del Siniestro '.number_format($a->monto).' USD' ?> </h6>
                                              <h6 class="card-title" style="color: black;"> <?=' Monto del Pagado '.number_format($a->montopagado).' USD' ?> </h6>
                                            <?php
                                            $doc = DB::table('docuemntos')->where('id_accidente',$a->id)->get();
                                            //generamodalsiniestros($a->id,$doc); 
                                            foreach ($doc as $d)
                                            {
                                              
                                              ?>
                                              <a 
                                                href="https://cotiseguros.com.ve/<?=$d->documentonombre?>" 
                                                class='btn btn-secondary colorbtn' target='_blank'>
                                                <?=$d->tipodocumento?>
                                                </a> &nbsp;
                                              <?php
                                            }
                                          }
                                        ?>
                                        
                                      </div>
                                    </div>
                                    

                                </div>
                                <?php 
                              }
                              
                              ?>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              else
                echo "<h3 style='color:black;'> No tiene pólizas registradas <h3>";
            ?>
          </div>
        </div>
      </div>
      <!-- -->
      <div class="accordion-item m-2">
        <h6  
          id=""
          class="accordion-header collapsed redondear"
          >
          <a href="https://cotiseguros.com.ve/cotizador/salud" style ="text-decoration:none; color:#fff;" target='_blank'>
            Cotizar polizas
          </a>
          
        </h6>     
      </div> <br>
      <!-- -->
  </div>
  
</div>
<!-- --> 

<!--modales  -->
<?php 
function generamoaldocumentos($id,$data)
{
  $htmlmodal ='';
  $htmlmodal .= "<div class='modal fade' id='modaldocumentopoliza_$id' tabindex='' aria-labelledby='modaldocumentopoliza_$id' aria-hidden='true'>";
  $htmlmodal .= "<div class='modal-dialog'>";
  $htmlmodal .= "<div class='modal-content'>";
  $htmlmodal .= "<div class='modal-header'>";
  $htmlmodal .= "<h1 class='modal-title fs-5'>Documentos Poliza</h1>";
  $htmlmodal .= "<button type='button' class='btn-close colorbtn' data-bs-dismiss='modal' aria-label='Close'></button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-body'>";
  
  foreach( $data as $p)
  {
    //$htmlmodal .= "<div class='card-body text-center'>";
    $htmlmodal .= "<a href='https://cotiseguros.com.ve/$p->documentonombre' class='btn btn-secondary colorbtn' target='_blank'>$p->tipodocumento</a> &nbsp;";
    //$htmlmodal .= "</div>";
  }
  $htmlmodal .= "</ul>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-footer'>";
  $htmlmodal .= "<button type='button' class='btn btn-secondary colorbtn' data-bs-dismiss='modal'>Cerrar</button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  echo $htmlmodal;
}
function generarmodalbenficiarios($id,$data)
{
  $htmlmodal ='';
  $htmlmodal .= "<div class='modal fade' id='modalbeneficiariso_$id' tabindex='' aria-labelledby='modalbeneficiariso_$id' aria-hidden='true'>";
  $htmlmodal .= "<div class='modal-dialog'>";
  $htmlmodal .= "<div class='modal-content'>";
  $htmlmodal .= "<div class='modal-header'>";
  $htmlmodal .= "<h1 class='modal-title fs-5'>Beneficiarios</h1>";
  $htmlmodal .= "<button type='button' class='btn-close colorbtn' data-bs-dismiss='modal' aria-label='Close'></button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-body'>";
  $htmlmodal .= "<ul class='list-group'>";
  foreach( $data as $m)
  {
    
    $htmlmodal .= "<p>".$m->status.' '.$m->gender .' ( '.$m->date.' años)'."</p>";
  }
  $htmlmodal .= "</ul>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-footer'>";
  $htmlmodal .= "<button type='button' class='btn btn-secondary colorbtn' data-bs-dismiss='modal'>Cerrar</button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  echo $htmlmodal;
}
function generamodalpagospolizas($id,$data)
{
  $htmlmodal ='';
  $htmlmodal .= "<div class='modal fade' id='pagospolizas_$id' tabindex='' aria-labelledby='pagospolizas_$id' aria-hidden='true'>";
  $htmlmodal .= "<div class='modal-dialog'>";
  $htmlmodal .= "<div class='modal-content'>";
  $htmlmodal .= "<div class='modal-header'>";
  $htmlmodal .= "<h1 class='modal-title fs-5'>Pagos de la poliza</h1>";
  $htmlmodal .= "<button type='button' class='btn-close colorbtn' data-bs-dismiss='modal' aria-label='Close'></button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-body'>";
  //$htmlmodal .= "<ul class='list-group'>";
  foreach( $data as $f)
  {
    $estado ='Pagada';
    if ($f->estadodepago ==0)
      $estado ='Pendiente';
    $htmlmodal .="<li class='list-group-item active' aria-current='true'>";
      $htmlmodal .='Fecha  de pago : '.$f->fechafin .' '.$estado;
      if ($estado=='Pagada')
        $htmlmodal .="<a href='https://cotiseguros.com.ve/$f->photo_payment' class='' target='_blank'> <i class='bi bi-eye-fill'></i></a>";
    $htmlmodal .=" </li>";
  }
  //$htmlmodal .= "</ul>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-footer'>";
  $htmlmodal .= "<button type='button' class='btn btn-secondary colorbtn' data-bs-dismiss='modal'>Cerrar</button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  echo $htmlmodal;
}
function generamodalsiniestros($id,$data)
{
  $htmlmodal ='';
  $htmlmodal .= "<div class='modal fade' id='modalbeneficiariso_$id' tabindex='' aria-labelledby='modalbeneficiariso_$id' aria-hidden='true'>";
  $htmlmodal .= "<div class='modal-dialog'>";
  $htmlmodal .= "<div class='modal-content'>";
  $htmlmodal .= "<div class='modal-header'>";
  $htmlmodal .= "<h1 class='modal-title fs-5'>Beneficiarios</h1>";
  $htmlmodal .= "<button type='button' class='btn-close colorbtn' data-bs-dismiss='modal' aria-label='Close'></button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-body'>";
  foreach( $data as $m)
  {
    
    //$htmlmodal .= "<p>".$m->status.' '.$m->gender .' ( '.$m->date.' años)'."</p>";
  }
  $htmlmodal .= "</div>";
  $htmlmodal .= "<div class='modal-footer'>";
  $htmlmodal .= "<button type='button' class='btn btn-secondary colorbtn' data-bs-dismiss='modal'>Cerrar</button>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  $htmlmodal .= "</div>";
  echo $htmlmodal;
}
?>
 <!-- Footer -->
<div class="row bg-dark p-0 m-0 pt-4 px-5 " id="footer">
    <div class=" col-md-3 p-3" style="text-align: center;">
      <img src="{{ asset('storage/LOGO RGB_Icono full color (1).png') }}" style="width: 50px ;" alt="">
    </div>
    <div class=" col-md-3" style="text-align: center;">
      <h2 class="mon-bold text-white text-uppercase fs-5">contactanos</h2>
      <a href="mailto:{{ $footer->email }}" style ="text-decoration:none;">
      <img src="{{ asset('envelope-fill.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->email }}</span>
      </a><br>
      
      <?php $url="whatsapp://send?phone=+584247089641&text=hola"; ?>
      <a href="<?=$url?>" style ="text-decoration:none;">
      <img src="{{ asset('whatsapp.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->whatsapp }}</span> 
      </a><br/>
      
    </div>
    <div class=" col-md-3 " style="text-align: center;">
      <h2 class="mon-bold text-white text-uppercase fs-5">siguenos</h2>
      <a class="mx-2" href="{{ $footer->instagram }}"><img src="{{ asset('instagram.svg') }}" alt=""></a>
      <a class="mx-2" href="{{ $footer->facebook }}"><img src="{{ asset('facebook.svg') }}" alt=""></a> 
      <a class="mx-2" href="{{ $footer->tiktok }}"><img src="{{ asset('tiktok.svg') }}" alt=""></a>
    </div>
    <div style="text-align: center;">
    <p class="text-white " style="font-size: 10px;">COTISEGUROS 	&copy; 2022 - Todos los derechos reservados </p>
    </div>
  </div>
</body>
</html>