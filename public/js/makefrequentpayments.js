
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
    fetch(urlservidor+"api/consultar-pagos-empresas", 
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
        $("#tablecontenidoformuariopago3").html('');
        if (r.frecuencias)
        {
            Swal.fire('Existe fechas de pago generadas para esta póliza');
            
            let fre=r.data;   
            console.log(fre); 
            fre.map((f,index) =>
            {
                if (f.montoestimado >0)
                {
                    $("#tablecontenidoformuariopago3").append(`
                        <tr>
                            <th>
                            ${ f.estadodepago ==1 ?'' : `<input type="checkbox" name="cbox[]" value="${index}">` }
                            </th>
                            <th>
                                <input type="hidden" name="frequencyofpayments[]" value="${f.id}">
                                <label> Fecha Pago</label>
                                <input class="form-check-input" readonly  
                                    type="date" name="fechainicio[]" id="" value="${f.fechainicio}">
                            </th>
                            <th>
                                <label> Fecha Pago</label>
                                <input class="form-check-input" readonly  
                                    type="date" name="fechafin[]" id="" value="${f.fechafin}">
                            </th>
                            <th>
                                <label> Monto</label>
                                <input class="form-check-input"  
                                    type="numeric" name="monto[]" id="" value="${f.estadodepago ==1 ? f.montopago :f.montoestimado}" size="10">
                            </th>
                            <th>
                                ${f.estadodepago ==1 ? inputanularpago(f.id,f.photo_payment ) :inputsubirpago(f.estadodepago )} 
                                
                            </th>
                            </th>
                        </tr>
                        `);
                }
                
            });
            $("#divbtnguardarpagos2").css('display','block');
        }
        else
            Swal.fire('No existe fechas de pago generadas para esta póliza');
        
    }).finally(()=>
    {
        ocultarcarga()
    });
  
}

function inputsubirpago(estadodepago)
{
    html =`<input 
        ${ estadodepago ==1 ?'' : `disabeld` }
        type="file" 
        class="custom-file-input" 
        name="photo_payment[]" 
        id="photo_payment"
        accept="png,jpeg,pdf" 
    >`;
    return html;
}
function inputanularpago(id,photo_payment)
{
    html ='';
    html =`<input 
    class="form-check-input" 
    type="radio" 
    name="btneliminarfrecuecia" 
    id="btneliminarfrecuecia" 
    onclick="eliminarfrecuecia(${id})"
    >

    Anular pago
    
    <a href="${photo_payment}" target="_blank">
    ver img
    </a>
    
    `;
    return html;
}
$("#guardarpagpendiente").on("click",function()
    {
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idquotefp" readonly name="idquotefp" class="form-control" value ="0"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idadminfp" readonly name="idadminfp" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="id_insurancepoliciesfp" readonly name="id_insurancepoliciesfp" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idclientefp" readonly name="idclientefp" class="form-control" value ="${$("#idcliente").val()}"/>`);
        let formulario = document.getElementById('realizarpagofrecuencia');
        formulario.submit();
    });