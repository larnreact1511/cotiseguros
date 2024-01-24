@extends('voyager::master')

@section('content')
    <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
    <script src="{{ asset('js/cotizadorinterno.js') }}" defer></script>
    <div class="row">
        <div class="col-md-12">
            <h3 class="mon-black display-4 text-uppercase text-center my-5 text-wine">Cotiza tu poliza <br/> Ingresa tus datos</h3>
            <form id="form-cot" class="container px-4 my-5" action="" method="post">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row br-5 shadow-lg px-4 py-4 text-center">
                    <div class="col-12 text-center">
                        <h3 class="mon-black display-6 text-uppercase text-wine mb-4">información personal</h3>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                        <div class="form-floating mb-3">
                            <input 
                            name="name" 
                            id="name"
                            type="text" 
                            class="form-control shadow-none border-0 bg-grey" 
                            placeholder="Nombre" required>
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                        <div class="form-floating mb-3">
                            <input 
                
                                name="last_name" 
                                id="last_name" 
                                type="text" 
                                class="form-control shadow-none border-0 bg-grey" 
                                required
                                placeholder="Apellido" 
                                >
                            
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex text-center">
                        <div class="col-2 col-md-2 d-flex">
                            <select 
                            
                                name="code" 
                                id="code" 
                                class="form-select shadow-none border-0 bg-grey w-25 align-self-start" 
                                aria-label="Default select example" 
                                required
                                >
                            
                                <option  selected value="+58">+58 </option>
                            </select>
                        </div>
                        <div class="col-10 col-md-6 d-flex">
                            <div class="form-floating mb-3 w-75 ms-3">
                                <input 
                                    name="phone" 
                                    type="number" 
                                    class="form-control shadow-none border-0 bg-grey" 
                                    id="phone" 
                                    required
                                    placeholder="Nro de telefono" 
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-center">
                        <div class="form-floating mb-3">
                            <input 
                
                                name="email" 
                                type="email" 
                                class="form-control shadow-none border-0 bg-grey" 
                                id="email" 
                                required
                                placeholder="Correo electrónico" 
                                >
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex text-center">
                        <h3 class="mon-bold h3 text-uppercase mb-4 text-wine">Estado</h3>
                        <select 
                            name="province" 
                            id="province" 
                            class="form-select w-100 shadow-none border-0 bg-grey w-25 align-self-start"  
                            aria-label="Default select example" required >

                            @foreach ($provinces as $p)
                                <option @if( $p["estado"] == 'Táchira' ) selected @endif  value="{{ $p["estado"] }}">{{ $p["estado"] }}</option>
                            @endforeach 
                            
                        </select>
                    </div>
                    <div class="col-12">
                        <hr class="mt-3" />
                    </div>
                    <div class="col-12 my-3">
                        <h3 class="mon-bold h3 text-uppercase mb-4 text-wine">Suma asegurada</h3>
                        <select 
                            name="coverage" 
                            id="coverage" 
                            class="w-auto form-select shadow-none border-0 bg-grey align-self-start"  
                            aria-label="Default select example" >
                            <opt>Elije tu cobertura</option>
                            @foreach ($coverages as $c)
                                <option value="{{ $c->coverage }}">{{ number_format( $c->coverage ) }} USD</option> 
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col-12 d-flex flex-column flex-md-row justify-content-center align-items-center my-5" >
                        <h3 class="mon-black display-4 text-uppercase text-center my-5 text-wine" >Personas a asegurar</h3>
                    </div>
                    <div id="cotizador">

                    </div>
                    <br>
                    <div 
                        class="col-12 d-flex flex-column flex-md-row justify-content-center align-items-center my-5">
                            <span class="fas fa-user-plus"></span>
                            <div 
                                onClick="addFamiliar()" 
                                class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded-pill"
                                >
                                    
                                    <span 
                                        class="ms-3 mon-light">
                                            añadir integrante a mi poliza
                                    </span>
                            </div>
                            <button 
                                onClick="sendCot()" 
                                class="btn bg-pink text-white rounded-pill  px-5 py-3 ms-2" 
                                type="button"
                            >
                                Encuentra tu poliza ideal
                            </button>
                    </div>
                    <div class="col-12">
                        <hr class="mt-3" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection

