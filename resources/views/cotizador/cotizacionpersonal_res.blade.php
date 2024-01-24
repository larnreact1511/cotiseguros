@extends('layouts.app')

@section('content')
    <?php    //echo "<pre>"; print_r($coverages);    ?>
    <style>
        .custom-loader {
        width:100px;
        height:100px;
        border-radius:50%;
        border:16px solid;
        border-color:#766DF4 #0000;
        animation:s1 1s infinite;
        margin-top: 20%;
        margin-left: 50%;
        z-index: 100;
        }
        @keyframes s1 {to{transform: rotate(.5turn)}}
    </style>
    
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
          </div>
        <div id="cotizacionpesonal" class="my-5">
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

                </div> 
            </div>
            <!-- -->
            <div class="custom-loader" id ="carga" sytyle="display:none"></div>
            <!-- -->
            <div class="accordion px-3"  id="accordionExample">

            </div>
            <!-- -->
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
                                <h1 class="mon-black text-danger display-6 text-start my-3">PERSONAS A ASEGURAR</h1>
                            <div 
                                class="row"
                            >
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
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="mon-regular text-secondary">Sexo</label>
                                        <select class="form-select shadow-none border-0 bg-light" required="" style="height: 58px;">
                                            <option value="Masculino" selected="">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3 py-0">
                                        <label class="mon-regular text-secondary">Fecha de nacimiento</label>
                                        <div class="d-flex">
                                                <select 
                                                    class="form-select shadow-none border-0 bg-light" 
                                                    required="" 
                                                    style="height: 58px;"
                                                >
                                                    <option value="0">Día</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18" selected="">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                                <select 
                                                    class="form-select shadow-none border-0 bg-light ms-2" 
                                                    required="" 
                                                    style="height: 58px;">
                                                        <option value="0">Mes</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12" selected="">12</option>
                                                </select>
                                                <select 
                                                    class="form-select shadow-none border-0 bg-light ms-2" 
                                                    required="" 
                                                    style="height: 58px;"
                                                >
                                                    <option value="0">Año</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2006" selected="">2006</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2000">2000</option>
                                                    <option value="1999">1999</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1970">1970</option>
                                                    <option value="1969">1969</option>
                                                    <option value="1968">1968</option>
                                                    <option value="1967">1967</option>
                                                    <option value="1966">1966</option>
                                                    <option value="1965">1965</option>
                                                    <option value="1964">1964</option>
                                                    <option value="1963">1963</option>
                                                    <option value="1962">1962</option>
                                                    <option value="1961">1961</option>
                                                    <option value="1960">1960</option>
                                                    <option value="1959">1959</option>
                                                    <option value="1958">1958</option>
                                                    <option value="1957">1957</option>
                                                    <option value="1956">1956</option>
                                                    <option value="1955">1955</option>
                                                    <option value="1954">1954</option>
                                                    <option value="1953">1953</option>
                                                    <option value="1952">1952</option>
                                                    <option value="1951">1951</option>
                                                    <option value="1950">1950</option>
                                                    <option value="1949">1949</option>
                                                    <option value="1948">1948</option>
                                                    <option value="1947">1947</option>
                                                    <option value="1946">1946</option>
                                                    <option value="1945">1945</option>
                                                    <option value="1944">1944</option>
                                                    <option value="1943">1943</option>
                                                    <option value="1942">1942</option>
                                                    <option value="1941">1941</option>
                                                    <option value="1940">1940</option>
                                                    <option value="1939">1939</option>
                                                    <option value="1938">1938</option>
                                                    <option value="1937">1937</option>
                                                    <option value="1936">1936</option>
                                                    <option value="1935">1935</option>
                                                    <option value="1934">1934</option>
                                                    <option value="1933">1933</option>
                                                    <option value="1932">1932</option>
                                                    <option value="1931">1931</option>
                                                    <option value="1930">1930</option>
                                                    <option value="1929">1929</option>
                                                    <option value="1928">1928</option>
                                                    <option value="1927">1927</option>
                                                    <option value="1926">1926</option>
                                                    <option value="1925">1925</option>
                                                    <option value="1924">1924</option>
                                                    <option value="1923">1923</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-12 col-md-2 d-flex flex-column justify-content-center align-items-center">}
                                    <span>&nbsp;</span>
                                    <div class="btn btn-light text-white w-100 h-100 justify-content-start align-items-center" style="display: none;">
                                    <img height="30" src="/storage/Eliminar-grupo-02.png">
                                        <span class="mon-regular text-dark px-3 fw-bold">Eliminar</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <hr class="mt-3">
                                </div>
                            </div>
                </div>
                <div class="w-100 d-flex justify-content-center mb-3"><div class="btn btn-light rounded-pill mon-regular p-3">
                    <img class="px-2" height="30" src="/storage/anadir-grupo-04.png">Añadir integrante a mi póliza
                </div>
                <div class="btn bg-primary rounded-pill text-white mon-light d-flex justify-content-center align-items-center ms-2">
                    Guardar integrantes
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        
    </div>
    <a class="text-decoration-none bg-white rounded-pill text-wine fw-bold p-2 ms-3 shadow" style="position: fixed ;top: 75px ;" href="javascript: history.go(-1)">Volver atrás</a>
    <script> 
        
        let members =[];
        //let frequencySelected =["frequency" : 1 , "name" : "Anual"] 
        let frequencySelected = {frequency:"1", name:"Anual"}; //console.log(frequencySelected);
        let coverages =[];
        let coverageSelected =[];
        let coveragesList=[];
        let quote =[];
        let familiar ='';
        let htmlacordeon ='';
        let htmlbenefit='';
        let htmlmiembreso ='';
        let htmlbenefit2='';
        let ym =1950; // año menor
        let ya = new Date().getFullYear(); // año actual
        // nuevp
        let insurerCoverage =[];
        $( document ).ready(function() 
        {
            $("#carga").css('display','block');
            buscarcoverages()
            //buscarprimas()
            buscarprimas2()
            $("#cerrarmodalpersonas" ).on( "click", function() 
            {
                $("#exampleModal").css('display','none');
            });
        });
        function buscarprimas()
        {
            //
            fetch(`/api/salud/cotizacion/${ window.location.href.split("/")[window.location.href.split("/").length - 1] }`)
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
                    quote =data;
                    coverageSelected =data.coverage;
                    coverages =data.arrayCoverages;
                    members =data.memberquote;
                    const m = data.memberquote;
                    for (let index = 0; index < m.length; index++) 
                    {
                        m[index].show = true;
                    }
                    familiar =m;
                    localStorage.setItem("coverages", data.id );
                    //
                    coverages.map((coverage,indexCoverages) =>{

                        console.log(indexCoverages)
                        //console.log( coverage,indexCoverages) 
                        htmlacordeon +=
                        `<div class="accordion-item row my-3 shadow">
                            <div class="col-12 col-md-2 d-flex flex-column">
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center py-3">
                                    <img class="img-insurer" src="/storage/${coverage.insurer.image}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="w-100 text-uppercase text-center mon-black text-pink">cobertura hcm</div>
                                <div class="w-100 text-uppercase text-center mon-black text-pink">${ new Intl.NumberFormat().format(coverage.coverage) } usd 1</div>
                            </div>
                            <div class="col-12 col-md-3 d-flex flex-column">
                                <h6 class="mon-black text-uppercase text-center mt-2" id ="nombreprima">prima ${ frequencySelected.name }</h6>
                                ${ miembros(indexCoverages) }
                                <div class="w-100 d-flex">
                                    <div class="w-100 text-uppercase text-start mon-black h3 text-pink">total</div>
                                    <div class="w-100 text-uppercase text-end mon-black h3 text-pink" id ="total_${indexCoverages}">${ totalForCoverage(indexCoverages) }  USD 2</div>
                                </div>
                            </div>
                            
                            <div class="m-0 p-0 col-12 col-md-2 d-flex flex-column justify-content-center align-items-center">
                                <div  
                                    data-bs-toggle="collapse"
                                    data-bs-target="${`#collapse${indexCoverages}`}" 
                                    aria-expanded="false" aria-controls="${`#collapse${indexCoverages}`}" 
                                    class="btn btn-benefit bg-pink py-2 px-3 rounded-pill mon-black d-flex my-2"
                                >
                                    <img src="/storage/Enmascarargrupo24.png" />
                                    <div
                                        data-bs-toggle="collapse" 
                                        data-bs-target="${`#collapse${indexCoverages}`}" 
                                        aria-expanded="false" aria-controls="${`#collapse${indexCoverages}`}"  
                                        class="w-100 h-100 d-flex justify-content-start align-items-center mon-black text-start ps-2 text-white">Ver detalles</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-center align-items-center px-3">
                                <div  class="btn btn-benefit bg-pink py-2 px-3 rounded-pill mon-black d-flex align-items-center my-2">
                                    <i class="bi bi-send-fill h3 text-white mb-0"></i>
                                    <div 
                                        class="w-100 h-100 d-flex justify-content-start align-items-center mon-black text-start ps-2 text-white"
                                        onclick ="sendQuote(${indexCoverages})";
                                    >
                                        Enviar cotizacion
                                    </div>
                                </div>
                                
                            </div>

                            <div id ="collapse${indexCoverages}" class="accordion-collapse collapse col-12" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="row" id="#${indexCoverages}">
                                    <div class='col-12'>
                                        <div class='col-12'>
                                            <p class='mon-black font-weight-bold p-0 m-0'>${ (coverage.insurer.note) ? 'Nota:' : '' } ${ coverage.insurer.note }</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios incluidos</h3>
                                        ${ benefit(indexCoverages)}
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios pagos</h3>
                                        ${ benefit_2(indexCoverages)}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    } );
                    $("#accordionExample").html('');
                    $("#accordionExample").html(htmlacordeon);
                    //
                }
                $("#carga").css('display','none');
            });
            //
        }
        function buscarprimas2()
        {
            //
            fetch(`/api/getCotizacionSalud/${ window.location.href.split("/")[window.location.href.split("/").length - 1] }`)
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
                    insurerCoverage.map((ic,indexInsurerCoverage) =>
                    {
                        htmlacordeon +=`
                        <div class="accordion-item row my-3 shadow">
                            <div class="accordion-header bg-white" id=${indexInsurerCoverage}}>
                                <div class='row m-0 p-3'>
                                    <div class='col-12 col-md-2 p-2 d-flex justify-content-center align-items-center'>
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
                                            <h4 class='mon-black text-primary text-center h6 mb-0'>PRIMA ${ frequencySelected.name }</h4>
                                        </div>
                                        ${ indexMembernuevo(ic.coverages.members,indexInsurerCoverage)} 
                                    
                                        <div class='w-100 h-100 mt-2 d-flex justify-content-between'>
                                            <span class='text-dark mon-black h4'>Total</span>
                                            <span class='text-primary mon-black h4' id="idtotal${indexInsurerCoverage}"> 
                                                ${ getRateTotal(indexInsurerCoverage).toLocaleString('es-MX') } USD
                                            </span>
                                        </div>
                                    </div>
                                        <div class='col-12 col-md-5 p-0 px-3  d-flex justify-content-around align-items-center'>
                                            <span 
                                                class='btn rounded-pill bg-light fs-sm text-primary p-2 mon-bold shadow-lg mx-2' 
                                                data-bs-toggle="collapse" 
                                                data-bs-target=${`#collapse${indexInsurerCoverage}`} 
                                                aria-expanded="false" aria-controls=${`collapse${indexInsurerCoverage}`}
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
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div id ="collapse${indexInsurerCoverage}" class="accordion-collapse collapse col-12" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="row" id="#${indexInsurerCoverage}">
                                    <div class='col-12'>
                                        <div class='col-12'>
                                            <p class='mon-black font-weight-bold p-0 m-0'>${ (ic.note) ? 'Nota:' : '' } ${ic.note }</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios incluidos</h3>
                                        ${ benefitnuevo(ic.benefits,indexInsurerCoverage)}
                                    </div>
                                    <div class="col-12 col-md-6 border-end">
                                        <h3 class="text-uppercase text-success mon-black h3 pt-3 mb-4">beneficios pagos</h3>
                                        ${ benefitnuevo_2(ic.benefits,indexInsurerCoverage)}
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
        
        function changeFrequency_no(nombre,frecuency)
        {
            
            frequencySelected = {frequency:frecuency, name:nombre};
            $("#nombreprima").html('');
            $("#nombreprima").html(' Prima '+nombre);
            for(let i = 0; i < coverages.length ; i++)
            {
                coverages[i].total = 0;
            }
            coverages =coverages;
            coverages.map((coverage,indexCoverages) =>
            {
                miembros2(indexCoverages)
            })
            
        }
        function miembros(indexCoverages)
        {
            htmlmiembreso =''; 
            members.map((member,indexMember) =>{
                htmlmiembreso +=`<div  class="w-100 d-flex">
                                    <div class="w-100 text-start mon-black text-dark"> ${member.status} </div>
                                    <div class="w-100 text-uppercase text-end mon-black text-pink" id="indexCoverages${indexCoverages}_${indexMember}">
                                        ${ rateForMember(indexCoverages,indexMember) + totalBenefits(indexCoverages) } USD 3
                                    </div>
                                </div>`;
            });
            
            return htmlmiembreso;
        }
        function miembros2(indexCoverages)
        {
            htmlmiembreso ='';
            members.map((member,indexMember) =>
            {
                
               let t1 =rateForMember(indexCoverages,indexMember); console.log(t1);
               let t2 =totalBenefits(indexCoverages); console.log(t2);
               console.log('indexCoverages'+indexCoverages+'_'+indexMember)
               if (   (parseFloat(t1) + parseFloat(t2))>0 )
                $("#indexCoverages"+indexCoverages+'_'+indexMember).html( (parseFloat(t1) + parseFloat(t2))+' USD' ); 

                totalForCoverage2(indexCoverages)
            });
            
            return htmlmiembreso;
        }
        function benefit(indexCoverages)
        {
            
            coverages[indexCoverages].insurer.benefits_insurer.map((benefit,indexBenefit)=>
            {
                htmlbenefit +=`
                <div  id="${indexBenefit}" class="${ (benefit.pay == 0) ? "d-block" : "d-none" }">
                    <div class="w-100 my-2 d-flex text-start text-uppercase mon-black align-items-center h4">
                        <img class="img-benefit" src="/storage/${benefit.benefit.image}" />
                        <span class="ms-2 text-pink h5">${ benefit.benefit.benefit }</span> 
                    </div>     
                    <div class="row">
                        <div 
                            style="${{ "display" : checkCoverage(benefit.pay_benefit.length)} }" 
                            class="py-3 col-6 col-md-6 justify-content-start align-items-center"
                        >
                            <h3 class="text-uppercase mon-normal h5">cobertura de</h3>
                        </div>
                        <div 
                            style="${{ "display" : checkCoverage(benefit.pay_benefit.length)} }" 
                            class="py-3 col-6 col-md-6 justify-content-end align-items-center">
                                ${pay_benefit(benefit)}                                       
                        </div>
                        <div class="col-12 my-3">
                            <p class="mon-light"> ${benefit.benefit.description}</p>
                        </div>
                    </div>           
                </div>`;
            });
            return htmlbenefit;
        }
        function benefit_2(indexCoverages)
        {
            
            coverages[indexCoverages].insurer.benefits_insurer.map((benefit,indexBenefit)=>
            {
                htmlbenefit2 +=`
                <div  id="${indexBenefit}" class="${ (benefit.pay == 1) ? "d-block" : "d-none" }">
                    <div class="w-100 my-2 d-flex text-start text-uppercase mon-black align-items-center h4">
                        <img class="img-benefit" src="/storage/${benefit.benefit.image}" />
                        <span class="ms-2 text-pink h5">${ benefit.benefit.benefit }</span> 
                    </div>     
                    <div class="row">
                        <div class="col-6 col-md-6 d-flex justify-content-start align-items-center">
                            <h3 class="text-uppercase mon-normal h5">cobertura de</h3>
                        </div>
                        <div class="col-6 col-md-6">
                            <select 
                                class="form-select shadow-none border-0 bg-grey w-100 align-self-start" 
                                id ="sebeneficio${indexBenefit}"
                                onChange ="selectPayBenefit(${indexCoverages},${indexBenefit} )"
                                style="height: 58px;" 
                                aria-label="Default select example">
                                <option value="-1"> Beneficio desactivado</option>
                                ${selectbenficio(benefit.pay_benefit) }                        
                            </select>                         
                        </div>
                        <div 
                            class=${ (coverages[indexCoverages].insurer.benefits_insurer[indexBenefit].selected_benefit > 0) ? "col-6 col-md-6 d-flex justify-content-start align-items-center my-3" : "d-none" } >
                            <h3 class="text-uppercase mon-black h5">prima de</h3>
                        </div>
                        <div class=${ (coverages[indexCoverages].insurer.benefits_insurer[indexBenefit].selected_benefit > 0) ? "col-6 col-md-6 d-flex justify-content-start align-items-center my-3" : "d-none" }>
                            <h3 class="text-uppercase mon-black h5 text-pink">{ coverages[indexCoverages].insurer.benefits_insurer[indexBenefit].selected_benefit } usd 4 </h3>
                        </div>
                        <div class="col-12 my-3">
                            <p class="mon-light"> ${benefit.benefit.description}</p>
                        </div>
                    </div>           
                </div>`;
            });
            return htmlbenefit2;
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
        function sendQuote (indexCoverage)  
        {
            //window.open(`https://wa.me/${ window.location.href.split("/")[window.location.href.split("/").length - 1] }?text=hola`, '_blank');
            /*
            let space = "%20";
            let enter = "%0A";
            let message = "";
            console.log(frequencySelected);
            message += `*Cliente:* ${quote.name} ${quote.last_name} ${enter}`;
            console.log(quote.name,quote.last_name);
            message += `*Seguro:* ${coverages[indexCoverage].insurer.name} ${enter}`;
            console.log(coverages[indexCoverage].insurer.name);
            message += `*Cobertura:* ${coverages[indexCoverage].coverage} ${enter}`;
            console.log(coverages[indexCoverage].coverage);
            message += `*Frecuencia de pago:* ${frequencySelected.name} ${enter}${enter}`;
            message += `*Beneficiados:* ${enter}${enter}`;
            for( let j = 0 ; j < members.length ; j++ )
            {
                message += `*${members[j].status} ${members[j].gender, members[j].date}*: ${rateForMember(indexCoverage,j) + totalBenefits(indexCoverage)} ${enter}`;
                console.log( members[j].status, members[j].gender, members[j].date ,rateForMember(indexCoverage,j) + totalBenefits(indexCoverage) )
            }
            message += `${enter}${enter}*Beneficios Pagos:* ${enter}`;
            for( let i = 0 ; i < coverages[indexCoverage].insurer.benefits_insurer.length ; i++ )
            {
                if(coverages[indexCoverage].insurer.benefits_insurer[i].pay == 1 && coverages[indexCoverage].insurer.benefits_insurer[i].selected_benefit > 0 )
                {
                    message += `*${coverages[indexCoverage].insurer.benefits_insurer[i].benefit.benefit}*: ${coverages[indexCoverage].insurer.benefits_insurer[i].selected_benefit}${enter}`;
                    console.log(coverages[indexCoverage].insurer.benefits_insurer[i].benefit.benefit,coverages[indexCoverage].insurer.benefits_insurer[i].pay,coverages[indexCoverage].insurer.benefits_insurer[i].selected_benefit);
                }
            }
            //window.open(`https://wa.me/584247089641?text=${message}`, '_blank');
            //console.log(totalForCoverage(indexCoverage));
            */
            sendCotizacion(indexCoverage)
        }
        function changeCoverage()
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

        function sendCotizacion(indexCoverage)
        {
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
            let url ='';
            console.log('enviar');
            console.log('coverages',coverages,indexCoverage);
            console.log('members',members)
            phone =$("#numerocontizador").val();
    
            let formData = new FormData();
            formData.append("members", members);
            formData.append("phone", phone);
            /*
            fetch("/api/sendCotizacionlotes", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    members: members,
                    coverage: coverages[indexCoverage],
                  phone: phone
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
                //console.log(r);
                console.log(r['file']);
                url = r['file'];
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            }).finally(()=>
                {
                    abrirvenatan(url)
                });
            */
            
        }
        function abrirvenatan(url)
        {
            window.open(url, "_blank");
            download(url, 'toco.pdf');
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
                        $("#selectcoverage").append(`<option selected value=${coverage.coverage}> ${ new Intl.NumberFormat().format(coverage.coverage) }$</option>`);
                    else
                        $("#selectcoverage").append(`<option value=${coverage.coverage}> ${ new Intl.NumberFormat().format(coverage.coverage) }$</option>`);  
                })
            });
        }
        function generartodo()
        {
            
            $("#accordionExample").css('display','none');
            $("#carga").css('display','block');
            let url ='';
            phone =$("#numerocontizador").val();
    
            let formData = new FormData();
            formData.append("members", members);
            formData.append("phone", phone);
            fetch("/api/sendCotizacionlotes2", 
            {
                headers: {
                    'X-CSRF-TOKEN': window.CSRF_TOKEN, // <--- aquí el token
                    "Content-type": "application/json; charset=UTF-8"
                },
                method: "POST",
                body: JSON.stringify({
                    members: members,
                    coverage: coverages,
                  phone: phone
                }),
            })
            .then(r => r.json())
            .then(r => 
            {
                console.log(r['file']);
                url = r['file'];
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            }).finally(()=>
                {
                    abrirvenatan(url)
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
                        ${getRateByMember(indexInsurerCoverage,m.rate).toLocaleString('es-MX')} USD
                        
                    </span>
                </div>`;   
            });
            return htmnuev;
        }
        function indexMembernuevo2(vector,indexInsurerCoverage)
        {
           
            vector.map((m,indexMember) =>
            {
                $("#totalmiembro"+indexInsurerCoverage+'_'+m.id).html(getRateByMember(indexInsurerCoverage,m.rate).toLocaleString('es-MX')+' USD ');
                
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
            vector.map((b,indexBenefits)=>
            {
                valorr ='';
                if (b.pay_benefit.length == 1)
                    valorr =b.pay_benefit[0].coverage.toLocaleString('es-MX')+' USD';
                    
                htmlbenefit +=`
                <div  id="${b.id}" class="${ (b.pay == 0) ? "d-block" : "d-none" }">
                    <div class="w-100 my-2 d-flex text-start text-uppercase mon-black align-items-center h4">
                        <img class="img-benefit" src="/storage/${b.benefit.image}" />
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
                            <p class="mon-light"> ${b.benefit.description}</p>
                        </div>
                    </div>           
                </div>`;
            });
            return htmlbenefit;
        }
        function selectPayBenefit2(i,j)
        {
            let sebeneficio= $("#sebeneficio2"+j).val();
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
                $("#idtotal"+indexInsurerCoverage).html(getRateTotal(indexInsurerCoverage).toLocaleString('es-MX')+' USD ');
            });
            $("#totalben"+i+'_'+j).html(insurerCoverage[i].benefits[j].selected_benefit+' USD ')
            
        }
        function benefitnuevo_2 (vector,indexInsurerCoverage)
        {
            
            vector.map((b,indexBenefit)=>
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
                                id ="sebeneficio2${indexBenefit}"
                                onChange ="selectPayBenefit2(${indexInsurerCoverage},${indexBenefit} )"
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
                //console.log(r);
                console.log(r['file']);
                url = r['file'];
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            }).finally(()=>
                {
                    abrirvenatan(url)
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
                console.log(r['file']);
                url = r['file'];
                $("#accordionExample").css('display','block');
                $("#carga").css('display','none');
            }).finally(()=>
                {
                    abrirvenatan(url)
                });
            
        }
        function changeFrequency(nombre,frecuency)
        {
            
            frequencySelected = {frequency:frecuency, name:nombre};
            $("#nombreprima").html('');
            $("#nombreprima").html(' Prima '+nombre);
            for(let i = 0; i < insurerCoverage.length ; i++)
            {
                insurerCoverage[i].total = 0;
            }
            insurerCoverage =insurerCoverage;
            insurerCoverage.map((ic,indexInsurerCoverage) =>
            {
                indexMembernuevo2(ic.coverages.members,indexInsurerCoverage);
                $("#idtotal"+indexInsurerCoverage).html(getRateTotal(indexInsurerCoverage).toLocaleString('es-MX')+' USD ');
            });
            
        }
        function openModalMembers()
        {
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
    </script>
@endsection