@extends('voyager::master')

@section('content')
<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
-->
<link rel="stylesheet" href="{{ asset('/css/modalpersonal.css') }}">
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/listado.js') }}" defer></script>
<div class="container">
    <div class="row">
        <div class="col-12" id="">
            <div class="custom-loader" id ="carga" sytyle="display:none"></div>
        </div>
        <div class="col-12" id="divtabla">
            <table id="example" class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Nombre </th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Cobertura </th>
                    <th>Fecha </th>
                    <th>Estado </th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="closemodal">&times;</span>
    <div class="row text-center p-2">
        <input class="form-check-input"  type="hidden" name="idquotemodificar" id="idquotemodificar" value="">
        <div class="col-md-4">
            <div class="form-check">
                <label>Correo nuevo</label>
                <input class="form-check-input"  
                    type="text" name="correonuevo" id="correonuevo" value="" size="40">
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <label>Número telefónico nuevo</label>
                <input class="form-check-input"  
                    type="text" name="numeronuevo" id="numeronuevo" value="" >
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <label>Cliente a moficiar</label>
                <input class="form-check-input"  
                    type="text" name="nombremodificar" id="nombremodificar" size="40">
                
            </div>
        </div>
    </div>
    <div class="row text-center p-2">
        <div class="col-md-12">
            <div id="mjserrormodicicar" name="mjserrormodicicar"></div>
        </div>
    </div>
    <div class="row text-center p-2">
        <div class="col-md-3">
           <button id="modificardatosquote" namw="modificardatosquote" type="button"> Modifcar </button>
        </div>
        <div class="col-md-3">
           <button id="modificardatosquote" namw="modificardatosquote" type="button" class="closemodal"> Cerrar </button>
        </div>
    </div>
  </div>
</div>

@endsection