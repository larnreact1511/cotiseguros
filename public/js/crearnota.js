//let url  ="https://dev.cotiseguros.com.ve/";
//let url  ='http://127.0.0.1:8000/';
let url  ='https://www.cotiseguros.com.ve/';
$(document).ready(function () 
{
    $( "#guardarnota" ).on( "click", function() 
    {
        crearnota()
    });
    $( "#vernotasanteriores" ).on( "click", function() 
    {   
        //
        idquote=$("#idquote").val();
        fetch(url+"api/vernotasanteriores/"+idquote, 
        {
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
                "Content-type": "application/json; charset=UTF-8"
            },
            method: "POST",
            body: JSON.stringify(
            {
                fecha_notificiacion: $("#fecha_notificiacion").val(),
                notificacion: $("#notificacion").val(),
                idusuario: $("#idusuario").val(),
                idquote:idquote
    
            }),
        })
        .then(r => r.json())
        .then(r => 
        {
            if (r.data)
            {
                notas =r.data;
                $("#divlista").html('');
                notas.map((n,inde) =>
                {
                    //$("#divlista").append(  ` Fecha del nota : ${n.fecha_notificiacion} ->   ${n.notificacion}`);
                    $("#divlista").append(  `<button  type="button"  class="list-group-item list-group-item-action"> Fecha del nota : ${n.fecha_notificiacion} ->   ${n.notificacion} (${n.name}) </button>`);
                });
            }
        }).finally(()=>
        {
            
        });
        //
    } );
});

function crearnota()
{
    let fecha_notificiacion=$("#fecha_notificiacion").val();
    let notificacion=$("#notificacion").val();
    let idusuario=$("#idusuario").val();
    let idquote=$("#idquote").val();
    if ((fecha_notificiacion=='') || (notificacion =='') || (idusuario=='') || (idquote=='') )
    {
        Swal.fire('Complete los datos para ingresar la nota');
    }  
    else
    {   
        
        fetch(url+"api/crearnotacliente", 
        {
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
                "Content-type": "application/json; charset=UTF-8"
            },
            method: "POST",
            body: JSON.stringify(
            {
                fecha_notificiacion: $("#fecha_notificiacion").val(),
                notificacion: $("#notificacion").val(),
                idusuario: $("#idusuario").val(),
                idquote:idquote
    
            }),
        })
        .then(r => r.json())
        .then(r => 
        {
            if (r.result)
            {
                Swal.fire({
                    title: r.mjs,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
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
                    title: 'hubo un problema con el servidor, intente de nuevo',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                }).then((result) => 
                {
                    if (result.isConfirmed) 
                    {
                        location.reload();
                    }
                });
            }
        }).finally(()=>
        {
            
        });
    }
    
}


