@extends('layouts.menuclientes')

@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;" >
    <div class="col-md-10">
        <?php 
            if ( count($polizas))
            {
                ?>
                    <!-- -->
                    <div class="accordion accordion-flush" id="accordionExample">
                        <?php 
                        $i=0;
                        foreach ( $polizas as  $insur)
                        {
                            $tipopoliza= $insur->name.' ';
                            switch ($insur->tipopoliza) 
                            {
                                case 1:
                                    $tipopoliza .='Póliza de Salud';
                                    break;
                                case 2:
                                    $tipopoliza .='Póliza de Autos';
                                    break;
                                case 3:
                                    $tipopoliza .='Póliza de Patrimonio';
                                    break;
                            }
                            $tipopoliza .=' monto de '.number_format($insur->coverage). ' USD';
                            $vec2=array('id_insurancepolicies'=>$insur->id);
                            $documentos =DB::table('docuemntos')->where($vec2)->get();    
                            $memberquotes = $memberquotes = DB::table('member_quotes')
                            ->where('member_quotes.id_insurancepolicies', '=',$insur->id)
                            ->select('member_quotes.status',
                            'member_quotes.gender',
                            'member_quotes.date',
                            'member_quotes.birthday')
                            ->get(); 
                            ?>
                            <div class="accordion-item">
                                <h6 
                                    class="accordion-header collapsed redondear" 
                                    id="headingOne_<?=$insur->id?>"
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapseOne_<?=$insur->id?>" 
                                    aria-expanded="false" 
                                    aria-controls="collapseOne_<?=$insur->id?>"
                                >
                                    <?=$tipopoliza;?>
                                </h6>
                                <div id="collapseOne_<?=$insur->id?>" class="accordion-collapse collapse" aria-labelledby="headingOne_<?=$insur->id?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body row">
                                        <div class="col-md-6">
                                            <?php 
                                                if ( strlen($insur->comentario) > 0)
                                                ?>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <p><strong> Nota :</strong> <?=$insur->comentario;?> </p> 
                                                        </li>
                                                    </ul>
                                                    
                                                <?php 
                                                if (( count($memberquotes) >0 ) && ($insur->tipopoliza ==1))
                                                {
                                                    ?>
                                                    <strong>Beneficiarios de la póliza  </strong> 
                                                    <?php
                                                    if ( count($memberquotes) >0 ) 
                                                    {
                                                        foreach( $memberquotes as $m)
                                                        {
                                                            ?>
                                                                <li class="list-group-item">
                                                                <p><?=$m->status.' - '.$m->gender.'('.$m->date.') años de edad ';  ?></p>
                                                                </li>
                                                        <?php
                                                        }         
                                                        
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                        <strong> Documentos de la póliza </strong> 
                                            <ul class="list-group list-group-flush">
                                                <?php 
                                                    if ( count($documentos) >0 ) 
                                                    {
                                                        foreach( $documentos as $p)
                                                        {
                                                            $ruta= $url.trim($p->documentonombre);
                                                            ?>
                                                                <li class="list-group-item">
                                                                <p><?=$p->tipodocumento  ?> 
                                                                <a href="<?=$ruta?>" target='_blank' title= "ver documento" >
                                                                    <i class="bi bi-eye-fill"></i>
                                                                </a>
                                                                </p>
                                                                
                                                                
                                                                </li>
                                                        <?php
                                                        }         
                                                        
                                                    } 
                                                ?>
                                            </ul>     
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <?php  
                            $i++;
                        }
                        ?>
                        
                    </div>
                    <!-- --> 
                <?php 
            }
            else
            {
                ?>
                <div>
                <h1>
                No encontramos pólizas a su nombre 
                </h1>
                </div>
                <?php 
            }
        ?>
        
    </div>
</div>

@endsection
