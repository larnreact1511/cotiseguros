@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <!--  -->  
    <div 
      class="accordion accordion-flush" 
      id="acoordeoplolizasclientesalud" 
      style="text-align: center;"
      >   
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
                              src="https://cotiseguros.com.ve/storage/{{$poliza->image}}"
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
            echo " En estos momentos, no tiene pólizas de autos inscritas ";
        ?>
    </div>
    <!--  --> 
</div>
<?php 
  
?>
@endsection
