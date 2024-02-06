@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/clinicas.js') }}" defer></script>
<div class="container">
    <div class="row">
        <div  
            class="card" 
            id="divempresas" 
            >
                <form  
                    action="agregarclinica" 
                    method="POST"
                    enctype="multipart/form-data"
                    id="formagregarclinica"
                    name="formagregarclinica"
                    class="container px-4 my-5">
                    @csrf
                    <input type="text" id="id_clinica" name="id_clinica"  value="" hidden>
                    <table  class="table">
                        <tr>
                            <th >
                                <label> Nombre</label> <br>
                                <input type="text" id="nombre" name="nombre" value="" size="50">
                            </th>
                            
                            <th  >
                                <label>Seguro </label> <br>
                                <select 
                    
                                    name="id_seguro" 
                                    id="id_seguro" 
                                    class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                    >
                                         
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
                        </tr>
                        <tr>
                            <th>    
                                <label>Municipio </label> <br>
                                <select 
                    
                                    name="id_municipio" 
                                    id="id_municipio" 
                                    class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                    >
                                         
                                        
                                </select>
                                
                            </th>
                            <th>
                                <label> Cuidad</label> <br>
                                <select 
                    
                                    name="id_ciudad" 
                                    id="id_ciudad" 
                                    class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                    >
                                         
                                        
                                </select>
                            </th>
                            <th>
                                <label> Dirrección</label> <br>
                                <input type="text" id="direccion" name="direccion"  value="" size="50" > 
                            </th>
                            
                        </tr>
                        
                    </table>  
                    <button type="button" onclick="guardarclinica()" class="m-2 p-2">
                       Guardar clinica
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
                    <th>Nombre</th>
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