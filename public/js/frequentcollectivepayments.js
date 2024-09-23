
$(document).ready(function () 
{
    ocultarcarga()
});
function ocultarcarga()
{
    $("#carga").css('display','none');
    $("#divprincipal").css('display','block');
}
function addcompanybtn()
{
    mostrarcarga()
    $.ajax({
        method: "POST",
        url: 'agregar-empresa',
        data:  new FormData(document.getElementById("form-add-company")),
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){},
        success: function(data){
           if (data)
            { 
                var jsondata = JSON.parse(data);
                if (jsondata['result']=='success')
                {
                    ocultarcarga();
                    Swal.fire({ 
                        text: jsondata['message'], 
                        icon: "success", 
                        buttonsStyling: !1, 
                        confirmButtonText: "Ok", 
                        customClass: { confirmButton: "btn btn-primary" } }).then(
                        function (e) {
                            window.location ='agregar-empresa';
                        }
                    );
                }
            else
                enablebutton(jsondata['message']);
           }
           else
            enablebutton('No se pudo agregar la empresa.');    
        },
        error: function (request, status, error) {
           enablebutton(request.responseText);
        }
    });
}
function mostrarcarga()
{
    $("#carga").css('display','block');
    $("#divprincipal").css('display','none');
}
function enablebutton(msj){
    ocultarcarga();
    if (msj !='')
    {
        Swal.fire({ 
            text: msj, 
            icon: "warning", 
            buttonsStyling: !1, 
            confirmButtonText: "Ok,", 
            customClass: { confirmButton: "btn btn-primary" } }).then(
            function (e) { }
        );
        
    }   
}

function buscarfrecuencias2(id,monto,id_insurancepolicies) // para realizar pagos
{
    
    mostrarcarga();
    localStorage.setItem("idcotizacionpagar",id);console.log('click');
    fetch(urlservidor+"api/pagospolizas-colectivos", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            idcovertura: id,
            monto: monto,
            idpoliza: id_insurancepolicies,
            
        }),
    })
    .then(r => r.json())
    .then(r => 
    {
        if (r.frecuencias)
        {
            Swal.fire('Tiene frecuencias generada la empresa');
            $("#div_frecuencias").css('display','none'); 
            $("#divbtnguardarpagos").css('display','block'); 
            $("#tablacontenidoformuariopago2").empty('')
            //
            let fre=r.data;    
            fre.map((f,index) =>
            {
               
                $("#tablacontenidoformuariopago2").append(`
                <tr>
                    <th>
                        <label> Fecha inicio</label>
                        <input class="form-check-input" type="date" name="fechainici[]" id="fechainici_${f.id}" value="${f.fechainicio}" >
                    </th>
                    <th>
                        <label> Fecha fin</label>
                        <input class="form-check-input" type="date" name="fechafin[]" id="fechafin_${f.id}" value="${f.fechafin}">
                    </th>
                    <th>
                        <label> Monto</label>
                        <input class="form-check-input" type="numeric" name="monto[]" id="" value="${f.montoestimado}" size="10">
                    </th>
                    <th>
                        
                </tr>
                `);
            });
            //
        }
        else
        {
            $("#div_frecuencias").css('display','block'); 
            $("#divbtnguardarpagos").css('display','none'); 
            $("#tablacontenidoformuariopago2").empty('');
        }
        
    }).finally(()=>
    {
        ocultarcarga()
    });
  
}
$( "#calcularpagos" ).on( "click", function() 
{
    let frecuencia = localStorage.getItem("frecuencia");
    let idcotizacionpagar = localStorage.getItem("idcotizacionpagar");
    let montocotizacionpagar = localStorage.getItem("montocotizacionpagar");
    let id_insurancepolicies = localStorage.getItem("id_insurancepolicies");
    let fechainicio =$("#fechainicio").val();
    if (  (localStorage.getItem("frecuencia") > 0)  )
    {
        //
        mostrarcarga()
        fetch(urlservidor+"api/collective-quotas", 
        {
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
                "Content-type": "application/json; charset=UTF-8"
            },
            method: "POST",
            body: JSON.stringify(
            {
                frecuencia: frecuencia,
                idcotizacionpagar: idcotizacionpagar,
                montocotizacionpagar: montocotizacionpagar,
                fechainicio: fechainicio,
                id_insurancepolicies:id_insurancepolicies
                
            }),
        })
        .then(r => r.json())
        .then(r => 
        {
            if (r.result)
            {
                let fre=r.data;
                $("#tablacontenidoformuariopago2").html('');
                $("#idquote").val(r.idcotizacionpagar);
                $("#id_insurancepolicies").val(r.id_insurancepolicies);
                fre.map((f,index) =>
                {
                
                $("#tablacontenidoformuariopago2").append(`
                <tr>
                    <th>
                        <label> Fecha inicio</label>
                        <input class="form-check-input" type="date" name="fechainici[]" id="" value="${f.fechaini}">
                    </th>
                    <th>
                        <label> Fecha fin</label>
                        <input class="form-check-input" type="date" name="fechafin[]" id="" value="${f.fechafin}">
                    </th>
                    <th>
                        <label> Monto</label>
                        <input class="form-check-input" type="numeric" name="monto[]" id="" value="" size="10">
                    </th>
                </tr>
                    `);
                });
                $("#divbtnguardarpagos").css('display','block'); 
                $("#guardarpagos").css('display','block');    
            }
        }).finally(()=>
        {
            ocultarcarga()
        });
        //
    }
    else
    {
        Swal.fire('Debe escoger una cotización y frecuencia de pago de la misma');
    }
});

$("#guardarpagos").on("click",function()
{
    $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="idquote" readonly name="idquote" class="form-control" value ="0"/>`);
    $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="${$("#idadmin").val()}"/>`);
    $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="id_insurancepolicies" readonly name="id_insurancepolicies" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
    //let formulario = document.getElementById('formulariospagorealizar2');
    //formulario.submit();
    $.ajax({
        method: "POST",
        url: './savecollectivequotas',
        data:  new FormData(document.getElementById("formulariospagorealizar2")),
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){},
        success: function(data){
            if (data)
            { 
                var jsondata = JSON.parse(data);
                if (jsondata['result']=='success')
                {
                    ocultarcarga();
                    Swal.fire({ 
                        text: jsondata['message'], 
                        icon: "success", 
                        buttonsStyling: !1, 
                        confirmButtonText: "Ok", 
                        customClass: { confirmButton: "btn btn-primary" } }).then(
                        function (e) {
                            
                        }
                    );
                    window.location ='lista-empresas';
                }
            else
                enablebutton(jsondata['message']);
           }
           else
            enablebutton('No se pudo agregar la empresa.');    
        },
        error: function (request, status, error) {
           enablebutton(request.responseText);
        }
    });
});