<?php 
use Illuminate\Support\Facades\DB;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cotiseguros</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <style>
    .btn-secondary {
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
  background-color: #3c485a !important;
  border-color:#3c485a;
  color: #fff;
}
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color:#911d1b !important;;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <?=$datacliente[0]->nombre.' '.$datacliente[0]->apellido?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
       
        <li class="nav-item">
          <a class="nav-link" href="#">Cotiza</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid mt-3">
  <div class="row">
      <?php 
        if ( @$datacliente[0]->cedula)
        {
          ?> 
          <div class="col-auto">
            <label for="cedula" class="visually">Cedula</label>
            <input type="text" readonly class="form-control-plaintext" id="cedula" value="<?=$datacliente[0]->cedula?>">
          </div>
          <?php
        }
        if ( @$datacliente[0]->rif)
        {
          ?> 
          <div class="col-auto">
            <label for="cedula" class="visually">Rif</label>
            <input type="text" readonly class="form-control-plaintext" id="cedula" value="<?=$datacliente[0]->rif?>">
          </div>
          <?php
        }
        if ( @$datacliente[0]->numerotelefono)
        {
          ?> 
            <div class="col-auto">
              <label for="Nrotelefono" class="visually">Nro telefono</label>
              <input type="text" readonly class="form-control-plaintext" id="Nrotelefono" value="<?=$datacliente[0]->numerotelefono?>">
            </div>
          <?php
        }
      ?> 
      
      
  </div>
  <!-- acordeon -->  
  <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">     
      <!--polizas salud --> 
      <div class="accordion-item">
        <h6 class="" id="flush-headingTwo">
          <button class="redondear collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            Polizas Salud 
          </button>
        </h6>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body row">
            <!-- -->
            <?php 
              if ( count($salud) > 0) 
              {
                //echo "<pre>"; print_r($salud);
                foreach ($salud as $poliza)
                {
                  $vec=array('id_insurancepolicies'=>$poliza->id_insurancepolicies,'quote_id'=>0);
                  $member_quotes =DB::table('member_quotes')->where($vec)->get();
                  $frequencyofpayments =DB::table('frequencyofpayments')
                  ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
                  ->where('frequencyofpayments.id',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();

                  $vec2=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vec2)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                        <div class="card-body text-center">
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage); ?></h5>
                            </div>
                            
                          </div>
                          <?php 
                          if ( count($documentos) >0 )
                          {
                            ?>
                            <div class="card text-center" style="width:100%;">
                                <div class="card-body text-center">
                                  <h5 class="card-title"> Documentos Poliza </h5>
                                  <?php  
                                    foreach( $documentos as $p)
                                    {
                                      ?>
                                      <div class="card-body text-center">
                                        
                                        <a href="https://dev.cotiseguros.com.ve/<?= $p->documentonombre; ?>" class="btn btn-secondary" target="_blank"> <?=$p->tipodocumento; ?></a>
                                        
                                      </div>
                                      <?php
                                    }
                                  ?>
                                  
                                </div>
                            </div>
                            <?php 
                          }
                          if ( count($member_quotes) >0 )
                          {
                            ?>
                            <div class="card text-center" style="width:100%;">
                                <div class="card-body text-center">
                                  <h5 class="card-title"> Beneficiarios </h5>
                                  <?php  
                                    foreach( $member_quotes as $m)
                                    {
                                      ?>
                                      <p> <?=$m->status.' '.$m->gender .' ( '.$m->date.' años)'; ?></p>
                                      <?php
                                    }
                                  ?>
                                  
                                </div>
                            </div>
                            <?php 
                          }
                          if ( count($frequencyofpayments) > 0)
                          {
                            ?>
                              <div class="card text-center" style="width:100%;">
                                  <div class="card-body text-center">
                                    <ul class="list-group">
                                      <li class="list-group-item active" aria-current="true">Pagos de la poliza</li>
                                    </ul>
                                    <?php  
                                      
                                      foreach( $frequencyofpayments as $f)
                                      {
                                        $estado ='Pagada';
                                        if ($f->estadodepago ==0)
                                          $estado ='Pendiente';
                                        ?>
                                          <li class="list-group-item active" aria-current="true">
                                            <?='Fecha  de pago : '.$f->fechafin .' '.$estado; ?>
                                            <?php 
                                              if ($estado=='Pagada')
                                            ?>
                                                <a href="https://dev.cotiseguros.com.ve/<?= $f->photo_payment; ?>" class="btn btn-secondary" target="_blank">  <i class="bi bi-eye-fill"></i></a>
                                          </li>
                                        <?php
                                      }
                                    ?>
                                    
                                  </div>
                              </div>
                            <?php 
                          }
                          ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
            ?>
            <!-- -->
          </div>
        </div>
      </div>
      <!-- polizas auto--> 
      <div class="accordion-item">
        <h6 class="" id="flush-headingThree">
          <button class="redondear collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          Polizas Auto 
          </button>
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
                  ->where('frequencyofpayments.id',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();
                  $vecd=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vecd)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                        <div class="card-body text-center">
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage); ?></h5>
                            </div>
                            
                          </div>
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->descripcionpoliza; ?></h5>
                            </div>
                          </div>
                          <?php 
                          if ( count($documentos) >0 )
                          {
                            ?>
                            <div class="card text-center" style="width:100%;">
                                <div class="card-body text-center">
                                  <h5 class="card-title"> Documentos Poliza </h5>
                                  <?php  
                                    foreach( $documentos as $p)
                                    {
                                      ?>
                                      <div class="card-body text-center">
                                        
                                        <a href="https://dev.cotiseguros.com.ve/<?= $p->documentonombre; ?>" class="btn btn-secondary" target="_blank"> <?=$p->tipodocumento; ?></a>
                                        
                                      </div>
                                      <?php
                                    }
                                  ?>
                                  
                                </div>
                            </div>
                            <?php 
                          }
                          if ( count($frequencyofpayments2) > 0)
                          {
                            ?>
                              <div class="card text-center" style="width:100%;">
                                  <div class="card-body text-center">
                                    <ul class="list-group">
                                      <li class="list-group-item active" aria-current="true">Pagos de la poliza</li>
                                    </ul>
                                    <?php  
                                      
                                      foreach( $frequencyofpayments2 as $f)
                                      {
                                        $estado ='Pagada';
                                        if ($f->estadodepago ==0)
                                          $estado ='Pendiente';
                                        ?>
                                          <li class="list-group-item active" aria-current="true">
                                            <?='Fecha  de pago : '.$f->fechafin .' '.$estado; ?>
                                            <?php 
                                              if ($estado=='Pagada')
                                            ?>
                                                <a href="https://dev.cotiseguros.com.ve/<?= $f->photo_payment; ?>" class="" target="_blank"> <i class="bi bi-eye-fill"></i></a>
                                          </li>
                                        <?php
                                      }
                                    ?>
                                    
                                  </div>
                              </div>
                            <?php 
                          }
                          ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
      <!--polizas empresa --> 
      <div class="accordion-item">
        <h6 class="" id="flush-headingfour">
          <button class="redondear collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
          Polizas Empresa 
          </button>
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
                  ->where('frequencyofpayments.id',$poliza->id_insurancepolicies)
                  ->select(
                    'frequencyofpayments.fechafin', 
                    'frequencyofpayments.estadodepago', 
                    'payments.montopago',
                    'payments.photo_payment')
                  ->get();
                  $vecd2=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                  $documentos =DB::table('docuemntos')->where($vecd2)->get();
                  ?>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <div class="card text-center " style="width:100%;">
                        <div class="card-body text-center">
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->name; ?></h5>
                              <h5 class="card-title"> <?=number_format($poliza->coverage); ?></h5>
                            </div>
                            
                          </div>
                          <div class="card text-center" style="width:100%;">
                            <div class="card-body text-center">
                              <h5 class="card-title"> <?=$poliza->descripcionpoliza; ?></h5>
                            </div>
                          </div>
                          <?php 
                          if ( count($documentos) >0 )
                          {
                            ?>
                            <div class="card text-center" style="width:100%;">
                                <div class="card-body text-center">
                                  <h5 class="card-title"> Documentos Poliza </h5>
                                  <?php  
                                    foreach( $documentos as $p)
                                    {
                                      ?>
                                      <div class="card-body text-center">
                                        
                                        <a href="https://dev.cotiseguros.com.ve/<?= $p->documentonombre; ?>" class="btn btn-secondary" target="_blank"> <?=$p->tipodocumento; ?></a>
                                        
                                      </div>
                                      <?php
                                    }
                                  ?>
                                  
                                </div>
                            </div>
                            <?php 
                          }
                          if ( count($frequencyofpayments3) > 0)
                          {
                            ?>
                              <div class="card text-center" style="width:100%;">
                                  <div class="card-body text-center">
                                    <ul class="list-group">
                                      <li class="list-group-item active" aria-current="true">Pagos de la poliza</li>
                                    </ul>
                                    <?php  
                                      
                                      foreach( $frequencyofpayments3 as $f)
                                      {
                                        $estado ='Pagada';
                                        if ($f->estadodepago ==0)
                                          $estado ='Pendiente';
                                        ?>
                                          <li class="list-group-item active" aria-current="true">
                                            <?='Fecha  de pago : '.$f->fechafin .' '.$estado; ?>
                                            <?php 
                                              if ($estado=='Pagada')
                                            ?>
                                                <a href="https://dev.cotiseguros.com.ve/<?= $f->photo_payment; ?>" class="" target="_blank"> <i class="bi bi-eye-fill"></i></a>
                                          </li>
                                        <?php
                                      }
                                    ?>
                                    
                                  </div>
                              </div>
                            <?php 
                          }
                          ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
      <!-- -->
  </div>
