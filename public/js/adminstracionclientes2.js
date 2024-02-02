

let familiar = 
{
    status: "-1",
    gender: "-1",
    date: "-1",
    birthday: "-1",
    quote_id: "",
    day: "1",
    mounth: "-1",
    year: "-1",
    total: "",
    activo :0

};
let gender=[] ; gender[0] = {sex :"-1" }; gender[1] = {sex :"Femenino" }; gender[2] = {sex :"Masculino" };
let today = new Date();
let year = today.getFullYear();
let parentescoarray =[]; 
parentescoarray[0]="-1"; 
parentescoarray[1]="Yo"; 
parentescoarray[2]="Madre o Padre";
parentescoarray[3]="Otro (a)"; 
parentescoarray[4]="Cónyuge";
parentescoarray[5]="Hijo/a";
let  miembrosasegurados =[];
let  cm =0; // contador miembros
let ym =parseFloat(year)-parseFloat(99); // año menor
let ya = new Date().getFullYear(); // año actual
let datasiniestros =[];
let urlservidor ='http://127.0.0.1:8000/';
//let urlservidor  ='https://dev.cotiseguros.com.ve//';
//let urlservidor  ='https://www.cotiseguros.com.ve/';

let polizaieditar =0;
let diveliminar =document.getElementById("diveliminar");
$( document ).ready(function() 
{
    miembrosasegurados[cm]=familiar;
    
    addFamiliartablainicio()
    $("#tipopoliza").val(0);
    $("#tipopoliza2").val(0);
    $("#tipopoliza3").val(0);
    //
    $( "#calcularpagos" ).on( "click", function() 
    {
        let frecuencia = localStorage.getItem("frecuencia");
        let idcotizacionpagar = localStorage.getItem("idcotizacionpagar");
        let montocotizacionpagar = localStorage.getItem("montocotizacionpagar");
        let id_insurancepolicies = localStorage.getItem("id_insurancepolicies");
        let fechainicio =$("#fechainicio").val();
        if (  (localStorage.getItem("frecuencia") > 0) && (localStorage.getItem("idcotizacionpagar") >0 ) && (localStorage.getItem("montocotizacionpagar") > 0 ) && (localStorage.getItem("id_insurancepolicies") > 0 ) )
        {
            //
            mostrarcarga()
            fetch(urlservidor+"api/calcularcuotas", 
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
    //
    $("#guardarpagos").on("click",function()
    {
        $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="idquote" readonly name="idquote" class="form-control" value ="0"/>`);
        $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariospagorealizar2" ).append(`<input type="hidden" id="id_insurancepolicies" readonly name="id_insurancepolicies" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
        let formulario = document.getElementById('formulariospagorealizar2');
        formulario.submit();
    });
    $("#guardarpagpendiente").on("click",function()
    {
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idquotefp" readonly name="idquotefp" class="form-control" value ="0"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idadminfp" readonly name="idadminfp" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="id_insurancepoliciesfp" readonly name="id_insurancepoliciesfp" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
        $( "#realizarpagofrecuencia" ).append(`<input type="hidden" id="idclientefp" readonly name="idclientefp" class="form-control" value ="${$("#idcliente").val()}"/>`);
        let formulario = document.getElementById('realizarpagofrecuencia');
        formulario.submit();
    });
    $("#carga").css('display','none');
});

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
function generardatosparientes()
{
    datosparientes ='';
    console.log(miembrosasegurados);
    miembrosasegurados.map((f,indexFamiliar) =>
    {
        
        if ( indexFamiliar ==0)
            display ='none';
        else
            display ='block';
        if (f.activo==0)
        {
            console.log( f.activo, f.gender)
            datosparientes +=`
            <div class="row mt-3 p-3 text-center" id="${indexFamiliar}">
                <div class="col-2 col-md-2 my-3">
                    ${generahtmlparentesco(indexFamiliar,f.status)}
                </div>
                <div class="col-2 col-md-2 my-3">
                    ${generahtmlsexo(indexFamiliar,f.gender)}
                </div>
                <div class="col-2 col-md-1 my-3">
                    ${generaretornardia(indexFamiliar,f.day)}
                </div>
                <div class="col-2 col-md-1 my-3">
                    ${generameses(indexFamiliar,f.mounth)}
                </div>
                <div class="col-2 col-md-1 my-3">
                    ${generayy(indexFamiliar, f.year)}
                </div>
                <div class="col-2 col-md-3 my-3" 
                    style="display :${display}"
                >
                    ${generabotonelminar(indexFamiliar)}  
                </div>
            </div>`;    
        }
        
    });
    $("#cotizador").html(datosparientes)
}
function addFamiliartablainicio()
{
    $("#tablaparentescospolizas").empty();
    miembrosasegurados.map((f,indexFamiliar) =>
    {
        if ( indexFamiliar ==0)
            display ='none';
        else
            display ='block';
        if (f.activo==0)
        {
            $("#tablaparentescospolizas").append(`
            <tr>
                <td>
                    ${generahtmlparentesco(indexFamiliar,f.status)}
                </td>
                <td>
                    ${generahtmlsexo(indexFamiliar,f.gender)}
                </td>
                <td>
                    ${generaretornardia(indexFamiliar,f.day)}
                </td>
                <th>
                    ${generameses(indexFamiliar,f.mounth)}
                </th>
                <th>
                    ${generayy(indexFamiliar, f.year)}
                </th>
                <th>
                    <div  style="display :${display} ; border: 1px solid #fff;"  >
                    ${generabotonelminar(indexFamiliar)}  
                    </div>
                </th>
            </tr>
            `);
        }
        
    });
    
        
}
function addFamiliartabla()
{
    cm ++;
    miembrosasegurados[cm]={
        status: "-1",
        gender: "-1",
        date: "-1",
        birthday: "-1",
        quote_id: "",
        day: "1",
        mounth: "1",
        year: "-1",
        total: "",
        activo :0
    
    }
    $("#tablaparentescospolizas").empty();
    miembrosasegurados.map((f,indexFamiliar) =>
    {
        if ( indexFamiliar ==0)
            display ='none';
        else
            display ='block';
        if (f.activo==0)
        {
            $("#tablaparentescospolizas").append(`
            <tr>
                <td>
                    ${generahtmlparentesco(indexFamiliar,f.status)}
                </td>
                <td>
                    ${generahtmlsexo(indexFamiliar,f.gender)}
                </td>
                <td>
                    ${generaretornardia(indexFamiliar,f.day)}
                </td>
                <th>
                    ${generameses(indexFamiliar,f.mounth)}
                </th>
                <th>
                    ${generayy(indexFamiliar, f.year)}
                </th>
                <th>
                    <div  style="display :${display} ; border: 1px solid #fff;"  >
                    ${generabotonelminar(indexFamiliar)}  
                    </div>
                </th>
            </tr>
            `);
        }
        
    });
    
        
}
function addFamiliar()
{
    
    cm ++;
    miembrosasegurados[cm]={
        status: "-1",
        gender: "-1",
        date: "-1",
        birthday: "-1",
        quote_id: "",
        day: "1",
        mounth: "1",
        year: "-1",
        total: "",
        activo :0
    
    }
    $("#cotizador").html('');
    generardatosparientes();
}
function generahtmlparentesco(id,valor,disabeld= null)
{
    htmlparentesco ='';
    htmlparentesco +=`
        <label class="mon-regular text-secondary">
            Parentesco
        </label><br>
        <select 
            class="form-select shadow-none border-0 bg-light" 
            required="" 
            name ="status_${id}"
            id ="status_${id}"
            onChange ="changeStatus(${id})"
            ${ disabeld ? 'disabeld': ''}
        >
               ${opcionesparentesco(valor)}
        </select>`;
    return htmlparentesco;
}
function opcionesparentesco(valor)
{
    let htmlop ='';
    for ( var i =0; i <=5 ; i++)
    {
        selected ='';
        texto =parentescoarray[i];
        if (parentescoarray[i]==valor)
            selected ='selected';
        if (parentescoarray[i]=='-1')
            texto ='Seleccione';
        htmlop +=`<option ${selected} value="${parentescoarray[i]}">${texto} </option>`;
    }
    return htmlop;
}
function generahtmlsexo(id,valor)
{
    htmlsexo ='';
    htmlsexo +=`
    <label class="mon-regular text-secondary">
    Sexo
    </label><br>
    <select 
        name="gender_${id}"
        id="gender_${id}" 
        onChange="changeGender(${id})"
        class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
        aria-label="Default select example"
    >
        ${generahtmlgenero(valor)}        
    </select>`;
    return htmlsexo;
}
function generahtmlgenero(valor)
{
    htmlgenero ='';
    gender.map((g,indexGender) =>
    {
        selected ='';
        texto =g.sex;
        if (g.sex==valor)
            selected ='selected';
        if (g.sex=='-1')
            texto ='Seleccione';
        htmlgenero+=`<option value=${g.sex} ${selected} >${texto}</option>` ;
    });
    return htmlgenero;
}
function generaretornardia(id,valor)
{
    retornardia ='';
    retornardia +=`
    <label class="mon-regular text-secondary">
        Dia
    </label><br>
    <select 
        required
        name="day_${id}" 
        id="day_${id}" 
        onChange="changeday(${id}) "
        class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
        aria-label="Default select example"
    >
    ${generahtmlnumeros(valor)}
    </select>`;
    return retornardia;
}
function generahtmlnumeros(valor)
{
    htmlnumeros ='';
    for ( let i =1 ; i <=31; i ++)
    {
        texto =i;
        selected ='';
        if (i==valor)
            selected ='selected';
        htmlnumeros+=`<option ${selected} value="${i}" >${texto}</option>` ;
    }
    return htmlnumeros;
}
function generameses(id,valor)
{
    meses ='';
    meses +=`
    <label class="mon-regular text-secondary">
        Mes
    </label><br>
    <select 
        required
        name="mounth_${id}" 
        id="mounth_${id}" 
        onChange="changemounth(${id}) "
        class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
        aria-label="Default select example"
    >
    ${generaretornames(valor)}
    </select>`;
    return meses;
}
function generaretornames (valor)
{
    retornames ='';
    for ( let i =1 ; i <=12; i ++)
    {
        texto =i;
        selected ='';
        if (i==valor)
            selected ='selected';
      
        retornames+=`<option ${selected} value="${i}" >${texto}</option>` ;
    }
    return retornames;
}
function generayy(id,valor)
{
    yy ='';
    yy +=`
    <label class="mon-regular text-secondary">
        Año
    </label><br>
    <select 
        required
        name="birthday_${id}" 
        id="birthday_${id}" 
        onChange="changebirthday(${id}) "
        class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
        aria-label="Default select example"
    >
    ${generadyy(valor)}
    </select>`;
    return yy;
}
function generadyy(valor)
{
    let dyy ='';
    for ( var i =ya; i >= ym ; i--)
    {
        texto =i;
        selected ='';
        if (i==valor)
            selected ='selected';
        
        dyy +=`<option ${selected} value="${i}">${texto} </option>`;
    }
    return dyy;
}
function generabotonelminar(id)
{
    let botonelminar ='';
    botonelminar+=`
    <button 
        type="button" 
        onclick="removeFamiliar(${id})"  
        class="btn btn-primary mt-2">
        <span class="ms-3 mon-light"  >Eliminar familiar</span>
    </button>
    `;
    return botonelminar;
}
function removeFamiliar(id)
{
    miembrosasegurados[id].activo=1;
    $("#tablaparentescospolizas").empty();
    miembrosasegurados.map((f,indexFamiliar) =>
    {
        if ( indexFamiliar ==0)
            display ='none';
        else
            display ='block';
        if (f.activo==0)
        {
            $("#tablaparentescospolizas").append(`
            <tr>
                <td>
                    ${generahtmlparentesco(indexFamiliar,f.status)}
                </td>
                <td>
                    ${generahtmlsexo(indexFamiliar,f.gender)}
                </td>
                <td>
                    ${generaretornardia(indexFamiliar,f.day)}
                </td>
                <th>
                    ${generameses(indexFamiliar,f.mounth)}
                </th>
                <th>
                    ${generayy(indexFamiliar, f.year)}
                </th>
                <th>
                    <div  style="display :${display} ; border: 1px solid #fff;"  >
                    ${generabotonelminar(indexFamiliar)}  
                    </div>
                </th>
            </tr>
            `);
        }
        
    });

}
function changeStatus (id)
{
    let valor =$("#status_"+id).val();
    miembrosasegurados[id].status=valor;
}
function changeGender(id)
{
    let valor =$("#gender_"+id).val();
    miembrosasegurados[id].gender=valor; 
}
function changeday(id)
{
    let valor =$("#day_"+id).val();
    miembrosasegurados[id].day=valor; 
}
function changemounth(id)
{
    let valor =$("#mounth_"+id).val();
    miembrosasegurados[id].mounth=valor;  
}
function changebirthday(id)
{
    let valor =$("#birthday_"+id).val();
    miembrosasegurados[id].year=valor;  
    
}
function addocument()
{
    $( "#tablasalud" ).append(`<tr>
    <th>
    <label class="custom-file-label" for=""> Agrega documento   </label>
    <input 
        type="file" 
        class="custom-file-input" 
        name="documentossalud[]" 
        accept="pdf,png,jpg" 
    >
    </th>
    <th>
    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
    <input 
        type="text" 
        class="custom-file-input" 
        name="nombredocumentosalud[]" 
        required
    >
    </th>
    
</tr>`);
}
function addocument2()
{
    $( "#tablaautos" ).append(`<tr>
    <th>
    <label class="custom-file-label" for=""> Agrega documento   </label>
    <input 
            type="file" 
            class="custom-file-input" 
            name="documentosautos[]" 
            accept="pdf,png,jpg"  
            >
    </th>
    <th>
    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
    <input 
            type="text" 
            class="custom-file-input" 
            name="nombredocumentosautos[]" 
            required
        >
    </th>
</tr>`);
}
function addocument3()
{
    $( "#tablaempresa" ).append(`<tr>
    <th>
    <label class="custom-file-label" for=""> Agrega documento   </label>
    <input 
        type="file" 
        class="custom-file-input" 
        name="documentosempresa[]" 
        accept="pdf" >
    </th>
    <th>
    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
    <input 
            type="text" 
            class="custom-file-input" 
            name="nombredocumentosempresa[]" 
            required
        >
    </th>
</tr>`);
}
function addcoomentario()
{
    $( "#tablacomentarios" ).append(`<tr> 
    <th>
        <input 
            type="text" 
            class="form-control shadow-none border-0 bg-grey" 
            name="comentariosalud[]" 
            id="comentariosalud[]" value="" 
            placeholder="Comentario sobre la póliza">
    </th>
</tr>`);
}
function addcoomentario2()
{
    $( "#tablacomentariosautos" ).append(`<tr> 
    <th>
        <input 
            type="text" 
            class="form-control shadow-none border-0 bg-grey" 
            name="comentarioautos[]" 
            value="" 
            placeholder="Comentario sobre la póliza">
    </th>
</tr>`);
}
function addcoomentario3()
{
    $( "#tablacomentarioempresa" ).append(`<tr> 
    <th>
        <input 
            type="text" 
            class="form-control shadow-none border-0 bg-grey" 
            name="comentarioempresa[]" 
            value="" 
            placeholder="Comentario sobre la póliza">
    </th>
</tr>`);
}
function patologiasi()
{
    $( "#tablapatologiascelaradas" ).append(`<tr> 
    <th>
        <input 
            type="text" 
            class="form-control shadow-none border-0 bg-grey" 
            name="patologiacomentadas[]" 
            id="patologiacomentadas[]" value="" 
            placeholder="Patología comentada">
    </th>
</tr>`);
}
function patologiano()
{
    $( "#tablapatologiasnodeclaradas" ).append(`<tr> 
    <th>
        <input 
            type="text" 
            class="form-control shadow-none border-0 bg-grey" 
            name="patologiasnocomentadas2[]" 
            id="patologiasnocomentadas2[]" value="" 
            placeholder="Patología NO comentada">
    </th>
</tr>`);
} 
function addocument4()
{
    $( "#tabladocumentosclientes" ).append(`<tr>
    <tr>
        <th>
        <label class="custom-file-label" for=""> Agrega documento   </label>
        <input 
            type="file" 
            class="custom-file-input" 
            name="documentopersonal[]" 
            accept="pdf,png,jpg" >
        </th>
        <th>
        <label class="custom-file-label" for="">Nombre del documento  </label><br>    
        <input 
                type="text" 
                class="custom-file-input" 
                name="nombredocumentopersonal[]" 
                
            >
        </th>
    </tr>`);
}
function addocument5()
{
    $( "#tablasiniestroseditar" ).append(`<tr>
    <tr>
        <th>
        <label class="custom-file-label" for=""> Agrega documento   </label>
        <input 
            type="file" 
            class="custom-file-input" 
            name="documentossiniestro[]" 
            accept="pdf" >
        </th>
        <th>
        <label class="custom-file-label" for="">Nombre del documento  </label><br>    
        <input 
                type="text" 
                class="custom-file-input" 
                name="nombredocumentossiniestro[]" 
                required
            >
        </th>
    </tr>`);
}
function addocument6()
{
    $( "#tablasiniestros" ).append(`<tr>
    <tr>
                                    <th>
                                    <label class="custom-file-label" for=""> Agregar documento   </label>
                                    <input 
                                        type="file" 
                                        class="custom-file-input" 
                                        name="documentossiniestro[]" 
                                        accept="pdf" >
                                    </th>
                                    <th>
                                    <label class="custom-file-label" for="">Nombre del documento  </label><br>    
                                    <input 
                                            type="text" 
                                            class="custom-file-input" 
                                            name="nombredocumentossiniestro[]" 
                                            required
                                        >
                                    </th>
                                </tr>`);
}
function selectsalud()
{
   
    $("#divsalud").css('display','block');
    $("#tipopoliza").val(1)
    $("#divauto").css('display','none');
    $("#divempresas").css('display','none');
    oculartedicion()


}
function selectauto()
{
    $("#divsalud").css('display','none');
    $("#tipopoliza2").val(2)
    $("#divauto").css('display','block');
    $("#divempresas").css('display','none');
    oculartedicion()
    
}
function selectempresa()
{
    $("#divsalud").css('display','none');
    $("#tipopoliza3").val(3)
    $("#divauto").css('display','none');
    $("#divempresas").css('display','block');
    oculartedicion()
}
function oculartedicion()
{
    if (polizaieditar >0)
    {
        let  edipoliza =document.getElementById("edipoliza_"+polizaieditar);
        edipoliza.checked = false;
    }
    $("#divsaludeditar").css('display','none');
    $("#divsaludeditar").css('display','none');
    $("#divempresaseditar").css('display','none');
    $("#diveliminar").css('display','none');	
}
function guardarsalud()
{
    if ($("#tipopoliza").val()==0)
    {
        Swal.fire('Debe escoger un tipo de póliza para avanzar');
    }
    if ($("#mnontocobertura").val()==0)
    {
        Swal.fire('Debe escoger un monto de póliza para avanzar');
    }
    if ($("#segurocobertura").val()==0)
    {
        Swal.fire('Debe escoger un seguro de póliza para avanzar');
    }
    else
    {
        $( "#formulariosalud" ).append(`<input type="hidden" id="idmontosalud" readonly name="idmontosalud" class="form-control" value ="${$("#mnontocobertura").val()}"/>`);
        $( "#formulariosalud" ).append(`<input type="hidden" id="idsegurosalud" readonly name="idsegurosalud" class="form-control" value ="${$("#segurocobertura").val()}"/>`);
        $( "#formulariosalud" ).append(`<input type="hidden" id="idaminsalud" readonly name="idaminsalud" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariosalud" ).append(`<input type="hidden" id="idclientesalud" readonly name="idclientesalud" class="form-control" value ="${$("#idcliente").val()}"/>`);
        $( "#formulariosalud" ).append(`<input type="hidden" id="index" readonly name="index" class="form-control" value ="${cm}"/>`);
        let formulario = document.getElementById('formulariosalud');
        formulario.submit();
    }
    
}
function guardarsiniestro()
{
    if ($("#descripcionsiniestro").val()==0)
    {
        Swal.fire('Debe ingresar una descripción');
    }
    else if ($("#montosiniestro").val()==0)
    {
        Swal.fire('Debe ingresar un monto');
    }
    else if (  (localStorage.getItem("id_insurancepolicies") =='0') || (localStorage.getItem("id_insurancepolicies") === null)  )
    {
        Swal.fire('Debe escoger una póliza');
    }
    else if ( $("#estadosiniestro").val()==0)
    {
        Swal.fire('Debe escoger un estado');
    }
    else
    {
       
        $( "#formulariossiniestros" ).append(`<input type="hidden" id="idadminsinisestro" readonly name="idadminsinisestro" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariossiniestros" ).append(`<input type="hidden" id="idusuariosiniestro" readonly name="idusuariosiniestro" class="form-control" value ="${$("#idcliente").val()}"/>`);
        $( "#formulariossiniestros" ).append(`<input type="hidden" id="id_insurancepoliciesaccidentes" readonly name="id_insurancepoliciesaccidentes" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
        let formulario = document.getElementById('formulariossiniestros');
        formulario.submit();
    }
}
function guardarpolizaautos()
{
    if ($("#tipopoliza2").val()==0)
    {
        Swal.fire('Debe escoger un tipo de póliza para avanzar');
    }
    if ($("#mnontocobertura").val()==0)
    {
        Swal.fire('Debe escoger un monto de póliza para avanzar');
    }
    if ($("#segurocobertura").val()==0)
    {
        Swal.fire('Debe escoger un seguro de póliza para avanzar');
    }
    else
    {
        $( "#formulariosaatuos" ).append(`<input type="hidden" id="idmontoautos" readonly name="idmontoautos" class="form-control" value ="${$("#mnontocobertura").val()}"/>`);
        $( "#formulariosaatuos" ).append(`<input type="hidden" id="idseguroautos" readonly name="idseguroautos" class="form-control" value ="${$("#segurocobertura").val()}"/>`);
        $( "#formulariosaatuos" ).append(`<input type="hidden" id="idaminautos" readonly name="idaminautos" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariosaatuos" ).append(`<input type="hidden" id="idclienteautos" readonly name="idclienteautos" class="form-control" value ="${$("#idcliente").val()}"/>`);
        let formulario = document.getElementById('formulariosaatuos');
        formulario.submit();
    }
    
}
function guardareempresas()
{
    if ($("#tipopoliza3").val()==0)
    {
        Swal.fire('Debe escoger un tipo de póliza para avanzar');
    }
    if ($("#mnontocobertura").val()==0)
    {
        Swal.fire('Debe escoger un monto de póliza para avanzar');
    }
    if ($("#segurocobertura").val()==0)
    {
        Swal.fire('Debe escoger un seguro de póliza para avanzar');
    }
    else
    {
        $( "#formulariosempresa" ).append(`<input type="hidden" id="idmontoempresa" readonly name="idmontoempresa" class="form-control" value ="${$("#mnontocobertura").val()}"/>`);
        $( "#formulariosempresa" ).append(`<input type="hidden" id="idseguroempresa" readonly name="idseguroempresa" class="form-control" value ="${$("#segurocobertura").val()}"/>`);
        $( "#formulariosempresa" ).append(`<input type="hidden" id="idaminempresa" readonly name="idaminempresa" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariosempresa" ).append(`<input type="hidden" id="idclienteempresa" readonly name="idclienteempresa" class="form-control" value ="${$("#idcliente").val()}"/>`);
        let formulario = document.getElementById('formulariosempresa');
        formulario.submit();
    }
    
}
function buscarfrecuencias(id,monto,id_insurancepolicies) //para crear pagos 
{
    
    mostrarcarga()
    fetch(urlservidor+"api/pagospolizas", 
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
            Swal.fire('Tiene frecuencias');
            $("#div_frecuencias").css('display','none'); 
            $("#divbtnguardarpagos").css('display','none'); 
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
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="editarfrecuencia" 
                            id="editarfrecuencia_${f.id}" 
                            onclick="funeditarfrecuencia(${f.id})">

                            editar
                        </th>
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
           localStorage.setItem("idcotizacionpagar",id);
           localStorage.setItem("montocotizacionpagar",monto);
           localStorage.setItem("id_insurancepolicies",id_insurancepolicies);
        }
        
    }).finally(()=>
    {
        ocultarcarga()
    });
  
}
function buscarfrecuencias2(id,monto,id_insurancepolicies) // para realizar pagos
{
    
    mostrarcarga()
    fetch(urlservidor+"api/pagospolizas", 
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
                        <input 
                            ${ f.estadodepago ==1 ?'' : `disabeld` }
                            type="file" 
                            class="custom-file-input" 
                            name="photo_payment[]" 
                            id="photo_payment"
                            accept="png,jpeg,pdf" 
                        >
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="btneliminarfrecuecia" 
                            id="btneliminarfrecuecia" 
                            onclick="eliminarfrecuecia(${f.id})"
                            >

                        Anular pago
                    </th>
                    </th>
                </tr>
                `);
            });
            $("#divbtnguardarpagos2").css('display','block');
        }
        else
            Swal.fire('No existe fechas de pago generadas para esta póliza');
        //ocultarcarga()
    }).finally(()=>
    {
        ocultarcarga()
    });
  
}
function eliminarfrecuecia(id)
{
    console.log('eliminar frecuencia');
}

function buscarfrecuencias3(id,monto,id_insurancepolicies) // para realizar pagos
{
    
    localStorage.setItem("id_insurancepolicies",id_insurancepolicies);
    mostrarcarga()
    fetch(urlservidor+"api/buscarsiniestros", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            id_insurancepolicies: id_insurancepolicies,
            
        }),
    })
    .then(r => r.json())
    .then(r => 
    {
        if (r.accidents)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire(
            {
                title: 'Atención',
                text: "La póliza tiene siniestro(s) agregados, escoja el editar alguno o ingresar uno nuevo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Editar',
                cancelButtonText: 'Agregar',
                reverseButtons: true
            }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $("#divformulariossiniestronuevo").css('display','none');  
                        datasiniestros = r;
                        monstrarinformacion(r.data,r.datadoc);
                        $("#divbotonesguardar").css('display','none');
                        $("#divbotoneseditar").css('display','block');
                    } 
                    else if ( result.dismiss === Swal.DismissReason.cancel ) 
                    {
                        $("#divformulariossiniestronuevo").css('display','block');
                        $("#divbotonesguardar").css('display','block');
                        $("#divbotoneseditar").css('display','none');
                    }
                });
        }
        else
        {
            $("#divbotoneseditar").css('display','none');
            $("#divformulariossiniestronuevo").css('display','block');
            $("#divtablalistadesiniestros").css('display','none');
            $("#divformulariossiniestroeditar").css('display','none');
            $("#tablalistasiniestroseditar").empty();
        }
    }).finally(()=>
    {
        ocultarcarga()
    });
    
  
}
function frecuencia(frecuencia) // frecuencia de pagar la cotizacion
{
  localStorage.setItem("frecuencia",frecuencia);
}

function monstrarinformacion(data,documentos)
{
    $("#tablalistasiniestroseditar").empty();
    $("#tablalistasiniestroseditar").append(`
    <tr>
        <th>
            
        </th>
        <th>
            <label>Descripción sobre el siniestro</label>
        </th>
        <th>
            <label> Monto del siniestro</label>
            
        </th>
        <th>
            <label> Monto pagado siniestro</label>
        </th>
        <th>
            <label> Documentos cargados</label>
        </th>
    </tr>`);
    data.map((d,indexd) =>
    {
        $("#tablalistasiniestroseditar").append(`
        <tr>
            <th>
                <input type="radio"  name="radioeditarsinisestro[]" vaule ="${indexd}"  onclick="editarsiniestrossleccionado(${indexd})">    
            </th>
            <th>
                <input type="text" id="descripcionsiniestro" name="descripcionsiniestro"  value="${d.descripcion}" readonly disabled>
            </th>
            <th>
                <input type="text" id="montosiniestro" name="montosiniestro"  value="${d.monto}" readonly disabled>
            </th>
            <th>
                <input type="text" id="montosiniestro" name="montosiniestro"  value="${d.montopagado}" readonly disabled>
            </th>
            <th>
                ${generarvistadocumentos(d.id,documentos)}
            </th>
        </tr>`);
    });
    $("#divtablalistadesiniestros").css('display','block');
}
function generarvistadocumentos(id,doc)
{
    let htmldoc =''; console.log('llega ',id,'doc',doc)
    let doc2 =doc;
    doc2.map((d,indx) =>{
        if (d.id_accidente == id)
        {
            htmldoc +=`
                <label> ${d.tipodocumento} </label> 
                <a href="#" style ="text-decoration: none;">
                    
                    <span 
                            class='icon voyager-documentation p-3 m-2' 
                            title='Ver'
                            onclick="verfoto('${d.documentonombre}')" 
                        ></span>   
                </a>
                <a href="#" style ="text-decoration: none;">
                    <span 
                        class='icon voyager-trash p-3 m-2' 
                        title='Borrar Documento'
                        onclick="borrar(${d.id})" 
                        ></span>    
                </a>
            <br>`;
        }
    });
    return htmldoc;
}
function editarsiniestrossleccionado(id)
{
    
    $("#descripcionsiniestroeditar").val(datasiniestros.data[id].descripcion);
    $("#montosiniestroeditar").val(datasiniestros.data[id].monto);
    $("#montopagadoeditar").val(datasiniestros.data[id].montopagado);
    $("#estadosiniestroeditar").val(datasiniestros.data[id].estado);
    $("#idsiniestroeditar").val(datasiniestros.data[id].id);
    $("#divformulariossiniestroeditar").css('display','block');
}
function guardardatoseditados()
{
    if ($("#descripcionsiniestroeditar").val()==0)
    {
        Swal.fire('Debe ingresar una descripción');
    }
    else if ($("#montosiniestroeditar").val()==0)
    {
        Swal.fire('Debe ingresar un monto');
    }
    else if (  (localStorage.getItem("id_insurancepolicies") =='0') || (localStorage.getItem("id_insurancepolicies") === null)  )
    {
        Swal.fire('Debe escoger una póliza');
    }
    else if ( $("#estadosiniestroeditar").val()==0)
    {
        Swal.fire('Debe escoger un estado');
    }
    else
    {
       
        $( "#formulariossiniestroseditar" ).append(`<input type="hidden" id="idadminsinisestro" readonly name="idadminsinisestro" class="form-control" value ="${$("#idadmin").val()}"/>`);
        $( "#formulariossiniestroseditar" ).append(`<input type="hidden" id="idusuariosiniestro" readonly name="idusuariosiniestro" class="form-control" value ="${$("#idcliente").val()}"/>`);
        $( "#formulariossiniestroseditar" ).append(`<input type="hidden" id="id_insurancepoliciesaccidentes" readonly name="id_insurancepoliciesaccidentes" class="form-control" value ="${localStorage.getItem("id_insurancepolicies")}"/>`);
        let formulario = document.getElementById('formulariossiniestroseditar');
        formulario.submit();
    }
}
function verfoto(img)
{

  Swal.fire({
    imageUrl: urlservidor+img,
    imageHeight: 400,
    imageAlt: 'image'
  })
  
}
function borrar(id)
{
    
    fetch(urlservidor+"borrardocumento/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );
    
}
function eliminarqr(id)
{
    
    fetch(urlservidor+"eliminarqr/"+id)
    .then(response => response.json())
    .then(
       // location.reload()
    );
}
function editarpoliza(id_insurancepolicies)
{
    polizaieditar =id_insurancepolicies;
    fetch(urlservidor+"editarpoliza/"+id_insurancepolicies)
    .then(response => response.json())
    .then(response=>{

        let insurers = response.insurers;
        let documentos = response.documentos;
        let comentario = response.comentario;
        if (  insurers[0].tipopoliza==1)
        {
            $("#diveliminar").css('display','block');
            let member = response.member;
            let declarada = response.declarada;
            let nodeclarada = response.nodeclarada;

            $("#divsaludeditar").css('display','block');
            $("#divsalud").css('display','none');
            $("#tipopoliza").val(1)

            $("#divauto").css('display','none');
            $("#divempresas").css('display','none');

            $("#divautoeditar").css('display','none');
            $("#divempresaseditar").css('display','none');

            $("#tablaparentescospolizaseditar").empty();
            if (member.length > 0)
            {
                member.map((f,indexFamiliar) =>
                {
                    $("#tablaparentescospolizaseditar").append(`
                        <tr>
                            <td>
                                ${generahtmlparentesco(indexFamiliar,f.status)}
                            </td>
                            <td>
                                ${generahtmlsexo(indexFamiliar,f.gender)}
                            </td>
                            <td>
                                ${generaretornardia(indexFamiliar,f.day)}
                            </td>
                            <th>
                                ${generameses(indexFamiliar,f.mounth)}
                            </th>
                            <th>
                                ${generayy(indexFamiliar, f.year)}
                            </th>
                            <th>
                            <span 
                                class='icon voyager-trash btn-delete p-3 m-2' 
                                title='borrar'
                                onclick="eliminarparentesco(${f.id})" 
                            >
                            Eliminar
                            </span>
                            </th>
                        </tr>
                        `);
                    
                });
            }
               

            $("#tablasaludocumentosdeditar").empty();
            if (documentos.length > 0)
            {
                documentos.map((f,indexFamiliar) =>
                {
                    $("#tablasaludocumentosdeditar").append(`
                        <tr>
                            <td width ="70%">
                            <p> documento cargado ->  ${ f.tipodocumento } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-documentation btn-delete p-3 m-2' 
                                    title='Ver'
                                    >
                                    <a href="../${ f.documentonombre }" target="_blank"  style ="text-decoration: none;" >
                                        ver
                                    </a>
                                </span>

                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminardocumento(${ f.id })"
                                >
                                    Eliminar
                                </span>
                                    
                            </td>
                        </tr>
                        `);
                });
            }
            

            $("#tablacomentarioseditar").empty();
            if (comentario.length > 0)
            {
                comentario.map((f,indexFamiliar) =>
                {
                    $("#tablacomentarioseditar").append(`
                        <tr>
                            <td width ="70%">
                            <p> comentario cargado ->  ${ f.comentario } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminarcomentario(${ f.id })"
                                >
                                    Eliminar
                                </span>
                            </td>
                        </tr>
                        `);
                });
            }
            

            $("#tabladeclaradaeditar").empty();
            if (declarada.length > 0)
            {
                declarada.map((f,indexFamiliar) =>
                {
                    $("#tabladeclaradaeditar").append(`
                        <tr>
                            <td width ="70%">
                            <p> Patologia delcarada ->  ${ f.descripcion } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminardelcarada(${f.id})"
                                >
                                    Eliminar
                                </span>
                            </td>
                        </tr>
                    `);
                });
            }
           

            $("#tablanodeclaradaeditar").empty();
            if (nodeclarada.length > 0)
            {
                nodeclarada.map((f,indexFamiliar) =>
                {
                    $("#tablanodeclaradaeditar").append(`
                        <tr>
                            <td width ="70%">
                            <p>  Patologia delcarada ->  ${ f.descripcion } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminarnodeclarada(${f.id})"
                                >
                                    Eliminar
                                </span>
                            </td>
                        </tr>
                    `);
                });
            }
            
                
        }
        else if (  insurers[0].tipopoliza==2)
        {
            $("#diveliminar").css('display','block');
            $("#divsaludeditar").css('display','none');
            $("#divsalud").css('display','none');
            $("#tipopoliza2").val(2)
            $("#divautoeditar").css('display','block');
            $("#divauto").css('display','none');

            $("#divempresas").css('display','none');
            $("#divempresaseditar").css('display','none');

            $("#tablaautosdocumentos").empty();
            if (documentos.length > 0)
            {
                documentos.map((f,indexFamiliar) =>
                {
                    $("#tablaautosdocumentos").append(`
                        <tr>
                            <td width ="70%">
                            <p> documento cargado ->  ${ f.tipodocumento } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-documentation btn-delete p-3 m-2' 
                                    title='Ver'
                                    >
                                    <a href="../${ f.documentonombre }" target="_blank"  style ="text-decoration: none;" >
                                        ver
                                    </a>
                                </span>

                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminardocumento(${ f.id })"
                                >
                                    Eliminar
                                </span>
                                    
                            </td>
                        </tr>
                        `);
                });
            }
            
            let modeloauto =  document.getElementById("modeloauto");
            modeloauto.innerHTML = insurers[0].descripcionpoliza;

            $("#tablaautoscomentarios").empty();
            if (comentario.length > 0)
            {
                comentario.map((f,indexFamiliar) =>
                {
                    $("#tablaautoscomentarios").append(`
                        <tr>
                            <td width ="70%">
                            <p> comentario cargado ->  ${ f.comentario } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminarcomentario('${ f.id }')"
                                >
                                    Eliminar
                                </span>
                            </td>
                        </tr>
                        `);
                });
            }

        }
        else 
        {
            
            $("#diveliminar").css('display','block');
            $("#divsaludeditar").css('display','none');
            $("#divsalud").css('display','none');
            $("#tipopoliza2").val(2)
            $("#divautoeditar").css('display','none');
            $("#divauto").css('display','none');

            $("#divempresas").css('display','none');
            $("#divempresaseditar").css('display','block');
            
            let descripcionpolizaempresa =  document.getElementById("descripcionpolizaempresa");
            descripcionpolizaempresa.innerHTML ='';
            descripcionpolizaempresa.innerHTML = insurers[0].descripcionpoliza;

            let dimensionesedit =  document.getElementById("dimensionesedit");
            dimensionesedit.innerHTML ='';
            dimensionesedit.innerHTML = 'Dimensiones '+ insurers[0].dimensiones;

            let ubicacion =  document.getElementById("ubicacionedit");
            ubicacion.innerHTML ='';
            ubicacion.innerHTML ='Ubicación '+insurers[0].ubicacion;

            if (documentos.length > 0)
            {
                documentos.map((f,indexFamiliar) =>
                {
                    $("#tabladocumentosempresaseidtar").append(`
                        <tr>
                            <td width ="70%">
                            <p> documento cargado ->  ${ f.tipodocumento } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-documentation btn-delete p-3 m-2' 
                                    title='Ver'
                                    >
                                    <a href="../${ f.documentonombre }" target="_blank"  style ="text-decoration: none;" >
                                        ver
                                    </a>
                                </span>

                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminardocumento(${ f.id })"
                                >
                                    Eliminar
                                </span>
                                    
                            </td>
                        </tr>
                        `);
                });
            }
            if (comentario.length > 0)
            {
                comentario.map((f,indexFamiliar) =>
                {
                    $("#tablacomentariosempresaeditar").append(`
                        <tr>
                            <td width ="70%">
                            <p> comentario cargado ->  ${ f.comentario } </p>
                            </td>
                            <td>
                                <span 
                                    class='icon voyager-trash btn-delete p-3 m-2' 
                                    title='borrar'
                                    onclick="eliminarcomentario('${ f.id }')"
                                >
                                    Eliminar
                                </span>
                            </td>
                        </tr>
                        `);
                });
            }
        }
    });
}
function eliminarparentesco(id)
{
    fetch(urlservidor+"eliminarparentesco/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );
}
function eliminardocumento(id)
{
    fetch(urlservidor+"eliminardocumento/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );
}
function eliminarcomentario(id)
{
    fetch(urlservidor+"eliminarcomentario/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );
}
function eliminardelcarada(id)
{
    fetch(urlservidor+"eliminardelcarada/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );
}
function eliminarnodeclarada(id)
{
    fetch(urlservidor+"eliminarnodeclarada/"+id)
    .then(response => response.json())
    .then(
        location.reload()
    );     
}
function btndivadd(id) 
{
    let divadd = document.getElementById("divadd_"+id);
    let savebtn = document.getElementById("savebtn"+id);
    let clearbtn = document.getElementById("clearbtn"+id);
    let btndivadd = document.getElementById("btndivadd"+id);
    let polisaeditar = document.getElementById("polisaeditar"+id);
    polisaeditar.value=polizaieditar;
    let polisaeditaradmin = document.getElementById("polisaeditaradmin"+id);
    polisaeditaradmin.value=$("#idadmin").val();

    let polisaidusuario = document.getElementById("polisaidusuario"+id);
    polisaidusuario.value=$("#idcliente").val();


    divadd.style.display = "block";
    btndivadd.style.display = "none";
    savebtn.style.display = "block";
    clearbtn.style.display = "block";
    // $( "#formulariosalud" ).append(`<input type="hidden" id="idaminsalud" readonly name="idaminsalud" class="form-control" value ="${$("#idadmin").val()}"/>`);
    if (id==1) // parentesco
    {
        //
        
        $("#tablaparentescoadd").empty();
        miembrosasegurados.map((f,indexFamiliar) =>
        {
            if ( indexFamiliar ==0)
                display ='none';
            else
                display ='block';
            if (f.activo==0)
            {
                $("#tablaparentescoadd").append(`
                <tr>
                    <td>
                        ${generahtmlparentesco(indexFamiliar,f.status)}
                    </td>
                    <td>
                        ${generahtmlsexo(indexFamiliar,f.gender)}
                    </td>
                    <td>
                        ${generaretornardia(indexFamiliar,f.day)}
                    </td>
                    <th>
                        ${generameses(indexFamiliar,f.mounth)}
                    </th>
                    <th>
                        ${generayy(indexFamiliar, f.year)}
                    </th>
                    <th>
                        <div  style="display :${display} ; border: 1px solid #fff;"  >
                        ${generabotonelminar(indexFamiliar)}  
                        </div>
                    </th>
                </tr>
                `);
            }
            
        });
        //
    }
    if (id==2) // documentos
    {
        //
        $("#tabladocumentosadd").empty();
        $( "#tabladocumentosadd" ).append(`<tr>
        <tr>
            <th>
            <label class="custom-file-label" for=""> Agrega documento   </label>
            <input 
                type="file" 
                class="custom-file-input" 
                name="documentopersonal2[]" 
                accept="pdf,png,jpg" >
            </th>
            <th>
            <label class="custom-file-label" for="">Nombre del documento  </label><br>    
            <input 
                    type="text" 
                    class="custom-file-input" 
                    name="nombredocumentopersonal2[]" 
                    
                >
            </th>
        </tr>`);
        //
    } 
    if (id==3) // Comentarios
    {
        //
        $("#tablacomentariosadd").empty();
        $( "#tablacomentariosadd" ).append(`<tr> 
            <th>
                <input 
                    type="text" 
                    class="form-control shadow-none border-0 bg-grey" 
                    name="comentariosalud2[]" 
                    id="comentariosalud2[]" value="" 
                    placeholder="Comentario sobre la póliza">
            </th>
        </tr>`);
        //
    }
    if (id==4) // patologia si
    {
        //
        $("#tablapatolociasiadd").empty();
        $( "#tablapatolociasiadd" ).append(`<tr> 
            <th>
                <input 
                    type="text" 
                    class="form-control shadow-none border-0 bg-grey" 
                    name="patologiacomentadas2[]" 
                    id="patologiacomentadas2[]" value="" 
                    placeholder="Patología declarada">
            </th>
        </tr>`);;
        //
    }
    if (id==5) // patologia no
    {
        //
        $("#tablapatolocianoadd").empty();
        $( "#tablapatolocianoadd" ).append(`<tr> 
            <th>
                <input 
                    type="text" 
                    class="form-control shadow-none border-0 bg-grey" 
                    name="patologianocomentadas2[]" 
                    id="patologianocomentadas2[]" value="" 
                    placeholder="Patología no declarada">
            </th>
        </tr>`);;
        //
    }
}
function btnclear(id)
{
    let savebtn = document.getElementById("savebtn"+id);
    let clearbtn = document.getElementById("clearbtn"+id);
    let btndivadd = document.getElementById("btndivadd"+id);
    let divadd = document.getElementById("divadd_"+id);
    btndivadd.style.display = "block";
    savebtn.style.display = "none";
    clearbtn.style.display = "none";
    divadd.style.display ="none";
    

    
}
function btnsaveadd(id)
{
   
    if (id==1)
    {
        let formadd1 = document.getElementById("formparentescoeditaradd");
        formadd1.submit();
    }
    else{
        let formadd = document.getElementById("formadd"+id);
        formadd.submit();
    }
    
}
//
function btneditautos(id)
{
    
    let divautoedit = document.getElementById("divautoedit_"+id);
    divautoedit.style.display = "block";

    let poliatuedit = document.getElementById("poliatuedit"+id);
    let adminpoliatuedit = document.getElementById("adminpoliatuedit"+id);
    let usuarioadminpoliatuedit = document.getElementById("usuarioadminpoliatuedit"+id);
    console.log(polizaieditar,id)
    poliatuedit.value =polizaieditar;
    adminpoliatuedit.value =$("#idadmin").val();
    usuarioadminpoliatuedit.value =$("#idcliente").val();

    if (id >1)
    {
        
        let clearatuosedit = document.getElementById("clearatuosedit"+id);
        clearatuosedit.style.display = "block";
        let saveeditautos = document.getElementById("saveeditautos"+id);
        saveeditautos.style.display = "block";

        let btneditauto = document.getElementById("btneditauto"+id);
        btneditauto.style.display = "none";
    }

}
function btnsaveeditautos(id)
{
    let formeditauto = document.getElementById("formeditauto"+id);
    formeditauto.submit();
}

function btneditempresa(id)
{
    let divempresaoedit = document.getElementById("divempresaoedit_"+id);
    divempresaoedit.style.display = "block";

    let polizaempresaedit = document.getElementById("polizaempresaedit"+id);
    let adminempresapoliza = document.getElementById("adminempresapoliza"+id);
    let usuarioempresapoliza = document.getElementById("usuarioempresapoliza"+id);

    let clearempresaedi = document.getElementById("clearempresaedi"+id);
    clearempresaedi.style.display = "block";

    
    let saveempresaedit = document.getElementById("saveempresaedit"+id);
    saveempresaedit.style.display = "block";
    
    let btneditempresa = document.getElementById("btneditempresa"+id);
    btneditempresa.style.display = "none";

    
    polizaempresaedit.value =polizaieditar;
    adminempresapoliza.value =$("#idadmin").val();
    usuarioempresapoliza.value =$("#idcliente").val();
    // 
   
}
function btnclearempresaedi(id)
{
    let divempresaoedit = document.getElementById("divempresaoedit_"+id);
    divempresaoedit.style.display = "none";


    if (id >1)
    {
        let clearempresaedi = document.getElementById("clearempresaedi"+id);
        clearempresaedi.style.display = "none";

        
        let saveempresaedit = document.getElementById("saveempresaedit"+id);
        saveempresaedit.style.display = "none";
        
        let btneditempresa = document.getElementById("btneditempresa"+id);
        btneditempresa.style.display = "block";

        let divempresaoedit = document.getElementById("divempresaoedit_"+id);
        divempresaoedit.style.display = "none";
    }
}
function btnsaveempresaedit(id)
{
    let formempresaedit = document.getElementById("formempresaedit"+id);
    formempresaedit.submit();
}

function funeditarfrecuencia(id)
{
    let fechainici = document.getElementById("fechainici_"+id);
    let fechafin = document.getElementById("fechafin_"+id);
    console.log(fechafin,fechainici)
    mostrarcarga()
    fetch(urlservidor+"api/funeditarfrecuencia", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            fechafin: fechafin.value,
            fechainici: fechainici.value,
            id: id,
            
        }),
    })
    .then(r => r.json())
    .then(r => 
    {
        //location.reload()
        
    }).finally(()=>
    {
        ocultarcarga()
    });
}
function eliminarpoliza()
{
   
    if (polizaieditar > 0)
    {
        fetch(urlservidor+"eliminarpoliza/"+polizaieditar)
        .then(response => response.json())
        .then(
            location.reload()
        ); 
    }
}
function editarnombredocumento()
{
    $("#diveditarnombredocumento").css('display','block');
    $("#enlaceeditar").css('display','none');
    
}
function btneditarnombre(id)
{
    mostrarcarga()
    fetch(urlservidor+"api/editarnombredocumento", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            
            nombrenuevo:$("#nuevonombre").val(),
            id: id,
            
        }),
    })
    .then(r => r.json())
    .then(r => 
    {
        location.reload()
        
    }).finally(()=>
    {
        ocultarcarga()
    });
}
function btnlimpiaredicionnombre()
{
    $("#diveditarnombredocumento").css('display','none');
    $("#enlaceeditar").css('display','block');  
}
