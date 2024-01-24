@extends('layouts.app')

@section('content')

<?php //print_r($polizas); ?>
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Informacion Personal
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <!-- --> 
        <form class="row g-3">
          <div class="col-auto">
            <label for="nombre" class="visual">Nombre</label>
            <input type="text" readonly class="form-control-plaintext" id="nombre" value="<?=$datacliente[0]->nombre?>">
          </div>
          <div class="col-auto">
            <label for="apellido" class="visually">Apellido</label>
            <input type="text" readonly class="form-control-plaintext" id="apellido" value="<?=$datacliente[0]->apellido?>">
          </div>
          <div class="col-auto">
            <label for="cedula" class="visually">Cedula</label>
            <input type="text" readonly class="form-control-plaintext" id="cedula" value="<?=$datacliente[0]->cedula?>">
          </div>
          <div class="col-auto">
            <label for="Nrotelefono" class="visually">Nro telefono</label>
            <input type="text" readonly class="form-control-plaintext" id="Nrotelefono" value="<?=$datacliente[0]->numerotelefono?>">
          </div>
        </form>
        <!-- --> 
      </div>
    </div>
  </div>
  <!-- --> 
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Polizas
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body row">
        <!-- -->
        <?php 
          if ( count($polizas) > 0) 
          {
            foreach ($polizas as $poliza)
            {
              $data = json_decode($poliza->policies);
              $vec = (array)$data;
              $coverages =$vec["coverages"];
              //print_r($coverages);
              ?>
               <div class="card text-center col-md-3" style="width: 18rem;">
                  <img class="card-img-top" src="https://cotiseguros.com.ve/storage/<?=$vec['image'] ?>" alt="Card image cap">
                  <div class="card-body text-center">
                    <h5 class="card-title"> <?=$vec['name'] ?>  <?=number_format($coverages->coverage); ?></h5>
                    <p class="card">
                      <?=$vec['note'] ?>
                    </p>
                    <!-- 
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    -->
                  </div>
                </div>
              <?php
            }
          }
        ?>
       
        <!-- --> 
      </div>
    </div>
  </div>
  <!-- --> 
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Documentos personales 
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body row">
      <?php 
          if ( count($documentos) > 0) 
          {
            foreach ($documentos as $d)
            {
             
              ?>
               <div class="card text-center col-md-3" style="width: 18rem;">
                  <img class="card-img-top" src="https://dev.cotiseguros.com.ve/<?= $d->documentonombre; ?>" alt="Card image cap">
                  <div class="card-body text-center">
                    <h5 class="card-title"> <?=$d->tipodocumento; ?></h5>

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
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingfour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
        Documentos / Contratos 
      </button>
    </h2>
    <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body row">
      <?php 
          if ( count($contratos) > 0) 
          {
            foreach ($contratos as $contrato)
            {
             
              ?>
               <div class="card text-center col-md-3" style="width: 18rem;">
                 
                  <div class="card-body text-center">
                    <h5 class="card-title"> <?=$contrato->tipodocumento; ?></h5>
                    <a href="https://cotiseguros.com.ve/<?= $contrato->documentonombre; ?>" class="btn btn-primary" target="_blank"> Ver contrato </a>
                    
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
@endsection