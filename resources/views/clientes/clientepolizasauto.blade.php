@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <!--  -->  
    <?php 
    if (count($autos) >0 )
    {
      ?>
          <!--  -->
          <h6 class="tituloh6" style="color:#911d1b !important;">
            Póliza de Autos
          </h6>
          <!-- --> 
          <div 
            class="accordion accordion-flush" 
            id="acoordeoplolizasclientesalud" 
            style="text-align: center;"
            >   
              <?php  
                  if ( count($autos) > 0) 
                  {
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
                      $comentarios =DB::table('comentariospolizas')->where('id_insurancepolicies',$poliza->id_insurancepolicies)->get();
                    
                      ?>
                          <div class="accordion-item m-2">
                              <h6  
                                  id="flush-headingp_{{$poliza->idinsurers}}"
                                  class="accordion-header collapsed redondear"
                                  data-bs-toggle="collapse" 
                                  data-bs-target="#flush-collapsePoliza_{{$poliza->idinsurers}}" 
                                  aria-expanded="false" 
                                  aria-controls="flush-collapsePoliza_{{$poliza->idinsurers}}"
                                  >
                                  <img 
                                    class="w-10" 
                                    height="30"  
                                    width ="50" 
                                    src="{{env('APP_URL')}}/storage/{{$poliza->image}}"
                                    >
                                      {{ $poliza->name }}  {{ number_format($poliza->coverage, 2, ',', '.') }} USD
                              </h6> 
                              <div
                                  id="flush-collapsePoliza_{{$poliza->idinsurers}}" 
                                  class="accordion-collapse collapse" 
                                  aria-labelledby="flush-headingp_{{$poliza->idinsurers}}" 
                                  data-bs-parent="#acoordeoplolizasclientesalud"
                                  >
                                  <div class="accordion-body row">
                                      
                                      
                                      <div class ="card m-2">
                                        <h6 class="tituloh6">
                                            Documentos  de la póliza
                                        </h6>
                                        <?php
                                              if ( count($documentos) >0 )
                                              {
                                                  foreach ($documentos as $documento => $d)
                                                  {
                                                      ?>
                                                         <p> 
                                                                <a 
                                                                  href="{{env('APP_URL')}}/{{$d->documentonombre}}" 
                                                                  class='m-2'
                                                                  style ="text-decoration:none; color: #3c485a; "
                                                                  target='_blank'>{{ $d->tipodocumento}} <i class="bi bi-eye  bi--md"></i>
                                                                </a> 
                                                              </p>
                                                      <?php 
                                                  }
                                              }
                                              else
                                                echo " Ninguno ";
                                        ?>
                                      </div>
                                      <!-- --> 
                                      <div 
                                          class="accordion accordion-flush" 
                                          id="accordionnotas" 
                                          style="text-align: center;">   
                                            
                                            <div class="accordion-item m-2 ">
                                              <h6 
                                                id="flush-headingnotas" 
                                                class="accordion-header collapsed -4-2 collapsed  redondear" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapseinfonotas_{{$poliza->idinsurers}}" 
                                                aria-expanded="false" 
                                                aria-controls="collapseinfonotas_{{$poliza->idinsurers}}"
                                                onclick="clicknota({{$poliza->idinsurers}})"
                                                >
                                                Notas
                                              </h6>
                                              <div 
                                                id="collapseinfonotas_{{$poliza->idinsurers}}" 
                                                class="accordion-collapse collapse" 
                                                aria-labelledby="flush-headingnotas" 
                                                data-bs-parent="#accordionnotas"
                                                >
                                                <div class="accordion-body row">
                                                    <!-- --> 
                                                    <?php 
                                                    if ( count($comentarios) >0 )
                                                    {
                                                      foreach($comentarios as $c)
                                                      {
                                                        ?>
                                                        <h7 class="card-title" style="color :black;">Nota : <?=@$c->comentario?></h7>
                                                        <?php 
                                                      }
                                                    
                                                    }
                                                    ?>
                                                    <!--  --> 
                                                    
                                                    <!--  -->
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <!-- -->
                                  </div>
                              </div>
                          </div>
                      
                      <?php
                    }
                  }
                  else
                  {
                    ?>
                    <h1 style="color:blue;">
                        Este Usuario no tiene pólizas disponibles de este tipo
                    </h1>
                     <?php  
                  }
              ?>
               <div class="accordion-item m-2">
                  <h6  
                      id=""
                      class="accordion-header collapsed redondear-4"
                      >
                      <a href="{{env('APP_URL')}}/usuarios" style ="text-decoration:none; color:#596475">
                      <i class=" bi-skip-start-fill bi--md"></i>
                      Volver
                      </a>
                      
                  </h6>     
              </div>
              <div class="accordion-item m-2">
                  <h6  
                      id=""
                      class="accordion-header collapsed redondear-4"
                      >
                      <a href="{{env('APP_URL')}}/logout" style ="text-decoration:none; color:#596475">
                      <i class=" bi bi-power bi--md"></i>
                      Cerrar
                      </a>
                      
                  </h6>     
              </div>
          </div>
      <?php 
    }
    else
    {
      ?>
      <div  class="row d-flex justify-content-center mt-2" >
        <h1 style="color:blue;">
            Este Usuario no tiene pólizas disponibles de este tipo
        </h1>

      </div>
      <div 
            class="accordion accordion-flush" 
            id="acoordeoplolizasclientesalud" 
            style="text-align: center;"
            >   
              <div class="accordion-item m-2">
                  <h6  
                      id=""
                      class="accordion-header collapsed redondear"
                      >
                      <a href="{{env('APP_URL')}}/usuarios" style ="text-decoration:none; color:#fff;">
                      <i class=" bi-skip-start-fill bi--md"></i>
                      Volver
                      </a>
                      
                  </h6>     
              </div>
              <div class="accordion-item m-2">
                  <h6  
                      id=""
                      class="accordion-header collapsed redondear"
                      >
                      <a href="{{env('APP_URL')}}/logout" style ="text-decoration:none; color:#fff;">
                      <i class=" bi bi-power bi--md"></i>
                      Cerrar
                      </a>
                      
                  </h6>     
              </div>
      </div>
      <?php 
    }
    ?>
   
</div>
<?php 
  
?>
@endsection
