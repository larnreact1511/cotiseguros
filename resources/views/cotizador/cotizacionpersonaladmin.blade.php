@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/sweetalert2.js') }}" defer></script>
    <link href="{{ asset('css/loaderpersona1.css') }}" rel="stylesheet">
    <div class="w-100 d-flex flex-column flex-md-row justify-content-center pt-2">
        {{-- @for ($i = 0; $i < 3; $i++)
            @include('../components/card-x')
        @endfor --}}
    </div>
    <div class="container my-5">
           
        <div class="w-100 d-flex flex-column align-items-center justify-content-center mb-3">
            <h2 class="text-uppercase mon-black text-wine text-center mt-5">Coberturas que te ofrecemos personal</h2>
            <input type="hidden" id="numerocontizador" name="numerocontizador"  value="<?php echo $numero; ?>">
            <input type="hidden" id="coverageselect" name="coverageselect"  value="<?php echo $coverage; ?>">
            <input type="hidden" id="idquote" name="idquote" value="<?php echo $idquote; ?>" readonly>
            <input type="hidden" id="idusuario" name="idusuario" value="<?php echo @$idusuario; ?>" readonly>
          </div>
        <div id="cotizacionpesonal" name="cotizacionpesonal" class="my-5">
            <div class="row bg-light py-4 px-5 rounded shadow mx-2">
                <div  class="col-12 col-md-4 d-flex flex-column mt-3" id="divcoverages">
                    <select  
                        class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
                        aria-label="Default select example"
                        onChange ="changeCoverage()"    
                        id ="selectcoverage"
                    >
                    </select>
                </div>
                <div class="col-12 col-md-5 mt-3">
                    <h6 class="text-uppercase text-center mon-black">Formas de pago</h6>
                    <div class="d-flex justify-content-around align-items-center p-3 mt-3">
                    @foreach ($frequency as $f)
                        <div  class=''>
                             <input class='' 
                             name="frecuency" 
                             type="radio" 
                             onChange ="changeFrequency('{{$f->name}}', '{{$f->frequency}}')"/> {{$f->name}}
                        </div>
                    @endforeach

                    </div>
                </div>
                <div class="col-12 col-md-3 mt-3 d-flex flex-column justify-content-center align-items-center">
                    <h6 class="text-uppercase text-center mon-black">Opciones</h6>
                    <div class='pt-2 d-flex justify-content-around align-items-center w-100'>
                        <div onClick="openModalMembers()" class='btn bg-white shadow d-flex p-2 px-3 rounded-pill' data-toggle="modal" data-target="#exampleModal">
                            <img src="/storage/anadir-grupo-04.png" width="20" />
                            <span class='ps-2 mon-regular fs-10 d-flex justify-content-center align-items-center'>Editar integrantes</span>
                            
                        </div>
                    </div>
                    <div class='pt-2 d-flex justify-content-around align-items-center w-100'>
                        <div onClick="generartodonuevo()" class='btn bg-white shadow d-flex p-2 px-3 rounded-pill' data-toggle="modal" data-target="#exampleModal">  
                            <span class='ps-2 mon-regular fs-10 d-flex justify-content-center align-items-center'>Cotizar todo</span>
                        </div>
                    </div>
                    <div class='pt-2 d-flex justify-content-around align-items-center w-100'>
                        <div onClick="cuadrocomparativo()" class='btn bg-white shadow d-flex p-2 px-3 rounded-pill' id="btncmpativo" style="display:none"  >  
                            <span class='ps-2 mon-regular fs-10 d-flex justify-content-center align-items-center' > Cuadro Comparativo </span>
                        </div>
                    </div>
                    
                    
                </div> 
            </div>
            <input type="hidden" id="idadmin" readonly name="idadmin" class="form-control" value ="<?=auth()->id(); ?>"/>
            <!-- -->
            <!--<div class="custom-loader" id ="cargaold" sytyle="display:none"></div>-->
            <div class="custom-loader2" id ="carga" sytyle="display:none">
                <img src="{{ asset('loaderlogo.gif') }}"></img>
            </div>
            
            <!--
            
             -->
             <div class="accordion" id="accordionExample3">

             </div>
            <div class="accordion px-3"  id="accordionExample">

            </div>
            <!-- -->
            
            <!-- aaa -->
        </div>
           
        <div class="modal fade show" id="exampleModal" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button 
                                    type="button" 
                                    id= "cerrarmodalpersonas"
                                    name="cerrarmodalpersonas"
                                    class="btn-close" 
                                    data-bs-dismiss="modal" 
                                    aria-label="Close">
                                </button>
                            </div>
                                <div class="modal-body">
                                    <div class="my-5">
                                        <h1 class="mon-black text-danger display-6 text-start my-3">PERSONAS A ASEGURAR </h1>
                                    <div 
                                        id ="divparientes"
                                        class="row"
                                    >
                                    </div>
                                <div class="col-12 col-md-12">
                                    <hr class="mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center mb-3">
                            <div 
                                class="btn btn-light rounded-pill mon-regular p-3"
                                onclick="addFamiliar()"
                                >
                                <img class="px-2" height="30" src="/storage/anadir-grupo-04.png">Añadir integrante a mi póliza
                            </div>
                        <div 
                            class="btn bg-primary rounded-pill text-white mon-light d-flex justify-content-center align-items-center ms-2"
                            onclick="guardarmiembros()"
                            >
                            Guardar integrantes
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- -->
        <div class="modal fade show" id="exampleModal2" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button 
                                    type="button" 
                                    id= "cerrarmodalpersonas2"
                                    name="cerrarmodalpersonas2"
                                    class="btn-close" 
                                    data-bs-dismiss="modal" 
                                    aria-label="Close">
                                </button>
                            </div>
                                <div class="modal-body  justify-content-center">
                                    <div class="my-5">
                                        <h1 class="mon-black text-danger display-6 text-start my-3">
                                                PDFS GENERADOS
                                        </h1>
                                        <h3 class="mon-black text-danger display-6 text-start my-3">
                                            se envio al su correo la información requerida
                                        </h>
                                    <div 
                                        id ="div_pdfs"
                                        class="row  text-center  justify-content-center mt-2"
                                    >
                                    </div>
                                <div class="col-12 col-md-12">
                                    <hr class="mt-3">
                                </div>
                            </div>
                        </div>
                       
                </div>
                
            </div>
        </div>

        
        <!-- -->
        <div class="modal fade show" id="exampleModal3" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header " >
                        
                        <button 
                            type="button" 
                            id= "cerrarmodalpersonas3"
                            name="cerrarmodalpersonas3"
                            class="btn-close" 
                            data-bs-dismiss="modal" 
                            aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body  justify-content-center">
                        <h3 class="text-uppercase mon-normal h5 text-center text-wine"
                            style="margin:auto;" 
                            id="titulocomparativo" 
                            name="titulocomparativo"
                            >
                            Cobertura de
                        </h3>
                       
                        <div class="row my-5" id="divcomparar" name="divcomparar"></div>
                    </div> 
                    <div class="modal-footer">
                        <div class="text-center p-2">
                            <button 
                                type="button" 
                                id= "generarpdfcomparativo"
                                name="generarpdfcomparativo"
                                class="btn btn-primary"
                            >
                            Generar PDF
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- -->
</div>
        
    </div>
    <a class="text-decoration-none bg-white rounded-pill text-wine fw-bold p-2 ms-3 shadow" style="position: fixed ;top: 75px ;" href="javascript: history.go(-1)">Volver atrás</a>
    <script> 
        let today = new Date();
        let year = today.getFullYear();
        let members =[];
        //let frequencySelected =["frequency" : 1 , "name" : "Anual"] 
        let frequencySelected = {frequency:"12", name:"Mensual"}; //console.log(frequencySelected);
        let coverages =[];
        let coverageSelected =[];
        let coveragesList=[];
        let quote =[];
        let htmlacordeon =''; 
        let htmlacordeon2 ='';
        let htmlbenefit='';
        let htmlmiembreso ='';
        let htmlbenefit2='';
        let quoteid =0; // id 
        // variables para generar listado cotizaciones
        let insurerCoverage =[];
        let vclickopcion =[];
        let insurerCoverage_c =[]; // esta se usa para cuadro comparativo
        let comparativo ={};
        let comparativobtn ={};
        let cantidadquotes =0;
        let crearcomparativo =true;
        let cantidadcomparativo =0;
        // variables para editar miembros
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
        let parentescoarray =[]; 
        parentescoarray[0]="-1"; 
        parentescoarray[1]="Yo"; 
        parentescoarray[2]="Madre o Padre";
        parentescoarray[3]="Otro (a)"; 
        parentescoarray[4]="Cónyuge";
        parentescoarray[5]="Hijo/a";
        let  miembrosasegurados =[];
        let  cm =0; // contador miembros
        let ym = parseFloat(year)-parseFloat(99); // año menor
        let ya = new Date().getFullYear();
        //
        $( document ).ready(function() 
        {
            $("#carga").css('display','block');
            buscarcoverages();
            buscarprimas2();
            $("#cerrarmodalpersonas" ).on( "click", function() { $("#exampleModal").css('display','none');});
            $("#cerrarmodalpersonas2" ).on( "click", function()  { $("#exampleModal2").css('display','none'); });
            $("#cerrarmodalpersonas3" ).on( "click", function()  { $("#exampleModal3").css('display','none');  });
            $("#generarpdfcomparativo" ).on( "click", function() { generarpdfcomparativo() });
            
        });
        function clickopcion(id)
        {
            if (vclickopcion.includes(id))
            {
                vclickopcion.shift();
                $("#collapse"+id).removeClass('accordion-collapse col-12 collapse show');
                $("#collapse"+id).removeClass('show');
                $("#collapse"+id).addClass('accordion-collapse collapse col-12');
                $("#collapse"+id).css('display','none');
            }
            else
            {
                if (vclickopcion.length >0)
                {
                    
                    let antes = vclickopcion[0];
                    $("#collapse"+antes).css('display','none'); 
                    vclickopcion.shift();
                    vclickopcion.push(id);
                    $("#collapse"+id).css('display','block'); 
                }
                else
                {
                    vclickopcion.push(id);
                    $("#collapse"+id).css('display','block'); 
                }
            }
        }
        function buscarprimas2()
        {
            //  primas
            insurerCoverage =[];
           
            fetch(`/api/getCotizacionSaludadmin/${$("#numerocontizador").val()}/${$("#idquote").val()}`)
            .then((response) => response.json())
            .then((data) => 
            {
                if(data.status == false)
                {
                    htmlacordeon =`<div class="w-100 d-flex flex-column align-items-center justify-content-center mb-3">
                        <h2 
                            class="text-uppercase mon-black text-wine text-center mt-5">
                            Haz superado el limite de cotizacion. comunicate con nuestros expertos.
                        </h2>
                    </div>`;
                    $("#accordionExample").html('');
                    $("#accordionExample").html(htmlacordeon);
                } 
                else 
                {
                    insurerCoverage =data.data;
                    console.log(insurerCoverage)
                    $("#idusuario").val(data.idusuario);
                    let idusuario =data.idusuario;
                    quoteid = data.id; 
                    insurerCoverage.map((ic,indexInsurerCoverage) =>
                    {
                        if (indexInsurerCoverage ==0)
                            insurerCoverage[indexInsurerCoverage].check=1;
                        else
                            insurerCoverage[indexInsurerCoverage].check=0;
                        
                        cantidadquotes ++;
                        htmlacordeon +=`
                        <div class="accordion-item row my-3 shadow">
                            <div class="accordion-header bg-white" id="headin${indexInsurerCoverage}">
                                <div class='row m-0 p-3'>
                                    <div class='col-12 col-md-2 p-2 d-flex justify-content-center align-items-center'>
                                        <input type="checkbox" id="check_${indexInsurerCoverage}"  name="check_${indexInsurerCoverage}" ${ indexInsurerCoverage >0 ? '':'checked' }  onclick='handleClick(${indexInsurerCoverage});'>
                                        <img width="100%" src="/storage/${ic.image}"/>
                                    </div>
                                    <div class='col-12 col-md-2 p-0 d-flex flex-column justify-content-center align-items-center'>
                                        <h3 class='mon-black text-primary h6'>
                                            COBERTURA HCM
                                        </h3>
                                        <span class='mon-black text-dark h4'>${ ic.coverages.coverage.toLocaleString('es-MX') } USD</span>
                                    </div>
                                    <div class='col-12 col-md-3 p-0 px-3 d-flex flex-column'>
                                        <div class='w-100 h-100 text-center mb-2'>
                                            <h4 class='mon-black text-primary text-center h6 mb-0 tituloprima'>PRIMA ${ frequencySelected.name }</h4>
                                        </div>
                                        ${ indexMembernuevo(ic.coverages.members,indexInsurerCoverage)} 
                                    
                                        <div class='w-100 h-100 mt-2 d-flex justify-content-between'>
                                            <span class='text-dark mon-black h4'>Total</span>
                                            <span class='text-primary mon-black h4' id="idtotal${indexInsurerCoverage}"> 
                                                ${  Math.round(getRateTotal(indexInsurerCoverage)).toLocaleString('es-MX') } USD
                                            </span>
                                        </div>
                                    </div>
                                        <div class='col-12 col-md-5 p-0 px-3  d-flex justify-content-around align-items-center'>
                                            <span 
                                                class='btn rounded-pill bg-light fs-sm text-primary p-2 mon-bold shadow-lg mx-2' 
                                                data-bs-toggle="collapse" 
                                                data-bs-target=${`#collapse${indexInsurerCoverage}`} 
                                                aria-expanded="true" 
                                                aria-controls="collapse${indexInsurerCoverage}"
                                                onclick="clickopcion(${indexInsurerCoverage})"
                                                id ="opcion${indexInsurerCoverage}"
                                            >
                                                <img class='me-2' width="15" src="/storage/eye-solid.png" />
                                                Ver Detalles
                                            </span>
                                            <span 
                                                onclick ="sendCotizacion_nuevo(${indexInsurerCoverage})"
                                                class='btn rounded-pill bg-primary fs-sm text-white p-2 mon-bold shadow-lg mx-2'
                                            >
                                                <img className='me-2' width="15" src="/storage/paper-plane-solid.png" />
                                                Enviar Cotizacion 
                                            </span>
                                            ${ idusuario >0 ? `<span 
                                                onclick ="aprobarpoliza(${indexInsurerCoverage})"
                                                class='btn rounded-pill bg-primary fs-sm text-white p-2 mon-bold shadow-lg mx-2'
                                            >
                                                <img className='me-2' width="15" src="/storage/paper-plane-solid.png" />
                                                Aprobar poliza
                                            </span>`:'' }
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div 
                                id ="collapse${indexInsurerCoverage}" 
                                class="accordion-collapse collapse col-12" 
                                aria-labelledby="headin${indexInsurerCoverage}" 
                                data-bs-parent="#accordionExample"
                                >
                                <div class="row accordion-body" id="#div${indexInsurerCoverage}">
                                    <div class='col-12'>
                                        <div class='col-12'>
                                            <p class='mon-black font-weight-bold p-0 m-0'>${ (ic.note) ? 'Nota:' : '' } ${ic.note }</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios incluidos</h3>
                                        ${ ic.benefits ?  benefitnuevo(ic.benefits,indexInsurerCoverage) :""}
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios pagos</h3>
                                        ${ ic.benefits ? benefitnuevo_2(ic.benefits,indexInsurerCoverage): "" }
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        `;
                    });
                }
                $("#accordionExample").html('');
                $("#accordionExample").html(htmlacordeon); 
                $("#carga").css('display','none');
                
            });
            //
        }
        function pay_benefit(benefit)
        {
            htmlbenefit ='';
            benefit.pay_benefit.map((payBenefit,indexPayBenefit) =>
            {
                //console.log('ingresa',payBenefit.rate)
                htmlbenefit =` <h3 id="${indexPayBenefit}" class="text-uppercase mon-black text-pink h5 text-right">${ `${payBenefit.rate} USD 5`  }</h3>`;
            });
            
            return htmlbenefit;
        }
        function totalForCoverage(indexCoverage) 
        {
          let total = 0;
          for (let index = 0; index < members.length; index++) 
          {
              total += rateForMember(indexCoverage,index) + totalBenefits(indexCoverage);
          }
          return total;
        }
        function totalForCoverage2(indexCoverage) 
        {
          let total = 0;
          for (let index = 0; index < members.length; index++) 
          {
              total += rateForMember(indexCoverage,index) + totalBenefits(indexCoverage);
          }
          $("#total_"+indexCoverage).html(total+' USD')
        }
        function checkCoverage(a)
        {
            if(a > 0)
            {
                return "flex";
            } 
            else 
            {
                return "none";
            }
        }
        function rateForMember (indexCoverages,indexMember)  
        {
        
            for (let index = 0; index < coverages[indexCoverages].rates.length; index++) 
            {
                if(members[indexMember].date >= coverages[indexCoverages].rates[index].from  && members[indexMember].date <= coverages[indexCoverages].rates[index].to)
                {
                    return (coverages[indexCoverages].rates[index].rate / frequencySelected.frequency) ;
                }
            }
            return 0;
        }
        function totalBenefits (indexCoverage)  
        {
          let total = 0;
          for (let index = 0; index < coverages[indexCoverage].insurer.benefits_insurer.length; index++) 
          {
              total += coverages[indexCoverage].insurer.benefits_insurer[index].selected_benefit;
          }
          
          return total / frequencySelected.frequency;
        }
        function selectbenficio(pay_benefit)
        {
            htmlselectbenficio ='';
            {pay_benefit.map((payBenefit,indexPayBenefit) =>
                htmlselectbenficio += ` <option value="${indexPayBenefit}">${ `${ new Intl.NumberFormat().format( payBenefit.coverage ) } $` }</option>`
            )}
            return htmlselectbenficio;
        }
        function selectPayBenefit(i,j)
        {
           let sebeneficio= $("#sebeneficio"+j).val();
           console.log(`Coverages antes `,coverages);
           if(sebeneficio > -1 )
           {
            
                coverages[i].insurer.benefits_insurer[j].selected_benefit = coverages[i].insurer.benefits_insurer[j].pay_benefit[sebeneficio].rate;
                coverages[i].insurer.benefits_insurer[j].pay_benefit[sebeneficio].selected = 1;
                coverageSelected =coverageSelected
                coverages =coverages;
                console.log(`Coverages `,coverages);
            }   
            else
            {
                coverages[i].insurer.benefits_insurer[j].selected_benefit = 0;
                for(let x = 0; x < coverages[i].insurer.benefits_insurer[j].pay_benefit.length ; x++ )
                {
                    coverages[i].insurer.benefits_insurer[j].pay_benefit[x].selected = 0;
                }
                coverages = coverages;
                console.log(`Coverages despues `,coverages);

            }
            // ordernar montos
            coverages.map((coverage,indexCoverages) =>
            {
                console.log('aqui',indexCoverages)
                miembros2(indexCoverages);
            });
        }
        
        function changeCoverageno()
        {
            let selectcoverage = $("#selectcoverage").val(); 
            
            fetch(`/api/changeCoverage/${ window.location.href.split("/")[window.location.href.split("/").length - 1] }/${selectcoverage}`)
            .then((response) => response.json())
            .then((data) => 
            {
               if (data.coverage)
               {
                $("#accordionExample").html('');
                htmlacordeon =''; 
                $("#carga").css('display','block');
                buscarprimas2()
               }
            });
        }

        function changeCoverage()
        {
            let selectcoverage = $("#selectcoverage").val(); 
            let idquote = $("#idquote").val(); 
            comparativo ={};
            crearcomparativo =true;
            if (idquote >0)
            {
                fetch("/api/changeCoverageid", 
                {
                    headers: {
                        'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                        "Content-type": "application/json; charset=UTF-8"
                    },
                    method: "POST",
                    body: JSON.stringify({
                        coverage: selectcoverage,
                        idquote:idquote
                    }),
                })
                .then(r => r.json())
                .then(r => 
                {
                    
                }).finally(()=>
                {
                    
                    $("#accordionExample").html('');
                    htmlacordeon =''; 
                    $("#carga").css('display','block');
                    buscarprimas2()
                });
            }
            else
            {
                Swal.fire('Hubo un problema en calcular las cifras, por favor recargue')
            }
            
            //
        }
        function abrirvenatan(url)
        {
            window.open(url, "_blank");
            //download(url, 'toco.pdf');
        }
        function buscarcoverages()
        {
            let divcoverages ='';
            let coverageselect =$("#coverageselect").val();
            fetch("/api/coverages").then((response) => response.json())
            .then((data) => 
            {
                coveragesList =data;
                coveragesList.map((coverage,indexCoverage) =>
                {
                    if (coverageselect==coverage.coverage)
                        $("#selectcoverage").append(`<option selected value=${coverage.coverage}> ${ new Intl.NumberFormat().format(coverage.coverage) } USD</option>`);
                    else
                        $("#selectcoverage").append(`<option value=${coverage.coverage}> ${ new Intl.NumberFormat().format(coverage.coverage) } USD</option>`);  
                })
            });
        }
        //--- funciones cambios nuevos 
        function getRateByMember (x,rate)  
        {
            //return (rate + addBenefitByMember(x)) / frequency;
            //return (rate + addBenefitByMember(x)) / 1;
            return (rate + addBenefitByMember(x)) / frequencySelected.frequency;
        }
        function addBenefitByMember (index)
        {
            let totalBenefit = 0;
            for (let i = 0; i < insurerCoverage[index].benefits.length; i++) 
            {
                if( insurerCoverage[index].benefits[i].pay == 1 )
                {
                    for (let j = 0; j < insurerCoverage[index].benefits[i].pay_benefit.length; j++) 
                    {
                        if(insurerCoverage[index].benefits[i].pay_benefit[j].selected == 1)
                        {
                            totalBenefit += insurerCoverage[index].benefits[i].pay_benefit[j].rate;
                        }
                    }
                }
            }
            return totalBenefit;
        }
        function indexMembernuevo(vector,indexInsurerCoverage)
        {
            let htmnuev ='';
            let estilo1 ='';
            let estilos2 ='';
            let estilos3 ='';
            vector.map((m,indexMember) =>
            {
                valor  =getRateByMember(indexInsurerCoverage,m.rate);
                if  (valor > 0)
                {
                    estilo1 ='text-dark mon-bold';
                    estilos2 ='text-muted mon-black';
                    estilos3='textDecorationLine:line-through';
                }
                else
                {
                    estilo1 ='text-muted mon-bold';
                    estilos2='text-primary mon-black';
                    estilos3 ='';
                }
                htmnuev +=`<div 
                    id ="${indexMember}" 
                    class='w-100 h-100 d-flex justify-content-between'>
                    <span 
                        class="${estilo1}"
                        style="textDecorationLine: "line-through" 
                    >
                        ${m.status} 
                        <b>
                        (${ m.date })
                        </b>
                        
                    </span>
                    <span 
                        id ="totalmiembro${indexInsurerCoverage}_${m.id}"
                        class="${estilos2} "
                        style="${estilos3}">
                        ${ Math.round(getRateByMember(indexInsurerCoverage,m.rate)).toLocaleString('es-MX')} USD
                        
                    </span>
                </div>`;   
            });
            return htmnuev;
        }
        function indexMembernuevo2(vector,indexInsurerCoverage)
        {
           
            vector.map((m,indexMember) =>
            {
                let totalmm =getRateByMember(indexInsurerCoverage,m.rate);
                totalmm = Math.round(totalmm);
                $("#totalmiembro"+indexInsurerCoverage+'_'+m.id).html(totalmm.toLocaleString('es-MX')+' USD ');
                
            });
        }
        function getRateTotal (a)  
        {
            let total = 0;
            for (let j = 0; j < insurerCoverage[a].coverages.members.length; j++) 
            {
                total += getRateByMember(a,insurerCoverage[a].coverages.members[j].rate);
            }
            return total;
        }
        function pay_benefitnuevo(benefit)
        {
            htmlbenefit ='';
            htmlbenefit =` <h3 
                class="mon-black text-secondary h3">
                    ${ `${benefit[0].coverage.toLocaleString('es-MX')} USD `  }
                </h3>`;
            return htmlbenefit;  
        }
        function benefitnuevo(vector,indexInsurerCoverage)
        {
            htmlbenefit ='';
            vector.map((b,indexBenefits)=>
            {
                valorr ='';
                
                if (b.pay_benefit.length == 1)
                    valorr =b.pay_benefit[0].coverage.toLocaleString('es-MX')+' USD';
                else
                {
                    
                }
                if (b.benefit)
                {
                    htmlbenefit +=`
                    <div  id="${b.id}" class="${ (b.pay == 0) ? "d-block" : "d-none" }">
                        <div class="w-100 my-2 d-flex text-start text-uppercase mon-black align-items-center h4">
                            <img class="img-benefit" src="/storage/${ b.benefit.image? b.benefit.image:"https://picsum.photos/200/300"  }" />
                            <span class="mon-black text-secondary ms-2 text-uppercase">${ b.benefit.benefit }</span> 
                        </div>     
                        <div class="row">
                            <div 
                                style= "display: ${checkCoverage(b.pay_benefit.length) }" 
                                class="py-3 col-6 col-md-6 justify-content-start align-items-center"
                            >
                                <h3 class="text-uppercase mon-normal h5">cobertura de</h3>
                            </div>
                            <div 
                                style="display: ${checkCoverage(b.pay_benefit.length) }" 
                            > 
                                <h3 
                                    class="mon-black text-secondary h3">
                                    ${valorr} 
                                </h3>           
                            </div>
                            <div class="col-12 my-3">
                                <p class="mon-light"> ${b.benefit.description ? b.benefit.description: "" }</p>
                            </div>
                        </div>           
                    </div>`;
                }
                
            });
            return htmlbenefit;
        }
        function selectPayBenefit2(i,j)
        {
            let sebeneficio= $("#sebeneficio"+i+"_"+j).val();
            console.log('selectPayBenefit2',sebeneficio,'cobertura',i,'beneficio',j)
            for (let index = 0; index < insurerCoverage[i].benefits[j].pay_benefit.length; index++) 
            {
                insurerCoverage[i].benefits[j].pay_benefit[index].selected = 0;
            }

            if( sebeneficio != -1  )
            {
                
                insurerCoverage[i].benefits[j].pay_benefit[sebeneficio].selected = 1;
                insurerCoverage[i].benefits[j].selected_benefit = insurerCoverage[i].benefits[j].pay_benefit[sebeneficio].rate;
                insurerCoverage[i].benefits[j].coverage = insurerCoverage[i].benefits[j].pay_benefit[sebeneficio].coverage;
            } 
            else if( sebeneficio == -1 )
            {
                insurerCoverage[i].benefits[j].selected_benefit = 0;
            }
            insurerCoverage =insurerCoverage;
            miembros2nuevo(i,j);
        }
        function miembros2nuevo(i,j)
        {
            insurerCoverage.map((ic,indexInsurerCoverage) =>
            {
                indexMembernuevo2(ic.coverages.members,indexInsurerCoverage);
                //$("#idtotal"+indexInsurerCoverage).html(getRateTotal(indexInsurerCoverage).toLocaleString('es-MX')+' USD ');
                let total= getRateTotal(indexInsurerCoverage).toLocaleString('es-MX')
                total = Math.round(total);
                $("#idtotal"+indexInsurerCoverage).html(total+' USD ');
            });
            //$("#totalben"+i+'_'+j).html(insurerCoverage[i].benefits[j].selected_benefit+' USD ')
            $("#totalben"+i+'_'+j).html( Math.round(insurerCoverage[i].benefits[j].selected_benefit)+' USD ')
            
        }
        function benefitnuevo_2 (vector,indexInsurerCoverage)
        {
            htmlbenefit2 ='';
            vector.map((b,indexBenefit)=>
            {
                if (b.benefit)
                {
                    htmlbenefit2 +=`
                    <div  id="${indexBenefit}" class="${ (b.pay == 1) ? "d-block" : "d-none" }">
                        <div class="w-100 my-2 d-flex text-start text-uppercase mon-black align-items-center h4">
                            <img class="img-benefit" src="/storage/${b.benefit.image}" />
                            <span class="ms-2 text-pink h5">${ b.benefit.benefit }</span> 
                        </div>     
                        <div class="row">
                            <div class="col-6 col-md-6 d-flex justify-content-start align-items-center">
                                <h3 class="mon-bold text-dark h3">cobertura de</h3>
                            </div>
                            <div class="col-6 col-md-6">
                                
                                <select 
                                    class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
                                    id ="sebeneficio${indexInsurerCoverage}_${indexBenefit}"
                                    onChange ="selectPayBenefit2(${indexInsurerCoverage},${indexBenefit})"
                                    style="height: 58px;" 
                                    aria-label="Default select example">
                                    <option value="-1"> Beneficio desactivado</option>
                                    ${selectbenficio(b.pay_benefit) }                        
                                </select>                         
                            </div>
                            <div 
                                class="">
                                <h3 class="mon-bold text-dark h3">prima de</h3>
                            </div>
                            <div class="">
                                <h3 
                                    class="mon-black text-secondary h3"
                                    id="totalben${indexInsurerCoverage}_${indexBenefit}"
                                >
                                        ${b.selected_benefit.toLocaleString('es-MX')} USD
                                </h3>
                            </div>
                            <div class="col-12 my-3">
                                <p class="mon-light"> ${b.benefit.description}</p>
                            </div>
                        </div>           
                    </div>`;
                }
               
            });
            return htmlbenefit2;
        }
        function sendCotizacion_nuevo(indexCoverage)
        {
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
            let url ='';
            phone =$("#numerocontizador").val();
            fetch("/api/sendCotizacionlotes3", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    cotizacion: insurerCoverage[indexCoverage],
                  phone: phone
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
                url = r['file'];
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            }).finally(()=>
                {
                    //
                    Swal.fire({
                        title: 'Pdf generado',
                        showCancelButton: true,
                        confirmButtonText: 'Ver pdf',
                        }).then((result) => 
                        {
                    
                            if (result.isConfirmed) 
                            {
                                abrirvenatan(url)
                            } 
                        });
                        $("#carga").css('display','none');
                    });
            
            
        }
        function generartodonuevo()
        {
            
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
            let url ='';
            phone =$("#numerocontizador").val();
            fetch("/api/sendCotizacionlotes4", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    cotizacion: insurerCoverage,
                  phone: phone
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
                if (r.ruta)
                {
                    $("#div_pdfs").html('');
                    htmlbotones ='';
                    r.ruta.map((r,indexr)=>
                    {   
                        htmlbotones +=`<div class="col-md-2"><a class="btn btn-light rounded-pill mon-regular p-3" href="${r}" target="_blank" > Ver PDF nro  -${indexr +1 }</a></div> `;
                    });

                    $("#div_pdfs").html(htmlbotones);
                    $("#exampleModal2").css('display','block');
                    
                }
            }).finally(()=>
                {
                    $("#carga").css('display','none');
                });
            
        }
        function changeFrequency(nombre,frecuency)
        {
            
            frequencySelected = {frequency:frecuency, name:nombre};
            $("#nombreprima").html('');
            $("#nombreprima").html(' Prima '+nombre);
            $(".tituloprima").html('');
            $(".tituloprima").html(' Prima '+nombre);
            for(let i = 0; i < insurerCoverage.length ; i++)
            {
                insurerCoverage[i].total = 0;
            }
            insurerCoverage =insurerCoverage;
            insurerCoverage.map((ic,indexInsurerCoverage) =>
            {
                indexMembernuevo2(ic.coverages.members,indexInsurerCoverage);
                let total = getRateTotal(indexInsurerCoverage);
                total = Math.round(total);
                $("#idtotal"+indexInsurerCoverage).html(total.toLocaleString('es-MX')+' USD ');
            });
        }
        function openModalMembers()
        {
            miembrosasegurados =insurerCoverage[0].coverages.members;
            cm =miembrosasegurados.length;
            generardatosparientes()
            $("#exampleModal").css('display','block');
        }
        function htmlparentesco()
        {
            htmlparentesco ='';
            htmlparentesco +=`
            <div class="col-12 col-md-4">
                <label class="mon-regular text-secondary">
                    Parentesco
                </label>
                <select 
                    class="form-select shadow-none border-0 bg-light" 
                    required="" 
                    style="height: 58px;">
                        <option value="Yo">Yo</option>
                        <option value="Madre o Padre">Madre o Padre</option>
                        <option value="Otro (a)">Otro (a)</option>
                        <option value="Cónyuge">Cónyuge</option>
                        <option value="Hijo/a">Hijo/a</option>
                </select>
            </div>`;
            return htmlparentesco;
        }
        function htmlyy()
        {
            htmlparentesco +=` <div class="col-12 col-md-3 py-0">
                                <label class="mon-regular text-secondary">Fecha de nacimiento</label>
                                <div class="d-flex">
                                        <select 
                                            class="form-select shadow-none border-0 bg-light" 
                                            required="" 
                                            style="height: 58px;"
                                        >
                                            <option value="0">Día</option>
                                            ${retornaropcion(1,31,1)}
                                            
                                        </select>
                                        <select 
                                            class="form-select shadow-none border-0 bg-light ms-2" 
                                            required="" 
                                            style="height: 58px;">
                                                <option value="0">Mes</option>
                                                ${retornaropcion(1,12,1)}
                                        </select>
                                        <select 
                                            class="form-select shadow-none border-0 bg-light ms-2" 
                                            required="" 
                                            style="height: 58px;"
                                        >
                                            <option value="0">Año</option>
                                            <option value="2023">2023</option>
                                            ${retornaropcion(1,12,2,)}
                                            
                                    </select>
                                </div>
                            </div>`;
            return htmlparentesco;
        }
        function retornaropcion(minimo,maximo,orden)
        {
            // orden =1 menor a mayor
            // orden= 2 mayor a menor
            retornaropcion ='';
            if (orden ==1)
            {
                for ( i =minimo; i <=maximo; i++ )
                {
                    retornaropcion +=`<option value="${i}">${i} </option>`;
                }
            }
            else
            {
                for ( i =maximo; i >=minimo; i-- )
                {
                    retornaropcion +=`<option value="${i}">${i} </option>`;
                }     
            }
            
            return retornaropcion;
        }
        function generardatosparientes()
        {
            let datosparientes='';
            miembrosasegurados.map((f,indexFamiliar) =>
            {
               
                datosparientes +=`
                        <div class="col-12 col-md-3">
                            ${generahtmlparentesco(indexFamiliar,f.status)}
                        </div>
                        <div class="col-12 col-md-3">
                            ${generahtmlsexo(indexFamiliar,f.gender)}
                        </div>
                        <div class="col-12 col-md-3 py-0">
                            <label class="mon-regular text-secondary">Fecha de nacimiento</label>
                            <div class="d-flex">
                                ${generaretornardia(indexFamiliar,f.day)}
                                ${generameses(indexFamiliar,f.month)}
                                ${generayy(indexFamiliar, f.year)}
                            </div>
                        </div>
                        <div 
                            class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center" 
                        >
                            ${  indexFamiliar ==0? '':generabotonelminar(indexFamiliar)}  
                        </div>`; 
                
            });
            $("#divparientes").html(datosparientes)
        }
        function generahtmlparentesco(id,valor)
        {
            htmlparentesco ='';
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
            <select 
                required
                name="day_${id}" 
                id="day_${id}" 
                onChange="changeday(${id}) "
                class="form-select shadow-none border-0 bg-light" 
                aria-label="Default select example"
            >
            <option value="-1">Día</option>
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
            <select 
                required
                name="mounth_${id}" 
                id="mounth_${id}" 
                onChange="changemounth(${id}) "
                class="form-select shadow-none border-0 bg-light" 
                aria-label="Default select example"
            >
            <option value="-1">Meses</option>
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
            <select 
                required
                name="birthday_${id}" 
                id="birthday_${id}" 
                onChange="changebirthday(${id}) "
                class="form-select shadow-none border-0 bg-light" 
                aria-label="Default select example"
            >
            <option value="-1">Año</option>
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
                class="">
                
                    <span class="btn bg-primary rounded-pill  text-white mon-light d-flex justify-content-center align-items-center ms-2">Eliminar familiar</span>
            </div>
            `;
            return botonelminar;
        }
        function removeFamiliar(id)
        {
            //miembrosasegurados[id].activo=1;
            miembrosasegurados.splice(id);
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
            miembrosasegurados[id].month=valor; 
        }
        function changebirthday(id)
        {
            let valor =$("#birthday_"+id).val();
            miembrosasegurados[id].year=valor;  
            
        }
        function addFamiliar()
        {
            cm  =miembrosasegurados.length;
            miembrosasegurados[cm]={
                status: "-1",
                gender: "-1",
                date: "-1",
                birthday: "-1",
                quote_id: "",
                day: "1",
                month: "1",
                year: "-1",
                total: "",
                activo :0
            }
            console.log(miembrosasegurados,'despues')
            $("#cotizador").html('');
            generardatosparientes();
        }
        
        function guardarmiembros()
        {
            
            phone =$("#numerocontizador").val();
            let idquote =$("#idquote").val();
            $("#exampleModal").css('display','none');
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
            fetch("/api/changeMembersByQuote2", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    personasAsegurar: miembrosasegurados,
                    phone: phone,
                    quoteid: idquote
                    
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
               if (r.response==true)
               {
                    Swal.fire({
                    title: '¡Datos integrantes actualizados!',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    }).then((result) => 
                    {
                        if (result.isConfirmed) 
                        {
                            location.reload()
                        } 
                        else
                        {

                        }
                    });    
                
               }
               else
               {
                    $("#divparientes").html('')
                    Swal.fire('Atencion!','No se pudo actualizar datos !','error');    
               }

            }).finally(()=>
            {
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            });
        }
        function handleClick(id)
        {
            if($("#check_"+id).is(':checked'))
                insurerCoverage[id].check=1;
            else
                insurerCoverage[id].check=0;
        }
        // funciones copias separadas para generar el cuadro comparativo 
        function cuadrocomparativo()
        {
            let fases =[];
            fases[0] ='Anual';
            fases[1]='Semestral';
            fases[2]='Trimestral';
            fases[3]='Mensual';
            let frequency=[];
            frequency[0]=1;
            frequency[1]=2;
            frequency[2]=4;
            frequency[3]=12;
            let valorc =$("#selectcoverage").val();
            $("#titulocomparativo").html('');
            $("#titulocomparativo").html(`Cobertura de ${ new Intl.NumberFormat().format(valorc) } USD`);
            for ( let i =0; i<= fases.length; i++)
            {
                if( !(typeof fases[i] === "undefined") )
                {
                    changeFrequency_c(fases[i],frequency[i])
                }
            }
            generarhtml()
        }
        function changeFrequency_c(nombre,frequency) // se toma base de la funcion para calcular le cuadro comparativo
        {
            insurerCoverage_c= insurerCoverage; // se cargar arreglo para cuadro comparativo
            for(let i = 0; i < insurerCoverage_c.length ; i++)
            {
                insurerCoverage_c[i].total = 0;
                if (crearcomparativo)
                {
                    comparativo[i]={
                        nombreseguros:insurerCoverage_c[i].name,
                        note:insurerCoverage_c[i].note,
                        plazos:insurerCoverage_c[i].plazos,
                        check:insurerCoverage_c[i].check,
                        totalanual:'',
                        totalsemestra:'',
                        totatrimetral:'',
                        totalmensual:'',
                        miembroanual:'',
                        miembrosemestral:'',
                        miembrostrimesral:'',
                        miembrosmensual:'',
                        image:insurerCoverage_c[i].image,
                        benefits:insurerCoverage_c[i].benefits 
                    };
                    cantidadcomparativo ++;
                }
                   
            }
            insurerCoverage_c =insurerCoverage_c;
            crearcomparativo =false;
            let c=0;
            insurerCoverage_c.map((ic,indexInsurerCoverage) =>
            {
                valor = indexMembernuevo2_2(ic.coverages.members,indexInsurerCoverage,frequency, 0);
                if (nombre.trim()=='Anual')
                {
                    comparativo[c].miembroanual=valor.miembros;
                    comparativo[c].totalanual= Math.round(valor.c);
                }    
                if (nombre.trim()=='Semestral')
                {
                    comparativo[c].miembrosemestral=valor.miembros;
                    comparativo[c].totalsemestra=Math.round(valor.c);
                }   
                if (nombre.trim()=='Trimestral')
                {
                    comparativo[c].miembrostrimesral=valor.miembros;
                    comparativo[c].totatrimetral=Math.round(valor.c);
                }
                if (nombre.trim()=='Mensual')
                {
                    comparativo[c].miembrosmensual=valor.miembros;
                    comparativo[c].totalmensual=Math.round(valor.c);
                }
                //console.log('total prima ! '+ic.name+' fase '+nombre , getRateTotal(indexInsurerCoverage).toLocaleString('es-MX'));
                c++;
            });
            //console.log(comparativo)
            
        }
        function indexMembernuevo2_2(vector,indexInsurerCoverage,frequency,id) // se toma base de la funcion para calcular le cuadro comparativo
        {
           
            //console.log(vector)
            let i =0;
            let miembro=[];
            let datos ={ miembros:'',c:''};
            let money =0;
            vector.map((m,indexMember) =>
            {
                //console.log('total miembro '+m.status ,getRateByMember_c(indexInsurerCoverage,m.rate,frequency).toLocaleString('es-MX'))
                mm =getRateByMember_c(indexInsurerCoverage,m.rate,frequency);
                money +=mm;
                miembro[i]=m.status+' '+Math.round(mm)+' USD';
                i++;
            });
            datos.miembros=miembro;
            datos.c=money;
            return datos;
        }
        function getRateByMember_c (x,rate,frequency)  
        {
            return (rate + addBenefitByMember_c(x)) / frequency;
        }
        function addBenefitByMember_c (index)
        {
            let totalBenefit = 0;
            for (let i = 0; i < insurerCoverage_c[index].benefits.length; i++) 
            {
                if( insurerCoverage_c[index].benefits[i].pay == 1 )
                {
                    for (let j = 0; j < insurerCoverage_c[index].benefits[i].pay_benefit.length; j++) 
                    {
                        if(insurerCoverage_c[index].benefits[i].pay_benefit[j].selected == 1)
                        {
                            totalBenefit += insurerCoverage_c[index].benefits[i].pay_benefit[j].rate;
                        }
                    }
                }
            }
            return totalBenefit;
        }
        function generarhtml()
        {
            html ='';
            console.log(comparativo);
            for (var i =0; i<cantidadcomparativo; i++)
            {
                
                //$("#divcomparar").html();
                if ((comparativo[i]) &&(comparativo[i].image) && (comparativo[i].benefits) && (comparativo[i].check) && (comparativo[i].check==1))
                {
                    //console.log(i,comparativo[i],comparativo[i].image,comparativo[i].benefits);
                    html +=`
                    <div class="row">
                        <div class="col-md-2  d-flex justify-content-center align-items-center" id="divlogo_${i}">
                            <img width="100%" src="/storage/${comparativo[i].image ?comparativo[i].image:"https://picsum.photos/200/300"}"/>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group" id="diva_${i}">
                                <button type="button" class="list-group-item list-group-item-action active">
                                    Anual
                                </button>
                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group" id="divtri_${i}">
                                <button type="button" class="list-group-item list-group-item-action active">
                                    Trimestral
                                </button>
                            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group" id="divse_${i}">
                                <button type="button" class="list-group-item list-group-item-action active">
                                    Semestral
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group" id="divmen_${i}">
                                <button type="button" class="list-group-item list-group-item-action active">
                                    Mensual
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-12 d-flex justify-content-center align-items-center">
                            <label> BENEFICIOS INCLUIDOS </label>
                            <div id="div_benficios_${i}" class="p-2">
                                ${generarbeneficios(comparativo[i].benefits)}
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class=" col-md-12 d-flex justify-content-center align-items-center">
                            <label> BENEFICIOS PAGOS </label>
                            <div id="div_benficios_${i}" class="p-2">
                                ${generarbeneficiospagos(comparativo[i].benefits)}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-12 d-flex justify-content-center align-items-center">
                            <label> NOTA:  </label>
                            <div id="div_benficios_${i}" class="p-2">
                                ${comparativo[i].note}
                            </div>
                        </div>
                    </div>  
                    
                    <hr>
                    `;
                }
                
            }
            $("#divcomparar").html('');
            $("#divcomparar").html(html);
            for (var i =0; i<cantidadcomparativo; i++)
            {
                if ((comparativo[i]) &&(comparativo[i].image) && (comparativo[i].benefits))
                {
                    generaranual(i);
                    generartrimestral(i);
                    generarsemestral(i);
                    generamensual(i);
                }   
            }
            comparativobtn =comparativo;
            comparativo ={};
            crearcomparativo =true;
            $("#exampleModal3").css('display','block');
        }
        function generarbeneficios(vector)
        {
            let html ='';
            vector.map((b,indexBenefits)=>
            {
                if ((b.pay == 0) && (b.benefit) && (b.benefit.benefit))
                {
                    html +=`<img class="img-benefit mx-2" title ="${b.benefit.benefit}" src="/storage/${ b.benefit.image? b.benefit.image:"https://picsum.photos/200/300"  }" />`;
                }
                
            });
            return html;
            
        }
        function generarbeneficiospagos(vector)
        {
            let html ='';
            vector.map((b,indexBenefits)=>
            {
                if ((b.pay == 1) && (b.benefit) && (b.benefit.benefit) && (b.coverage) && (b.coverage > 0) )
                {
                    html +=`<img class="img-benefit mx-2" title ="${b.benefit.benefit}" src="/storage/${ b.benefit.image? b.benefit.image:"https://picsum.photos/200/300"  }" />`;
                }
                
            });
            return html;
            
        }
        function generaranual(id)
        {
            //console.log(id)
            comparativo[id].miembroanual.map((c,indexcomparativo) =>
            {
                //console.log(c)
                $("#diva_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action">${c} </button>`);
            });
            $("#diva_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action">Total : ${Math.round(comparativo[id].totalanual).toLocaleString('es-MX')} $</button> <br>`);
        }
        function generartrimestral(id)
        {
            comparativo[id].miembrosemestral.map((c,indexcomparativo) =>
            {
                $("#divtri_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action">${c} </button>`);
            });
            $("#divtri_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action"> Total : ${ Math.round(comparativo[id].totatrimetral).toLocaleString('es-MX')} $ </button> <br>`);
        }
        function generarsemestral(id)
        {
            comparativo[id].miembrosemestral.map((c,indexcomparativo) =>
            {
                $("#divse_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action">${c} </button>`);
            });
            $("#divse_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action"> Total : ${ Math.round(comparativo[id].totalsemestra) .toLocaleString('es-MX')} $</button> <br>`);
        }
        function generamensual(id)
        {
            comparativo[id].miembrosmensual.map((c,indexcomparativo) =>
            {
                $("#divmen_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action">${c} </button>`);
            });
            $("#divmen_"+id).append(  `<button  type="button"  class="list-group-item list-group-item-action"> Total : ${ Math.round(comparativo[id].totalmensual).toLocaleString('es-MX')} $</button> <br>`);
        }
        function generarpdfcomparativo()
        {
            phone =$("#numerocontizador").val();
            ocular()
            fetch("/api/generarpdfcomparativo", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    cotizacion: comparativobtn,
                    phone:phone,
                    valor : $("#selectcoverage").val()
                    
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
                url = r['ruta'];
                $("#exampleModal3").css('display','none');;
                $("#carga").css('display','none');
            }).finally(()=>
            {
                Swal.fire({
                    title: 'Pdf generado',
                    showCancelButton: true,
                    confirmButtonText: 'Ver pdf',
                    }).then((result) => 
                    {
                
                        if (result.isConfirmed) 
                        {
                            abrirvenatan(url)
                        } 
                    });
                    mostrar()
            });
        }
        function ocular()
        {
            $("#exampleModal3").css('display','none');;
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
        }
        function mostrar()
        {
            $("#carga").css('display','none');
            $("#accordionExample").css('display','block');
            
        }
        function aprobarpoliza(quote)
        {
            
            $("#carga").css('display','block');
            $("#accordionExample").css('display','none');
            fetch("/api/aprobarpoliza", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    adminstrador: $("#idadmin").val(),
                    quote: insurerCoverage[quote],
                    id_quote:$("#idquote").val(),
                    quoteid:quote,
                    idusuario :$("#idusuario").val()
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
               if (r.resul)
               {
                    Swal.fire({
                    title: r.mjs,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    }).then((result) => 
                    {
                        if (result.isConfirmed) 
                        {
                            location.reload()
                        } 
        
                    });   
               }
               else
               {
                    
                    Swal.fire('Atencion!', r.mjs,'error');    
               }
            
            }).finally(()=>
            {
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            });
        }
    </script>
@endsection