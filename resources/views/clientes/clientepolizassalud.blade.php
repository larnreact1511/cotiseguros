@extends('layouts.clientesseguro2')
@section('content')
<div class="row d-flex justify-content-center" style="text-align: center;">
    <!--  -->  
    <div 
      class="accordion accordion-flush" 
      id="acoordeoplolizasclientesalud" 
      style="text-align: center;"
      >   
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
                            data-bs-target="#collapsePoliza_{{$poliza->idinsurers}}" 
                            aria-expanded="false" 
                            aria-controls="collapsePoliza_{{$poliza->idinsurers}}"
                            onclick="clickpoliza({{$poliza->idinsurers}})"
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
                            id="collapsePoliza_{{$poliza->idinsurers}}" 
                            class="accordion-collapse collapse" 
                            aria-labelledby="flush-headingp_{{$poliza->idinsurers}}" 
                            data-bs-parent="#acoordeoplolizasclientesalud"
                            >
                            <div class="accordion-body row">
                                <div class ="card m-2">
                                    <h6 style ="color:#911d1b !important;">
                                      Beneficiarios de la póliza
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
                                            Comentarios  de la póliza
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
                                            Documentos  de la póliza
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
                                <div class ="card m-2">
                                   <!-- --> 
                                   <div 
                                      class="accordion accordion-flush" 
                                      id="accordionnotas" 
                                      style="text-align: center;">   
                                        
                                        <div class="accordion-item m-2 ">
                                          <h6 
                                            id="flush-headingnotas" 
                                            class="accordion-header collapsed redondear-2 collapsed" 
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
                <?php
            }
        ?>
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
    <!--  --> 
</div>

<script> 
  let vcabezerapolizas =[];
  let vcabezerapolizasnotas =[];
  function clickpoliza(id)
  {
    let collapsePoliza = document.getElementById("collapsePoliza_"+id);
    if (vcabezerapolizas.includes(id))
    {
      
        vcabezerapolizas.shift(); 
        
        collapsePoliza.classList.remove('accordion-collapse'); 
        collapsePoliza.classList.remove('collapse')
        collapsePoliza.classList.remove('show'); 
      
        collapsePoliza.classList.add('accordion-collapse'); 
        collapsePoliza.classList.add('collapse'); 
        collapsePoliza.classList.add('hide'); 

        collapsePoliza.style.display = "none"; console.log(' con display ')
    }
    else
    {
      if (vcabezerapolizas.length >0)
      {
          
          let antes = vcabezerapolizas[0];
          let anterior =document.getElementById("collapsePoliza_"+antes);
          anterior.style.display = "none";
          vcabezerapolizas.shift();
          vcabezerapolizas.push(id);
          anterior.style.display = "block";
      }
      else
      {
          vcabezerapolizas.push(id);
          collapsePoliza.style.display = "block";
      }
    }
  }
  function clicknota(id)
  {
    let collapseinfonotas = document.getElementById("collapseinfonotas_"+id);
    if (vcabezerapolizasnotas.includes(id))
    {
      
        vcabezerapolizasnotas.shift(); 
        
        collapseinfonotas.classList.remove('accordion-collapse'); 
        collapseinfonotas.classList.remove('collapse')
        collapseinfonotas.classList.remove('show'); 
      
        collapseinfonotas.classList.add('accordion-collapse'); 
        collapseinfonotas.classList.add('collapse'); 
        collapseinfonotas.classList.add('hide'); 

        collapseinfonotas.style.display = "none";
    }
    else
    {
      if (vcabezerapolizasnotas.length >0)
      {
          
          let antes = vcabezerapolizasnotas[0];
          let anterior =document.getElementById("collapseinfonotas_"+antes);
          anterior.style.display = "none";
          vcabezerapolizasnotas.shift();
          vcabezerapolizasnotas.push(id);
          anterior.style.display = "block";
      }
      else
      {
          vcabezerapolizasnotas.push(id);
          collapseinfonotas.style.display = "block";
      }
    }
  }
</script> 

@endsection
