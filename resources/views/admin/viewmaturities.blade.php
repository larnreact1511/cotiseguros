@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<link ret ="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css')  }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/viewmaturities.js') }}" defer></script>
<!-- --> 
<?php 

?>
<div class="container-fluid">
    <div class ="row d-flex justify-content-center" id ="divcrearempresa">
        <div class='col-md-12'>
            <table id="tablematurities" class="table" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>    
                            <th>Apellido</th>
                            <th>Cedula</th>
                            <th>numero telefono</th>
                            <th>monto</th>
                            <th>fechafin</th>
                        </tr>
                    </thead>
            </table>
        </div>
    </div>
</div>

<!-- --> 
@endsection