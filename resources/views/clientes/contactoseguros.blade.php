@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/listadocontacto.js') }}" defer></script>
<div class="container">
    <div class="row">
        <div  
            class="card" 
            id="divempresas" 
            >
                <form  
                    action="guardarcontacto" 
                    method="POST"
                    enctype="multipart/form-data"
                    id="formguardarcontacto"
                    name="formguardarcontacto"
                    class="container px-4 my-5">
                    @csrf
                    <input type="text" id="conta_id" name="conta_id"  value="" hidden>
                    <table  class="table">
                        <tr>
                            <th>
                            <label>Seguro </label>
                                <select 
                    
                                    name="conta_idseguro" 
                                    id="conta_idseguro" 
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
                            </th>
                            <th>
                            <label> Servicio</label>
                            <input type="text" id="conta_servicio" name="conta_servicio"  value="">
                            </th>
                        </tr>
                        <tr>
                            <th>
                            <label>whatsap </label>
                            <input type="text" id="conta_nrowhat" name="conta_nrowhat"  value="">
                            </th>
                            <th>
                            <label> Llamada</label>
                            <input type="text" id="conta_nrocall" name="conta_nrocall"  value="">
                            </th>
                        </tr>
                    </table>  
                    <button type="button" onclick="guardarcontacto()" class="m-2 p-2">
                        Guardar la Póliza
                    </button> <br>
                </form>
                                   
        </div>   
    </div><br>
    <div class="row">
        <div class="col-12" id="">
            <table id="example" class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Seguro</th>
                    <th>Servicio </th>
                    <th>Nro What </th>
                    <th>Nro llamada </th>
                    <th>Acciones </th>
                </tr>
            </thead>
        </table>
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