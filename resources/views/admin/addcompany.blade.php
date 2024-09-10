@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/addcompany.js') }}" defer></script>
<div class="container">

    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
   
    <div class="row" id ="divprincipal">
        <h3>
            Ingresa tu empresa

        </h3>
        <div class="card" id="">
            <form 
                    id="form-add-company" 
                    class="container px-4 my-5"
                    action="" 
                    method="post"
                    enctype="multipart/form-data"
                    >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                    <table class="table">
                        <tr>
                            <th>
                                <label>Empresa </label>
                                    <input 
                                        name="companyname" 
                                        id="companyname"
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey"
                                        placeholder="Nombre de la empresa" 
                                        value="">
                            </th>
                            <th>
                                <label> Rif</label>
                                    <input 
                        
                                        name="rifcompany" 
                                        id="rifcompany" 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        
                                        placeholder="Rif de la empresa" 
                                        value=""
                                    >
                            </th>
                            <th>
                                    
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <label>Dirrecion </label>
                                    <input 
                                        name="adresscompany" 
                                        id="adresscompany"
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey"
                                        placeholder="Direccion de la empresa" 
                                        value="">
                            </th>
                            <th>
                                <label> Nota</label>
                                    <input 
                        
                                        name="notecompany" 
                                        id="notecompany" 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        
                                        placeholder="Nota de la empresa" 
                                        value=""
                                    >
                            </th>
                            <th>
                                    
                            </th>
                        </tr>
                        
                    </table>
                    
                    <button 
                        type="button" 
                        onClick="addcompanybtn()"  
                        type="button" 
                        class="btn btn-primary" > 
                            Agregar empresa
                        </button> 
                </form>
            
        </div>
    </div>
</div>



@endsection