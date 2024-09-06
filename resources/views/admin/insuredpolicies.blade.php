@extends('voyager::master')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/lloader.css') }}">
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/insuredpolicies.js') }}" defer></script>
<div class="container">

    <div class="col-12" id="">
        <div class="custom-loader" id ="carga" sytyle="display:none"></div>
    </div>
    
    <div class="row" id ="divprincipal">
        <div class="col-12" id="">
            <h3>
                Agrega polizas ha la empresa : {{$company[0]->companyname}}
            </h3>
                <form 
                    id="form_addpolicesgruop" 
                    name="form_addpolicesgruop" 
                    class="container px-4 my-5" 
                    method="post"
                    enctype="multipart/form-data"
                    >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="companyID" id="companyID" value="{{$id}}">
                    <table class="table">
                        <tr>
                            <td>
                                <label> 
                                    Monto 
                                </label><br>
                                <input 
                                    type="number" 
                                    id="mnontocobertura" 
                                    name="mnontocobertura" 
                                    value=""
                                >
                            
                            </td>
                            <td>
                                <label> 
                                    Seguro 
                                </label><br>
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
                            
                        </tr>
                        <tr>
                            <th>
                                <button
                                        onclick="addpolicesgruop()"
                                        class="btn btn-primary mt-2"
                                        type='button'
                                        
                                        >
                                            Agregar polizas al colectivo
                                    </button>
                            </th>
                            <th></th>

                        </tr>
                    </table>
                </form>
        </div>
    </div>
</div>



@endsection