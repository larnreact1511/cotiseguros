let arreglo =[];
//let urlservidor ='http://127.0.0.1:8000/';
let urlservidor  ='https://dev.cotiseguros.com.ve//';
//let urlservidor  ='https://www.cotiseguros.com.ve/';
$(document).ready(function () 
{
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: urlservidor+`listbirthdaydate/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'fecha_nacimiento' },
            { data: 'numerotelefono' }
        ]
    });
    //
});









