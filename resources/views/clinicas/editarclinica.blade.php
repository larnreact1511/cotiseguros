@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/clinicas.js') }}" defer></script>
<div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
<div class="container">
    <h3>
        Modifca tu clínica : {{ $clinica[0]->nombre}}

    </h3>
    <div class="row mt-2">
        <div  
            class="card mt-3" 
            id="divempresas" 
            >
                <form  
                    action="../agregarclinica" 
                    method="POST"
                    enctype="multipart/form-data"
                    id="formagregarclinica"
                    name="formagregarclinica"
                    class="container px-4 my-5">
                    @csrf
                    <input type="text" id="id_clinica" name="id_clinica"  value="{{ $clinica[0]->id}}" hidden>
                    <table  class="table">
                        <tr>
                            <th >
                                <label> Nombre</label> <br>
                                <input type="text" id="nombre" name="nombre" value="{{ $clinica[0]->nombre}}" size="50">
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
                                                $selected ='';
                                                if ($i->id == $clinica[0]->id_seguro)
                                                    $selected ='selected';
                                                ?>
                                                    <option 
                                                        value="{{ $i->id }}"
                                                        <?php echo $selected ?>
                                                        >{{  $i->name }} </option> 
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
                                                    $selected ='';
                                                    if ($i->estado == $clinica[0]->id_estado)
                                                        $selected ='selected';
                                                    ?>
                                                        <option 
                                                            value="{{ $i->id_estado }}"
                                                            <?php echo $selected ?>
                                                            >
                                                            {{  $i->estado }}</option> 
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
                                    <?php  
                                        foreach ($municipios as $i )
                                        {
                                            $selected ='';
                                            if ($i->id_municipio == $clinica[0]->id_municipio)
                                                $selected ='selected';
                                            ?>
                                                <option 
                                                    value="{{ $i->id_municipio }}"
                                                    <?php echo $selected ?>
                                                    >
                                                    {{  $i->municipio }}</option> 
                                            <?php  
                                        }
                                    ?>
                                </select>
                                
                            </th>
                            <th>
                                <label> Cuidad</label> <br>
                                <select 
                    
                                    name="id_ciudad" 
                                    id="id_ciudad" 
                                    class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                    >
                                    <?php  
                                        foreach ($ciudades as $i )
                                        {
                                            $selected ='';
                                            if ($i->id_ciudad == $clinica[0]->id_ciudad)
                                                $selected ='selected';
                                            ?>
                                                <option 
                                                    value="{{ $i->id_ciudad }}"
                                                    <?php echo $selected ?>
                                                    >
                                                    {{  $i->ciudad }}</option> 
                                            <?php  
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <label> Dirrección</label> <br>
                                <input type="text" id="direccion" name="direccion"  value="{{ $clinica[0]->direccion}}" size="50" > 
                            </th>
                            
                        </tr>
                        
                    </table>  
                    <button type="button" onclick="guardarclinica()" class="m-2 p-2">
                       Guardar clinica
                    </button> <br>
                </form>
            </br>                       
        </div>   
    </div><br>
</div>



@endsection