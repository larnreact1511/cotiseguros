@extends('layouts.clientesseguro')

@section('content')
<link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">
<?php 
use Illuminate\Support\Facades\DB;
    if ( count($accidents) > 0)
    {
        
        ?>
            <div style="height:70vh;">
                <!-- -->
                <div class="accordion accordion-flush" id="accordionFlushExample" style="text-align: center;">   
                    <?php 
                        foreach ($insurers as $insurer)
                        {
                            /*
                            $vec2=array('id_accidente'=>$acc->id);
                            
                            $documentos =DB::table('docuemntos')->where($vec2)->get();   
                            
                            $insurers =DB::table('insurancepolicies')
                            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
                            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
                            ->where('insurancepolicies.id',$acc->id_insurancepolicies)
                            ->select(
                                'coverages.coverage',
                                'insurers.name',
                                'insurers.image',
                                )->get(); 
                            */
                            $accidents = DB::table('accidents')
                            ->where('id_insurancepolicies',$insurer->id_insurancepolicies )
                            ->get();
                            
                            ?>
                            <!-- -->
                            <div  class="accordion-item m-2">
                                <h6 
                                id="flush-headinginforperson"
                                class="accordion-header collapsed redondear redondear-4"
                                data-bs-toggle="collapse" 
                                data-bs-target="#flush-collapseinforp{{$insurer->id_insurers}}"
                                 aria-expanded="false" 
                                 aria-controls="flush-collapseinforp{{$insurer->id_insurers}}"
                                >
                                <img 
                                    class="w-10" 
                                    height="30"  
                                    width ="50" 
                                    src="{{env('APP_URL')}}storage/{{$insurer->image}}"
                                    >
                                    {{ number_format($insurer->coverage, 2, ',', '.') }} {{$insurer->name}}
                                </h6>
                                <?php 
                                if ($accidents->count()  > 0)
                                {
                                    $ultimo= 0;
                                    foreach ($accidents as $accident => $t)
                                    {
                                       
                                        if ($t->id >0 )
                                        {
                                            $ultimo = $t->id;
                                        }
                                    }
                                    
                                    $estado =$accidents[0]->estado;
                                    $estado1 =$accidents[0]->estado ==2 ?'active':'';
                                    $estado2 =$accidents[0]->estado ==3?'active':'';
                                    $estado3 =$accidents[0]->estado ==5?'active':'';

                                    $vec2=array('id_accidente'=>$ultimo);
                                    $documentos =DB::table('docuemntos')->where($vec2)->get();   

                                    ?>
                                        <div 
                                            id="flush-collapseinforp{{$insurer->id_insurers}}" 
                                            class="accordion-collapse collapse" 
                                            aria-labelledby="flush-headinginforperson" 
                                            data-bs-parent="#accordionFlushExample"
                                            >
                                            <div class="accordion-body row ">
                                                <div class="card d-flex justify-content-center">
                                                    <div class="col-md-12 text-center justify-content-center ">
                                                        <h6 class="m-2 p-2">
                                                            Descripción :<?=$accidents[0]->descripcion.'( '.number_format($accidents[0]->monto).') USD ' ?>
                                                        </h6>
                                                        <h6 class="m-2 p-2">
                                                            Monto Aprobado : <?=number_format($accidents[0]->montopagado).' USD'?>
                                                        </h6>
                                                        <div class =" d-flex justify-content-center" >
                                                            <ul class="progressbar d-flex justify-content-center">   
                                                                <li class="<?=$estado1 ?> " style="width:80px;">Reportado</li>
                                                                <li class="<?=$estado2 ?> " style="width:80px;">Proceso</li>
                                                                <li class="<?=$estado3 ?> " style="width:80px;">Aprobado</li>
                                                            </ul>
                                                        </div>
                                                        
                                                    </div> 
                                                    <!-- --> 
                                                    <div class="col-md-12 text-center">
                                                        <?php  
                                                            if (count($documentos)>0)
                                                            {
                                                                ?>    
                                                                    <h5  class="m-2 p-2"> Documentos cargados sobre la poliza</h5>
                                                                    <ul class="list-group list-group-flush ">
                                                                    <?php 
                                                                    foreach( $documentos as $p)
                                                                    {
                                                                        $ruta = env('APP_URL').'/'.trim($p->documentonombre);
                                                                        ?>
                                                                            <li class="list-group-item">
                                                                                <h5><?=$p->tipodocumento  ?> 
                                                                                <a href="<?=$ruta?>" target='_blank' title= "ver documento" style="text-decoration:none;" >
                                                                                    ( ver documento 
                                                                                        <i class="bi bi-eye-fill"></i>
                                                                                    )
                                                                                    </a>
                                                                                </h5>
                                                                        <?php
                                                                    }
                                                                    ?> 
                                                                <?php
                                                            }
                                                        ?> 
                                                    </div>
                                                    <!-- --> 
                                                </div>
                                                <?php 
                                                    foreach ($accidents as $accident => $t)
                                                    {
                                                        $ruta = env('APP_URL').'/siniestro/'.trim($t->id);
                                                        if ($t->id != $ultimo )
                                                        {
                                                            ?>
                                                            <a 
                                                                href="<?=$ruta?>" 
                                                                target='_blank' 
                                                                title= " Siniestro anterior " 
                                                                class="btn btn-primary mt-2 redondear-3" >
                                                                Siniestro anterior
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php 
                                    
                                }
                                else
                                {
                                    ?>
                                        <div 
                                            id="flush-collapseinforp{{$insurer->id_insurers}}" 
                                            class="accordion-collapse collapse" 
                                            aria-labelledby="flush-headinginforperson" 
                                            data-bs-parent="#accordionFlushExample"
                                            >
                                            <div class="accordion-body row ">
                                                <div class="card d-flex justify-content-center">
                                                    <div class="col-md-12 text-center justify-content-center ">
                                                        <h6 class="m-2 p-2">
                                                            Sin Accidentes
                                                        </h6>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                }
                                ?>
                                

                            </div>
                            <!-- -->
                            <?php 
                        }
                    ?>
                </div>
                <div class ="row">
                    <div class="col-md-12 p-2">
                        <a 
                            href="{{env('APP_URL')}}/usuarios" 
                            style ="text-decoration:none; color:#911d1b !important;" 
                            class ="d-flex justify-content-center"
                            >
                            <i class=" bi-skip-start-fill bi--3xl"></i>
                            <strong> 
                            Volver
                            </strong>   
                        </a>
                    </div>
                </div>
            </div>
        <?php
        
    }
    else
    {
        ?>
        <div class="row d-flex justify-content-center text-center" style="height:70vh;">
            <h1>
            No tiene siniestros registrados de momento
            </h1>
        </div>

        <?php
    }
    

?>

@endsection
