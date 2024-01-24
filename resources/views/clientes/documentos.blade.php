@extends('layouts.sidebar')

@section('content')
<link rel="stylesheet" href=" {{ asset('css/fontawesome/css/font-awesome.min.css') }}">
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<div class="container my-5">
    <div class="row text-center">
        <!-- -->
        <div class="col-md-12">
            <label>
                Seleccione la imagen que desea agregar o clic en el ojo para ver la que ya tenga almacenada
            </label>
            <form 
                action="adminfiles2" 
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <input type="hidden" id="idcliente" readonly name="idcliente" class="form-control" value ="<?=auth()->id(); ?>"/>
                <div class="row justify-content-center">


                    <div class="custom-file col-md-12 p-2">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento1" 
                          id="documento1"
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega Cedula </label>
                        <?php 
                            if (@$documentos[0]->tipodocumento =='Cedula')
                            {
                                ?>
                                    <i class="fa fa-eye" aria-hidden="true" onclick="verfoto('<?=$documentos[0]->documentonombre; ?>')"></i>
                                <?php 
                            }
                        ?>
                  </div>
                  <div class="custom-file col-md-12 p-2">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento2" 
                          id="documento2"
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento  2 </label>
                      <?php 
                            if (@$documentos[1]->tipodocumento =='documento2')
                            {
                                ?>
                                    <i class="fa fa-eye" aria-hidden="true" onclick="verfoto('<?=$documentos[1]->documentonombre; ?>')"></i>
                                <?php
                            }
                        ?>      
                    </div>
                  <div class="custom-file col-md-12 p-">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento3" 
                          id="documento3" 
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento 3 </label>
                      <?php 
                            if (@$documentos[2]->tipodocumento =='documento3')
                            {
                                ?>
                                    <i class="fa fa-eye" aria-hidden="true" onclick="verfoto('<?=$documentos[2]->documentonombre; ?>')"></i>
                                <?php
                            }
                        ?> 
                  </div>
                  <div class="custom-file col-md-12 p-2">
                      <input 
                          type="file" 
                          class="custom-file-input" 
                          name="documento4" 
                          id="documento4" 
                          accept="png,jpeg" 
                      >
                      <label class="custom-file-label" for="customFile">Agrega documento 4 </label>
                      <?php 
                            if (@$documentos[3]->tipodocumento =='documento4')
                            {
                                ?>
                                    <i class="fa fa-eye" aria-hidden="true" onclick="verfoto('<?=$documentos[3]->documentonombre; ?>')"></i>
                                <?php
                            }
                        ?> 
                  </div>
                </div>
                <div class="col-md-12 p-2">
                    <button class="btn btn-primary" type="submit"> Guardar documentos </button>
                </div>
                
            </form>
        </div>
        <!-- -->pay
    </div>
</div>
<script>

function verfoto(img)
{
  
    //let url  ="https://dev.cotiseguros.com.ve/";
    //url ='http://127.0.0.1:8000/';
    let url  ='https://www.cotiseguros.com.ve/';
    Swal.fire({
    imageUrl: url+img,
    imageHeight: 400,
    imageAlt: 'image'
  })
  
}
</script>
@endsection