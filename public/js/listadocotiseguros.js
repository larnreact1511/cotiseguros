let arreglo =[];
$(document).ready(function () 
{
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarpersonal/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'cedula' },
            { data: 'rif' },
            { data: 'whatssap' },
            { data: 'llamada' },
            {
                orderable: false,
                data: "null",
                className: "center",
                defaultContent:'',
                render: function(data, type, row, meta) 
                {
                  arreglo[row.id] =row.memberquote;
                  return  `
                    <span 
                      class='icon voyager-trash btn-doc p-3' 
                      title='Eliminar Contacto'
                      onclick="eliminarpersonal(${row.id})" 
                    ></span>
                    <span 
                      class='icon voyager-wallet btn-doc p-3' 
                      title='Editar Contacto'
                      onclick="editarcontacto(${row.id},'${row.nombre}','${row.cedula}','${row.rif}','${row.whatssap}','${row.llamada}')" 
                    ></span>`;
                }
              },
        ]
    });
    //
});
function guardarcontacto()
{
    
    if ($("#nombre").val()==0)
    {
        Swal.fire('Ingrese un nombre');
    }
    if ($("#cedula").val()=='')
    {
        Swal.fire('Ingrese nombre cedula ');
    }
    if ($("#rif").val()=='')
    {
        Swal.fire('Ingrese nro rif ');
    }
    if ($("#whatssap").val()=='')
    {
        Swal.fire('Ingrese nro whatssap ');
    }
    if ($("#llamada").val()=='')
    {
        Swal.fire('Ingrese nro llamada ');
    }
    else
    {
        let formulario = document.getElementById('formguardarcontacto');
        formulario.submit();
    }
}
//let urlservidor ='http://127.0.0.1:8000/';
let urlservidor  ='https://dev.cotiseguros.com.ve//';
//let urlservidor  ='https://www.cotiseguros.com.ve/';
function eliminarpersonal(id)
{
    fetch(urlservidor+"eliminarpersonal/"+id)
    .then(response => response.json())
    .then(
       location.reload()
    );
}
function editarcontacto(id,nombre,cedula,rif,whatssap,llamada)
{
    $("#cotiseguros_id").val(id)
    $("#nombre").val(nombre)
    $("#cedula").val(cedula)
    $("#rif").val(rif)
    $("#whatssap").val(whatssap)
    $("#llamada").val(llamada)
    
}




