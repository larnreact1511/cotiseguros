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
$( document ).ready(function() 
{
    miembrosasegurados[cm]=familiar;
    generardatosparientes()
});

function generardatosparientes()
{
    datosparientes ='';
    miembrosasegurados.map((f,indexFamiliar) =>
    {
        if ( indexFamiliar ==0)
            display ='none';
        else
            display ='block';
        if (f.activo==0)
        {
            datosparientes +=`
            <div class="row mt-3 p-3 shadow rounded" id="${indexFamiliar}">
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
function generahtmlparentesco(id,valor)
{
    htmlparentesco ='';console.log(valor);
    htmlparentesco +=`
        <label class="mon-regular text-secondary">
            Parentesco
        </label>
        <select 
            class="form-select shadow-none border-0 bg-light" 
            required="" 
            name ="status_${id}"
            id ="status_${id}"
            onChange ="changeStatus(${id})"
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
    <div 
        onClick="removeFamiliar(${id})" 
        style="height: 58px;" 
        class="btn btn-add btn-light d-flex justify-content-start align-items-center p-3 rounded">
        
            <span class="ms-3 mon-light"  >Eliminar familiar</span>
    </div>
    `;
    return botonelminar;
}
function removeFamiliar(id)
{
    miembrosasegurados[id].activo=1;
    $("#cotizador").html('');
    generardatosparientes()
}
function changeStatus (id)
{
    let valor =$("#status_"+id).val();
    miembrosasegurados[id].status=valor;
}
function changeGender(id)
{
    let gender =$("#gender_"+id).val();
    miembrosasegurados[id].gender=gender; 
    //
    let status =$("#status_"+id).val();
    miembrosasegurados[id].status=status;
    //
    let day =$("#day_"+id).val();
    miembrosasegurados[id].day=day; 
    //
    let mounth =$("#mounth_"+id).val();
    miembrosasegurados[id].mounth=mounth;  
    //
    let birthday =$("#birthday_"+id).val();
    miembrosasegurados[id].year=birthday; 
    //
    

}
function changeday(id)
{
    let gender =$("#gender_"+id).val();
    miembrosasegurados[id].gender=gender; 
    //
    let status =$("#status_"+id).val();
    miembrosasegurados[id].status=status;
    //
    let day =$("#day_"+id).val();
    miembrosasegurados[id].day=day; 
    //
    let mounth =$("#mounth_"+id).val();
    miembrosasegurados[id].mounth=mounth;  
    //
    let birthday =$("#birthday_"+id).val();
    miembrosasegurados[id].year=birthday; 
    //
    
}
function changemounth(id)
{
    let gender =$("#gender_"+id).val();
    miembrosasegurados[id].gender=gender; 
    //
    let status =$("#status_"+id).val();
    miembrosasegurados[id].status=status;
    //
    let day =$("#day_"+id).val();
    miembrosasegurados[id].day=day; 
    //
    let mounth =$("#mounth_"+id).val();
    miembrosasegurados[id].mounth=mounth;  
    //
    let birthday =$("#birthday_"+id).val();
    miembrosasegurados[id].year=birthday; 
    //
    
}
function changebirthday(id)
{
    let gender =$("#gender_"+id).val();
    miembrosasegurados[id].gender=gender; 
    //
    let status =$("#status_"+id).val();
    miembrosasegurados[id].status=status;
    //
    let day =$("#day_"+id).val();
    miembrosasegurados[id].day=day; 
    //
    let mounth =$("#mounth_"+id).val();
    miembrosasegurados[id].mounth=mounth;  
    //
    let birthday =$("#birthday_"+id).val();
    miembrosasegurados[id].year=birthday; 
    //
    
    
}
function sendCot()
{
    
    fetch("/cotizador/salud/cotizacion2", 
    {
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // <--- aquí el token
            "Content-type": "application/json; charset=UTF-8"
        },
        method: "POST",
        body: JSON.stringify(
        {
            name: $("#name").val(),
            province: $("#province").val(),
            phone: $("#phone").val(),
            last_name: $("#last_name").val(),
            code: $("#code").val(),
            email: $("#email").val(),
            coverage: $("#coverage").val(),
            members: miembrosasegurados,
        }),
    })
    .then(r => r.json())
    .then(r => 
    {
        if(r.status == true)
        {
            //window.location.href =r.ruta;
            window.open(r.ruta, '_blank');
        }
    }).finally(()=>
    {
        
    });
    
}