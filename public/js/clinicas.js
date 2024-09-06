let arreglo =[];
$(document).ready(function () 
{
    //
    $('#example').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarclinicas/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'nombre_seguro' },
            { data: 'direccion' },
            { data: 'estado' },
            { data: 'ciudad' },
            { data: 'municipio' },
            {
                orderable: false,
                data: "null",
                className: "center",
                defaultContent:'',
                render: function(data, type, row, meta) 
                {
                  return  ` <a href="#" style ="text-decoration: none;" ><span 
                        class='icon voyager-wallet btn-doc p-3' 
                        title='Editar datos'
                        onclick="editarclinica(${row.id},'${row.nombre}','${row.direccion}',${row.id_estado},${row.id_ciudad},${row.id_municipio})" 
                        ></span>  </a>
                        <a href="#" style ="text-decoration: none;" >
                        <span 
                        class='icon voyager-trash btn-doc p-3' 
                        title='Eliminar Clinica'
                        onclick="eliminarclinica(${row.id})" 
                        ></span> </a>`;
                        }
              },
            
        ]
    });
    //
});
//let urlservidor ='http://127.0.0.1:8000/';
let urlservidor  ='https://dev.cotiseguros.com.ve//';
//let urlservidor  ='https://www.cotiseguros.com.ve/';
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
function changeselectestado()
{
    let estado = document.getElementById('id_estado');
    fetch(urlservidor+"changeselectestado/"+estado.value)
    .then(response => response.json())
    .then(response =>{
        
        let ciudades = response.ciudades;
        let municipios = response.municipios;
        $("#id_ciudad").empty();
        $("#id_municipio").empty();
        $( "#id_ciudad" ).append(`<option value="0">Seleccione</option>`);
        $( "#id_municipio" ).append(`<option value="0">Seleccione</option>`);
        ciudades.map((d,indx) =>{
            $( "#id_ciudad" ).append(`<option value="${d.id}"> ${d.text} </option> `);
        });
        municipios.map((d,indx) =>{
            $( "#id_municipio" ).append(`<option value="${d.id}"> ${d.text} </option> `);
        });
        // 
        // $( "#formulariossiniestroseditar" ).append(`<input type="hidden" id="idadminsinisestro" readonly name="idadminsinisestro" class="form-control" value ="${$("#idadmin").val()}"/>`);
    });
}
function guardarclinica()
{
    let formagregarclinica = document.getElementById('formagregarclinica');
    formagregarclinica.submit();
}
function editarclinica(id, nombre ,direccion,id_estado,id_ciudad,id_municipio)
{
    mostrarcarga()
    $("#nombre").val(nombre);
   $("#direccion").val(direccion);
   fetch(urlservidor+"editarclinica/"+id_estado)
    .then(response => response.json())
    .then(response =>{

        let ciudades = response.ciudades;
        let municipios = response.municipios;
        $("#id_ciudad").empty();
        $("#id_municipio").empty();
        $( "#id_ciudad" ).append(`<option value="0">Seleccione</option>`);
        $( "#id_municipio" ).append(`<option value="0">Seleccione</option>`);
        ciudades.map((d,indx) =>{
            $( "#id_ciudad" ).append(`<option value="${d.id}"> ${d.text} </option> `);
        });
        municipios.map((d,indx) =>{
            $( "#id_municipio" ).append(`<option value="${d.id}"> ${d.text} </option> `);
        });
        $("#id_municipio").val(id_municipio);
        $("#id_ciudad").val(id_ciudad);
        $("#id_estado").val(id_estado);
        $("#id_clinica").val(id);
    }).finally(()=>
    {
        ocultarcarga()
    });
}
function eliminarclinica(id)
{
    mostrarcarga()
    fetch(urlservidor+"eliminarclinica/"+id)
    .then(response => response.json())
    .then(
       location.reload()
    ).finally(()=>
    {
        ocultarcarga()
    });
}





