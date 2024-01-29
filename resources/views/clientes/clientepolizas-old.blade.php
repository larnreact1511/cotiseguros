@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <!--  -->  
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
                                  <!-- -->
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
                                              <h6 
                                                id="flush-notas_{{$poliza->id_insurancepolicies}}" 
                                                class="accordion-header collapsed redondear collapsed" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#flush-collapsenotas_{{$poliza->id_insurancepolicies}}" 
                                                aria-expanded="false" 
                                                aria-controls="flush-collapsenotas_{{$poliza->id_insurancepolicies}}"
                                                >
                                                Notas
                                              </h6>
                                              <div 
                                                id="flush-collapsenotas_{{$poliza->id_insurancepolicies}}" 
                                                class="accordion-collapse collapse" 
                                                aria-labelledby="flush-notas_{{$poliza->id_insurancepolicies}}" 
                                                data-bs-parent="#accordionFlushExample_2"
                                                >
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
          <h6 
            id="flush-headingThree"
            class="accordion-header collapsed redondear"
            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree"
            >
            Polizas Auto 
          </h6>
          <div 
            id="flush-collapseThree" 
            class="accordion-collapse collapse" 
            aria-labelledby="flush-headingThree" 
            data-bs-parent="#accordionFlushExample"
            >
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
        <div class="accordion-item m-2">
          <h6 
            id="flush-headingfour"
            class="accordion-header collapsed redondear"
            data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour"
            >
            Polizas Empresa 
          </h6>
          <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body row">
            <?php 
                if ( count($empresa) > 0) 
                {
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
    <!--  --> 
</div>
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

      $htmlmodal .="<li class='list-group-item active' aria-current='true'>";
        $htmlmodal .= "<a href='https://cotiseguros.com.ve/$p->documentonombre' class='btn btn-secondary colorbtn m-2' target='_blank'>$p->tipodocumento</a> &nbsp;";
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
@endsection
