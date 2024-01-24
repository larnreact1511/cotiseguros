@extends('voyager::master')

@section('content')
    <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert2.js') }}" defer></script>
    <script src="{{ asset('js/crearnota.js') }}" defer></script>
    <form id="form-cot" class="container px-4 my-5" action="" method="post">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3 class="mon-black display-4 text-uppercase text-center my-5 text-wine">
            Agregar nota a la cotización
        </h3>
        
        <input 
            name="idusuario" 
            id="idusuario"
            type="hidden" 
            class="form-control shadow-none border-0 bg-grey"
            placeholder="" 
            required
            hidden
            value="<?=auth()->id(); ?>"
        >
        <input 
            name="idquote" 
            id="idquote"
            type="hidden" 
            class="form-control shadow-none border-0 bg-grey"
            placeholder="" 
            required
            hidden
            value="<?=$idquote; ?>"
        >
        <div class="row br-5 shadow-lg px-4 py-4">
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input 
                    name="fecha_notificiacion" 
                    id="fecha_notificiacion"
                    type="date" 
                    class="form-control shadow-none border-0 bg-grey"
                    placeholder="fecha evento" required>
                    
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <textarea 
                        id="notificacion" 
                        name="notificacion" 
                        rows="4" 
                        cols="50"
                    ></textarea>
                    
                </div>
            </div>
            <hr class="mt-3" />
        </div>
        <button 
            type="button" 
            id ="guardarnota"
            name ="guardarnota"
        > Agregar nota</button> 
        <button   
            type="button" 
            id ="vernotasanteriores"
            name ="vernotasanteriores"
        > Ver notas anteriores</button>
    </form><br>
    <div class="container my-5 mt-2" id="divnotas">
        <div class="m-0 row justify-content-center">
            <div class="col-md-12">
                <div class="list-group" id="divlista">
                    <button type="button" class="list-group-item list-group-item-action active">
                        Notas agregadas
                    </button>
                    
                </div>
            </div>
        </div>
        
    </div>
@endsection

