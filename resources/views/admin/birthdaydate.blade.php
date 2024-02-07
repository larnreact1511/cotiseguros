@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/birthdaydate.js') }}" defer></script>
<div class="container">
    <br>
    <h5>
        Cumpleañeros del mes 
    </h5>
    <div class="row">
        <div class="col-12" id="">
            <table id="example" class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido </th>
                    <th>Cedula</th>
                    <th>Número de teléfono</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>



@endsection