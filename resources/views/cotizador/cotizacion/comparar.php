<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizacion</title>
    <!-- Bootstrap CSS -->
</head>
<body>
    <style>

body {
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
table {
    box-shadow: 0px 0px 5px 1px black;
    box-shadow: 0px 0px 5px 1px black;
    -webkit-box-shadow: 0px 0px 5px 1px black;
    -moz-box-shadow: 0px 0px 5px 1px black;
    border-radius: 20px !important;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center ;
  font-size: 9px ;
}


        .img-lg {
            position: absolute;
            width: 100%;
            left: -200px ;
            bottom: -200px ;
        }
        a {
            color: blue ;
        }

        .title {
            color: rgb(18,42,85) ;
            text-align: center;
            font-size: 32px;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: bold;
            margin: 30px 0px ;
        }

        .w-50 {
            position: relative;
            float: left;
            width: 50% ;
        }
        .total {
            font-weight: bold ;
            font-size: 18px ;
        }

        .footer {
            position: absolute ;
            left: 0px ;
            top: 960px ;
            width: 100% ;
            height: 15px ;
            z-index: 1000 ;
        }
        .logo-bg {
            position: absolute ;
            top: 40% ;
            left: -200px ;
            width: 700px ;
            height: 700px ;
            z-index: -10000;
            opacity: 0.5 ;
        }
        .footer-img {
            position: absolute ;
            bottom: -60px ;
            left: -80px ;
            width: 120% ;
            z-index: -100;
        }
        .subtitle {
            font-size: 12px !important;
        }

        .desc {
            font-size: 10px !important;
        }
        .content-time {
            background: rgb(218,220,224) ;
            padding: 10px 0px ;
            padding-right: 3px ;
            width: 100% ;
            font-size: 12px ;
        }
    </style>
    <img class="logo-bg" src="https://cotiseguros.com.ve/storage/LOGO%20RGB_Icono%20full%20color.png" alt="" srcset="">
    <img class="footer-img" src="https://cotiseguros.com.ve/storage/LOGO%20RGB_Icono%20full%20color%20copia.png" alt="" srcset="">
    
    <div style="width: 100%; text-align: center;">
        <div  style="display:inline;">
            <img 
                width="50%" 
                src="https://cotiseguros.com.ve/storage/LOGO%20RGB_Color.png" 
                alt=""
            >
            <?= date("d-m-y"); ?>
        </div>
    </div>
    <div class="title">Suma Asegurada:<?php echo number_format($valor). ' USD' ?></div>
    <?php 
        $cabezera=[];
        $cabezera[0]="Seguro";
        $cabezera[1]="Anual";
        $cabezera[2]="Semestral";
        $cabezera[3]="Trimestral";
        $cabezera[4]="Mensual";
    ?></div>
    
        <?php  
        $diccionario=[];
        $cantidad =0;
        foreach($cotizacion as $seguro)
        {
            if ($seguro['check']==1)
            {
                echo  "<table width='100%'>";
                $miembroanual = @$seguro["miembroanual"];
                $miembrosemestral= @$seguro["miembrosemestral"];
                $miembrostrimesral= @$seguro["miembrostrimesral"];
                $miembrosmensual= @$seguro["miembrosmensual"];

                $totalanual= @$seguro["totalanual"];
                $totalsemestra= @$seguro["totalsemestra"];
                $totatrimetral= @$seguro["totatrimetral"];
                $totalmensual= @$seguro["totalmensual"];
                $benefits= @$seguro["benefits"];
                $note= @$seguro["note"];
                $columnas =count($miembroanual);
                $jj =0;
                for ( $i=0; $i <=$columnas; $i++)
                {
                    
                    
                    if ($i==0)
                    {
                        echo  " <tr style ='background-color: #3c485a; color:white'>";
                        for ( $j=0; $j <5; $j++)
                        {
                            echo  "<th>".$cabezera[$j]."</th>";
                        }
                        echo  " </tr>";

                    }
                    else if ($i==1)
                    {
                        
                        echo  " <tr >";
                        //echo  "<th rowspan=". (floatval($columnas+1)).">".$seguro["nombreseguros"]."</th>";
                        // <img width="100%" src="/storage/insurers/February2023/icIZrNfL2eInK9MPdf8x.png">
                        //echo  "<th rowspan=". (floatval($columnas+1)).">".$seguro["image"]."</th>";
                        $url = $dominio.'/storage/'.$seguro["image"];
                        echo  "<th rowspan=". (floatval($columnas+1))."> <img width='120px' src='".$url."'> </th>";
                        echo  "<th>".$miembroanual[0]." USD</th>";
                        echo  "<th>".$miembrosemestral[0]." USD</th>";
                        echo  "<th>".$miembrostrimesral[0]." USD</th>";
                        echo  "<th>".$miembrosmensual[0]." USD</th>";
                        echo  " </tr>";
                        $jj++;
                    }
                    else
                    {
                        if ( $jj <$columnas )
                        {
                            echo  " <tr>";
                                echo  "<th>".$miembroanual[$jj]."</th>";
                                echo  "<th>".$miembrosemestral[$jj]."</th>";
                                echo  "<th>".$miembrostrimesral[$jj]."</th>";
                                echo  "<th>".$miembrosmensual[$jj]."</th>";
                            echo  " </tr>";
                        $jj++;
                        }
                    }
                }
                echo  " <tr>";
                    echo  "<th>". number_format($totalanual) ."</th>";
                    echo  "<th>". number_format($totalsemestra)."</th>";
                    echo  "<th>". number_format($totatrimetral)."</th>";
                    echo  "<th>". number_format($totalmensual)."</th>";
                echo  " </tr>";
                echo  " <tr>";

                    $beneficios ='';
                    for ( $k =0; $k <  count($benefits) ; $k++)
                    { 
                        if (($benefits[$k]) && ($benefits[$k]["benefit"]) && ($benefits[$k]["benefit"]['abbreviation']))
                        {
                            $dic = $benefits[$k]["benefit"]['abbreviation'].' : '.$benefits[$k]["benefit"]["benefit"];
                            if ( !(in_array(trim($dic), $diccionario)) )
                                array_push($diccionario, $dic);
                            if ($benefits[$k]["pay"]==0)
                                $beneficios.=''.$benefits[$k]["benefit"]['abbreviation'].'- ';
                        }
                           
                    }
                    echo  "<th colspan ='5'> beneficios incluidos : ".$beneficios."</th>";
                echo  " </tr>";
                echo  " <tr>";

                   
                    $beneficiospagos ='';
                    for ( $k =0; $k <  count($benefits) ; $k++)
                    { 
                        if (($benefits[$k]) && ($benefits[$k]["benefit"]) && ($benefits[$k]["benefit"]['abbreviation']))
                        {
                            $dic = $benefits[$k]["benefit"]['abbreviation'].' : '.$benefits[$k]["benefit"]["benefit"];
                            if ( !(in_array(trim($dic), $diccionario)) )
                                array_push($diccionario, $dic);
                            if (($benefits[$k]["pay"]==1) && ($benefits[$k]["coverage"])  && ($benefits[$k]["coverage"] > 0 ) )
                                $beneficiospagos.=''.$benefits[$k]["benefit"]['abbreviation'].'- ';
                           
                        }
                           
                    }
                    echo  "<th colspan ='5'> beneficios Pagos : ".$beneficiospagos."</th>";
                echo  " </tr>";
                echo  " <tr>";
                    echo  "<th colspan ='5'> Nota : ".$note."</th>";
                echo  " </tr>";
                /*
                echo  " <tr>";
                    $dicc ='';
                    foreach ($diccionario as $d)
                    {
                        $dicc.=' '.$d."<br>";
                    }
                    echo  "<th colspan ='5'> Diccionario datos <br> ".$dicc."</th>";
                echo  " </tr>";
                */
                echo  " </table> <br>";
            }
            $cantidad ++;
        }
        /*
        switch ($cantidad) 
        {
            case 1:
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                break;
            case 2:
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                break;
            case 3:
                echo "<br><br><br><br><br><br><br><br><br>";
            case 4:
                echo "<br><br>";
                break;
        }
        */
        echo "<table width='100%' border ='0'>";
            echo  " <tr>";
                $dicc ='';
                foreach ($diccionario as $d)
                {
                    $dicc.=' '.$d."<br>";
                }
                echo  "<th colspan ='5'> Diccionario de datos <br> ".$dicc."</th>";
            echo  " </tr>";
        echo  " </table>";
        //$rutafooter = $dominio.'/storage/footercotiseguros.png';
        //echo  "<img  src='".$rutafooter."'>";
        ?>
</body>
</html>