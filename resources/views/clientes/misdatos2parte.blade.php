@extends('layouts.clientesseguro')

@section('content')
    <!-- -->
        @if (session()->has('error_datos'))
            <div class="alert alert-danger">
                {{ session('error_datos') }}
            </div>
        @endif
        <?php 
            $code = '';
            $numerotelefono = ''; //numero telef contact
            $code2 = '';
            $telefonococontacto = ''; //numero cedula
            $letra1 = '';
            $cedula = ''; // nro cedula cliente
            $letra2 = '';
            $cedulacontacto = ''; // nro cedula contacto cliente
            if ( @$clientes[0]->numerotelefono )
            {
                $cantidad =strlen(@$clientes[0]->numerotelefono);
                $code =substr(@$clientes[0]->numerotelefono,0,3);
                $numerotelefono =substr(@$clientes[0]->numerotelefono,3,$cantidad);
            }
            if ( @$clientes[0]->cedula )
            {
                $cantidad =strlen(@$clientes[0]->cedula);
                $letra1 =substr(@$clientes[0]->cedula,0,1);
                $cedula =substr(@$clientes[0]->cedula,3,$cantidad);
            }
            if ( @$clientes[0]->telefonococontacto )
            {
                $cantidad =strlen(@$clientes[0]->telefonococontacto);
                $code2 =substr(@$clientes[0]->telefonococontacto,0,3);
                $telefonococontacto =substr(@$clientes[0]->telefonococontacto,3,$cantidad);
            }
            if ( @$clientes[0]->cedulacontacto )
            {
                $cantidad =strlen(@$clientes[0]->cedulacontacto);
                $letra2 =substr(@$clientes[0]->cedulacontacto,0,1);
                $cedulacontacto =substr(@$clientes[0]->cedulacontacto,3,$cantidad);
            }

        ?>
    <!-- -->  
    <div class="container-fluid">
        <div class="row" >
            <div class="col-12">
                <!-- -->
                <form action="actualizarmisdatos" 
                        method="post">
                        @csrf
                    <div class="page-header pt-3" hidden>
                        <h2>
                            Perfil de Cliente
                        </h2>
                    </div>
                    <div class="row mb-4" hidden>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="<?=@$clientes[0]->nombre ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="apellido">Apellido</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" value="<?=@$clientes[0]->apellido ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" hidden>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="letra1">&nbsp</label>
                                <select class="form-select" name="letra1" aria-label="Default select example">
                                    <option value="V"> V</option>
                                    <option value="E"> E </option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="cedula">Cedula</label>
                                <input type="number" id="cedula" name="cedula" class="form-control" value="<?=@$cedula ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="email">Correo</label>
                                <input type="email" id="correo" name="email" class="form-control" value="<?=@$clientes[0]->email ?>" readonly />
                                
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" hidden>
                        <div class="col">
                            <div class="form-outline">
                                    <label class="form-label" for="code1"> &nbsp; </label>
                                    <select class="form-select" name="code1" aria-label="Default select example">
                                        <option value="+58"> +58</option>
                                        <option value="+57"> +57 </option>
                                    </select>
                                    
                            </div>
                        </div>
                            
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="numerotelefono">Telefono</label>
                                <input type="number" id="numerotelefono" name="numerotelefono" class="form-control" value="<?=@$numerotelefono ?>" />
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="grupo">Grupo</label>
                                <input type="text" id="grupo" class="form-control" value="" />
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="page-header pt-3">
                        <h2>
                            Contacto de Emergencia
                        </h2>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="nombreconatacto">Nombre</label>
                                <input type="text" id="nombreconatacto" name="nombrecontacto" class="form-control" value="<?=@$clientes[0]->nombrecontacto ?>" />
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline">
                                <label class="form-label" for="apellidocontacto">Apellido</label>
                                <input type="text" id="apellidocontacto" name="apellidocontacto" class="form-control" value="<?=@$clientes[0]->apellidocontacto ?>" />
                                
                            </div>
                        </div>
                    </div>    
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-outline">
                                <label class="form-label" for="letra2"> &nbsp; </label>
                                <select class="form-select" name="letra2" aria-label="Default select example">
                                    <option value="V"> V</option>
                                    <option value="E"> E </option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-outline">
                                <label class="form-label" for="cedulacontacto">Cedula</label>
                                <input type="number" id="cedulacontacto" name="cedulacontacto" class="form-control" value="<?=@$cedulacontacto?>" />
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-outline">
                                <label class="form-label" for="code2"> &nbsp; </label>
                                <select class="form-select" name="code2" aria-label="Default select example">
                                    <option value="+58"> +58</option>
                                    <option value="+57"> +57 </option>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-outline">
                                <label class="form-label" for="nrotelefonocontacto">Telefono</label>
                                <input type="number" id="nrotelefonocontacto" name="nrotelefonocontacto" class="form-control" value="<?=@$telefonococontacto?>" />
                                
                            </div>
                        </div>
                    </div>    
                    <div class="text-center p-2">
                        <button type="submit" class="btn btn-secondary btn-floating mx-1">
                        Guardar datos 
                        </button>

                    </div>
                </form>
                <!-- -->
            </div>
            <?php 
                if ( count($memberquotes) >0 )
                {
                    ?>
                    <hr>
                    <div class="page-header pt-3">
                        <h2>
                            Grupo Familiar
                        </h2>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="container-fluid">
                            <div class="row">
                                <?php 
                                    foreach ($memberquotes  as $m)
                                    {
                                        ?>
                                        <div class="col-md-2 p-1 m-2 ">
                                            <div class="alert alert-info">
                                                    <p class="">
                                                        <?=$m->status.' - '.$m->gender.'('.$m->date.') años de edad ';  ?>
                                                    </p>
                                                </div>
                                        </div>
                                        <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <?php
                }
            ?> 
        </div>
        <div class ="row">
            <div class="col-md-12 p-2">
                <a 
                    href="{{env('APP_URL')}}/cliente/mis-datos" 
                    style ="text-decoration:none; color:#911d1b !important;" 
                    class ="d-flex justify-content-center"
                    >
                    <i class=" bi-skip-start-fill bi--3xl"></i>
                    <strong> 
                    Volver
                    </strong>   
                </a>
            </div>
            
        </div>
    </div>
@endsection
