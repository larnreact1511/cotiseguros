@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/addgrupupe.js') }}" defer></script>
<div class="container">

    <div class="row" id ="divprincipal">
        <div class="col-md-12">
                <h3> 
                    Cliente 
                </h3>
                <form 
                    id="form-cot" 
                    class="container px-4 my-5"
                    action="empleado-colectivo" 
                    method="post"
                    enctype="multipart/form-data"
                    >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="idempleado" readonly name="idempleado" class="form-control" value ="<?=$cliente[0]->id; ?>"/>
                   
                    <table class="table">
                        <tr>
                            <th>
                                <label>Nombre </label>
                                    <input 
                                        name="nombre" 
                                        id="nombre"
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey"
                                        placeholder="Nombre" 
                                        value="<?= @$cliente[0]->nombre; ?>">
                            </th>
                            <th>
                                <label> Apellido</label>
                                    <input 
                        
                                        name="apellido" 
                                        id="apellido" 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        
                                        placeholder="Apellido" 
                                        value="<?= @$cliente[0]->apellido; ?>"
                                    >
                            </th>
                            <td>
                                <label> Cédula </label>
                                <input 
                                    name="cedula" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedula" 
                                    
                                    placeholder="Cedula" 
                                    value="<?= @$cliente[0]->cedula; ?>"
                                    >
                            </td>
                            <td>
                                <label> Rif </label>
                                <input 
                                    name="rif" 
                                    type="text" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedula" 
                                    
                                    placeholder="rif" 
                                    value="<?= @$cliente[0]->rif; ?>"
                                >
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label>Empresa </label><br>
                                <select 
                        
                                    name="idempresa" 
                                    id="idempresa" 
                                    class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                    aria-label="Default select example" 
                                    
                                    >
                                        <option value="0">Seleccione</option> 
                                        <?php  
                                            foreach ($companys as $i )
                                            {
                                                ?>
                                                    <option value="{{ $i->id }}">{{  $i->companyname }} </option> 
                                                <?php  
                                            }
                                        ?>
                                </select>
                                    
                            </th>
                            <th>
                                <br>
                                <button type="submit" 
                                    id="" 
                                    class='btn btn-primary'
                                    name=""> 
                                    Pasar empleado a empresa
                                </button>
                                
                            </th>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        
                    </table>
                   
                </form>
            

        </div>
        
    </div>
</div>

<!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
            </div>
        </div>
    </div>

@endsection