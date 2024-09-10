@extends('voyager::master')

@section('content')
<script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" defer></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>

<div class="container">
    <div class="row">
        <h3>
            Sube tus clinicas

        </h3>
        <div  
            class="card" 
            id="" 
            >
                <form  
                    action="importar-clinicas-excel" 
                    method="POST"
                    enctype="multipart/form-data"
                    id="formimportausu"
                    name="formimportausu"
                    class="container px-4 my-5">
                    @csrf
                    <table id="tablasalud" name="tablasalud" class="table">
                            <tr>
                                <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    
                                    <input type="file" id="excel" name ="excel" class="form-control" />
                                </th>
                        
                            </tr>
                        </table>

                    <button type="submit" class="m-2 mb-2">
                      Subir Clinicas
                    </button> 
                </form>
            </br>                       
        </div>   
    </div>
   
</div>

<!-- The Modal -->
  

@endsection