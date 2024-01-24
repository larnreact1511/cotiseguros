let arreglo =[];
$(document).ready(function () 
{
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarpagospendientes/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'numerotelefono' },
            { data: 'fechainicio' }
            
        ]
    });
});




