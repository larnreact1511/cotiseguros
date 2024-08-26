@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/tabs.css') }}">
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert.js') }}" defer></script>
<script src="{{ asset('js/adminstracionclientes3.js') }}" defer></script>
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
                                        placeholder="Nombre" 
                                        value="<?= @$info[0]->nombre; ?>">
                            </th>
                            <th>
                                <label> Apellido</label>
                                    <input 
                        
                                        name="apellido" 
                                        id="apellido" 
                                        type="text" 
                                        class="form-control shadow-none border-0 bg-grey" 
                                        
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
                                            
                                            placeholder="Nro de telefono" 
                                            value="<?=$numero ?>">
                            </td>
                            <td>
                                <label> Nacionalidad </label><br> 
                                <select class="form-select" name="nacionalidad" id="nacionalidad" aria-label="Default select example">
                                    <option value="V"  <?= @$info[0]->nacionalidad =="V" ?  'selected':'' ; ?>> V</option>
                                    <option value="E" <?= @$info[0]->nacionalidad =="E" ?  'selected':'' ; ?> > E </option>
                                </select>
                            </td>
                            <td>
                                <label> Cédula </label>
                                <input 
                                    name="cedula" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="cedula" 
                                    
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
                                    aria-label="Default select example"  >

                                    @foreach ($provinces as $p)
                                        <option @if( $p["estado"] == 'Táchira' ) selected @endif  value="{{ $p["estado"] }}">{{ $p["estado"] }}</option>
                                    @endforeach 
                                    
                                </select>
                            </td>
                            <td>
                                <label>Fecha de nacimiento </label><br>
                                <input 
                                        name="fecha_nacimiento" 
                                        id="fecha_nacimiento"
                                        type="date" 
                                        class="form-control shadow-none border-0 bg-grey"
                                        placeholder="Fecha de Nacimiento" 
                                        value="<?= @$info[0]->fecha_nacimiento; ?>"
                                        >
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
                                                    <a href="#" onclick="borrar('{{$d->id}}')" style ="text-decoration: none;">
                                                        <span 
                                                        class='icon voyager-trash p-3 m-2' 
                                                        title='Borrar Documento'
                                                        
                                                        ></span>    
                                                        Eliminar
                                                    </a>
                                                    
                                                    
                                                </th>
                                                <th>
                                                    <a href="#" onclick="editarnombredocumento()" id ="enlaceeditar" style ="text-decoration: none;">
                                                        <span 
                                                        class='icon voyager-documentation p-3 m-2' 
                                                        title='Editar Nombre'
                                                        onClick="enivarnouevonombre('{{$d->id}}')" 
                                                        ></span>    
                                                        Editar (nombre)
                                                    </a>
                                                    <div 
                                                        id ="diveditarnombredocumento"
                                                        name="diveditarnombredocumento"
                                                        style= "display: none;"
                                                        >
                                                            <input 
                                                                type="text" 
                                                                class="text" 
                                                                name="nuevonombre" 
                                                                id ="nuevonombre"
                                                            >
                                                            <button  
                                                                id="btnenviarn" 
                                                                name="btnenviarn" 
                                                                onclick="btneditarnombre('{{$d->id}}')"  
                                                                type="button" class="btn btn-primary"> Editar nombre </button> 
                                                            
                                                            <button 
                                                                class="btn btn-primary" 
                                                                id="btnlimpiar" 
                                                                name="btnlimpiar" 
                                                                onclick="btnlimpiaredicionnombre()" 
                                                                type="button"
                                                                > 
                                                                Cancelar 
                                                                </button> 
                                                    </div>
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
                    
                    
                    <button type="submit" class="btn btn-primary"> Actualizar Datos Persoanles </button> 
                    <button type="button" onClick="addocument4()"  type="button" class="btn btn-primary" > Agregar otro documento </button> 
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
                        $monto = number_format($i->idcoverages) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="edipoliza" 
                                id="edipoliza_{{$i->id_insurancepolicies}}" 
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
                            <input 
                                type="number" 
                                id="mnontocobertura" 
                                name="mnontocobertura" 
                                value=""
                            >
                           
                        </td>
                        <td>
                            <select 
                        
                                name="segurocobertura" 
                                id="segurocobertura" 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                aria-label="Default select example" 
                                
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
                <!-- --> 
                <div  id="diveliminar" style="display:none; border: 0px;">
                    <table class="table">
                        <tr>
                            <th>
                                <button
                                        onclick="eliminarpoliza()"
                                        class="btn btn-primary mt-2"
                                        >

                                        Eliminar poilza
                                    </button>
                            </th>
                            <th>
                                <button
                                        onclick="renovarpoliza()"
                                        class="btn btn-primary mt-2"
                                        >

                                        Renovar poilza
                                    </button>
                            </th>
                            <th>
                                <button
                                        onclick="crearcontinuidad()"
                                        class="btn btn-primary mt-2"
                                        >

                                        Continudad de la   poilza
                                    </button>
                            </th>
                        </tr>
                    
                    </table>

                </div>
                <!-- div para renovar -->
                <div id ='divrenovar'style="display:none; border: 0px;" >
                    <form 
                        action="renovarpoliza" 
                        method="POST"
                        enctype="multipart/form-data"
                        id="formrenovar"
                        name="formrenovar"
                        class="container px-4 my-5"
                        >
                        @csrf
                            <input type="hidden" name="idpolozarenovar" id='idpolozarenovar' value="">
                            <table class="table">
                                <tr>
                                        <th colspan="2">
                                            <label> 
                                                monto renovar polizar 
                                            </label><br>
                                            <input type="number" id="montorenovarpoliza" name="montorenovarpoliza" value="">
                                        </th>

                                </tr>


                                <tr>
                                    <th>
                                        <label>
                                        ¿Desea la renovación con el mismo seguro?
                                        </label>
                                        <br>  
                                        <input type="radio" id="segurosi" name="seguro" value="si">
                                        <label for="html">Si</label><br>
                                        <input type="radio" id="segurono" name="seguro" value="no">
                                        <label for="css">No</label><br>
                                    
                                    
                                    </th>
                                    <th>
                                        <label>
                                        ¿Mismas frecuencias de pago?
                                        </label>
                                        <br>  
                                        <input type="radio" id="frecuenciassi" name="frecuencias" value="si">
                                        <label for="html">Si</label><br>
                                        <input type="radio" id="frecuenciasno" name="frecuencias" value="no">
                                        <label for="css">No</label><br>
                                    </th>
                                
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <div id='div_segurorenovacion' style="display:none; border: 0px;">
                                            <select 
                                                name="segurorenovacion" 
                                                id="segurorenovacion" 
                                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                                aria-label="Default select example"     
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
                                        </div>
                                    </td>
                                </tr> 

                                <tr>
                                    <td colspan="2">
                                        <div 
                                            class="m-0 row justify-content-center" 
                                            id="div_frecuencias_renovacion"
                                            name="div_frecuencias_renovacion"
                                            style="display:none;"
                                            >
                                            <?php 
                                                foreach ($frequencies as $frequencie) 
                                                { 
                                                    ?> 
                                                        <input 
                                                            
                                                            style="padding:5px;"
                                                            type="radio" 
                                                            name="frequencierenovacion" 
                                                            id="frequenciepagosrenovacion" 
                                                            onclick="frecuenciarenovacion(<?=$frequencie->frequency ?>)"
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
                                                <button 
                                                    type="button" 
                                                    id="calcularpagosrenovacion" 
                                                    name="calcularpagosrenovacion"> 
                                                        Calcular
                                                </button>
                                                <div  
                                                    style="border: 0px solid #fff;"
                                                    >
                                                        <form  id ="formulariospagorealizar2" 
                                                            name="formulariospagorealizar2" 
                                                            method="POST"
                                                            class=""
                                                            action="frecuenciapagos" 
                                                            
                                                        >
                                                            @csrf 
                                                            <table id="tablacontenidoformuariopago2renovacion" class="table">
                                                            </table>   
                                                        </form>           
                                                </div>      
                                        </div>  
                                        
                                    </td>
                                </tr> 
                                                    
                                <tr>
                                    <th>
                                        <button
                                                onclick="generarrenovacion()"
                                                class="btn btn-primary mt-2"
                                                
                                                >
                                                Genere renovación
                                            </button>
                                    </th>
                                    <th></th>

                                </tr>
                            
                            </table>
                    </form>


                </div>
                <div id ="divcontinuidad" style="display:none; border: 0px;">
                    <form 
                            action="continuidad" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formcontinuidad"
                            name="formcontinuidad"
                            class="container px-4 my-5"
                            >
                            @csrf
                            <input type="hidden" name="idpolizacontinuidad" id='idpolizacontinuidad' value="">
                            <table>
                                <tr>
                                    <th colspan="2">
                                        <label> 
                                            Seguro de la continuidad
                                        </label><br>
                                        <select 
                                                name="segurocontinuidad" 
                                                id="segurocontinuidad" 
                                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                                aria-label="Default select example"     
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
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <button
                                            onclick="generecontinuidad()"
                                            class="btn btn-primary mt-2"
                                            
                                            >
                                            Genere continuidad
                                        </button>
                                    </th>
                                </tr>


                            </table>
                    </form>


                </div>
                
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
                                    <button onClick="addFamiliartabla()" type="button" class="btn btn-primary mt-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir integrante a la póliza
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="addocument()" type="button" class="btn btn-primary mt-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir documento a la póliza
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="addcoomentario()" type="button" class="btn btn-primary mt-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir otro comentario
                                        </span>        
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <button onClick="patologiasi()" type="button" class="btn btn-primary mt-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir Patología  comentada
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button onClick="patologiano()" type="button" class="btn btn-primary mt-2"> 
                                        <span 
                                                class="ms-3 mon-light">
                                                Añadir Patología NO comentada
                                        </span>        
                                    </button>
                                </th>
                                <th>
                                    <button type="button" onclick="guardarsalud()" class="btn btn-primary mt-2">
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
                        <hr>
                        <h4> Parentesco de la póliza </h4>
                        <table  id="tablaparentescospolizaseditar" name="tablaparentescospolizaseditar" class="table">
                        </table>    
                        <table  class="table">
                            <tr>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="btndivadd1"
                                        onClick="btndivadd(1)"  
                                        name="btndivadd1"
                                        class="btn btn-primary mt-2"
                                        >
                                        Agregar            
                                    </button>
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="clearbtn1"
                                        onClick="btnclear(1)"  
                                        name="clearbtn1"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        
                                        >
                                        Cancelar            
                                    </button>
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="savebtn1"
                                        onClick="btnsaveadd(1)"  
                                        name="savebtn1"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Guardar            
                                    </button> 
                                </th>
                            </tr>
                        </table>
                        <div id ="divadd_1" name="divadd_1" style="display : none;" >
                            <form action="parentescoadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formparentescoeditaradd"
                                name="formparentescoeditaradd"
                                class="container px-4 my-5">
                                @csrf
                                
                            </form>            
                            <form action="parentescoadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formparentescoeditaradd"
                                name="formparentescoeditaradd"
                                class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polisaeditar1" readonly name="polisaeditar1" class="form-control" value =""/>
                                <input type="hidden" id="polisaeditaradmin1" readonly name="polisaeditaradmin1" class="form-control" value =""/>
                                <input type="hidden" id="polisaidusuario1" readonly name="polisaidusuario1" class="form-control" value =""/>
                                <table id="tablaparentescoadd" name="tablaparentescoadd" class="table"></table>
                            </form>
                                       
                        </div>
                        <!-- -->    
                        <hr>
                        <h4> Documentos de la póliza </h4>
                        <table id="tablasaludocumentosdeditar" name="tablasaludocumentosdeditar" class="table"></table>
        
                        <table  class="table">
                            <tr>
                                <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btndivadd2"
                                    name="btndivadd2"
                                    onClick="btndivadd(2)"  
                                    >
                                    Agregar            
                                </button>
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="clearbtn2"
                                        onClick="btnclear(2)"  
                                        name="clearbtn2"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Cancelar            
                                    </button> 
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="savebtn2"
                                        onClick="btnsaveadd(2)"  
                                        name="savebtn2"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Guardar            
                                    </button> 
                                </th>
                            </tr>
                        </table>
                        <div id ="divadd_2" name="divadd_2" style="display : none;" >
                            
                            <form action="documentosadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formadd2"
                                name="formadd2"
                                class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polisaeditar2" readonly name="polisaeditar2" class="form-control" value =""/>
                                <input type="hidden" id="polisaeditaradmin2" readonly name="polisaeditaradmin2" class="form-control" value =""/>
                                <input type="hidden" id="polisaidusuario2" readonly name="polisaidusuario2" class="form-control" value =""/>
                                <table id="tabladocumentosadd" name="tabladocumentosadd" class="table"></table>
                            </form>
                        </div>
                        <!-- -->
                        <hr>
                        <h4> Comentarios de la póliza </h4>
                        <table id="tablacomentarioseditar" name="tablacomentarioseditar" class="table"></table>
                         
                        <table  class="table">
                            <tr>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="btndivadd3"
                                        name="btndivadd3"
                                        onClick="btndivadd(3)"
                                        class="btn btn-primary mt-2"
                                        >
                                        Agregar            
                                    </button> 
                                </th>
                                <th width ="30%">
                                    <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="clearbtn3"
                                    onClick="btnclear(3)"  
                                    name="clearbtn3"
                                    class="btn btn-primary mt-2"
                                    style="display : none;"
                                    >
                                    Cancelar            
                                </button>  
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="savebtn3"
                                        onClick="btnsaveadd(3)"  
                                        name="savebtn3"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Guardar            
                                    </button>  
                                </th>
                            </tr>
                        </table>
                        <div id ="divadd_3" name="divadd_3" style="display : none;" >
                            <form action="comentariosadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formadd3"
                                name="formadd3"
                                class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polisaeditar3" readonly name="polisaeditar3" class="form-control" value =""/>
                                <input type="hidden" id="polisaeditaradmin3" readonly name="polisaeditaradmin3" class="form-control" value =""/>
                                <input type="hidden" id="polisaidusuario3" readonly name="polisaidusuario3" class="form-control" value =""/>
                                <table id="tablacomentariosadd" class="table"></table>
                            </form>
                           
                        </div>            
                        <!-- -->
                        <hr>
                        <h4> Patologías declaradas de la póliza </h4>
                        <table id="tabladeclaradaeditar" class="table"></table>
                        <table  class="table">
                            <tr>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="btndivadd4"
                                        name="btndivadd4"
                                        class="btn btn-primary mt-2"
                                        onClick="btndivadd(4)"
                                        >
                                        Agregar            
                                    </button>
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="clearbtn4"
                                        onClick="btnclear(4)"  
                                        name="clearbtn4"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Cancelar            
                                    </button> 
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="savebtn4"
                                        onClick="btnsaveadd(4)"  
                                        name="savebtn4"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Guardar            
                                    </button>
                                </th>
                            </tr>
                        </table>
                        <div id ="divadd_4" name="divadd_4" style="display : none;" >
                            <form action="patologiasiadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formadd4"
                                name="formadd4"
                                class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polisaeditar4" readonly name="polisaeditar4" class="form-control" value =""/>
                                <input type="hidden" id="polisaeditaradmin4" readonly name="polisaeditaradmin4" class="form-control" value =""/>
                                <input type="hidden" id="polisaidusuario4" readonly name="polisaidusuario4" class="form-control" value =""/>
                                <table id="tablapatolociasiadd" class="table"></table>       
                            </form>
                                  
                        </div>
                        <!-- -->
                        <hr>
                        <h4> Patologías No  declaradas de la póliza </h4>
                        <table id="tablanodeclaradaeditar" class="table"></table>
                        
                        <table  class="table">
                            <tr>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="btndivadd5"
                                        name="btndivadd5"
                                        onClick="btndivadd(5)"
                                        class="btn btn-primary mt-2"
                                        >
                                        Agregar            
                                    </button>
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="clearbtn5"
                                        onClick="btnclear(5)"  
                                        name="clearbtn5"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Cancelar            
                                    </button>  
                                </th>
                                <th width ="30%">
                                    <button
                                        class="btn btn-primary mt-2"
                                        type="button" 
                                        id="savebtn5"
                                        onClick="btnsaveadd(5)"  
                                        name="savebtn5"
                                        class="btn btn-primary mt-2"
                                        style="display : none;"
                                        >
                                        Guardar            
                                    </button>
                                </th>
                            </tr>
                        </table>
                        <div id ="divadd_5" name="divadd_5" style="display : none;" >
                            
                            <form action="patologianoadd" 
                                method="POST"
                                enctype="multipart/form-data"
                                id="formadd5"
                                name="formadd5"
                                class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polisaeditar5" readonly name="polisaeditar5" class="form-control" value =""/>
                                <input type="hidden" id="polisaeditaradmin5" readonly name="polisaeditaradmin5" class="form-control" value =""/>
                                <input type="hidden" id="polisaidusuario5" readonly name="polisaidusuario5" class="form-control" value =""/>
                                <table id="tablapatolocianoadd" class="table"></table>   
                            </form>           
                        </div>
                        
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
                                            
                                        >
                                    </th>
                                </tr>
                            </table>

                            <!-- -->

                            <table id="addautos" class="table">
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
                                type="button" class="btn btn-primary mt-2" > 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir documento
                                </span>        
                            </button>
                            <!-- --> 
                            <button onClick="addcoomentario2()" type="button" class="btn btn-primary mt-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                            <!-- -->          
                            <button 
                                type="button" 
                                onclick="guardarpolizaautos()" 
                                class="btn btn-primary mt-2"> 
                                Guardar la Póliza
                            </button>
                    </form>
                           
                </div>
                <!-- formmulario auto editar  -->
                <div  class="card" id="divautoeditar" style="display:none;">
                    <input type="hidden" id="tipopoliza2" readonly name="tipopoliza2" class="form-control" value =""/>
                    <table  class="table">
                        <tr>
                            <th>
                                <label>Modelo  </label>
                                <label id="modeloauto" name ="modeloauto">

                                </label>
                            </th>
                            <th>
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditauto1"
                                    onClick="btneditempresa(1)"  
                                    name="btneditauto1"
                                    class="btn btn-primary mt-2"
                                    >
                                    Editar            
                                </button>
                            </th>
                        </tr>
                    </table> 
                    <div id="divautoedit_1" style="display:none;">
                        <form action="editmodeloautos" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formeditauto1"
                            name="formeditauto1"
                            class="container px-4 my-5">
                            @csrf
                            
                        </form>

                        <form action="editmodeloautos" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formeditauto1"
                            name="formeditauto1"
                            class="container px-4 my-5">
                            @csrf
                            <input type="hidden" id="poliatuedit1" readonly name="poliatuedit1" class="form-control" value =""/>
                            <input type="hidden" id="adminpoliatuedit1" readonly name="adminpoliatuedit1" class="form-control" value =""/>
                            <input type="hidden" id="usuarioadminpoliatuedit1" readonly name="usuarioadminpoliatuedit1" class="form-control" value =""/>
                            <table  class="table">
                                <tr>
                                    <th>
                                    <label>Nro  De placa </label>
                                    <input type="text" id="nroplacaedit" name="nroplacaedit"  value="">
                                    </th>
                                    <th>
                                    <label> Modelo</label>
                                    <input type="text" id="modeloedit" name="modeloedit"  value="">
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <button
                                            class="btn btn-primary mt-2"
                                            type="button" 
                                            id="clearatuosedit1"
                                            onClick="btnclearatuosedit(1)"  
                                            class="btn btn-primary mt-2"
                                            name="clearatuosedit1"
                                            >
                                            Cancelar            
                                        </button>
                                    </th>
                                    <th>
                                        <button
                                            class="btn btn-primary mt-2"
                                            type="button" 
                                            id="saveeditautos1"
                                            onClick="btnsaveeditautos(1)"  
                                            class="btn btn-primary mt-2"
                                            name="saveeditautos1"
                                            >
                                            Guardar            
                                        </button>
                                    </th>
                                </tr>
                            </table> 
                        </form>
                        
                    </div>           
                    
                    <!-- pdf poliza auto-->
                    <hr>
                    <h4> Documentos Cargados  </h4>
                    <table id="tablaautosdocumentos" name="tablaautosdocumentos" class="table"></table>
                    <table  class="table">
                        <tr>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditauto2"
                                    name="btneditauto2"
                                    onClick="btneditautos(2)"
                                    >
                                    Agregar            
                                </button> 
                            </th>
                            <th width ="30%">
                                <button
                                class="btn btn-primary mt-2"
                                type="button" 
                                id="clearatuosedit2"
                                onClick="btnclearatuosedit(2)"  
                                name="clearatuosedit2"
                                
                                style="display : none;"
                                >
                                Cancelar            
                            </button>  
                            </th>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="saveeditautos2"
                                    onClick="btnsaveeditautos(2)"  
                                    name="saveeditautos2"
                                    style="display : none;"
                                    >
                                    Guardar            
                                </button>  
                            </th>
                        </tr>
                    </table>
                    <div id="divautoedit_2" style="display:none;">
                        <form action="formeditdocumentosautosadd" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formeditauto2"
                            name="formeditauto2"
                            class="container px-4 my-5">
                            @csrf
                            <input type="hidden" id="poliatuedit2" readonly name="poliatuedit2" class="form-control" value =""/>
                            <input type="hidden" id="adminpoliatuedit2" readonly name="adminpoliatuedit2" class="form-control" value =""/>
                            <input type="hidden" id="usuarioadminpoliatuedit2" readonly name="usuarioadminpoliatuedit2" class="form-control" value =""/>
                            <table id="" name="" class="table">
                                <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            name="documentosautoseditardd[]" 
                                            accept="pdf,png,jpg"  
                                            >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentosautoseditardd[]" 
                                            
                                        >
                                    </th>
                                </tr>
                            </table> 
                        </form>
                                      
                    </div>
                    <!-- -->
                    <hr>
                    <h4> Comentarios Cargados  </h4>
                    <table id="tablaautoscomentarios" class="table"></table>
                    <table  class="table">
                        <tr>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditauto3"
                                    name="btneditauto3"
                                    onClick="btneditautos(3)"
                                    >
                                    Agregar            
                                </button> 
                            </th>
                            <th width ="30%">
                                <button
                                class="btn btn-primary mt-2"
                                type="button" 
                                id="clearatuosedit3"
                                onClick="btnclearatuosedit(3)"  
                                name="clearatuosedit3"
                                style="display : none;"
                                >
                                Cancelar            
                            </button>  
                            </th>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="saveeditautos3"
                                    onClick="btnsaveeditautos(3)"  
                                    name="saveeditautos3"
                                    style="display : none;"
                                    >
                                    Guardar            
                                </button>  
                            </th>
                        </tr>
                    </table>
                    <div id="divautoedit_3" style="display:none;">
                        <form action="formcomentarioseditadd" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formeditauto3"
                            name="formeditauto3"
                            class="container px-4 my-5">
                            @csrf
                            <input type="hidden" id="poliatuedit3" readonly name="poliatuedit3" class="form-control" value =""/>
                            <input type="hidden" id="adminpoliatuedit3" readonly name="adminpoliatuedit3" class="form-control" value =""/>
                            <input type="hidden" id="usuarioadminpoliatuedit3" readonly name="usuarioadminpoliatuedit3" class="form-control" value =""/>
                            <table id="" name="" class="table">
                                <tr> 
                                    <th>
                                        <input 
                                            type="text" 
                                            class="form-control shadow-none border-0 bg-grey" 
                                            name="comentarioautoseditadd[]" id="comentarioautoseditadd" 
                                            value="" placeholder="Comentario sobre la póliza">
                                    </th>
                                </tr> 
                            </table> 
                        </form>
                                      
                    </div>
                    <!-- --> 
                    
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
                                <label> Ubicación</label>
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
                        <button onClick="addocument3()"  type="button" class="btn btn-primary mt-2"> 
                            <span 
                                    class="ms-3 mon-light">
                                    Añadir documento
                            </span>        
                        </button>
                        <!-- --> 
                        <button onClick="addcoomentario3()" type="button" class="btn btn-primary mt-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir otro comentario
                                </span>        
                            </button>
                        <!-- -->         
                        <button type="button" onclick="guardareempresas()" class="btn btn-primary mt-2">
                            Guardar la Póliza
                        </button>
                    </form>
                                   
                </div>
                <!-- formulario empresa editar -->
                <div  class="card" id="divempresaseditar" style="display:none;">
                                    
                    <!-- --> 
                    <table  class="table">
                        <tr>
                            <th>
                                <label id="dimensionesedit" name ="dimensionesedit">
                                <label id="ubicacionedit" name ="ubicacionedit">
                                <label id="descripcionpolizaempresa" name ="descripcionpolizaempresa">
                            </th>
                            <th>
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditempresa1"
                                    onClick="btneditempresa(1)"  
                                    name="btneditempresa1"
                                    >
                                    Editar            
                                </button>
                            </th>
                        </tr>
                    </table> 
                    <!-- --> 
                    <div id="divempresaoedit_1" style="display:none;">

                        <form  action="editarempresaadd" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formempresaedit1"
                            name="formempresaedit1"
                            class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polizaempresaedit1" readonly name="polizaempresaedit1" class="form-control" value =""/>
                                <input type="hidden" id="adminempresapoliza1" readonly name="adminempresapoliza1" class="form-control" value =""/>
                                <input type="hidden" id="usuarioempresapoliza1" readonly name="usuarioempresapoliza1" class="form-control" value =""/>
                                <table class="table">
                                    <tr>
                                        <th>
                                            <label>Nombre de la empresa</label>
                                            <input type="text" id="nombreempresaedita" name="nombreempresaedita"  value="">
                                        </th>
                                        <th>
                                            <label> Representante</label>
                                            <input type="text" id="representanteedit" name="representanteedit"  value="">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label>Dimensiones</label>
                                            <input type="text" id="dimensionesedit" name="dimensionesedit"  value="">
                                        </th>
                                        <th>
                                            <label> Ubicación</label>
                                            <input type="text" id="ubicacionedit" name="ubicacionedit"  value="">
                                        </th>
                                    </tr>
                                    <tr>
                                    <th>
                                        <button
                                            class="btn btn-primary mt-2"
                                            type="button" 
                                            id="clearempresaedi1"
                                            onClick="btnclearempresaedi(1)"  
                                            name="clearempresaedi1"
                                            >
                                            Cancelar            
                                        </button>
                                    </th>
                                    <th>
                                        <button
                                            class="btn btn-primary mt-2"
                                            type="button" 
                                            id="saveempresaedit1"
                                            onClick="btnsaveempresaedit(1)"  
                                            name="saveempresaedit1"
                                            >
                                            Guardar            
                                        </button>
                                    </th>
                                </tr>
                                </table>        
                        </form>
                    </div>
                    <hr>
                    
                    <table  class="table">
                        <tr>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditempresa2"
                                    name="btneditempresa2"
                                    onClick="btneditempresa(2)"
                                    >
                                    Agregar            
                                </button> 
                            </th>
                            <th width ="30%">
                                <button
                                class="btn btn-primary mt-2"
                                type="button" 
                                id="clearempresaedi2"
                                onClick="btnclearempresaedi(2)"  
                                name="clearempresaedi2"
                                style="display : none;"
                                >
                                Cancelar            
                            </button>  
                            </th>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="saveempresaedit2"
                                    onClick="btnsaveempresaedit(2)"  
                                    name="saveempresaedit2"
                                    style="display : none;"
                                    >
                                    Guardar            
                                </button>  
                            </th>
                        </tr>
                    </table>  
                    <table id="tabladocumentosempresaseidtar" name="tabladocumentosempresaseidtar" class="table"></table> 
                    <div id="divempresaoedit_2" style="display:none;">
                        <form  action="editardocumentoseditar" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formempresaedit2"
                            name="formempresaedit2"
                            class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polizaempresaedit2" readonly name="polizaempresaedit2" class="form-control" value =""/>
                                <input type="hidden" id="adminempresapoliza2" readonly name="adminempresapoliza2" class="form-control" value =""/>
                                <input type="hidden" id="usuarioempresapoliza2" readonly name="usuarioempresapoliza2" class="form-control" value =""/>
                                <table id="" name="" class="table">
                                    <tr>
                                        <th>
                                        <label class="custom-file-label" for=""> Agregar documento  </label>
                                        <input 
                                            type="file" 
                                            class="custom-file-input" 
                                            name="documentosempresaeditar[]" 
                                            accept="pdf" >
                                        </th>
                                        <th>
                                        <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                        <input 
                                                type="text" 
                                                class="custom-file-input" 
                                                name="nombredocumentosempresaeditar[]" 
                                                
                                            >
                                        </th>
                                    </tr>
                                </table>     
                        </form>
                    </div>
                    <h>
                    
                    <table  class="table">
                        <tr>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="btneditempresa3"
                                    name="btneditempresa3"
                                    onClick="btneditempresa(3)"
                                    >
                                    Agregar            
                                </button> 
                            </th>
                            <th width ="30%">
                                <button
                                class="btn btn-primary mt-2"
                                type="button" 
                                id="clearempresaedi3"
                                onClick="btnclearempresaedi(3)"  
                                name="clearempresaedi3"
                                style="display : none;"
                                >
                                Cancelar            
                            </button>  
                            </th>
                            <th width ="30%">
                                <button
                                    class="btn btn-primary mt-2"
                                    type="button" 
                                    id="saveempresaedit3"
                                    onClick="btnsaveempresaedit(3)"  
                                    name="saveempresaedit3"
                                    style="display : none;"
                                    >
                                    Guardar            
                                </button>  
                            </th>
                        </tr>
                    </table>
                    <table id="tablacomentariosempresaeditar" name="tablacomentariosempresaeditar" class="table"></table>   
                    <div id="divempresaoedit_3" style="display:none;">
                        <form  action="editarcomentarioempresa" 
                            method="POST"
                            enctype="multipart/form-data"
                            id="formempresaedit3"
                            name="formempresaedit3"
                            class="container px-4 my-5">
                                @csrf
                                <input type="hidden" id="polizaempresaedit3" readonly name="polizaempresaedit3" class="form-control" value =""/>
                                <input type="hidden" id="adminempresapoliza3" readonly name="adminempresapoliza3" class="form-control" value =""/>
                                <input type="hidden" id="usuarioempresapoliza3" readonly name="usuarioempresapoliza3" class="form-control" value =""/>
                                <table id="tablacomentarioempresa" class="table">
                                    <tr> 
                                        <th>
                                            <input 
                                                type="text"
                                                class="form-control shadow-none border-0 bg-grey" 
                                                name="comentarioempresaeditar[]" id="comentarioempresaeditar" value="" 
                                                placeholder="Comentario sobre la póliza">
                                        </th>
                                    </tr>                  
                                </table>    
                        </form>
                    </div>
                    
                                
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
                        $monto = number_format($i->idcoverages) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="flexRadioDefault" 
                                id="flexRadioDefault2" 
                                onclick="buscarfrecuencias(0,<?=$i->idcoverages?>,<?=$i->id_insurancepolicies ?>)">
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
                            <button type="button" id="guardarpagos" name="guardarpagos" class="btn btn-primary mt-2" style="display:none;"> Guardar fechas</button>
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
                        $monto = number_format($i->idcoverages) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="flexRadioDefault3" 
                                        id="flexRadioDefault3" 
                                        onclick="buscarfrecuencias2(0,<?=$i->idcoverages?>,<?=$i->id_insurancepolicies ?>)">
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
                            <button type="button" id="guardarpagpendiente" name="guardarpagpendiente" class="btn btn-primary mt-2"> Guardar Pagos </button>
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
                        $monto = number_format($i->idcoverages) .' USD ( '.$i->name.' :'.$tipopoliza.' ) '
                        ?>
                            <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="flexRadioDefault3" 
                                        id="flexRadioDefault3" 
                                        onclick="buscarfrecuencias3(0,<?=$i->idcoverages?>,<?=$i->id_insurancepolicies ?>)">
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
                                            
                                        >
                                    </th>
                                </tr>
                            </table>   
                            <!-- --> 
                            <button onClick="addocument6()"  type="button" class="btn btn-primary mt-2"> 
                                <span 
                                        class="ms-3 mon-light">
                                        Añadir documento 1
                                </span>        
                            </button>
                            <!-- -->         
                            <button type="button" onclick="guardarsiniestro()" class="btn btn-primary mt-2">
                                Guardar siniestro 1
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
                                            
                                        >
                                    </th>
                                </tr>
                            </table>   
                            
                    </form>
                </div>    
                
                <div id="divbotonesguardar" class="ocultardiv" style="border: 1px solid #fff;">
                    <!-- --> 
                        <button onClick="addocument6()"  type="button" class="btn btn-primary mt-2"> 
                        <span 
                                class="ms-3 mon-light">
                                Añadir documento
                        </span>        
                    </button>
                    <!-- -->         
                    <button type="button" onclick="guardarsiniestro()" class="btn btn-primary mt-2">
                        Guardar
                    </button>
                    <!-- --> 
                </div>
                <div id="divbotoneseditar" class="ocultardiv">
                    <button onClick="addocument5()"  type="button" class="btn btn-primary mt-2"> 
                        <span 
                                class="ms-3 mon-light">
                                Añadir documento (editar)
                        </span>        
                    </button>
                    <!-- -->
                    <button type="button" onclick="guardardatoseditados()" class="btn btn-primary mt-2" >
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