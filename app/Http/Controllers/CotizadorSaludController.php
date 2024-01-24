<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use PDF;
use App\Footer;
use App\Quote;
use App\MemberQuote;
use App\Insurer;
use App\Rate;
use App\Coverage;
use App\BenefitInsurer;
use App\PayBenefit;
use App\Frequency;
use App\Mail\Cotizador;
use App\Phone;
use App\Models\Insurancepolicies;

class CotizadorSaludController extends Controller
{
    public function salud(){
        return view("cotizador.salud2",[
            "footer" => Footer::first(),
        ]);
    }

    public function cotizarSalud(Request $request){
        $quote = new Quote();
        $quote->name = $request->input("name");
        $quote->last_name = $request->input("lastName");
        $quote->phone = $request->input("code") . $request->input("phone");
        $quote->email = $request->input("email");
        $quote->coverage = $request->input("coverage");
        $quote->province = $request->input("province");
        $quote->state = 1;
        $quote->save();
        
        for ( $i=0 ; $i < count( $request->input("personasAsegurar") ); $i++ ) {
            $member = new MemberQuote();
            $member->status = $request->input("personasAsegurar")[$i]["status"];
            $member->gender = $request->input("personasAsegurar")[$i]["gender"];
            $member->date = Carbon::parse( $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] )->age;//Carbon::parse($request->input("date$i"))->age;
            $member->birthday = $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] ;
            $member->day = $request->input("personasAsegurar")[$i]["day"];
            $member->month = $request->input("personasAsegurar")[$i]["month"];
            $member->year = $request->input("personasAsegurar")[$i]["year"];
            $member->quote_id = $quote->id;
            $member->save();
        }

        return [
            "status" => true
        ];
    }

    public function getCotizacionSalud($phone)
    {
        $nros_excluidos =[];
        $exluido=false;
        // luis 584247574613
        $nros_excluidos[0]='+5804247574613';
        $nros_excluidos[1]='+584247574613';
        // paola
        $nros_excluidos[2]='+5804125471687';
        $nros_excluidos[3]='+584125471687';
        // daniel
        $nros_excluidos[4]='+5804120721749';
        $nros_excluidos[5]='+584120721749';
        //jose
        $nros_excluidos[4]='+584247551587';
        $nros_excluidos[5]='+5804247551587';

        $phoneVerify = Phone::where([
            "phone" => $phone
        ])->first();
        /*
        $quotesCount = Quote::where([
            "phone" => $phone,
            "state" => 1
        ])->count();
        */
        $quotesCount = Quote::where([
            "phone" => $phone,
        ])->count();
        if (in_array(trim($phone), $nros_excluidos)) 
        {
            //
            $quote = Quote::where([
                "phone" => $phone
                ])
                ->orderBy("id","DESC")
                ->first();
            $coverage = $quote->coverage;
            $insurers = Insurer::orderBy("orden","ASC")->get();
            $coverageArray = [];
            $c = [];
            for ($i=0; $i < count($insurers) ; $i++) {
                $coverages = Coverage::select(
                    "id",
                    "coverage",
                    "insurer_id"
                )
                ->where("coverage","=", $coverage)
                ->where("insurer_id","=",$insurers[$i]["id"])
                ->first();
    
                if($coverages != null){
                    $memberQuote = MemberQuote::where([
                        "quote_id" => $quote->id
                    ])->get();
    
                    $insurers[$i]["coverages"] = $coverages;
                    $insurers[$i]["coverages"]["members"] = $memberQuote;
                    for ($j=0; $j < count($insurers[$i]["coverages"]["members"]) ; $j++) {
                        
                        $rate = Rate::where("coverage_id",$insurers[$i]["coverages"]["id"])
                            ->where("from","<=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                            ->where("to",">=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                            ->first();
                        
                        if($rate){
                            $insurers[$i]["coverages"]["members"][$j]["rate"] = $rate->rate;
                        } else {
                            $insurers[$i]["coverages"]["members"][$j]["rate"] = 0;
                        }
                        
                       
                    }
                    $befefits = BenefitInsurer::where("insurer_id",$insurers[$i]["id"])
                        ->with("payBenefit")
                        ->with("benefit")
                        ->get();
                    $insurers[$i]["benefits"] = $befefits;
                }
            }
    
            $dataArray = [];
            for($i=0; $i < count($insurers) ; $i++) 
            { 
                if(  $insurers[$i]["coverages"] != null )
                {
                    $dataArray[] = $insurers[$i];
                } 
            }
            if ((@$quote->id) && (@$quote->coverage > 0))
            {
                return [
                    "status" => true,
                    "idquote" =>$quote->id,
                    "data" => $dataArray,
                    "id"=>$quote->id,
                    "message" => ""
                ];
            }
            else
            {
                return [
                    "status" => false,
                    "idquote" =>$quote->id,   
                    "data" => [],
                    "id"=>$quote->id,
                    "message" => "La cotización no fue creada correctamente, pro favor verifiqué los datos de la misma"
                ];
            }
            //
        }
        else if($quotesCount < 5 || $phoneVerify->accept == 1 )
        {
            if( $phoneVerify )
            {
                if($phoneVerify->lock == 0 || $phoneVerify->accept == 1 )
                {
                    $quote = Quote::where([
                        "phone" => $phone
                        ])
                        ->orderBy("id","DESC")
                        ->first();
                    
                    $coverage = $quote->coverage;
            
                    $insurers = Insurer::orderBy("orden","ASC")->get();
            
                    $coverageArray = [];
                    $c = [];
                    for ($i=0; $i < count($insurers) ; $i++) {
                        $coverages = Coverage::select(
                            "id",
                            "coverage",
                            "insurer_id"
                        )
                        ->where("coverage","=", $coverage)
                        ->where("insurer_id","=",$insurers[$i]["id"])
                        ->first();
            
                        if($coverages != null){
                            $memberQuote = MemberQuote::where([
                                "quote_id" => $quote->id
                            ])->get();
            
                            $insurers[$i]["coverages"] = $coverages;
                            $insurers[$i]["coverages"]["members"] = $memberQuote;
                            for ($j=0; $j < count($insurers[$i]["coverages"]["members"]) ; $j++) {
                                
                                $rate = Rate::where("coverage_id",$insurers[$i]["coverages"]["id"])
                                    ->where("from","<=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                                    ->where("to",">=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                                    ->first();
                                
                                if($rate){
                                    $insurers[$i]["coverages"]["members"][$j]["rate"] = $rate->rate;
                                } else {
                                    $insurers[$i]["coverages"]["members"][$j]["rate"] = 0;
                                }
                                
                               
                            }
                            $befefits = BenefitInsurer::where("insurer_id",$insurers[$i]["id"])
                                ->with("payBenefit")
                                ->with("benefit")
                                ->get();
                            $insurers[$i]["benefits"] = $befefits;
                        }
                    }
            
                    $dataArray = [];
                    for($i=0; $i < count($insurers) ; $i++) 
                    { 
                        if(  $insurers[$i]["coverages"] != null )
                        {
                            $dataArray[] = $insurers[$i];
                        } 
                    }
                    if ((@$quote->id) && (@$quote->coverage > 0))
                    {
                        return [
                            "status" => true,
                            "data" => $dataArray,
                            "id"=>$quote->id,
                            "message" => "",
                            "idquote" =>$quote->id,
                        ];
                    }
                    else
                    {
                        return [
                            "status" => false,
                            "data" => [],
                            "id"=>$quote->id,
                            "message" => "La cotización no fue creada correctamente, pro favor verifiqué los datos de la misma",
                            "idquote" =>0,
                        ];
                    }
                    
                } 
                else 
                {
                    return [
                        "status" => false,
                        "data" => [],
                        "message" => "Haz superado el limite de cotizacion. comunicate con nuestros expertos.",
                        "idquote" =>0
                    ];
                }
            } else {
                return [
                    "status" => false,
                    "data" => [],
                    "message" => "Numero no registrado.",
                    "idquote" =>0
                ];
            }
        } else {
            $phoneVerify->lock = 1;
            $phoneVerify->save();

            return [
                "status" => false,
                "data" => [],
                "message" => "Haz superado el limite de cotizacion. comunicate con nuestros expertos.",
                "idquote" =>0
            ];
        }
    }

    public function getCotizacionSaludadmin($phone,$id)
    {
        $quote = Quote::where([
            "id" => $id
            ])
            ->orderBy("id","DESC")
            ->first();
        $coverage = $quote->coverage;
        $insurers = Insurer::orderBy("orden","ASC")->get();
        for ($i=0; $i < count($insurers) ; $i++) 
        {
            $coverages = Coverage::select(
                "id",
                "coverage",
                "insurer_id"
            )
            ->where("coverage","=", $coverage)
            ->where("insurer_id","=",$insurers[$i]["id"])
            ->first();

            if($coverages != null){
                $memberQuote = MemberQuote::where([
                    "quote_id" => $quote->id
                ])->get();

                $insurers[$i]["coverages"] = $coverages;
                $insurers[$i]["coverages"]["members"] = $memberQuote;
                for ($j=0; $j < count($insurers[$i]["coverages"]["members"]) ; $j++) {
                    
                    $rate = Rate::where("coverage_id",$insurers[$i]["coverages"]["id"])
                        ->where("from","<=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                        ->where("to",">=", $insurers[$i]["coverages"]["members"][$j]["date"] )
                        ->first();
                    
                    if($rate){
                        $insurers[$i]["coverages"]["members"][$j]["rate"] = $rate->rate;
                    } else {
                        $insurers[$i]["coverages"]["members"][$j]["rate"] = 0;
                    }
                    
                   
                }
                $befefits = BenefitInsurer::where("insurer_id",$insurers[$i]["id"])
                    ->with("payBenefit")
                    ->with("benefit")
                    ->get();
                $insurers[$i]["benefits"] = $befefits;
                $insurers[$i]["insurersid"] = $insurers[$i]["id"];
            }
        }

        $dataArray = [];
        for($i=0; $i < count($insurers) ; $i++) { 
            if(  $insurers[$i]["coverages"] != null ){
                $dataArray[] = $insurers[$i];
            } 
        }
        $busquote =array(  'idquote'=>$id );
        $idusuario =0;
        if ( (DB::table('quote_clients')->where($busquote)->count()) > 0)
        {
            $resul = DB::table('quote_clients')->where($busquote)->get();
            $idusuario = $resul[0]->idusuario;   
           
        }
        
        return [
            "status" => true,
            "idquote" =>$quote->id,
            "idusuario" =>$idusuario,
            "data" => $dataArray,
            "message" => ""
        ];
    }
    
    public function getQuoteByPhone($phone){
        $quote = Quote::where([
            "phone" => $phone
            ])
            ->orderBy("id","DESC")
            ->first();

        return $quote;
    }

    public function changeCoverage($phone,$coverage){
        $quote = Quote::where(
        [
            "state" => 1,
            "phone" => $phone
        ])->orderBy("id","DESC")->first();
        if ($quote)
        {
            //echo " a";
            $quote->coverage = $coverage;
            if($quote->save()){
                return [ "coverage" => (int)$coverage ,  "id" =>$quote->id ];
            }
        }
        else
        {
            $quote = Quote::where(
                [
                    "state" => 0,
                    "phone" => $phone
                ])->orderBy("id","DESC")->first();
                $quote->coverage = $coverage;
                //$quote->state=1;
                if($quote->save()){
                    return [ "coverage" => (int)$coverage ];
                }
        }
        return [ "response" => false ];
    }
     public function changeCoverageid(Request $request)
     {
        $quote = Quote::where(
        [
            "id" => $request->idquote
        ])->orderBy("id","DESC")->first();
        //echo $request->coverage.''.$request->idquote;
        if ($quote)
        {
            //echo " a";
            $quote->coverage = (int)$request->coverage;
            if($quote->save()){
                return [ "coverage" => (int)$request->coverage ,  "id" =>$quote->id ];
            }
        }
        else
        {
            $quote = Quote::where(
                [
                    "id" => $request->idquote
                ])->orderBy("id","DESC")->first();
                $quote->coverage = (int)$request->coverage;
                //$quote->state=1;
                if($quote->save()){
                    return [ "coverage" => (int)$request->coverage ];
                }
        }
        return [ "response" => false ];
    }

    public function getMembersByQuote($phone){
        $quote = Quote::where([
            "state" => 1,
            "phone" => $phone
            ])
        ->orderBy("id","DESC")
        ->first();

        return MemberQuote::where("quote_id", $quote->id )->get();

    }

    public function changeMembersByQuote(Request $request){
        $quote = Quote::where([
            "state" => 1,
            "phone" => $request->input("phone")
            ])
        ->orderBy("id","DESC")
        ->first();

        if( MemberQuote::where("quote_id", $quote->id )->delete() ){
            for ( $i=0 ; $i < count( $request->input("personasAsegurar") ); $i++ ) {
                $member = new MemberQuote();
                $member->status = $request->input("personasAsegurar")[$i]["status"];
                $member->gender = $request->input("personasAsegurar")[$i]["gender"];
                $member->date = Carbon::parse( $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] )->age;//Carbon::parse($request->input("date$i"))->age;
                $member->birthday = $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] ;
                $member->quote_id = $quote->id;
                $member->save();
            }

            return [
                "response" => true
            ];
        } else {
            return "dfhf";
        }
    }
    public function changeMembersByQuote2(Request $request)
    {
        
        $quoteid =$request->input("quoteid");
        if( MemberQuote::where("quote_id", $quoteid )->delete() )
        {
            for ( $i=0 ; $i < count( $request->input("personasAsegurar") ); $i++ ) 
            {
                $member = new MemberQuote();
                $member->status = $request->input("personasAsegurar")[$i]["status"];
                $member->gender = $request->input("personasAsegurar")[$i]["gender"];
                $member->date = Carbon::parse( $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] )->age;//Carbon::parse($request->input("date$i"))->age;
                $member->birthday = $request->input("personasAsegurar")[$i]["day"] . "-" . $request->input("personasAsegurar")[$i]["month"] . "-" . $request->input("personasAsegurar")[$i]["year"] ;
                $member->quote_id = $quoteid;
                $member->day = $request->input("personasAsegurar")[$i]["day"];
                $member->month = $request->input("personasAsegurar")[$i]["month"] ;
                $member->year = $request->input("personasAsegurar")[$i]["year"] ;
                $member->save();
            }

            return [
                "response" => true,
                "quoteid" => $quoteid
            ];
        } else {
            return [
                "response" => false,
                "quoteid" => $quoteid
            ];
        }
    }

    public function sendCotizacion(Request $request){

        $cotizacion = Quote::where([
            "phone" => $request->input("phone")
        ])->first();

        $file = "archivo-" . str_replace("+","",$cotizacion->phone) . "-" . Carbon::parse($cotizacion->created_at)->format('d-m-y') . "-" . uniqid() . '-cotizacion.pdf';

        $res = PDF::loadView('cotizador.cotizacion.salud', [
                "cotizacion" => $request->input("cotizacion"),
                "frecuencies" => Frequency::all()
            ])
        //->download('mi-archivo.pdf');
        
        ->save(storage_path('app/public/') . $file );

        Mail::to($cotizacion->email)->send(new Cotizador( env('APP_URL') . "/storage/" . $file ));

        return [
            "file" => env('APP_URL') . "/storage/" . $file,
            "email" => $cotizacion->email
        ];
    }

    public function sendCotizacionlotes(Request $request)
    {
        
        $members =$request->input("members");
        $phone =$request->input("phone");
        $coverage =$request->input("coverage");
        
        $time =time();
        $file = '/'.$time.'.pdf';
        $data['file']= env('APP_URL') . "storage/" . $file;
        //$data['email']=$coverage['email'];
        $datos["id"] =5;
        $datos["name"] ='Constitución';
        $datos["note"] ='Este monto no incluye el IGTF';
        $datos["image"] ='insurers/February2023/WtF5iAbFzAH7koVkqJ5y.png';
        $datos["plazos"]="<ul>\r\n<li><span class=\"fontstyle0\">Poseen cobertura inmediata para enfermedades virales, accidentes, apendicitis, dengue, infecciones</span><span class=\"fontstyle0\">&nbsp;respiratorias. </span><strong><span class=\"fontstyle0\" style=\"color: rgb(224, 62, 45);\">COBERTURA DE COVID-19</span></strong><span class=\"fontstyle0\">, tiene 30 d&iacute;as de plazo de espera</span></li>\r\n<li><span class=\"fontstyle0\">A los&nbsp;</span><span class=\"fontstyle3\">seis (06) </span><span class=\"fontstyle0\">meses cobertura de adenoiditis no infecciosa, hemorroides, v&eacute;rtigo o laberintitis, </span><span class=\"fontstyle0\">faringo- amigdalitis entre otras.</span></li>\r\n<li><span class=\"fontstyle0\">A los&nbsp;</span><span class=\"fontstyle3\">nueve (9) </span><span class=\"fontstyle0\">meses, tendr&aacute;n cobertura Hernias, aneurisma, arritmia card&iacute;aca, arterosclerosis, </span><span class=\"fontstyle0\">hipertensi&oacute;n arterial, c&aacute;ncer, todas las dem&aacute;s</span></li>\r\n<li><span class=\"fontstyle0\">Maternidad&nbsp;</span><span class=\"fontstyle3\">diez (10) </span><span class=\"fontstyle0\">meses</span></li>\r\n</ul>";
	
        $res = PDF::loadView('cotizador.cotizacion.salud2', [
            "cotizacion" => $coverage,
            "members" => $members,
            "datos" => $datos,
            "frecuencies" => Frequency::all()
        ])
        //->download('mi-archivo.pdf');
        //->save(storage_path('app/public/') . $file );
        ->save('C:\xampp8\htdocs\cotiseguros\public\storage'.$file );
          
        return response()->json($data);
        
    }
    public function sendCotizacionlotes2(Request $request)
    {
        
        $members =$request->input("members");
        $phone =$request->input("phone");
        $coverage =$request->input("coverage");
        $time =time();
        $file = '/'.$time.'.pdf';
        $data['file']= env('APP_URL') . "storage/" . $file;
        //$data['email']=$coverage['email'];
        $datos["id"] =5;
        $datos["name"] ='Constitución';
        $datos["note"] ='Este monto no incluye el IGTF';
        //$datos["image"] ='insurers/February2023/WtF5iAbFzAH7koVkqJ5y.png';
        $datos["plazos"]="<ul>\r\n<li><span class=\"fontstyle0\">Poseen cobertura inmediata para enfermedades virales, accidentes, apendicitis, dengue, infecciones</span><span class=\"fontstyle0\">&nbsp;respiratorias. </span><strong><span class=\"fontstyle0\" style=\"color: rgb(224, 62, 45);\">COBERTURA DE COVID-19</span></strong><span class=\"fontstyle0\">, tiene 30 d&iacute;as de plazo de espera</span></li>\r\n<li><span class=\"fontstyle0\">A los&nbsp;</span><span class=\"fontstyle3\">seis (06) </span><span class=\"fontstyle0\">meses cobertura de adenoiditis no infecciosa, hemorroides, v&eacute;rtigo o laberintitis, </span><span class=\"fontstyle0\">faringo- amigdalitis entre otras.</span></li>\r\n<li><span class=\"fontstyle0\">A los&nbsp;</span><span class=\"fontstyle3\">nueve (9) </span><span class=\"fontstyle0\">meses, tendr&aacute;n cobertura Hernias, aneurisma, arritmia card&iacute;aca, arterosclerosis, </span><span class=\"fontstyle0\">hipertensi&oacute;n arterial, c&aacute;ncer, todas las dem&aacute;s</span></li>\r\n<li><span class=\"fontstyle0\">Maternidad&nbsp;</span><span class=\"fontstyle3\">diez (10) </span><span class=\"fontstyle0\">meses</span></li>\r\n</ul>";
	
        $res = PDF::loadView('cotizador.cotizacion.salud3', 
        [
            "cotizaciones" => $coverage,
            "members" => $members,
            "datos" => $datos,
            "frecuencies" => Frequency::all()
        ])
        //->download('mi-archivo.pdf');
        //->save(storage_path('app/public/') . $file );
        ->save('C:\xampp8\htdocs\cotiseguros\public\storage'.$file );
          
        return response()->json($data);
        
    }
    public function sendCotizacionlotes3(Request $request){

        $cotizacion = Quote::where([
            "phone" => $request->input("phone")
        ])->first();

        $file = "archivo-" . str_replace("+","",$cotizacion->phone) . "-" . Carbon::parse($cotizacion->created_at)->format('d-m-y') . "-" . uniqid() . '-cotizacion.pdf';

        $res = PDF::loadView('cotizador.cotizacion.salud', [
                "cotizacion" => $request->input("cotizacion"),
                "frecuencies" => Frequency::all()
            ])
        //->download('mi-archivo.pdf');
        ->save(storage_path('app/public/') . $file );
        Mail::to($cotizacion->email)->send(new Cotizador( env('APP_URL') . "/storage/" . $file ));
        return [
            "file" => env('APP_URL') . "/storage/" . $file,
            "email" => $cotizacion->email
        ];
    }
    public function sendCotizacionlotes4(Request $request){

        $cotizacion = Quote::where([
            "phone" => $request->input("phone")
        ])->first();
        $i=0;
        $coverages =$request->input("cotizacion");
        //echo "<pre>"; print_r($coverages); die;
        
        foreach ($coverages as $coverage )
        {
            //echo $coverage['check'];
            
            if ($coverage['check']==1)
            {
                $file = "archivo-" . str_replace("+","",$cotizacion->phone) . "-" . Carbon::parse($cotizacion->created_at)->format('d-m-y') . "-" . uniqid() . '-cotizacion.pdf';
                $res = PDF::loadView('cotizador.cotizacion.salud', [
                        "cotizacion" => $coverage,
                        "frecuencies" => Frequency::all()
                    ])
                //->download('mi-archivo.pdf');
                ->save(storage_path('app/public/') . $file );
                Mail::to($cotizacion->email)->send(new Cotizador( env('APP_URL') . "/storage/" . $file ));
                $data['ruta'][$i]= env('APP_URL') . "/storage/" . $file;
                $i++;
            }
        }
        
       // $data['ruta'][0]='hola/';
       // $data['ruta'][1]='hola/';
        return response()->json($data);

    }
    public function generarpdfcomparativo(Request $request){

        $cotizacion = Quote::where([
            "phone" => $request->input("phone")
        ])->first();
        $i=0;
        $coverages =$request->input("cotizacion");
        $file = "archivo-" . str_replace("+","",$cotizacion->phone) . "-" . Carbon::parse($cotizacion->created_at)->format('d-m-y') . "-" . uniqid() . 'comparativo.pdf';
        $res = PDF::loadView('cotizador.cotizacion.comparar', [
                "cotizacion" => $coverages,
                "valor" =>$request->input("valor"),
                "dominio" =>env('APP_URL'),
                "frecuencies" => Frequency::all()
            ])
        //->download('mi-archivo.pdf');
        ->save(storage_path('app/public/') . $file );
        Mail::to($cotizacion->email)->send(new Cotizador( env('APP_URL') . "/storage/" . $file ));
        $data['ruta'][$i]= env('APP_URL') . "/storage/" . $file;
        $i++;
        return response()->json($data);

    }
    public function smtp(){
        Mail::to("bahimer8080@gmail.com")->send(new Cotizador("hola@hello"));
        return "holaaaa";
    }

}