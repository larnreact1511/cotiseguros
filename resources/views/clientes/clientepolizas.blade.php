@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <!--
    <img src="https://cotiseguros.com.ve/saludo.png" style="width: 80%;">
    -->
    <!-- --> 
    <!-- acordeon -->  
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
             
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
                                      if ( count($comentarios) >0 )
                                      {
                                        foreach($comentarios as $c)
                                        {
                                          ?>
                                          <h6 class="card-title">Nota : <?=@$c->comentario?></h6>
                                          <?php 
                                        }
                                      
                                      }
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
              <!-- -->
          </div>
          <!--  --> 

</div>
@endsection
