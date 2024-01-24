@extends('layouts.menuclientes')

@section('content')
<style>
    .form-control {
    height: 40px !important;
    background: #f8f9fa;
    color: #000;
    font-size: 13px;
    border-radius: 4px;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: transparent;
}
</style>
<div class="row" style="text-align: center;">
    <div class="col-md-12">
        <form
            action=""
        >
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="nombrecliente">Nombre</label>
                <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                <label for="apellidocliente">Apellido</label>
                <input type="text" class="form-control" id="apellidocliente" name="apellidocliente" placeholder="Apellido">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="selectletra">&nbsp; </label>
                    <select class="custom-select mr-sm-2" id="selectletra" name="selectletra">
                        <option selected>Seleccione</option>
                        <option value="V">V</option>
                        <option value="E">E</option>
        
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="nrocedula">Nro cedula</label>
                    <input type="text" class="form-control" id="nrocedula" placeholder="Nro de cedula">
                </div>
                <div class="form-group col-md-6">
                    <label for="correcloente">Correo</label>
                    <input type="text" class="form-control" id="correcloente" placeholder="Correo">
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-3">
                    <label for="nrocedula">Fecha de nacimiento</label>
                    <input type="text" class="form-control" id="nrocedula" placeholder="Nro de cedula">
                </div>
                <div class="form-group col-md-6">
                    <label for="correcloente">Sexo</label>
                    <input type="text" class="form-control" id="correcloente" placeholder="Correo">
                </div>
            </div>
            <div class="form-row">
                
                <div class="form-group col-md-3">
                    <label for="selectletra">&nbsp; </label>
                    <select class="custom-select mr-sm-2" id="selectletra" name="selectletra">
                        <option selected></option>
                        <option value="+58">+58</option>
                        <option value="+57">+57</option>
        
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="nrocedula">Nro cedula</label>
                    <input type="text" class="form-control" id="nrocedula" placeholder="Nro de cedula">
                </div>
                <div class="form-group col-md-6">
                    <label for="correcloente">Correo</label>
                    <input type="text" class="form-control" id="correcloente" placeholder="Correo">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
    
</div>
@endsection
