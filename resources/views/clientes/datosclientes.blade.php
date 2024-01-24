@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="m-0 row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" id="usurio" class="form-control" />
                <label class="form-label" for="usurio">Nombre</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="clave" class="form-control" />
                <label class="form-label" for="clave">Apelldio</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="clave" class="form-control" />
                <label class="form-label" for="clave">cedula</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="clave" class="form-control" />
                <label class="form-label" for="clave">Correo</label>
            </div>
            <!-- Submit button -->
            <button type="button" class="btn btn-primary btn-block mb-4">Actulaizar</button>

            </form>
        </div>
    </div>
    
</div>
@endsection