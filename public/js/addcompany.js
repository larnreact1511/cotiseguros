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
function editarempresa()
{
    let idempresa =$("#listadodeempresas").val();
    if (idempresa > 0)
    {
        mostrarcarga()
        $.ajax({
            method: "GET",
            url: 'info-empresa/'+idempresa,
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
                        let data = jsondata['data'];
                        console.log(data);
                        $('#idempresa').val(data[0]['id']);
                        $('#companyname').val(data[0]['companyname']);
                        $('#rifcompany').val(data[0]['rifcompany']);
                        $('#adresscompany').val(data[0]['adresscompany']);
                        $('#notecompany').val(data[0]['notecompany']);
                        ocultarcarga();
                    }
                    else
                        ocultarcarga();
               }
               else
                ocultarcarga();  
            },
            error: function (request, status, error) {
                ocultarcarga();
            }
        });
    }
    else
    {
        
        $('#idempresa').val(0);
        $('#companyname').val('');
        $('#rifcompany').val('');
        $('#adresscompany').val('');
        $('#notecompany').val('');
    }
    

}