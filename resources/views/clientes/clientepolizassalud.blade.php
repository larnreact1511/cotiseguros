@extends('layouts.clientesseguro')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;">
    <!--  -->  
    <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
        <?php  
            foreach ($salud as $poliza)
            {
                $vec=array('id_insurancepolicies'=>$poliza->id_insurancepolicies,'quote_id'=>0);
                $member_quotes =DB::table('member_quotes')->where($vec)->get();
                $comentarios =DB::table('comentariospolizas')->where('id_insurancepolicies',$poliza->id_insurancepolicies)->get();
                $vec2=array('id_insurancepolicies'=>$poliza->id_insurancepolicies);
                $documentos =DB::table('docuemntos')->where($vec2)->get();
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
                            data-bs-parent="#accordionFlushExample"
                            >
                            <div class="accordion-body row">
                                <div class ="card m-2">
                                    <h6 style ="color:#911d1b !important;">
                                        Beneficiarios 
                                    </h6>
                                    <?php  
                                        if ( count($member_quotes) >0 )
                                        {
                                            foreach ($member_quotes as $member => $m)
                                            {
                                                ?>
                                                    <div class ="card m-2">
                                                        <p> 
                                                        {{ $m->status}}  {{ $m->gender}} ( {{ $m->date}}  años )
                                                        </p>
                                                    </div>
                                                <?php 
                                            }
                                        }
                                        ?>
                                        <h6 style ="color:#911d1b !important;">
                                            Comentarios 
                                        </h6>
                                        <?php 
                                        if ( count($comentarios) >0 )
                                        {
                                            foreach ($comentarios as $comentario => $c)
                                            {
                                                ?>
                                                   <div class ="card m-2">
                                                        <p> 
                                                        {{ $c->comentario}} 
                                                        </p>
                                                    </div> 
                                                <?php 
                                            }
                                        }
                                        else
                                          echo " Ninguno ";
                                        ?>
                                        <h6 style ="color:#911d1b !important;">
                                            Documentos 
                                        </h6>
                                        <?php
                                        if ( count($documentos) >0 )
                                        {
                                            foreach ($documentos as $documento => $d)
                                            {
                                                ?>
                                                   <div class ="card m-2">
                                                        <p> 
                                                          <a 
                                                            href="{{env('APP_URL')}}/{{$d->documentonombre}}" 
                                                            class='btn btn-secondary colorbtn m-2' 
                                                            target='_blank'>{{ $d->tipodocumento}}
                                                          </a> 
                                                        </p>
                                                        
                                                    </div>  
                                                <?php 
                                            }
                                        }
                                        else
                                          echo " Ninguno ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }

        ?>
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
