@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/listadocliente.js') }}" defer></script>
<div class="container">

    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
    
    <div class="row" id ="divprincipal">
        <div class="col-md-12">
            <button class="btn btn-primary" id="btndeletegrupe" name="btndeletegrupe"  onclick ="deletselct()">
                Eliminar Selección
            </button>
        </div>
        <div class="col-12" id="">
            <table id="example" class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>    
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula </th>
                    <th>Nro telefono </th>
                    <th>Correo </th>
                    <th>Estado</th>
                    <th>Acciones</th>
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