</div>
<!--modales  -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 <!-- Footer -->
<div class="row bg-dark p-0 m-0 pt-4 px-5" id="footer">
    <div class="col-12 col-md-3 p-2 m-0">
      <img src="{{ asset('storage/LOGO RGB_Icono full color (1).png') }}" style="width: 100px ;" alt="">
    </div>
    <div class="col-12 col-md-3 mt-3">
      <h2 class="mon-bold text-white text-uppercase fs-5 d-none">donde estamos</h2>
      <p class="mon-regular text-white fs-6 pt-3 d-none">{{ $footer->donde_estamos }}</p>
    </div>
    <div class="col-12 col-md-3 mt-3">
      <h2 class="mon-bold text-white text-uppercase fs-5">contactanos</h2>
      <img src="{{ asset('envelope-fill.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->email }}</span> <br/>
      <img src="{{ asset('whatsapp.svg') }}" alt=""> <span class="text-white mon-regular">{{ $footer->whatsapp }}</span> <br/>
    </div>
    <div class="col-12 col-md-3 mt-3">
      <h2 class="mon-bold text-white text-uppercase fs-5">siguenos</h2>
      <a class="mx-2" href="{{ $footer->instagram }}"><img src="{{ asset('instagram.svg') }}" alt=""></a>
      <a class="mx-2" href="{{ $footer->facebook }}"><img src="{{ asset('facebook.svg') }}" alt=""></a> 
      <a class="mx-2" href="{{ $footer->tiktok }}"><img src="{{ asset('tiktok.svg') }}" alt=""></a>
    </div>
    <div class="col-12">
      <h3 class="text-white h5 my-5">COTISEGUROS 	&copy; 2022 - Todos los derechos reservados</h3>
    </div>
  </div>
</body>
</html>
