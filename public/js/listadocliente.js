let arreglo =[];
$(document).ready(function () 
{
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarclientes/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'cedula' },
            { data: 'numerotelefono' },
            { data: 'email' },
            //{ data: 'estado' },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                return  `${row.estado ==1 ? 'Activo':''}`;
              }
            },
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
                    class='icon voyager-wallet btn-doc p-3' 
                    title='Adminstracion cliente'
                    onclick="adminstracionclientes(${row.id})" 
                  ></span>`;
              }
            },
        ]
    });
});

function verperfil(id)
{
  window.open(`perfilcliente/${id}`);
}
function adminstracionclientes(id)
{
  //window.open(`adminstracionclientes/${id}`);
  window.location.href=`adminstracionclientes/${id}`;
}
function relizapagos(id)
{
  
}


