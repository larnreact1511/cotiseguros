let arreglo =[];
$(document).ready(function () 
{
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarcontactos/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'id' },
            { data: 'seguro' },
            { data: 'servicio' },
            { data: 'whatsap' },
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
                      onclick="eliminarcontacto(${row.id})" 
                    ></span>
                    <span 
                      class='icon voyager-wallet btn-doc p-3' 
                      title='Editar Contacto'
                      onclick="editarcontacto(${row.id},'${row.seguro}','${row.servicio}','${row.whatsap}','${row.llamada}','${row.idseguro}')" 
                    ></span>`;
                }
              },
        ]
    });
    //
});
function guardarcontacto()
{
    
    if ($("#conta_idseguro").val()==0)
    {
        Swal.fire('Ingrese un seguro');
    }
    if ($("#conta_servicio").val()=='')
    {
        Swal.fire('Ingrese nombre servicio ');
    }
    if ($("#conta_nrowhat").val()=='')
    {
        Swal.fire('Ingrese nro whatsapp ');
    }
    if ($("#conta_nrocall").val()=='')
    {
        Swal.fire('Ingrese nro llamada ');
    }
    else
    {
        let formulario = document.getElementById('formguardarcontacto');
        formulario.submit();
    }
}

function eliminarcontacto(id)
{
    
}
function editarcontacto(id,seguro,servicio,whatsap,llamada,idseguro)
{
    $("#conta_id").val(id)
    $("#conta_servicio").val(servicio)
    $("#conta_idseguro").val(idseguro)
    $("#conta_nrowhat").val(whatsap)
    $("#conta_nrocall").val(llamada)
    
}




