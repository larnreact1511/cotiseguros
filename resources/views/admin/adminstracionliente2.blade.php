@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/tabs.css') }}">
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/adminstracionclientes2.js') }}" defer></script>
<!-- --> 
<?php 
$code = '';
$numero = '';
if ( @$info[0]->numerotelefono )
{
    $cantidad =strlen(@$info[0]->numerotelefono);
    $code =substr(@$info[0]->numerotelefono,0,3);
    $numero =substr(@$info[0]->numerotelefono,3,$cantidad);
}

?>
<div class="container">
    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
    <input type="hidden" id="idcliente" name="idcliente" value ="<?=$idcliente; ?>">
    <input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="<?=auth()->id(); ?>"/>
    <div class="pc-tab" id ="divprincipal">
        <input checked="checked" id="tab1" type="radio" name="pct" />
        <input id="tab2" type="radio" name="pct" />
        <input id="tab3" type="radio" name="pct" />
        <input id="tab4" type="radio" name="pct" />
        <input id="tab5" type="radio" name="pct" />
        <input id="tab6" type="radio" name="pct" />
        <nav>
            <ul>
            <li class="tab1">
                <label for="tab1">Información personal</label>
            </li>
            <li class="tab2">
                <label for="tab2">Pólizas de seguro</label>
            </li>
            <li class="tab3">
                <label for="tab3">Agregar fechas de pago </label>
            </li>
            <li class="tab4">
                <label for="tab4">Realizar pagos Polizas</label>
            </li>
            <li class="tab5">
                <label for="tab5">Agregar Siniestro</label>
            </li>
            <li class="tab6">
                <label for="tab6">Codigo QR</label>
            </li>
            </ul>
        </nav>
        <section>
            <!-- Información personal -->
            <div class="tab1">
                <form 
                    id="form-cot" 
                    class="container px-4 my-5"
                    action="actualizardatos" 
                    method="post"
                    enctype="multipart/form-data"
                    >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="idcliente2" readonly name="idcliente2" class="form-control" value ="<?=$idcliente; ?>"/>
                   
                    <table class="table">
                        <tr>
                            <th>
                                <label>Nombre </label>
                                    <input 
                                        name="nombre" 
                                        id="nombre"
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey"
                                        placeholder="Nombre" required
                                        value="<?= @$info[0]->nombre; ?>">
                            </th>
                            <th>
                                <label> Apellido</label>
                                    <input 
                        
                                        name="apellido" 
                                        id="apellido" 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        required
                                        placeholder="Apellido" 
                                        value="<?= @$info[0]->apellido; ?>"
                                    >
                            </th>
                            <th>
                                    <label>Código de teléfono</label><br>
                                    <select 
                                        name="code" 
                                        id="code" 
                                        class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                        aria-label="Default select example" 
                                        required
                                        >
                                        
                                        <option  selected value="+58">+58 </option>
                                        <option   value="+57">+57 </option>
                                    </select>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <label> Nro. de teléfono  </label>
                                        <input 
                                            name="numerotelefono" 
                                            type="number" 
                                            class="form-control shadow-none border-0 bg-grey" 
                                            id="numerotelefono" 
                                            required
                                            placeholder="Nro de telefono" 
                                            value="<?=$numero ?>">
                            </td>
                            <td>
                                <label> Cédula </label>
                                <input 
                                    name="cedula" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedula" 
                                    required
                                    placeholder="Cedula" 
                                    value="<?= @$info[0]->cedula; ?>"
                                    >
                            </td>
                            <td>
                                <label> Rif </label>
                                <input 
                                    name="rif" 
                                    type="text" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedula" 
                                    required
                                    placeholder="rif" 
                                    value="<?= @$info[0]->rif; ?>"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label> Estado de localidad </label><br>
                                <select 
                                    name="province" 
                                    id="province" 
                                    class="form-select w-100 shadow-none border-0 bg-grey w-25 align-self-start"  
                                    aria-label="Default select example" required >

                                    @foreach ($provinces as $p)
                                        <option @if( $p["estado"] == 'Táchira' ) selected @endif  value="{{ $p["estado"] }}">{{ $p["estado"] }}</option>
                                    @endforeach 
                                    
                                </select>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label> Nombre Contacto </label><br>
                                <input 
                                    name="nombrecontacto" 
                                    type="text" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="nombrecontacto" 
                                    required
                                    placeholder="Nombre del contacto " 
                                    value="<?=@$nombrecontacto?>"
                                    >
                            </td>
                            <td>
                                <label>Cedula Contacto  </label>
                                <input 
                                    name="cedulacontacto" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedulacontacto" 
                                    required
                                    placeholder="Cedula Contacto" 
                                    value="<?=@$cedulacontacto?>"
                                    >
                            </td>
                            <td>
                                <label>Telefono Contacto  </label>
                                <input 
                                    name="telefonococontacto" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="telefonococontacto" 
                                    required
                                    placeholder="Telefono Contacto " 
                                    value="<?=@$telefonococontacto?>"
                                    >
                            </td>
                        </tr>
                    </table>
                    <!-- documentos cargados al cliente-->
                    <?php 
                        if ( (count(@$documentoscliente)) > 0)
                        {
                            //echo "<pre>"; print_r($documentoscliente); die;
                            $i=0;
                            ?>
                                <table id="tabladocumentoscargados" name="tabladocumentoscargados" class="table">
                                    <?php foreach($documentoscliente as $d ) 
                                    {
                                        ?>
                                            <tr>
                                                <th>
                                                    <label> <?=$d->tipodocumento ?></label>
                                                </th>
                                                <th>
                                                    <a href="../<?=$d->documentonombre ?>" target="_blank">
                                                        ver img
                                                    </a>
                                                    <a href="#" onclick="borrar('{{$d->id}}')">
                                                        Eliminar
                                                    </a>
                                                </th>
                                                
                                            </tr>
                                        <?php 
                                        $i++;
                                    }
                                    ?>
                                </table>
                            <?php 
                        }
                    ?>
                    <!-- -->    
                    <table id="tabladocumentosclientes" name="tabladocumentosclientes" class="table">
                        <tr>
                            <th>
                            <label class="custom-file-label" for=""> Agregar documento de cliente   </label>
                            <input 
                                type="file" 
                                class="custom-file-input" 
                                name="documentopersonal[]" 
                                accept="pdf,png,jpg" 
                            >
                            </th>
                            <th>
                            <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                            <input 
                                type="text" 
                                class="custom-file-input" 
                                name="nombredocumentopersonal[]" 
                               
                            >
                            </th>
                            
                        </tr>
                    </table>
                    
                    
                    <button type="submit"> Actualizar Datos Persoanles </button> 
                    <button type="button" onClick="addocument4()"  type="button" class="my-5 p-3" > Agregar otro documento </button> 
                </form>
            </div>
            <!-- Crear polizas-->
            <div class="tab2" >
                
                <?php                                  
                    foreach ($insurancepolicies as $i )
                    {
                        $tipopoliza='';
                        switch ($i->tipopoliza) {
                            case 1:
                                $tipopoliza =" Salud ";
                                break;
                            case 2:
                                $tipopoliza =" Autos ";
                                break;
                            case 3:
                                $tipopoliza =" Empresa ";
                                break;
                        }
                        $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="flexRadioDefault" 
                                id="flexRadioDefault2" 
                                onclick="editarpoliza(<?=$i->id_insurancepolicies ?>)">
                            <label class="form-check-label" for="flexRadioDefault2">
                                {{ $monto }}
                            </label>
                        <?php  
                    }
                ?>
                <table class="table">
                    <tr>
                        <th><label> Monto </label></th>
                        <th><label> Seguro</label></th>
                        <th><label> Tipo seguro</label></th>
                    </tr>
                    <tr>
                        <td>
                            <select 
                                name="mnontocobertura" 
                                id="mnontocobertura" 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                aria-label="Default select example" 
                                required
                                >
                                <option value="0">Seleccione</option> 
                                <?php  
                                    foreach ($coverages as $c )
                                    {
                                        ?>
                                            <option value="{{ $c->id }}">{{ number_format( $c->coverage ) }} USD</option> 
                                        <?php  
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select 
                        
                                name="segurocobertura" 
                                id="segurocobertura" 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                aria-label="Default select example" 
                                required
                                >
                                    <option value="0">Seleccione</option> 
                                    <?php  
                                        foreach ($insurers as $i )
                                        {
                                            ?>
                                                <option value="{{ $i->id }}">{{  $i->name }} </option> 
                                            <?php  
                                        }
                                    ?>
                            </select>
                        </td>
                        <td>
                            <input type="radio" id="salud" name="tipopolizas" value="1" onclick="selectsalud();">
                            <label for="salud">Salud</label>
                            <input type="radio" id="auto" name="tipopolizas" value="2" onclick="selectauto();">
                            <label for="auto">Auto</label>
                            <input type="radio" id="empresa" name="tipopolizas" value="3" onclick="selectempresa();">
                            <label for="empresa">Patrimonio</label>
                        </td>
                    </tr>
                </table>
                <!-- formulario salud -->
                <div class="card" id="divsalud" style="display:none;">
                    <form action="polizassalud" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosalud"
                        name="formulariosalud"
                        class="container px-4 my-5">
                        @csrf
                        <!-- Beneficiarios poliza salud-->
                        <input type="hidden" id="tipopoliza" readonly name="tipopoliza" class="form-control" value =""/>
                        
                        <div id="cotizador" class="row text-center " hidden> 

                        </div>
                        <table class="table" id="tablaparentescospolizas">
                            
                        </table>                
                       
                        <!-- -->    
                        <table id="tablasalud" name="tablasalud" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agregar documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentossalud[]" 
                                    accept="pdf,png,jpg" 
                                >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                    type="text" 
                                    class="custom-file-input" 
                                    name="nombredocumentosalud[]" 
                                    required
                                >
                                </th>
                                
                            </tr>
                        </table>
                         <!-- -->
                         <table id="tablacomentarios" class="table">
                            <tr> 
                                <th>
                                    <input 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        name="comentariosalud[]" 
                                        id="comentariosalud[]" value="" 
                                        placeholder="Comentario sobre la póliza">
                                </th>
                            </tr>                  
                         </table>
                         <br>
                         <!-- -->
                         <table id="tablapatologiascelaradas" class="table">
                            <tr> 
                                <th>
                                    <input 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        name="patologiacomentadas[]" 
                                        id="patologiacomentadas[]" value="" 
                                        placeholder="Patología Declarada">
                                </th>
                            </tr>                  
                         </table>
                        <br>
                        <!-- -->
                        <table id="tablapatologiasnodeclaradas" class="table">
                            <tr> 
                                <th>
                                    <input 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        name="patologiasnocomentadas[]" 
                                        id="patologiasnocomentadas[]" value="" 
                                        placeholder="Patología NO Declarada">
                                </th>
                            </tr>                  
                         </table>
                        <br>
                        <!-- -->
                        <table id="tablasalud" name="tablasalud" class="table">
                            <tr>
                                <th>
                                    <button onClick="addFamiliartabla()" type="button" class="p-3 m-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir integrante a la póliza
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="addocument()" type="button" class="p-3 m-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir documento a la póliza
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="addcoomentario()" type="button" class="p-3 m-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir otro comentario
                                        </span>        
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <button onClick="patologiasi()" type="button" class="p-3 m-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir Patología  comentada
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="patologiano()" type="button" class="p-3 m-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir Patología NO comentada
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button type="button" onclick="guardarsalud()" class="p-3 m-2">
                                        Guardar la Póliza
                                    </button> 
                                </th>
                            </tr>
                        </table>                    
                        <!-- -->  
                       
                        <!-- boton agregar documentos en polizas tipo salud-->
                        

                        
                        <!-- btn guardar -->   
                              
                    </form>
                                       
                </div> 
                <!-- salud editar -->
                <div class="card" id="divsaludeditar" style="display:none;">
                    <form action="polizassaludeditar" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosalud"
                        name="formulariosalud"
                        class="container px-4 my-5">
                        @csrf
                        <!-- Beneficiarios poliza salud-->
                        <input type="hidden" id="tipopoliza" readonly name="tipopoliza" class="form-control" value =""/>
                        
                        <div id="cotizador" class="row text-center " hidden> 

                        </div>
                        <hr>
                        <h4> Parentesco de la póliza </h4>
                        <table  id="tablaparentescospolizaseditar" name="tablaparentescospolizaseditar" class="table">
                        </table>    
                        <button
                            class="btn btn-primary mt-2"
                            id="addparentesco"
                            name="addparentesco"
                            >
                            Agregar            
                        </button> 
                        <!-- -->    
                        <hr>
                        <h4> Documentos de la póliza </h4>
                        <table id="tablasaludocumentosdeditar" name="tablasaludocumentosdeditar" class="table"></table>
                        <button
                            class="btn btn-primary mt-2"
                            id="addocumento"
                            name="addocumento"
                            >
                            Agregar            
                        </button>
                        <!-- -->
                        <hr>
                        <h4> Comentarios de la póliza </h4>
                        <table id="tablacomentarioseditar" name="tablacomentarioseditar" class="table"></table>
                        <button
                            class="btn btn-primary mt-2"
                            id="addcomentario"
                            name="addcomentario"
                            >
                            Agregar            
                        </button>                
                        <!-- -->
                        <hr>
                        <h4> Patologías declaradas de la póliza </h4>
                        <table id="tabladeclaradaeditar" class="table"></table>
                        <button
                            class="btn btn-primary mt-2"
                            id="addpatologia"
                            name="addpatologia"
                            >
                            Agregar            
                        </button>
                        <!-- -->
                        <hr>
                        <h4> Patologías No  declaradas de la póliza </h4>
                        <table id="tablanodeclaradaeditar" class="table"></table>
                        <button
                            class="btn btn-primary mt-2"
                            id="addpatologiano"
                            name="addpatologiano"
                            >
                            Agregar            
                        </button>
                        <br>
                        <!-- -->
                                           
                        <!-- -->  
                              
                    </form>
                                       
                </div>
                <!-- formmulario auto -->
                <div  class="card" id="divauto" style="display:none;">
                    <form action="polizasuato" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosaatuos"
                        name="formulariosaatuos"
                        class="container px-4 my-5">
                        @csrf
                            <input type="hidden" id="tipopoliza2" readonly name="tipopoliza2" class="form-control" value =""/>
                            <table  class="table">
                                <tr>
                                    <th>
                                    <label>Nro  De placa </label>
                                    <input type="text" id="nroplaca" name="nroplaca"  value="">
                                    </th>
                                    <th>
                                    <label> Modelo</label>
                                    <input type="text" id="modelo" name="modelo"  value="">
                                    </th>
                                </tr>
                            </table> 
                            
                            <!-- pdf poliza auto-->
                            <table id="tablaautos" name="tablasalud" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            name="documentosautos[]" 
                                            accept="pdf,png,jpg"  
                                            >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentosautos[]" 
                                            required
                                        >
                                    </th>
                                </tr>
                            </table>

                            <!-- -->

                            <table id="tablacomentariosautos" class="table">
                                <tr> 
                                    <th>
                                        <input 
                                            type="text" 
                                            class="form-control shadow-none border-0 bg-grey" 
                                            name="comentarioautos[]" id="comentarioautos" 
                                            value="" placeholder="Comentario sobre la póliza">
                                    </th>
                                </tr>                  
                            </table>
                            
                            
                            <!-- --> 
                            <button 
                                onClick="addocument2()"  
                                type="button" class="p-3 m-3"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir documento
                                </span>        
                            </button>
                            <!-- --> 
                            <button onClick="addcoomentario2()" type="button" class="p-3 m-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                            <!-- -->          
                            <button 
                                type="button" 
                                onclick="guardarpolizaautos()" 
                                class="p-3 m-3"> 
                                Guardar la Póliza
                            </button>
                    </form>
                           
                </div>
                <!-- formmulario editar  -->
                <div  class="card" id="divautoeditar" style="display:none;">
                    <form action="polizasuatoeditar" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosaatuos"
                        name="formulariosaatuos"
                        class="container px-4 my-5">
                        @csrf
                            <input type="hidden" id="tipopoliza2" readonly name="tipopoliza2" class="form-control" value =""/>
                            <table  class="table">
                                <tr>
                                    <th>
                                    <label>Nro  De placa </label>
                                    <input type="text" id="nroplaca" name="nroplaca"  value="">
                                    </th>
                                    <th>
                                    <label> Modelo</label>
                                    <input type="text" id="modelo" name="modelo"  value="">
                                    </th>
                                </tr>
                            </table> 
                            
                            <!-- pdf poliza auto-->
                            <table id="tablaautos" name="tablasalud" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            name="documentosautos[]" 
                                            accept="pdf,png,jpg"  
                                            >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentosautos[]" 
                                            required
                                        >
                                    </th>
                                </tr>
                            </table>

                            <!-- -->

                            <table id="tablacomentariosautos" class="table">
                                <tr> 
                                    <th>
                                        <input 
                                            type="text" 
                                            class="form-control shadow-none border-0 bg-grey" 
                                            name="comentarioautos[]" id="comentarioautos" 
                                            value="" placeholder="Comentario sobre la póliza">
                                    </th>
                                </tr>                  
                            </table>
                            
                            
                            <!-- --> 
                            <button 
                                onClick="addocument2()"  
                                type="button" class="p-3 m-3"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir documento
                                </span>        
                            </button>
                            <!-- --> 
                            <button onClick="addcoomentario2()" type="button" class="p-3 m-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                            <!-- -->          
                            <button 
                                type="button" 
                                onclick="guardarpolizaautos()" 
                                class="p-3 m-3"> 
                                Guardar la Póliza
                            </button>
                    </form>
                           
                </div>
                <!-- formulario empresa -->
                <div  class="card" id="divempresas" style="display:none;">
                    <form  action="polizaempresas" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosempresa"
                        name="formulariosempresa"
                        class="container px-4 my-5">
                        @csrf
                        <input type="hidden" id="tipopoliza3" readonly name="tipopoliza3" class="form-control" value =""/>
                        <table class="table">
                            <tr>
                                <th>
                                <label>Nombre de la empresa</label>
                                <input type="text" id="nombreempresa" name="nombreempresa"  value="">
                                </th>
                                <th>
                                <label> Representante</label>
                                <input type="text" id="representante" name="representante"  value="">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                <label>Dimensiones</label>
                                <input type="text" id="dimensiones" name="dimensiones"  value="">
                                </th>
                                <th>
                                <label> ubicación</label>
                                <input type="text" id="ubicacion" name="ubicacion"  value="">
                                </th>
                            </tr>
                        </table>      
                        <!-- pdf poliza auto-->
                        <table id="tablaempresa" name="tablasalud" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agregar documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentosempresa[]" 
                                    accept="pdf" >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                        type="text" 
                                        class="custom-file-input" 
                                        name="nombredocumentosempresa[]" 
                                        required
                                    >
                                </th>
                            </tr>
                        </table>   
                        <!-- -->
                        <table id="tablacomentarioempresa" class="table">
                                <tr> 
                                    <th>
                                        <input 
                                            type="text"
                                            class="form-control shadow-none border-0 bg-grey" 
                                            name="comentarioempresa[]" id="comentarioempresa" value="" 
                                            placeholder="Comentario sobre la póliza">
                                    </th>
                                </tr>                  
                            </table>    
                        <!-- --> 
                        <button onClick="addocument3()"  type="button" class="my-5 p-3"> 
                            <span 
                                    class="ms-3 mon-light">
                                    Añadir documento
                            </span>        
                        </button>
                        <!-- --> 
                        <button onClick="addcoomentario3()" type="button" class="p-3 m-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                        <!-- -->         
                        <button type="button" onclick="guardareempresas()" class="my-5 p-3">
                            Guardar la Póliza
                        </button>
                    </form>
                                   
                </div>
                 <!-- formulario empresa -->
                 <div  class="card" id="divempresaseditar" style="display:none;">
                    <form  action="polizaempresaseditar" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formulariosempresa"
                        name="formulariosempresa"
                        class="container px-4 my-5">
                        @csrf
                        <input type="hidden" id="tipopoliza3" readonly name="tipopoliza3" class="form-control" value =""/>
                        <table class="table">
                            <tr>
                                <th>
                                <label>Nombre de la empresa</label>
                                <input type="text" id="nombreempresa" name="nombreempresa"  value="">
                                </th>
                                <th>
                                <label> Representante</label>
                                <input type="text" id="representante" name="representante"  value="">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                <label>Dimensiones</label>
                                <input type="text" id="dimensiones" name="dimensiones"  value="">
                                </th>
                                <th>
                                <label> ubicación</label>
                                <input type="text" id="ubicacion" name="ubicacion"  value="">
                                </th>
                            </tr>
                        </table>      
                        <!-- pdf poliza auto-->
                        <table id="tablaempresa" name="tablasalud" class="table">
                            <tr>
                                <th>
                                <label class="custom-file-label" for=""> Agregar documento   </label>
                                <input 
                                    type="file" 
                                    class="custom-file-input" 
                                    name="documentosempresa[]" 
                                    accept="pdf" >
                                </th>
                                <th>
                                <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                <input 
                                        type="text" 
                                        class="custom-file-input" 
                                        name="nombredocumentosempresa[]" 
                                        required
                                    >
                                </th>
                            </tr>
                        </table>   
                        <!-- -->
                        <table id="tablacomentarioempresa" class="table">
                                <tr> 
                                    <th>
                                        <input 
                                            type="text"
                                            class="form-control shadow-none border-0 bg-grey" 
                                            name="comentarioempresa[]" id="comentarioempresa" value="" 
                                            placeholder="Comentario sobre la póliza">
                                    </th>
                                </tr>                  
                            </table>    
                        <!-- --> 
                        <button onClick="addocument3()"  type="button" class="my-5 p-3"> 
                            <span 
                                    class="ms-3 mon-light">
                                    Añadir documento
                            </span>        
                        </button>
                        <!-- --> 
                        <button onClick="addcoomentario3()" type="button" class="p-3 m-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                        <!-- -->         
                        <button type="button" onclick="guardareempresas()" class="my-5 p-3">
                            Guardar la Póliza
                        </button>
                    </form>
                                   
                </div>                    
                <!-- -->                        
            </div>
            <!-- Agregar fechas de pago-->
            <div class="tab3">
                <?php                                  
                    foreach ($insurancepolicies as $i )
                    {
                        $tipopoliza='';
                        switch ($i->tipopoliza) {
                            case 1:
                                $tipopoliza =" Salud ";
                                break;
                            case 2:
                                $tipopoliza =" Autos ";
                                break;
                            case 3:
                                $tipopoliza =" Empresa ";
                                break;
                        }
                        $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="flexRadioDefault" 
                                id="flexRadioDefault2" 
                                onclick="buscarfrecuencias(<?=$i->id ?>,<?=$i->coverage?>,<?=$i->id_insurancepolicies ?>)">
                            <label class="form-check-label" for="flexRadioDefault2">
                                {{ $monto }}
                            </label>
                        <?php  
                    }
                ?>
                <!-- -->
                <div class="m-0 row justify-content-center ocultardiv" id="div_frecuencias">
                    <?php 
                        foreach ($frequencies as $frequencie) 
                        { 
                            ?> 
                                <input 
                                    
                                    style="padding:5px;"
                                    type="radio" 
                                    name="frequencie" 
                                    id="frequenciepagos" 
                                    onclick="frecuencia(<?=$frequencie->frequency ?>)"
                                >
                                    
                                    <label class="form-check-label" for="frequenciepagos">
                                        <?php echo $frequencie->name; ?>
                                    </label>
                            <?php 
                        } 
                    ?>  
                    <label>Fecha de Inicio pagos </label>
                    <input 
                        class="form-check-input"  
                        type="date" 
                        name="fechainicio" 
                        id="fechainicio" value="<?= date('Y-m-d'); ?>"
                        >
                        <button type="button" id="calcularpagos" name="calcularpagos"> Calcular</button>     
                </div>  
                <div  style="border: 1px solid #fff;">
                    
                        <form  id ="formulariospagorealizar2" 
                            name="formulariospagorealizar2" 
                            method="POST"
                            class=""
                            action="frecuenciapagos" 
                            
                        >
                            @csrf 
                            <table id="tablacontenidoformuariopago2" class="table">
                                   
                            </table>
                            <br>
                            <button type="button" id="guardarpagos" name="guardarpagos" style="display:none;"> Guardar fechas</button>
                        </form>           
                </div> 
                <!-- -->
            </div>
            <!-- Realizar pagos Polizas-->
            <div class="tab4">
                <!-- --> 
                <?php           
                    foreach ($insurancepolicies as $i )
                    {
                        $tipopoliza='';
                        switch ($i->tipopoliza) {
                            case 1:
                                $tipopoliza =" Salud ";
                                break;
                            case 2:
                                $tipopoliza =" Autos ";
                                break;
                            case 3:
                                $tipopoliza =" Empresa ";
                                break;
                        }
                        $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="flexRadioDefault3" 
                                        id="flexRadioDefault3" 
                                        onclick="buscarfrecuencias2(<?=$i->id ?>,<?=$i->coverage?>,<?=$i->id_insurancepolicies ?>)">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        {{ $monto }}
                                    </label>
                        <?php  
                    }
                ?>
                    <form  id ="realizarpagofrecuencia" 
                            name="realizarpagofrecuencia" 
                            method="POST"
                            class="container px-4 my-5"
                            action="adminpagos" 
                            enctype="multipart/form-data"
                        >
                        @csrf 
                        <br>
                        <table id ="tablecontenidoformuariopago3" class="table">

                        </table>    
                        <div class="ocultardiv" id="divbtnguardarpagos2" style=" border: 1px solid #fff;">
                            <button type="button" id="guardarpagpendiente" name="guardarpagpendiente"> Guardar Pagos </button>
                        </div>
                        
                    </form>   
            </div>
            <!-- --> 
            <div class="tab5">
                <?php           
                    foreach ($insurancepolicies as $i )
                    {
                        $tipopoliza='';
                        switch ($i->tipopoliza) {
                            case 1:
                                $tipopoliza =" Salud ";
                                break;
                            case 2:
                                $tipopoliza =" Autos ";
                                break;
                            case 3:
                                $tipopoliza =" Empresa ";
                                break;
                        }
                        $monto = number_format($i->coverage) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="flexRadioDefault3" 
                                        id="flexRadioDefault3" 
                                        onclick="buscarfrecuencias3(<?=$i->id ?>,<?=$i->coverage?>,<?=$i->id_insurancepolicies ?>)">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        {{ $monto }}
                                    </label>
                        <?php  
                    }
                ?>
                <br>
                <div id ="divformulariossiniestronuevo" class="ocultardiv">
                    <form  action="gudardarsinisestro" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formulariossiniestros"
                            name="formulariossiniestros"
                            class="container px-4 my-5"
                            >
                            @csrf   
                            <table  class="table">
                                <tr>
                                    <th>
                                        <label>Descripción sobre el siniestro</label><br>
                                        <input type="text" id="descripcionsiniestro" name="descripcionsiniestro"  value="" >
                                    </th>
                                    <th>
                                        <label>Monto del siniestro</label><br>
                                        <input type="text" id="montosiniestro" name="montosiniestro"  value="">
                                    </th>
                                    <th>
                                        <label>Estado del siniestro</label><br>
                                        <select name="estadosiniestro" id="estadosiniestro">
                                            <option value="0">Seleccione</option>
                                            <!--<option value="1">Alerta de Siniestro</option>-->
                                            <option value="2">Reportado</option>
                                            <option value="3">En Proceso</option>
                                            <!--<option value="4">Tramitado</option>-->
                                            <option value="5">Aprobado</option>
                                        </select>
                                    </th>
                                </tr>
                            </table>  
                            <!-- pdf poliza auto-->
                            <table id="tablasiniestros" name="tablasiniestros" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                        type="file" 
                                        class="custom-file-input" 
                                        name="documentossiniestro[]" 
                                        accept="pdf" >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentossiniestro[]" 
                                            required
                                        >
                                    </th>
                                </tr>
                            </table>   
                            <!-- --> 
                            <button onClick="addocument6()"  type="button"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir documento
                                </span>        
                            </button>
                            <!-- -->         
                            <button type="button" onclick="guardarsiniestro()">
                                Guardar siniestro
                            </button>
                    </form>
                </div>
                <div id="divtablalistadesiniestros" class="ocultardiv">
                    <table id="tablalistasiniestroseditar" name="tablalistasiniestroseditar" class="table">
                                
                    </table> 
                </div>
                <div id ="divformulariossiniestroeditar" class="ocultardiv" style="border: 1px solid #fff;">
                    <form  action="gudardarsinisestroeditar" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formulariossiniestroseditar"
                            name="formulariossiniestroseditar"
                            class="container px-4 my-5"
                            >
                            @csrf 
                            <input type="hidden" id="idsiniestroeditar" name="idsiniestroeditar"  value="">  
                            <table  class="table">
                                <tr>
                                    <th>
                                        <label>Descripción sobre el siniestro</label><br>
                                        <input type="text" id="descripcionsiniestroeditar" name="descripcionsiniestroeditar"  value="" >
                                    </th>
                                    <th>
                                        <label> Monto del siniestro</label><br>
                                        <input type="text" id="montosiniestroeditar" name="montosiniestroeditar"  value="">
                                    </th>
                                    <th>
                                        <label> Monto pagado del siniestro</label><br>
                                        <input type="text" id="montopagadoeditar" name="montopagadoeditar"  value="">
                                    </th>
                                    <th>
                                        <label> Estado del siniestro </label><br>
                                        <select name="estadosiniestroeditar" id="estadosiniestroeditar">
                                            <option value="0">Seleccione</option>
                                            <!--<option value="1">Alerta de Siniestro</option>-->
                                            <option value="2">Reportado</option>
                                            <option value="3">En Proceso</option>
                                            <!--<option value="4">Tramitado</option>-->
                                            <option value="5">Aprobado</option>
                                        </select>
                                    </th>
                                </tr>
                            </table>  
                            <!-- pdf poliza auto-->
                            <table id="tablasiniestroseditar" name="tablasiniestroseditar" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                        type="file" 
                                        class="custom-file-input" 
                                        name="documentossiniestro[]" 
                                        accept="pdf" >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentossiniestro[]" 
                                            required
                                        >
                                    </th>
                                </tr>
                            </table>   
                            
                    </form>
                </div>    
                
                <div id="divbotonesguardar" class="ocultardiv" style="border: 1px solid #fff;">
                    <!-- --> 
                        <button onClick="addocument6()"  type="button"> 
                        <span 
                                class="ms-3 mon-light">
                                Añadir documento
                        </span>        
                    </button>
                    <!-- -->         
                    <button type="button" onclick="guardarsiniestro()">
                        Guardar
                    </button>
                    <!-- --> 
                </div>
                <div id="divbotoneseditar" class="ocultardiv">
                    <button onClick="addocument5()"  type="button"> 
                        <span 
                                class="ms-3 mon-light">
                                Añadir documento (editar)
                        </span>        
                    </button>
                    <!-- -->
                    <button type="button" onclick="guardardatoseditados()">
                        Guardar Cambios
                    </button>  
                    <!-- -->  
                </div>
                
            </div>
            <!-- -->
            <div class="tab6">
                <form 
                    action="generateqr" 
                    id ="forgenerate"
                    name ="forgenerate"
                    method="POST"
                    class="container px-4 my-5">
                    <input type="hidden" id="idcliente4" readonly name="idcliente4" class="form-control" value ="<?=$idcliente; ?>"/>  
                    <input type="hidden" id="idadmin3" readonly name="idadmin3" class="form-control" value ="<?=auth()->id(); ?>"/>
                    <input type="hidden" id="keyqrrandon" readonly name="keyqrrandon" class="form-control" value ="<?=$keyqrrandon; ?>"/>  
                    @csrf        
                    <?php 
                        
                        if ($codeqr)
                        {
                            ?>
                                    <div class="text-center" style="border: 1px solid #fff;">
                                        <div class="row" style="border: 1px solid #fff;">
                                            <img src="{{env('APP_URL')}}/qrcodes/<?=$codeqr?>.svg">
                                        </div>
                                        <a 
                                            href="{{env('APP_URL')}}/qrcodes/<?=$codeqr?>.svg"" 
                                            class="btn btn-primary"
                                            download>
                                            Descargar
                                        </a>
                                        <a 
                                            href="#" 
                                            class="btn btn-primary"
                                            onclick="eliminarqr('{{$idcliente}}')"
                                            >
                                            Eliminar
                                        </a>
                                    </div>
                                    <div class="text-center" style="border: 1px solid #fff;">
                                        <label for=""> codigo : <?=$codeqr?> </label>
                                    </div>
                            <?php 
                        }
                        else
                        {
                            ?>
                            <div class="row">
                                    <div class="offset-md-3 col-md-2" style="border: 1px solid #fff;">
                                        <button type="submit" id="btngnerarqr" name="btngnerarqr"> Generar QR</button>
                                    </div>
                                </div>
                            <?php 
                        }
                    ?>
                </form>
            </div>
            <!-- -->
        </section>
    </div>
</div>

<!-- --> 
@endsection