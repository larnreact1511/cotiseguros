$(document).ready(function () 
{
    $('#tablaempresas').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: `listarempresas/`,
        language:
            {
				"url": "json/Spanish.json"
			},
        columns: [
            { data: 'nombreempresa' },
            { data: 'rifempresa' },
            { data: 'razonsocial' },
            {
              orderable: false,
              data: "null",
              className: "center",
              defaultContent:'',
              render: function(data, type, row, meta) 
              {
                return  ` <span 
                class='icon voyager-wallet btn-doc p-3' 
                title='Editar datos'
                onclick="editardatos(${row.id},'${row.nombreempresa}','${row.rifempresa}','${row.razonsocial}')" 
              ></span> 
              <span 
                class='icon voyager-wallet btn-doc p-3' 
                title='Agregar una poliza'
                onclick="agregarpoliza(${row.id})" 
              ></span>`;
              }
            },
            
        ]
    });
});
function editardatos(id,nombre,rif,razon)
{
  $("#nombreempresa").val(nombre)
  $("#rifempresa").val(rif)
  $("#razonsocial").val(razon)
  $("#idempresa").val(id)
  
}
function agregarpoliza(id)
{
  $("#divcrearempresa").css("display","none");
  $("#divcrearpolizaapemresa").css("display","block")
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