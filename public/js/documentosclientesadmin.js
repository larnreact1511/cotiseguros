

let totalpagado=0;
let resto=0;
$( document ).ready(function() 
{
  localStorage.setItem("frecuencia",0);
  localStorage.setItem("idcotizacionpagar",0);
  localStorage.setItem("montocotizacionpagar",0);
  localStorage.setItem("id_insurancepolicies",0);


  $( "#btnpagos" ).on( "click", function() 
  {
      let todobien=true;
      if ( $("#idquote2").val() ==0)
      {
        Swal.fire('Para agregar un pago escoja una cotización');
        todobien =false;
      }
      if ( $("#montopago").val() ==0)
      {
        Swal.fire('Para agregar un pago ingrese un monto');
        todobien =false;
      }
      if ( $("#fechapago").val() ==0)
      {
        Swal.fire('Para agregar un pago escoja una fecha de pago');
        todobien =false;
      }
      if (   parseFloat($("#montopago").val())  > parseFloat(resto) )
      {
        Swal.fire('El monto ingresado supera el saldo restante');
        todobien =false;
      }
        
      if (todobien)
        document.getElementById("formulariopagos").submit();

  });
  $( "#btneditarpago" ).on( "click", function() 
  {
      let todobien=true;
      if ( $("#pagoeditar").val() ==0)
      {
        Swal.fire('Lo sentimos el sistema no identifica que pago desea modificar');
        todobien =false;
      }
      if ( $("#montopago").val() ==0)
      {
        Swal.fire('Para agregar un pago ingrese un monto');
        todobien =false;
      }
      if ( $("#fechapago").val() ==0)
      {
        Swal.fire('Para agregar un pago escoja una fecha de pago');
        todobien =false;
      }
      if (   parseFloat($("#montopago").val())  > parseFloat(resto) )
      {
        Swal.fire('El monto ingresado supera el saldo restante');
        todobien =false;
      }
        
      if (todobien)
        document.getElementById("formulariopagos").submit();

  });
  $( "#calcularpagos" ).on( "click", function() 
  {
    let frecuencia = localStorage.getItem("frecuencia");
    let idcotizacionpagar = localStorage.getItem("idcotizacionpagar");
    let montocotizacionpagar = localStorage.getItem("montocotizacionpagar");
    let id_insurancepolicies = localStorage.getItem("id_insurancepolicies");
    let fechainicio =$("#fechainicio").val()
    if (  (localStorage.getItem("frecuencia") > 0) && (localStorage.getItem("idcotizacionpagar") >0 ) && (localStorage.getItem("montocotizacionpagar") > 0 ) && (localStorage.getItem("id_insurancepolicies") > 0 ) )
    {
      //
      let url  ="https://dev.cotiseguros.com.ve/";
      //let url  ='http://127.0.0.1:8000/';
      fetch(url+"api/calcularcuotas", 
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
            $("#contenidoformuariopago").html('');
            $("#idquote").val(r.idcotizacionpagar);
            $("#id_insurancepolicies").val(r.id_insurancepolicies);
            fre.map((f,index) =>
            {
              
              $("#contenidoformuariopago").append(`
                <div class="col-md-2">
                      <div class="form-check">
                      <label> Fecha inicio</label>
                      <input class="form-check-input"  
                          type="date" name="fechainici[]" id="" value="${f.fechaini}">
                      </div>
                </div> 
                <div class="col-md-2">
                      <div class="form-check">
                      <label> Fecha fin</label>
                      <input class="form-check-input"  
                          type="date" name="fechafin[]" id="" value="${f.fechafin}">
                      </div>
                </div>
                <div class="col-md-2">
                      <div class="form-check">
                      <label> Monto</label>
                      <input class="form-check-input"  
                          type="numeric" name="monto[]" id="" value="" size="10">
                      </div>
                </div>`);
            });
            //$("#formulariospagorealizar").append(``);  
       
          }
          else
          {
              
          }
      }).finally(()=>
      {
          
      });
      //
    }
    else
    {
      Swal.fire('Debe escoger una cotización y frecuencia de pago de la misma');
    }
  });
  
});
function verfoto(img)
{
  //let url ="https://dev.cotiseguros.com.ve/";
  //let url ='http://127.0.0.1:8000/';
  let url  ='https://www.cotiseguros.com.ve/';
  Swal.fire({
    imageUrl: url+img,
    imageHeight: 400,
    imageAlt: 'image'
  })
  
}
function editarpago(id,fecha,monto)
{
  
  $("#montopago").val(monto);
  $("#fechapago").val(fecha);
  $("#pagoeditar").val(id);
  
  $("#btnpagos").css('display','none');
  $("#btneditarpago").css('display','block');
  $("#rcambio").css('display','block');
}
function cotizacion(id,monto,id_insurancepolicies)
{
  $("#idquote2").val(id);
  fetch(`/api/verpagos/${id}/${id_insurancepolicies}`)
  .then((response) => response.json())
  .then((r) => 
  {
    if (r.payments)
    {
      $("#divlistapagos").empty();
      $("#divlistapagos").append(  `<button type="button" class="list-group-item list-group-item-action active"> Pagos / Cuotas </button>`);
      pagos =r.payments;
      pagos.map((n,inde) =>
      {
          totalpagado += n.montopago;
          buton ='';
          if (n.photo_payment =='')
            buton =`<span    class='icon voyager-edit p-3'   title='editar pago'   onclick="editarpago(${n.id},'${n.fechapago}',${n.montopago})" ></span>`;
          else
            buton =`<span class='icon voyager-edit p-3'   title='editar pago'  onclick="editarpago(${n.id},'${n.fechapago}',${n.montopago})" ></span> 
            <span  class='icon voyager-eye' title='ver pago' onclick='verfoto("${n.photo_payment}")'></span> `;

          if (n.montopago)
          {
            $("#divlistapagos").append(`<button  
            type="button"  
            class="list-group-item list-group-item-action"> 
              Fecha Incio : ${n.fechainicio} , Fecha Fin : ${n.fechafin} monto pagado ${n.montopago} USD el ${n.fechapago}
              <span class='icon voyager-edit p-3' title='editar pago'  onclick="editarpago(${n.id},'${n.fechapago}',${n.montopago})" ></span> 
              <span  class='icon voyager-eye p-3' title='ver pago' onclick='verfoto("${n.photo_payment}")'></span>
              </button>`);
          }
          else
          {
            $("#divlistapagos").append(`<button  
            type="button"  
            class="list-group-item list-group-item-action"> 
              <input type="radio"  name="check" onclick="checkfrecuencia(${n.id},${n.montoestimado} )" >
              Fecha Incio : ${n.fechainicio} , Fecha Fin : ${n.fechafin} </button>`);
          }
          
      });
      resto = parseFloat(monto) - parseFloat(totalpagado) ;
      $("#divlistapagos").append(  `<button type="button" class="list-group-item list-group-item-action active"> Monto pagado de la cotización :  ${ new Intl.NumberFormat("de-DE").format(totalpagado) }  resta : ${ new Intl.NumberFormat("de-DE").format(resto) } </button>`);
    }
  });
  
}
function frecuencia(frecuencia) // frecuencia de pagar la cotizacion
{
  localStorage.setItem("frecuencia",frecuencia);
}
function cotiazacionfrecuencia(id,monto,id_insurancepolicies) // que cu
{
  localStorage.setItem("idcotizacionpagar",id);
  localStorage.setItem("montocotizacionpagar",monto);
  localStorage.setItem("id_insurancepolicies",id_insurancepolicies);
  
}
function agregarpago()
{
  $("#montopago").val('');
  $("#fechapago").val('');
  $("#pagoeditar").val(0);
  
  $("#btnpagos").css('display','block');
  $("#btneditarpago").css('display','none')
}

function checkfrecuencia(id,monto)
{
  $("#idfrecuenciapagar").val(id);
  if (monto > 0)
    $("#montopago").val(monto);
}