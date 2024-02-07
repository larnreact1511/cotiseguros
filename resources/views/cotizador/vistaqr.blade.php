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
  <link href="{{ asset('css/cssqr.css') }}" rel="stylesheet">
  <style>
    
  </style>
  <script   src="{{ asset('js/bootstrap.bundle.min.js') }}"   ></script>
  
</head>
<body>

  <?php 
  $estilo ='background-color:green !important;';
  if ( $bloqueado)
    $estilo ='background-color:#911d1b !important;';
  ?>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="<?=$estilo; ?>">
    <div class="container-fluid d-flex justify-content-center">
      <a class="navbar-brand" href="#">
        <?=$datacliente[0]->nombre.' '.$datacliente[0]->apellido?>
      </a>
    </div>
  </nav>


  <div class="container-fluid mt-3 mb-5">
    <?php 
    if ( $bloqueado)
    {
        echo "<h4> Lo sentimos en estos momentos el cliente esta pendiente de pago <h4>";
        ?>
          <div class="contenedor">
            <label>
              <input type="checkbox" class="form-check-input" id="cbox1" value="first_checkbox" checked disabled/> 
              Estado de la póliza 
              <strong style="color:#911d1b !important;">
                Insolvente
              </strong>
              
            </label>
          </div>
          <br/>
        <?php 
    }
    else
    {
      ?> 
          <div class="contenedor">
            <label>
              <input type="checkbox" class="form-check-input" id="cbox1" value="first_checkbox" checked disabled/> 
              Estado de la póliza 
              <strong style="color:green !important;">
                Solvente
              </strong>
              
            </label>
          </div>
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
                <div 
                  id="flush-collapseinforp" 
                  class="accordion-collapse collapse" 
                  aria-labelledby="flush-headinginforperson" 
                  data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body row">
                    <!--  --> 
                    <div class="col-md-12 card p-1" style="text-align: center;">
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
                    <div class="col-md-12 card mt-2 p-1" style="text-align: center;">
                      <h6> Documentos del asegurado</h6>
                      <?php 
                        
                        if ( count( @$documentos) > 0)
                        {
                          foreach($documentos as $d)
                          {
                            ?> 
                            <h7 style="color:black;">
                              <?=$d->tipodocumento?> 
                              <a href='{{env('APP_URL')}}/<?=$d->documentonombre ?>' class='' target='_blank'> 
                              <i class='bi bi-eye-fill'></i></a>  
                            </h7>
                            
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
              <div class="accordion-item m-2" >
                <h6 
                  id="flush-headingTwo"
                  class="accordion-header collapsed redondear"
                  data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"
                  >
                  Pólizas Salud 
                </h6>
                <div 
                  id="flush-collapseTwo" 
                  class="accordion-collapse collapse" 
                  aria-labelledby="flush-headingTwo" 
                  data-bs-parent="#accordionFlushExample"
                  >
                  <div class="accordion-body row">
                    <!-- -->
                    <?php 
                      if ( count($salud) > 0) 
                      {
                        foreach ($salud as $poliza)
                        {
                          $vec=array('id_insurancepolicies'=>$poliza->id_insurancepolicies,'quote_id'=>0);
                          $member_quotes =DB::table('member_quotes')->where($vec)->get();
                          $comentarios =DB::table('comentariospolizas')->where('id_insurancepolicies',$poliza->id_insurancepolicies)->get();
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
                                      
                                      <?php 
                                      
                                      if ( count($documentos) >0 )
                                      {
                                        ?>
                                        <button type="button" 
                                          class="btn btn-primary m-2 colorbtn" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#modaldocumentopoliza_<?=$poliza->id_poliza ?>">
                                          Documentos Póliza 
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
                                      
                                      ?>
                                    </div>
                                    <!-- --> 
                                    <div class="card-body text-center">
                                    <!-- --> 
                                    <div 
                                      class="accordion accordion-flush" 
                                      id="accordionFlushExample_2" 
                                      style="text-align: center;">   
                                        
                                        <div class="accordion-item m-2 ">
                                          <h6 id="flush-headinginforperson_2" class="accordion-header collapsed redondear collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseinforp_2" aria-expanded="false" aria-controls="flush-collapseinforp_2">
                                            Notas
                                          </h6>
                                          <div id="flush-collapseinforp_2" class="accordion-collapse collapse" aria-labelledby="flush-headinginforperson_2" data-bs-parent="#accordionFlushExample_2" style="">
                                            <div class="accordion-body row">
                                              <?php 
                                              if ( count($comentarios) >0 )
                                              {
                                                foreach($comentarios as $c)
                                                {
                                                  ?>
                                                  <h6 class="card-title" style="color :black;">Nota : <?=@$c->comentario?></h6>
                                                  <?php 
                                                }
                                              
                                              }
                                              ?>
                                              <!--  --> 
                                              <div class ="card m-2">
                                                <h6  style ="color:green !important;">
                                                  Patologias Declaradas
                                                </h6>
                                                <?php
                                                  $patologias =  DB::table('patologia')
                                                  ->where('pat_id_poliza',$poliza->id_insurancepolicies)
                                                  ->where('pat_status','=',1)->get();
                                                  if ( $patologias->count() >0)
                                                  {
                                                    foreach ($patologias as $patologia => $p)
                                                    {
                                                      
                                                      ?>
                                                          <p>
                                                          <?php
                                                            echo $p->pat_descripcion; 
                                                          ?>
                                                          </p>
                                                            
                                                      <?php
                                                    }

                                                  }
                                                  else
                                                  {
                                                    echo " Ninguno ";
                                                  }
                                                ?>
                                              </div>
                                              <div class ="card m-2">
                                                <h6 style ="color:#911d1b !important;">
                                                  Patologias NO Declaradas
                                                </h6>
                                                <?php
                                                  $patologiasno =  DB::table('patologia')
                                                  ->where('pat_id_poliza',$poliza->id_insurancepolicies)
                                                  ->where('pat_status','=',0)->get();
                                                  if ( $patologiasno->count() >0)
                                                  {
                                                    foreach ($patologiasno as $patologiano => $pn)
                                                    {
                                                      
                                                      ?>
                                                          <p>
                                                          <?php
                                                            echo $pn->pat_descripcion; 
                                                          ?>
                                                          </p>
                                                            
                                                      <?php
                                                    }

                                                  }
                                                  else
                                                  {
                                                    echo " Ninguno ";
                                                  }
                                                ?>
                                              </div>
                                              <!--  -->
                                            </div>
                                          </div>
                                        </div>
                                    </div>


                                    <!-- --> 
                                    </div>
                                    <!-- --> 
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
              <!--Cotizar póliza -->
              <div class="accordion-item m-2">
                <h6  
                  id=""
                  class="accordion-header collapsed redondear"
                  >
                  <a href="{{env('APP_URL')}}/cotizador/salud" style ="text-decoration:none; color:#fff;" target='_blank'>
                    Cotizar pólizas
                  </a>
                  
                </h6>     
              </div>
              <!--Ingresa a tu Perfil -->
              <div class="accordion-item m-2">
                <h6 id="flush-ingresar" class="accordion-header collapsed redondear" data-bs-toggle="collapse" data-bs-target="#flush-collapseingesar" aria-expanded="false" aria-controls="flush-collapseingesar">
                  Ingresa a tu Perfil
                </h6>
                <div id="flush-collapseingesar" class="accordion-collapse collapse" aria-labelledby="flush-ingresar" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body row">
                          <div class="row p-2">
                            <!-- -->
                            <div class="w-100 h-100" style="background-image: url('http://localhost:8000/storage/fondo-de-login.png') ;background-size: cover;background-position: center;">  
                                <div class="container w-100">
                                    <div class="row  d-flex justify-content-center">
                                        <div class="col-md-4 ">
                                            <div class="card border-10">
                                                <!--<div class="card-header">{{ __('Login') }}</div>-->
                                                <div class="w-100 d-flex justify-content-center px-5 py-3">
                                                    <img class="w-100" src="{{env('APP_URL')}}/storage/LOGO%20RGB_Color.png" alt="">
                                                </div>
                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                
                                                        <div class="row mb-3">
                                                            <!--<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>-->
                                
                                                            <div class="col-md-12">
                                                                <input 
                                                                  id="email" 
                                                                  type="email" 
                                                                  class="form-control @error('email') is-invalid @enderror" 
                                                                  name="email" value="{{ old('email') }}" 
                                                                  required autocomplete="email" autofocus>
                                
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                
                                                        <div class="row mb-3">
                                                            <!--<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>-->
                                
                                                            <div class="col-md-12">
                                                                <input 
                                                                  id="password" 
                                                                  type="password" 
                                                                  class="form-control @error('password') is-invalid @enderror" 
                                                                  name="password" 
                                                                  required autocomplete="current-password">
                                
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                
                                                        <div class="row">
                                                            <div class="col-12 d-flex justify-content-center">
                                                                <div >
                                                                    <input 
                                                                      class="mycheck" 
                                                                      type="checkbox" 
                                                                      name="remember" 
                                                                      id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                    <label class="form-check-label mon-light" for="remember">
                                                                      Mantener sesión iniciada
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                
                                                        <div class="row mb-0">
                                                            <div class="col-12 d-flex align-items-center flex-column">
                                                                @if (Route::has('password.request'))
                                                                    <a class="text-pink my-2 mon-light text-decoration-none" href="{{ route('password.request') }}">
                                                                    Olvide mi contraseña
                                                                    </a>
                                                                @endif
                                                                <button type="submit" class="btn bg-pink text-white rounded-pill w-50 my-2">
                                                                    Enviar
                                                                </button>
                                
                                                                
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- --> 
                          </div>
                    </div>
                </div>
              </div>
              <!-- -->
              <h>
                <h4
                style="text-align: center; color:#596475 !important;"          
                > Números de contacto <h4>
              <h>
              <!-- Numeros de Cotiseguros --> 
              <div class="accordion-item m-2" >
                <h6 
                  id="headingContactoCotiseguros"
                  class="accordion-header collapsed redondear-3"
                  data-bs-toggle="collapse" 
                  data-bs-target="#collapseCotiNumero" 
                  aria-expanded="false" 
                  aria-controls="collapseCotiNumero"
                  >
                  Cotiseguros
                </h6>
                <div 
                  id="collapseCotiNumero" 
                  class="accordion-collapse collapse" 
                  aria-labelledby="headingContactoCotiseguros" 
                  data-bs-parent="#accordionFlushExample"
                  >
                  <div class="accordion-body row">
                    <!-- -->
                    <?php 
                      if ( count($contactocotiseguros) > 0 )
                      {
                       foreach ($contactocotiseguros as $contact =>$cn )
                       {
                          $url="whatsapp://send?phone=+".$cn['whatssap']."&text=hola";
                                  
                          ?>
                            <h4 style="text-align: center; color:#596475 !important;" class="mb-2">
                              {{$cn['nombre']  }} 
                       </h4>
                            <p>
                              <a 
                                class="btn btn-success rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                                href=<?= ($cn['whatssap']) ? $url : "#"; ?> 
                                target="_blank">
                                whatssap -  {{ $cn['whatssap'] }} 
                              </a>
                            </p>
                            <p>
                              <button 
                                class="btn btn-info rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                                style="background-color:#3c485a !important; color :#fff;"  >    
                              llamada {{ $cn['llamada']}} 
                              </button>
                            </p>
                            
                            
                          <?php 
                       }
                      }
                    ?>
                    
                    <!-- -->
                  </div>
                </div>
              </div>
              <!-- Numeros de seguros --> 
              <?php 
                if ( count($salud) > 0) 
                {
                  foreach ($salud as $poliza)
                  {
                    $idinsurers = $poliza->idinsurers;
                    $name = $poliza->name;
                    ?>
                      <div class="accordion-item m-2" >
                        <h6 
                          id="headingcontactoseguro_{{$idinsurers}}"
                          class="accordion-header collapsed redondear-2"
                          data-bs-toggle="collapse" 
                          data-bs-target="#collapseCotacseguro_{{$idinsurers}}" 
                          aria-expanded="false" 
                          aria-controls="collapseCotacseguro_{{$idinsurers}}"
                          >
                          <img 
                              class="w-10" 
                              height="25"  
                              width ="50" 
                              src="{{env('APP_URL')}}/storage/{{$poliza->image}}"
                              >
                              <strong>
                              <!--{{$name }}-->
                              </strong>
                          
                        </h6>
                        <div 
                          id="collapseCotacseguro_{{$idinsurers}}" 
                          class="accordion-collapse collapse" 
                          aria-labelledby="headingcontactoseguro_{{$idinsurers}}" 
                          data-bs-parent="#accordionFlushExample"
                          >
                          <div class="accordion-body row d-flex justify-content-center">
                            <!-- -->
                            <?php
                              $contactoseguros =  DB::table('contactoseguros')->where('conta_idseguro',$idinsurers)->get();
                              if ( $contactoseguros->count() > 0)
                              {
                                foreach ($contactoseguros as $contact => $con)
                                {
                                  $url="whatsapp://send?phone=+".$con->conta_nrowhat."&text=hola";
                                  
                                  ?>
                                    <h5 class="tituloservicio mb-2" >
                                      {{ $con->conta_servicio }}  1
                                    </h5>
                                    
                                    <p>
                                      <a 
                                        class="btn btn-success rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                                        href=<?= ($con->conta_nrowhat) ? $url : "#"; ?> 
                                        target="_blank">
                                        whatssap   {{ $con->conta_nrowhat ?  $con->conta_nrowhat : ' Sin contacto' }} 
                                      </a>
                                    </p>
                                    <p>
                                      <button 
                                        class="btn btn-info rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                                        style="background-color:#3c485a !important; color :#fff;"  >    
                                      llamada {{ $con->conta_nrocall  ?  $con->conta_nrocall : ' Sin contacto'}} 
                                      </button>
                                    </p>
                                    
                                    
                                  <?php
                                  
                                }
                              }
                            ?> 
                            <!-- -->
                          </div>
                        </div>
                      </div>
                    <?php 
                  }
                }
              ?>
              
              <!-- Numeros de Emergencia --> 
              <div class="accordion-item m-2" >
                <h6 
                  id="headingContacemergencia"
                  class="accordion-header collapsed redondear"
                  data-bs-toggle="collapse" 
                  data-bs-target="#collapseCotacEmergencia" 
                  aria-expanded="false" 
                  aria-controls="collapseCotacEmergencia"
                  >
                  Nro de emergencia
                </h6>
                <div 
                  id="collapseCotacEmergencia" 
                  class="accordion-collapse collapse" 
                  aria-labelledby="headingContacemergencia" 
                  data-bs-parent="#accordionFlushExample"
                  >
                  <div class="accordion-body row">
                    <!-- -->
                    <?php 
                      if ( count($datacliente) > 0 )
                      {
                        $url="whatsapp://send?phone=+".@$datacliente[0]->telefonococontacto."&text=hola";
                                  
                        ?>
                          <p class="tituloservicio">
                          {{ @$datacliente[0]->nombrecontacto }} {{ @$datacliente[0]->apellidocontacto }} 
                          </p>
                          <p>
                            <a 
                              class="btn btn-success rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                              href=<?= (@$datacliente[0]->telefonococontacto) ? $url : "#"; ?> 
                              target="_blank">
                              whatssap -  {{ @$datacliente[0]->telefonococontacto  ?  @$datacliente[0]->telefonococontacto : ' Sin contacto' }} 
                            </a>
                          </p>
                          <p>
                            <button 
                              class="btn btn-info rounded-pill px-1 mx-sm-0 mb-2 w-100" 
                              style="background-color:#3c485a !important; color :#fff;"  >    
                            llamada - {{ @$datacliente[0]->telefonococontacto  ?  @$datacliente[0]->telefonococontacto : ' Sin contacto' }} 
                            </button>
                          </p>
                          
                          
                        <?php
                      }
                    ?>
                    <!-- -->
                  </div>
                </div>
              </div>
          </div>
          
      <?php 
    }
    ?> 
  </div>

  <div class="row bg-dark ">
      <div class=" col-md-3 p-3" style="text-align: center;">
        <img src="{{ asset('storage/LOGO RGB_Icono full color (1).png') }}" style="width: 50px ;" alt="">
      </div>
      <div class=" col-md-3 p-3" style="text-align: center;">
        <h2 class="mon-bold text-white text-uppercase fs-5 p-1">Contactanos</h2>
        <a href="mailto:{{ $footer->email }}" style ="text-decoration:none;">
        <img src="{{ asset('envelope-fill.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->email }}</span>
        </a><br>
        
        <?php $url="whatsapp://send?phone=+584247089641&text=hola"; ?>
        <a href="<?=$url?>" style ="text-decoration:none;">
        <img src="{{ asset('whatsapp.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->whatsapp }}</span> 
        </a><br/>
        
      </div>
      <div class=" col-md-3 p-3" style="text-align: center;">
        <h2 class="mon-bold text-white text-uppercase fs-5">siguenos</h2>
        <a class="mx-2" href="{{ $footer->instagram }}"><img src="{{ asset('instagram.svg') }}" alt=""></a>
        <a class="mx-2" href="{{ $footer->facebook }}"><img src="{{ asset('facebook.svg') }}" alt=""></a> 
        <a class="mx-2" href="{{ $footer->tiktok }}"><img src="{{ asset('tiktok.svg') }}" alt=""></a>
      </div>
      <div style="text-align: center;">
        <p class="text-white " style="font-size: 15px; margin-top:10px; margin-bottom:10px;">COTISEGUROS 	&copy; 2022 - Todos los derechos reservados </p>
      </div>
    </div>
  </div>


  <!--modales  -->
  <?php 
  function generamoaldocumentos($id,$data)
  {
    $htmlmodal ='';
    $htmlmodal .= "<div class='modal fade' id='modaldocumentopoliza_$id' tabindex='' aria-labelledby='modaldocumentopoliza_$id' aria-hidden='true'>";
    $htmlmodal .= "<div class='modal-dialog'>";
    $htmlmodal .= "<div class='modal-content'>";
    $htmlmodal .= "<div class='modal-header'>";
    $htmlmodal .= "<h1 class='modal-title fs-5'>Documentos Póliza</h1>";
    $htmlmodal .= "<button type='button' class='btn-close colorbtn' data-bs-dismiss='modal' aria-label='Close'></button>";
    $htmlmodal .= "</div>";
    $htmlmodal .= "<div class='modal-body'>";
    
    foreach( $data as $p)
    {
      $ruta = env('APP_URL').'/'.$p->documentonombre;
      $htmlmodal .="<li class='list-group-item active' aria-current='true'>";
        $htmlmodal .= "<a href='".$ruta."' class='btn btn-secondary colorbtn m-2' target='_blank'>$p->tipodocumento</a> &nbsp;";
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
          $htmlmodal .="<a href='{{env('APP_URL')}}/$f->photo_payment' class='' target='_blank'> <i class='bi bi-eye-fill'></i></a>";
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
</body>
</html>
