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
                                      <div class="accordion-body row"
                                          >
                                          contenido poliza
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
          </div>
      <?php 
    }
    else
    {
      ?>
      <div  class="row d-flex justify-content-center" style="text-align: center; height:50vh; background-image: url('{{env('APP_URL')}}/saludo.jpg');">

      </div>
      <div 
            class="accordion accordion-flush mt-2" 
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
