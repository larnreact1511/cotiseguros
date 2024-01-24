@extends('layouts.menuclientes')

@section('content')
<link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">
<?php 
    if ( count($accidents) > 0)
    {
        
        ?>
        <div style="height:70vh;">
            <!-- -->
            <?php 
                foreach ($accidents as $acc)
                {
                    $vec2=array('id_accidente'=>$acc->id);
                    $estado =$acc->estado;
                    $estado1 =$acc->estado ==2 ?'active':'';
                    $estado2 =$acc->estado ==3?'active':'';
                    $estado3 =$acc->estado ==5?'active':'';
                    $documentos =DB::table('docuemntos')->where($vec2)->get();    
                    ?>
                        <div class="row d-flex justify-content-center p-2 m-2">
                            <div class="col-md-6 text-center justify-content-center ">
                                <h5 class="m-2 p-2">
                                    Descripción :<?=$acc->descripcion.'( '.number_format($acc->monto).') USD ' ?>
                                </h5>
                                <h5 class="m-2 p-2">
                                    Monto Aprobado : <?=number_format($acc->montopagado).' USD'?>
                                </h5>
                                <ul class="progressbar">   
                                    <li class="<?=$estado1 ?>">Reportado</li>
                                    <li class="<?=$estado2 ?>">Proceso</li>
                                    <li class="<?=$estado3 ?>">Aprobado</li>
                                </ul>
                            </div> 
                            <div class="col-md-6 text-center">
                                <?php  
                                    if (count($documentos)>0) 
                                    {
                                        ?>
                                            <h5  class="m-2 p-2"> Documentos cargados sobre la poliza</h5>
                                            <ul class="list-group ">
                                            <?php   
                                            foreach( $documentos as $p)
                                            {
                                                {
                                                    $ruta= "https://cotiseguros.com.ve/".trim($p->documentonombre);
                                                    ?>
                                                        <li class="list-group-item">
                                                        <h5><?=$p->tipodocumento  ?> 
                                                        <a href="<?=$ruta?>" target='_blank' title= "ver documento" style="text-decoration:none;" >
                                                            ( ver documento 
                                                                <i class="bi bi-eye-fill"></i>
                                                            )
                                                        </a>
                                                        </h5>
                                                        
                                                        
                                                        </li>
                                                    <?php
                                                }
                                            }
                                            ?> 
                                            </ul>
                                        <?php
                                            
                                    }
                                ?>
                            </div>  
                        </div>

                    <?php 
                }
            ?>
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
