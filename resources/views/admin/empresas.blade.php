@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<link ret ="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css')  }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/empresas.js') }}" defer></script>
<!-- --> 
<?php 

?>
<div class="container-fluid">
    <div class ="row d-flex justify-content-center" id ="divcrearempresa">
        <div class="col-md-12">
            <form id="formempresa" 
                    class="container px-4 my-5"
                    action="datosempresa" 
                    method="post"
                    >
                @csrf
                <input 
                                name="idempresa" 
                                type="hidden" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="idempresa" 
                                required
                                placeholder="Nombre Empresa" 
                                value=""
                            >
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Rif</th>
                        <th>Razon social</th>
                    </tr>
                    <tr>
                        <td>
                            <input 
                                name="nombreempresa" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="nombreempresa" 
                                required
                                placeholder="Nombre Empresa" 
                                value=""
                            >
                        </td>
                        <td>
                            <input 
                                name="rifempresa" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="rifempresa" 
                                required
                                placeholder="Rif Empresa" 
                                value=""
                            >
                        </td>
                        <td>
                            <input 
                                name="razonsocial" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="razonsocial" 
                                required
                                placeholder="Razón social" 
                                value=""
                            >
                        </td>
                    </tr>
                </table>
                <button type="submit">
                    Guardar
                </button>
            </form>
        </div>
    </div>
    <div class ="row d-flex justify-content-center" id="divcrearpolizaapemresa" style ="display:none;">
        <form  action="crearpolizaapemresa" 
            method="POST"
            enctype="multipart/form-data"
            id="formulariosempresa"
            name="formulariosempresa"
            class="container px-4 my-5">
            @csrf
            <!-- -->  
            
            <!--  -->
            <table class="table">
                <tr>
                    <td>
                        <label> Monto</label>  <br>   
                        <select 
                            name="mnontocobertura" 
                            id="mnontocobertura" 
                            class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                            aria-label="Default select example" 
                            required
                            >
                            <option value="0">Seleccione</option> 
                            <?php  
                                foreach ($coverages as $c )
                                {
                                    ?>
                                        <option value="{{ $c->id }}">{{ number_format( $c->coverage ) }} USD</option> 
                                    <?php  
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label> Seguro</label><br>        
                        <select 
                    
                            name="segurocobertura" 
                            id="segurocobertura" 
                            class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                            aria-label="Default select example" 
                            required
                            >
                                <option value="0">Seleccione</option> 
                                <?php  
                                    foreach ($insurers as $i )
                                    {
                                        ?>
                                            <option value="{{ $i->id }}">{{  $i->name }} </option> 
                                        <?php  
                                    }
                                ?>
                        </select>
                    </td>
                    <td>
                        <label> Representante</label><br>
                        <input type="text" id="representante" name="representante"  value="">             
                    </td>
                    <td>
                        <label> Afiliados</label>
                        <input type="file" id="afiliados" name="afiliados" class="custom-file-input"  accept="xlxs" value="">             
                    </td>
                </tr>
            </table>      
            <!-- pdf poliza auto-->
            <table id="tablaempresa" name="tablasalud" class="table">
                <tr>
                    <th>
                    <label class="custom-file-label" for=""> Agregar documento   </label>
                    <input 
                        type="file" 
                        class="custom-file-input" 
                        name="documentosempresa[]" 
                        accept="pdf" >
                    </th>
                    <th>
                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                    <input 
                            type="text" 
                            class="custom-file-input" 
                            name="nombredocumentosempresa[]" 
                            required
                        >
                    </th>
                </tr>
            </table>   
            <!-- -->
            <input type="text" 
                class="form-control shadow-none border-0 bg-grey" 
                name="comentarioempresa" id="comentarioempresa" value="" 
                placeholder="Comentario sobre la póliza"><br>
                
            <!-- --> 
            <button onClick="addocument3()"  type="button" class="my-5 p-3"> 
                <span 
                        class="ms-3 mon-light">
                        Añadir documento
                </span>        
            </button>
            <!-- -->         
            <button type="submit"  class="my-5 p-3">
                Guardar la Póliza
            </button>
        </form>
    </div>
    <div class="container-fluid" id ="divtablaempresas">
        <div class="wp-80 d-flex justify-content-center">
            <div class="table">
                <table id="tablaempresas" class="table" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Rif</th>
                            <th>Razon social </th>
                            <th> </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>
    
</div>

<!-- --> 
@endsection