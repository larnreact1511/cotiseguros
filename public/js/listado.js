let arreglo =[];
$(document).ready(function () 
{
   let example=  $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        //ajax: `listartabla/`,
        'ajax': {
            'url':'listartabla',
            'data': function(data) {
                let buscar_inicio = $('#buscar_inicio').val();
                let buscar_fin = $('#buscar_fin').val();
                data.buscarFechaInicio = buscar_inicio;
                data.buscarFechaFin = buscar_fin;
            }
        },
        language:
              {
          "url": "json/Spanish.json"
        },
        columns: [
            //{ data: 'id' },
            { data: 'name' },
           
            { data: 'phone' },
            { data: 'email' },
            { data: 'coverage' },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                return  `${row.fecha}`;
              }
            },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                let st ='';
                if (row.state===3)
                  st =' Aceptada';
                else if (row.state <=3)
                  st =' En Solicitud';
                return  `${st}`;
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
                let hacerusuario='';
                let agregarquiote='';
                if (row.esusuario==0)
                {
                  hacerusuario =`<span 
                  class='icon voyager-check-circle btn-client p-3 m-2' 
                  title='Hacer cliente'
                  onclick="cliente(${row.id},'${row.name}')" 
                  ></span>`; 
                }
                else
                {
                   if (  (row.aceptada >0) )
                   {
                     
                   }
                   else
                   {
                      hacerusuario +=`<span 
                      class='icon voyager-plus btn-client p-3 m-2' 
                      title='Agregar al cliente ${row.email}'
                      onclick="agregarcliente(${row.id},'${row.esusuario}')" 
                      ></span> <span 
                      class='icon voyager-pen  p-3 m-2 ' 
                      title='Cambair correo ${row.email}'
                      onclick="cambiarcorreo(${row.id},'${row.name}')" 
                      ></span>`;
                   }
                }
                return  ` 
                  <span 
                    class='icon voyager-people btn-rest p-3 m-2' 
                    title='beneficiarios'
                    onclick="mostrarbeneficiarios(${row.id})" 
                  ></span> 
                  <span 
                    class='icon voyager-trash btn-delete p-3 m-2' 
                    title='borrar'
                    onclick="eliminarcotiazacion(${row.id})" 
                  ></span><br>
                  ${hacerusuario}
                  <span 
                    class='icon voyager-eye btn-ver p-3 m-2' 
                    title='Ver'
                    onclick="ver('${row.phone}',${row.id})" 
                  ></span><br>
                  <span 
                    class='icon voyager-bookmark btn-note p-3 m-2' 
                    title='Agregar nota'
                    onclick="nota(${row.id})" 
                  ></span> `;
              }
            },
        ]
    });
    $( ".closemodal" ).on( "click", function() 
    {
      let modal = document.getElementById("myModal");
      modal.style.display = "none";

    });
    $( "#modificardatosquote" ).on( "click", function() 
    {
      if ( ( $("#correonuevo").val() !='') && ( $("#numeronuevo").val() !='') )
      {
        //
        //let url  ="https://dev.cotiseguros.com.ve/";
        let url  ='http://127.0.0.1:8000/';
        //let url  ='https://www.cotiseguros.com.ve/';
        $("#carga").css('display','block');
        $("#divtabla").css('display','none');
        let modal = document.getElementById("myModal");
        modal.style.display = "none";
        fetch(url+"api/modificardatosquote", 
        {
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
                "Content-type": "application/json; charset=UTF-8"
            },
            method: "POST",
            body: JSON.stringify(
            {
                correonuevo: $("#correonuevo").val(),
                numeronuevo: $("#numeronuevo").val(),
                idquotemodificar: $("#idquotemodificar").val()
                
            }),
        })
        .then(r => r.json())
        .then(r => 
        {
            if (r.result)
            {
              
              location.reload()
            }
            else
            {
              location.reload()     
            }
        }).finally(()=>
        {
            
        });
        //
      }
      else
      {
        $("#mjserrormodicicar").html('Debe completar los datos, para realizar la modificación');
      }

    });
    $("#carga").css('display','none');

    $("#btnsearchbydate " ).on( "click", function() {
        example.draw();
    });
    $("#btnclear " ).on( "click", function() {
      $("#buscar_inicio").val('');
      $("#buscar_fin").val('');
      example.draw();
  });
   
});

function mostrarbeneficiarios(id)
{
    
    let cadena ='';
    arreglo[id].forEach(function(a) 
    {
       cadena +=' '+a.status+',  '+a.date+'  años <br>';
    })
    Swal.fire({
        title: '<strong> Beneficiarios </strong>',
        icon: 'info',
        html:cadena,
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText:'<i class="fa fa-thumbs-up"></i> OK!',
        confirmButtonAriaLabel: 'OK!',
        cancelButtonText:'<i class="fa fa-thumbs-down"></i>',
        cancelButtonAriaLabel: 'Thumbs down'
      })
}
function eliminarcotiazacion(id)
{
    //console.log('elimina',id)
    Swal.fire({
        title: '¿Está seguro de eliminar esta cotización?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) 
        {
          //Swal.fire('Saved!', '', 'success')
          fetch(`/api/deletecotizacion/${id}`)
          .then((response) => response.json())
          .then((data) => 
          {
                if(data)
                {
                    Swal.fire({
                        title: 'Eliminacion exitosa',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Si',
                      }).then((result) => 
                      {
                        if (result.isConfirmed) 
                        {
                            location.reload();
                        }
                      });
                } 
                else 
                {
                    Swal.fire({
                        title: 'No se pudo eliminar!',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'Si',
                      }).then((result) => 
                      {
                        if (result.isConfirmed) 
                        {
                            location.reload();
                        }
                      });
                }
          });
        } 
      })
}

function modalcliente() 
{
    $("#modalcreatecliente").modal('show');
}
function cliente(id,name)
{
  Swal.fire({
    title: '¿Desea hacer cliente a '+name+' ?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Si',

  }).then((result) => 
  {

    if (result.isConfirmed) 
    {
        //
        fetch(`/api/createcliente/${id}`)
        .then((response) => response.json())
        .then((data) => 
        {
            //
            if(data)
            {
                
                  Swal.fire({
                    title: data['mjs'],
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'ok',
                  }).then((result) => 
                  {
                    if (result.isConfirmed) 
                    {
                      location.reload();
                    }
                  });
            } 
            //
        });
        //
    } 
  });
}
function ver(phone,id) 
{
  window.open(`cotizador/salud/cotizacionpersonaladmin/${phone}/${id}`  , '_blank');
}
function nota(id) 
{
  window.open(`nota/${id}`  , '_blank');
}
function agregarcliente(idquote, idusuario)
{
  //console.log('agregar', idquote, idusuario)
  Swal.fire({
    title: '¿Desea agregar esta cotización al cliente ?',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Si',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) 
    {
      //Swal.fire('Saved!', '', 'success')
      fetch(`/api/agregarcuotacliente/${idquote}/${idusuario}`)
      .then((response) => response.json())
      .then((data) => 
      {
        //
        if(data)
        {
          Swal.fire({
            title: data['mjs'],
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'ok',
          }).then((result) => 
          {
            if (result.isConfirmed) 
            {
              location.reload();
            }
          });
        } 
        //
      });
    } 
  })
  //
}
function cambiarcorreo(id,name)
{
  let  modal = document.getElementById("myModal");
  modal.style.display = "block";
  $("#idquotemodificar").val(id);
  $("#nombremodificar").val(name);
  $("#mjserrormodicicar").html('');
}

