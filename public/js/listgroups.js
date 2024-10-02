let arreglo =[];
let clientesborrar=[];
$(document).ready(function () 
{
  let idcompany =$("#idcompany").val();
  let urlget ='list-group/';
  
  $('#tablecompany').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        //ajax: `../list-group/`,
        'ajax': {
            'url':'../list-group/',
            'data': function(data) {
                let idcompany = $('#idcompany').val();
                data.idcompany = idcompany;
            }
        },
        columns: [
            { data: 'id' },
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
            { data: 'company' },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                arreglo[row.id] =row.memberquote;
                return  `
                <a href="#" style ="text-decoration: none;">
                  <span 
                    class='icon voyager-x btn-doc p-3' 
                    title='Eliminar cliente'
                    onclick="removefromthecollective(${row.idusuario})" 
                  ></span>
                </a>
                <a href="#" style ="text-decoration: none;">
                  <span 
                    class='icon voyager-wallet btn-doc p-3' 
                    title='Adminstracion cliente'
                    onclick="adminstracionclientes(${row.id})" 
                  ></span>
                </a>
                
                <a href="#" style ="text-decoration: none;">
                  <span 
                    class='icon voyager-trash btn-doc p-3' 
                    title='Eliminar cliente'
                    onclick="eliminarcliente(${row.id})" 
                  ></span>
                </a>
                <input 
                class="form-check-input" 
                type="checkbox" 
                name="cliente_${row.id}" 
                id="cliente_${row.id}" 
                onclick="agregareliminar(${row.id})">
                `;
              }
            },
        ]
    });
    ocultarcarga()
});

function agregareliminar(id)
{
  let checkBox = document.getElementById("cliente_"+id);
  if (checkBox.checked == true){
    clientesborrar.push(id);
    
  } else {
    clientesborrar = clientesborrar.filter(idborrar => idborrar != id);
    
  }

}
function removefromthecollective(id)
{
  window.location.href=`./removefromthecollective/${id}`;
}
function deletselct()
{
  mostrarcarga()
    fetch("deletselct", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            data: clientesborrar,

        }),
    })
    .then(r => r.json())
    .then(r => 
    {
      location.reload()
        //ocultarcarga()
    }).finally(()=>
    {
        //ocultarcarga()
    });
}
function verperfil(id)
{
  window.open(`perfilcliente/${id}`);
}
function adminstracionclientes(id)
{
  window.location.href=`../adminstracionclientes/${id}`;
}
function relizapagos(id)
{
  
}
function mostrarcarga()
{
    $("#carga").css('display','block');
    $("#divprincipal").css('display','none');
}
function ocultarcarga()
{
    $("#carga").css('display','none');
    $("#divprincipal").css('display','block');
}
function eliminarcliente(id)
{
  
  mostrarcarga()
  fetch("eliminarclietne/"+id)
    .then(response => response.json())
    .then( response => {
      
      location.reload()
    });
  
}


