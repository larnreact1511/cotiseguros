@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/listadocotiseguros.js') }}" defer></script>
<div class="container">
    <div class="row">
        <div  
            class="card" 
            id="divempresas" 
            >
                <form  
                    action="guardarcontactocotiseguro" 
                    method="POST"
                    enctype="multipart/form-data"
                    id="formguardarcontacto"
                    name="formguardarcontacto"
                    class="container px-4 my-5">
                    @csrf
                    <input type="text" id="cotiseguros_id" name="cotiseguros_id"  value="" hidden>
                    <table  class="table">
                        <tr>
                            <th>
                                <label>nombre </label>
                                <input type="text" id="nombre" name="nombre"  value="">
                            </th>
                            <th>
                                <label> cedula</label>
                                <input type="text" id="cedula" name="cedula"  value="">
                            </th>
                            <th>
                                <label> rif</label>
                                <input type="text" id="rif" name="rif"  value="">
                            </th>
                        </tr>
                        <tr>
                            <th>
                            <label>whatssap </label>
                            <input type="text" id="whatssap" name="whatssap"  value="">
                            </th>
                            <th>
                            <label> Llamada</label>
                            <input type="text" id="llamada" name="llamada"  value="">
                            </th>
                            <th>

                            </th>
                        </tr>
                    </table>  
                    <button type="button" onclick="guardarcontacto()" class="m-2 p-2">
                        Guardar Contacto
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
                    <th>nombre</th>
                    <th>cedula </th>
                    <th>rif </th>
                    <th>whatssap </th>
                    <th>llamada </th>
                    <th>Acciones </th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>

<!-- The Modal -->
  

@endsection