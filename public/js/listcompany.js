
$(document).ready(function () 
{
    $('#tablecompany').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `getcompanys`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'id' },
            { data: 'companyname' },
            { data: 'rifcompany' },
            { data: 'adresscompany' },
            { data: 'notecompany' },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                return  `<a href="colectivos-asegurados" style ="text-decoration: none;">
                    <span 
                        class='voyager-list btn-doc p-4' 
                        title='Asegurados'
                        onclick="" 
                    ></span>
                </a>
                <a href="colectivos-polizas/${row.id}" style ="text-decoration: none;">
                    <span 
                        class='voyager-double-right btn-doc p-4' 
                        title='Polizas colectivos'
                        onclick="" 
                    ></span>
                </a>
                <a href="colectivos-frecuencias-pagos/${row.id}" style ="text-decoration: none;">
                    <span 
                        class='voyager-activity btn-doc p-4' 
                        title='Frecuencia de pagos'
                        onclick="" 
                    ></span>
                </a>
                <a href="realizar-pagos-frecuentes/${row.id}" style ="text-decoration: none;">
                    <span 
                        class='voyager-bar-chart btn-doc p-4' 
                        title='realizar pagos frecuentes'
                        onclick="" 
                    ></span>
                </a>
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
  //window.open(`adminstracionclientes/${id}`);
  window.location.href=`adminstracionclientes/${id}`;
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


