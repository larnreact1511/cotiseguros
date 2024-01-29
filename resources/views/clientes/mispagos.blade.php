@extends('layouts.clientesseguro')

@section('content')
<div class="row d-flex justify-content-center" style="text-align: center; height:70vh;" >
    
    <div class=" col-md-10 ">
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
                    <div 
                        id="collapseOne_<?=$insur->id?>" 
                        class="accordion-collapse collapse " 
                        aria-labelledby="headingOne_<?=$insur->id?>" 
                        data-bs-parent="#accordionExample"
                        >
                        <div class="accordion-body row">
                            <ul class="list-group list-group-flush">
                                <?php 
                                     $payments =  DB::table('payments')
                                     ->leftJoin('frequencyofpayments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
                                     ->where('payments.idusuario',auth()->id())
                                     ->where('frequencyofpayments.id_insurancepolicies',$insur->id)
                                     ->select('payments.fechapago',
                                     'payments.montopago',
                                     'payments.photo_payment',
                                     'payments.fechapago',
                                     'frequencyofpayments.id_insurancepolicies')
                                     ->get(); 
                                    if ( count($payments) >0 ) 
                                    {
                                        foreach( $payments as $p)
                                        {
                                            if ($p->id_insurancepolicies == $insur->id )
                                            {
                                                $ruta= $url.trim($p->photo_payment);
                                                ?>
                                                    <li class="list-group-item">
                                                        <h4>
                                                        Monto pagado ( <?=$p->fechapago?> )    
                                                        <?=number_format($p->montopago). ' USD '  ?> 
                                                        <a href="<?=$ruta?>" target='_blank' title= "Ver Pago" >
                                                            <i class="bi bi-eye-fill"></i>
                                                        </a>
                                                        </h4>
                                                    </li>
                                                <?php
                                            }
                                        }         
                                        
                                    } 
                                    else
                                    {
                                        ?>
                                        <h4>
                                            No posee pago registrado a esta póliza
                                        </h4>
                                        <?php
                                    }
                                ?>
                            </ul> 
                        </div>
                    </div>
                </div>
                <?php  
                $i++;
            }
            ?>
            
        </div>
        <!-- --> 
    </div>
</div>
@endsection
