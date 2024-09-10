@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/listadoclinicas.js') }}" defer></script>
<div class="col-md-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
<div class="container">
    <h3>
        Listado de clinicas de sistema

    </h3>
    <div class="row">
        <div class="col-md-12">
            <table  class="table">
                <tr>
                    <th >
                        <label>Seguro </label> <br>
                        <select 
            
                            name="id_seguro" 
                            id="id_seguro" 
                            class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                            >
                                <option value="0">
                                    Seleccione
                                </option> 
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
                    <th >
                        <label>Estado </label>  <br>
                        <select 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 

                                id ="id_estado"
                                name ="id_estado"
                                onchange="changeselectestado()"
                                
                                >
                                    <option value="0">
                                        Seleccione
                                    </option>  
                                    <?php  
                                        foreach ($estados as $i )
                                        {
                                            ?>
                                                <option value="{{ $i->id_estado }}">{{  $i->estado }}</option> 
                                            <?php  
                                        }
                                    ?>
                        </select>
                        
                    </th>
                    <th>
                        <label>Municipio </label> <br>
                        <select 
            
                            name="id_municipio" 
                            id="id_municipio" 
                            class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                            >    
                            <option value="0">
                                    Seleccione
                            </option> 
                        </select>
                        
                        
                    </th>
                    <th >
                        <label> Cuidad</label> <br>
                        <select 
            
                            name="id_ciudad" 
                            id="id_ciudad" 
                            class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                            >
                            <option value="0">
                                    Seleccione
                            </option> 
                        </select>
                        
                    </th>
                </tr>
            </table>  

        </div>
        <div class='col-md-4'>
            <button type="button" class='btn btn-primary' id ='filtrotabla'>
               Filtrar
            </button> 

        </div>
        <div class='col-md-4'>
            <button type="button"class='btn btn-primary'  id ='clean' >
               Limpiar filtros
            </button> 

        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="">
            <table id="example" class="table" >
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Seguro</th>
                    <th>Dirección </th>
                    <th>Estado </th>
                    <th>Ciudad </th>
                    <th>Municipio </th>
                    <th>Acciones </th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div>



@endsection