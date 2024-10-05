@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>

<div class="container">
    <div class="row" id ="divprincipal">
        <h3>
            Listado Seguros 
        </h3>
        <div class="col-12" id="">
            <table id="tablecompany" class="table" >
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>    
                        <th>Nombre</th>
                        <th>note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insurers as $insurer)
                        <tr>
                            <td>
                                {{ $insurer->id}}  
                            </td>
                            <td>
                                {{ $insurer->name}}  
                            </td>
                            <td>
                                {{ $insurer->note}}  
                            </td>
                            
                        </tr>

                    @endforeach()
                    
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection