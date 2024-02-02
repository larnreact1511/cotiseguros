<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Status;
use App\CodePhone;
use App\Coverage;
use App\Quote;
use App\MemberQuote;
use App\Insurer;
use App\Frequency;
use App\SaludSlider;
use App\Rate;
use App\Benefit;
use App\BenefitInsurer;
use App\PayBenefit;
use App\Footer;
use App\Phone;
use TCG\Voyager\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use PDF;
use Twilio\Rest\Client;
class CotizadorController extends Controller
{
    public function salud(){
        //dd(Auth::user()->name);
        //$codes = Http::get('https://restcountries.com/v2/all');
        $provinces = \Lang::get('provinces')["provinces"];
        //dd(env('APP_URL') . '/js/provincesVenezuela.json');
        //$provinces = Http::acceptJson()->get(env('APP_URL') . '/js/provincesVenezuela.json')->json();
        //return $provinces;
        //dd( \json_encode( $provinces) );
        //return $codes[0]["callingCodes"][0];
        $code_phones = CodePhone::all();

        $coverages = Coverage::select([
            "coverage"
        ])
            ->groupBy("coverage")
            ->orderBy("coverage","ASC")
            ->get();
        /*
        $codes_countries = [];
        //dd( count( \json_decode( $codes ) ) );
        for ($i=0;  $i < count(\json_decode( $codes )) ; $i++)  {
            $codes_countries[] = $codes[$i];
        }
        */
        //dd($codes_countries);
        $codes_countries['callingCodes']='+57';
        $codes_countries['name']='venezuela';
        return view("cotizador.salud",[
            "code_phones" => $code_phones,
            "codes" => $codes_countries,
            "coverages" => $coverages,
            "provinces" => $provinces,
            "item" => SaludSlider::first(),
            "footer" => Footer::first(),
        ]);
    }

    public function auto(){
        return view("cotizador.auto",[
            "footer" => Footer::first(),
        ]);
    }

    public function hogar(){
        return view("cotizador.hogar",[
            "footer" => Footer::first(),
        ]);
    }

    public function addCotizacion(Request $request){
        $quote = new Quote();
        $quote->name = $request->input("name");
        $quote->last_name = $request->input("last_name");
        $quote->phone = $request->input("code") . $request->input("phone");
        $quote->email = $request->input("email");
        $quote->coverage = $request->input("coverage");
        $quote->province = $request->input("province");
        $quote->state = 0;
        $quote->save();

        for ( $i=0 ; $i <= $request->input("index"); $i++ ) {
            $member = new MemberQuote();
            $member->status = $request->input("status$i");
            $member->gender = $request->input("gender$i");
            $member->date = Carbon::parse( $request->input("day$i") . "-" . $request->input("mounth$i") . "-" . $request->input("year$i") )->age;//Carbon::parse($request->input("date$i"))->age;
            $member->birthday = $request->input("day$i") . "-" . $request->input("mounth$i") . "-" . $request->input("year$i");
            $member->quote_id = $quote->id;
            $member->day =$request->input("day$i");
            $member->month =$request->input("mounth$i");
            $member->year =$request->input("year$i") ;
            $member->save();
        }

        return redirect("/cotizador/salud/cotizacionpersonal/$quote->phone");
    }
    public function addCotizacion2(Request $request)
    {
        
        $quote = new Quote();
        $quote->name = $request->input("name");
        $quote->last_name = $request->input("last_name");
        $quote->phone = $request->input("code") . $request->input("phone");
        $quote->email = $request->input("email");
        $quote->coverage = $request->input("coverage");
        $quote->province = $request->input("province");
        $quote->state = 0;
        $quote->save();
        $members = $request->input("members");
        for ( $i=0 ; $i < count($members); $i++ ) 
        {
            
            if ($members[$i]["activo"]==0)
            {
                if ( floatval($members[$i]["day"])  < 10 )
                    $members[$i]["day"] ='0'.$members[$i]["day"];

                if ( floatval($members[$i]["mounth"])  < 10 )
                    $members[$i]["mounth"] ='0'.$members[$i]["mounth"];

                if ( strlen($members[$i]["year"])  < 4 )
                    $members[$i]["year"] =2000;

                $member = new MemberQuote();
                $member->status = $members[$i]["status"];
                $member->gender = $members[$i]["gender"];
                $member->date = Carbon::parse( $members[$i]["day"]. "-" .$members[$i]["mounth"]. "-" .$members[$i]["year"] )->age;
                $member->birthday = $members[$i]["day"]. "-" .$members[$i]["mounth"]. "-" .$members[$i]["year"];
                $member->quote_id = $quote->id;
                $member->day =$members[$i]["day"];
                $member->month =$members[$i]["mounth"];
                $member->year =$members[$i]["year"];
                $member->save();
            }   
        }
        $dataresponce['status'] = true;
        $dataresponce['nro'] = true;
        $dataresponce['ruta']="/cotizador/salud/cotizacionpersonaladmin/".$quote->phone;
        return response()->json($dataresponce);
        
    }
    public function getCotizacion(){
        return view("cotizador.cotizacion",[
            "item" => SaludSlider::first(),
            "footer" => Footer::first(),
        ]);
    }
    public function getCotizacion2($p)
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

        $getCotizacion2 ='';
        $user =false;
        $lock =0;
        if (in_array(trim($p), $nros_excluidos)) 
        {
            $getCotizacion2= $this->getCoverageData($p); //echo " aa".$p; die;
            return view("cotizador.cotizacionpersonal",
            [
                "coverages"=>Coverage::select(["coverage"])->groupBy("coverage")->orderBy("coverage","ASC")->get(),
                "frequency"=>Frequency::all(),
                "arrayCoverages"=>$getCotizacion2['arrayCoverages'],
                "memberquote"=>$getCotizacion2['memberquote'],
                "coverages"=>$getCotizacion2['coverages'],
                "lock"=>0,
                "numero"=>$p,
                "coverage"=>$getCotizacion2['coverage'],
                "item" => SaludSlider::first(),
                "footer" => Footer::first(),
            ]);
        }
        else if( $user )
        {
            
            $getCotizacion2= $this->getCoverageData($p);
            
        } 
        else 
        {
            //echo " no es user ";
            $phone = Phone::where("phone",$p)->first();
            if( $phone->lock == 1 )
            {
                $lock=1; 
                return view("cotizador.cotizacionpersonal",
                [
                "coverages"=>Coverage::select(["coverage"])->groupBy("coverage")->orderBy("coverage","ASC")->get(),
                "frequency"=>Frequency::all(),
                "arrayCoverages"=>[],
                "memberquote"=>[],
                "coverages"=>[],
                "lock"=>$lock,
                "numero"=>$p,
                "coverage"=>0,
                    "item" => SaludSlider::first(),
                    "footer" => Footer::first(),
                ]);
            } 
            else 
            {
                
                $getCotizacion2= $this->getCoverageData($p);
                return view("cotizador.cotizacionpersonal",
                [
                   "coverages"=>Coverage::select(["coverage"])->groupBy("coverage")->orderBy("coverage","ASC")->get(),
                   "frequency"=>Frequency::all(),
                   "arrayCoverages"=>$getCotizacion2['arrayCoverages'],
                   "memberquote"=>$getCotizacion2['memberquote'],
                   "coverages"=>$getCotizacion2['coverages'],
                   "lock"=>$lock,
                   "numero"=>$p,
                   "coverage"=>$getCotizacion2['coverage'],
                    "item" => SaludSlider::first(),
                    "footer" => Footer::first(),
                ]);
               
            }
        }
        //echo "<pre>"; print_r($getCotizacion2); die;
       
    }
    public function getCotizacion3($p,$id)
    {
        $user = User::where("phone",$p)->first();
        $getCotizacion2= $this->getCoverageData($p);
        return view("cotizador.cotizacionpersonaladmin",
        [
           "coverages"=>Coverage::select(["coverage"])->groupBy("coverage")->orderBy("coverage","ASC")->get(),
           "frequency"=>Frequency::all(),
           "arrayCoverages"=>$getCotizacion2['arrayCoverages'],
           "memberquote"=>$getCotizacion2['memberquote'],
           "coverages"=>$getCotizacion2['coverages'],
            "lock"=>false,
           "numero"=>$p,
           "idquote"=>$id,
           "coverage"=>$getCotizacion2['coverage'],
            "item" => SaludSlider::first(),
            "footer" => Footer::first(),
        ]);
    }
    public function getCotizacion4($p)
    {
        $user = User::where("phone",$p)->first();
        $getCotizacion2= $this->getCoverageData($p);
        return view("cotizador.cotizacionpersonaladmin",
        [
           "coverages"=>Coverage::select(["coverage"])->groupBy("coverage")->orderBy("coverage","ASC")->get(),
           "frequency"=>Frequency::all(),
           "arrayCoverages"=>$getCotizacion2['arrayCoverages'],
           "memberquote"=>$getCotizacion2['memberquote'],
           "coverages"=>$getCotizacion2['coverages'],
            "lock"=>false,
           "numero"=>$p,
           "idquote"=>$getCotizacion2["id"],
           "coverage"=>$getCotizacion2['coverage'],
            "item" => SaludSlider::first(),
            "footer" => Footer::first(),
        ]);
    }
    public function getCotizacionByPhone($p)
    {
        $nros_excluidos =[];
        $exluido=false;
        // luis
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
        $user = User::where("phone",$p)->first();

        if( $user )
        {
            return $this->getCoverageData($p);
        } 
        else 
        {
            if (in_array(trim($p), $nros_excluidos)) 
            {
                return $this->getCoverageData($p);
            }
            else
            {
                $qoutes = Quote::where("phone",$p)->count();
                $phone = Phone::where("phone",$p)->first();

                if( $phone->lock == 1 )
                {
                    return [ "status" => false];
                } 
                else 
                {
                    return $this->getCoverageData($p);
                    // if( $qoutes > 0 && is_int( $qoutes / 5 ) >= 1 ){
                    //     //$phone->lock = 1;
                    //     //$phone->save();

                    //     return [ "status" => false];
                    // } else {
                    //     return $this->getCoverageData($p);
                    // }
                }
            }
            
        }

        
    }

    public function getCoverageData($phone)
    {
        $quote =  Quote::with("memberquote")
            ->with(["coverages" => function($q){
                $q->orderBy("orden","ASC");
                $q->with("rates")
                    ->with(["insurer" => function($queryInsurer){
                        //$queryInsurer->orderBy("orden","ASC");
                        $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                            $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                        }]);
                }]);
            }])
            /*->where([
                "state" => 0,
                "phone" => $phone
            ])*/
            ->where([
                "phone" => $phone
            ])
            ->orderBy("id","DESC")
            ->first();
        //unset($quote["coverages"][0]);
        //echo "<pre>"; print_r($quote); echo " 2 "; die;
        $listCoverages = []; 

        for($i=0 ; $i < count($quote["coverages"]); $i++ ) {
            $bool = false;
            for($j=0; $j < count($quote["coverages"][$i]["rates"]) ; $j++) {
                for($k=0 ; $k < count($quote["memberquote"]) ; $k++ ) { 
                    if( $quote["coverages"][$i]["rates"][$j]["from"] <= $quote["memberquote"][$k]["date"] && $quote["coverages"][$i]["rates"][$j]["to"] >= $quote["memberquote"][$k]["date"] ){
                        
                        $bool = true;
                    }
                }
            }
            if( $bool ){
                $listCoverages[] = $i;
            }
        }
        

        $arrayCoverages = [];
        for($i=0 ; $i < count($quote["coverages"]); $i++ ) {
            $bool = false;
            for ($j=0; $j < count($listCoverages) ; $j++) {
                //unset($quote["coverages"][$listCoverages[$j]]);
                if( $listCoverages[$j] == $i ){
                    $bool = true;
                }
            }
            if( $bool ){
                $arrayCoverages[] = $quote["coverages"][$i];
            }
        }
        $quote["id"] =$quote->id;
        $quote["arrayCoverages"] = $arrayCoverages;

        return $quote;
    }

    public function test(){
        return Insurer::with(["benefitsInsurer" => function($q){
            $q->with(["payBenefit","benefit"]);
        }])->get();
    }

    public function getFrequency(){
        return Frequency::all();
    }

    public function getCoberages(){
        $coverages = Coverage::select([
            "coverage"
        ])
            ->groupBy("coverage")
            ->orderBy("coverage","ASC")
            ->get();

        return $coverages;
    }


    public function changeCoverage($phone,$coverage){
        $quote = Quote::where([
            "state" => 0,
            "phone" => $phone
            ])
        ->orderBy("id","DESC")
        ->first();
        
        $quote->coverage = $coverage;
        $quote->save();

        return $this->getCoverageData($phone);
    }

    public function importExcel(Request $request){
        $insurers = Insurer::all();
        $rows = Excel::toArray( [] ,$request->file('excel'));

        $nameInsurer = $rows[0][0][0];
        $insurer = Insurer::where("name",$nameInsurer)->first();
        if(!$insurer){
            return view("admin.importExcel",[
                "insurers" => $insurers,
                "message" => [
                    "status" => false,
                    "message" => "Seguro no registrado"
                ]
            ]);
        }

        for($i = 0; $i < count($rows) ;$i++){
            switch($i){
                case 0:
                    $listCoverages = $rows[$i][1];
                    $listRates = $rows[$i];
                    //return $listRates;
                    Coverage::where("insurer_id",$insurer->id)->delete();
                    Rate::where('insure_id', $insurer->id)->delete();
                    for($indexCoverage = 1; $indexCoverage < count($listCoverages) ;$indexCoverage++){
                        if((int)$listCoverages[$indexCoverage] != 0 || (int)$listCoverages[$indexCoverage] == null ){
                            $coverage = new Coverage();
                            $coverage->coverage = (int)$listCoverages[$indexCoverage];
                            $coverage->insurer_id = $insurer->id;
                            $coverage->orden = $insurer->orden ? $insurer->orden: 2;
                            $coverage->save();

                            for( $indexRate = 2 ; $indexRate < count( $listRates ) ; $indexRate++ ){
                                if( $listRates[$indexRate][0] != null ){
                                    $from = (int)explode("-", $listRates[$indexRate][0] )[0];
                                    $to = (int)explode("-", $listRates[$indexRate][0] )[1];

                                    $rate = new Rate();
                                    $rate->from = $from;
                                    $rate->to = $to;
                                    $rate->rate = (int)$listRates[$indexRate][$indexCoverage];
                                    $rate->coverage_id = $coverage->id;
                                    $rate->insure_id = $insurer->id;
                                    $rate->save();
                                }
                                
                                
                            }
                        }
                        

                    }
                    break;
                default:
                    $benefitSelected = $rows[$i][0][0];
                    $rates = $rows[$i];


                    $benefit = Benefit::where("benefit",$benefitSelected)->first();
                    if(!$benefit){
                        return "error benefit $benefitSelected";
                    }

                    $benefitInsurer = BenefitInsurer::where([
                        "benefit_id" => $benefit->id,
                        "insurer_id" => $insurer->id
                    ])->first();
                
                    if($benefitInsurer){
                        if( $rows[$i][0][1] == "incluido" ){
                            $benefitInsurer->pay = 0;
                        }
                        if( $rows[$i][0][1] == "pago" ){
                            $benefitInsurer->pay = 1;
                        }
                        $benefitInsurer->save();
                        PayBenefit::where([
                                "insurer_id" => $insurer->id,
                                "benefit_insurer_id" => $benefitInsurer->id
                            ])->delete();
                        for($indexRate = 1; $indexRate < count($rates) ;$indexRate++){
                            if( (int)$rates[$indexRate][1] > 0 ){
                                $payBenefit = new PayBenefit();
                                $payBenefit->insurer_id = $insurer->id;
                                $payBenefit->benefit_insurer_id = $benefitInsurer->id;
                                $payBenefit->coverage = $rates[$indexRate][0];
                                $payBenefit->rate = $rates[$indexRate][1];
                                $payBenefit->save();
                            }
                        }
                    }

                    
                    break;
            }
        }
        
        return view("admin.importExcel",[
            "insurers" => $insurers,
            "message" => [
                "status" => true,
                "message" => "Coverturas actualzadas con exito"
            ]
        ]);
        //return redirect("/admin/excel");
    }

    public function insurerExcel(){
        $insurers = Insurer::all();
        return view("admin.importExcel",[
            "insurers" => $insurers
        ]);
    }

    public function listarCotizaciones($page){
        return view("admin.listarCotizaciones",[
            "page" => $page
        ]);
    }

    public function getCotizacionesByOrder(){
        return Quote::orderBy('id', 'DESC')
            ->with("memberquote")
            ->with(["coverages" => function($q){
                $q->with("rates")->with(["insurer" => function($queryInsurer){
                    $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                        $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                    }]);
                }]);
            }])
            ->paginate(3);
            // ->skip( ( $number * 10 ) - 10 )
            // ->take(10)
            // ->orderBy("id","DESC")
            // ->get();
    }
    public function listado()
    {
        return view("cotizador.listado");
    }
    public function cotizar()
    {
        $provinces = \Lang::get('provinces')["provinces"];
        $code_phones = CodePhone::all();
        $coverages = Coverage::select([
            "coverage"
        ])
            ->groupBy("coverage")
            ->orderBy("coverage","ASC")
            ->get();
        $codes_countries['callingCodes']='+57';
        $codes_countries['name']='venezuela';
        return view("cotizador.cotizarinterno",[
            "code_phones" => $code_phones,
            "codes" => $codes_countries,
            "coverages" => $coverages,
            "provinces" => $provinces
        ]);
    }
    public function listartabla(Request $request)
    {
        $search = $request->input('search'); 
        if ($search['value']=='')
        {
            $Quote =Quote::orderBy('id', 'DESC')
            ->with("memberquote")
            ->with(["coverages" => function($q){
                $q->with("rates")->with(["insurer" => function($queryInsurer){
                    $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                        $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                    }]);
                }]);
            }])->skip($request->input('start'))->take($request->input('length'))->get();
            //
            $count =Quote::orderBy('id', 'DESC')
            ->with("memberquote")
            ->with(["coverages" => function($q){
                $q->with("rates")->with(["insurer" => function($queryInsurer){
                    $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                        $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                    }]);
                }]);
            }])->count();
        }
        else
        {
            $value =$search['value']; 
            $Quote =Quote::orderBy('id', 'DESC')->where(function ($query) use ($value) {
                $query->where('name', 'LIKE', "%$value%")
                    ->orWhere('email', 'LIKE', "%$value%")
                    ->orWhere('phone', 'LIKE', "%$value%");      
            })
            ->with("memberquote")
            ->with(["coverages" => function($q)
            {
                $q->with("rates")->with(["insurer" => function($queryInsurer){
                    $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                        $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                    }]);
                }]);
            }])->get();
           
            //
            $count =Quote::orderBy('id', 'DESC')
            ->with("memberquote")
            ->with(["coverages" => function($q){
                $q->with("rates")->with(["insurer" => function($queryInsurer){
                    $queryInsurer->with(["benefitsInsurer" => function($queryBenefitsInsurer){
                        $queryBenefitsInsurer->with(["payBenefit","benefit"]);
                    }]);
                }]);
            }])->count();
        }
        $i = 0;
        $datos=[];
        foreach( $Quote  as $q)
        {
            $vbuscar =array('email'=>$q->email);
            $vbuscar2 =array('idquote'=>$q->id);
            $esusuario =0;
            if ( (DB::table('users')->where($vbuscar)->count())> 0 )
            {
                $users =DB::table('users')->where($vbuscar)->get();
                $esusuario =$users[0]->id;
            }    
            $aceptada =DB::table('quote_clients')->where($vbuscar2)->count();
            $datos[$i]['esusuario'] =$esusuario;
            $datos[$i]['aceptada'] =$aceptada;
            $datos[$i]['id'] = $q->id;
            $datos[$i]['name'] = $q->name.' '.$q->last_name;
            $datos[$i]['phone'] = $q->phone;
            $datos[$i]['email'] = $q->email;
            $datos[$i]['fecha'] =date_format($q->created_at, "Y/m/d");;
            $datos[$i]['coverage'] =number_format($q->coverage, 2, ',', ' '); ;
            $datos[$i]['memberquote'] = $q->memberquote;
            $datos[$i]['state'] = $q->state;
            $datos[$i]['coverages'] = $q->coverages;
            

            $i++;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = count($datos) >0 ? $count: 0;
        $dataresponce['recordsFiltered'] = count($datos) >0 ? $count: 0;
        $dataresponce['data'] = $datos;
        return response()->json($dataresponce);
    }

    public function cotizacionExitosa(){
        return view("cotizador.exitoza");
    }

    public function checkPhone($phone)
    {
        $data = Phone::where("phone",$phone)->first();
        if( $data )
        {
            if( $data->status == 1 )
            {
                return [
                    "status" => true
                ];
            } 
            else 
            {
                $this->sendSms($data->phone,$data->code);
                return 
                [
                    "status" => false
                ];
            }
        } 
        else 
        {
            $p = new Phone();
            $p->phone = $phone;
            $p->code = random_int(100000, 999999);
            //$p->code = 202020;
            $p->save();
            $this->sendSms($phone,$p->code);
            return [
                "status" => false
            ];
        }
    }

    public function verifyCode($phone,$code){
        $data = Phone::where("phone",$phone)->first();
        if( $data ){
            if( $data->code == $code ){
                $data->status = 1;
                $data->save();

                return [
                    "status" => true,
                ];
            } else {
                return [
                    "status" => false,
                    "message" => "Codigo erroneo"
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Numero no registrado."
            ];
        }
    }

    public function sendSmsold($phone,$code)
    {
        $response = Http::asForm()
        ->withBasicAuth('AC13191eced4e5518b813a199bf4327ca8', 'ef4158677bbcf0edad8851023791ed15')
        ->post('https://api.twilio.com/2010-04-01/Accounts/AC13191eced4e5518b813a199bf4327ca8/Messages.json', [
            "To" => "$phone",
            "MessagingServiceSid" => "AC13191eced4e5518b813a199bf4327ca8",
            "Body" => "Bienvenido a cotiseguros. Tu codigo de verificacion es $code"
                
        ]);
        //print_r($response);
    }
    public function sendSms2()
    {
        $account_sid = 'AC13191eced4e5518b813a199bf4327ca8';
        $auth_token = 'ef4158677bbcf0edad8851023791ed15';
        $twilio_number = "+15419063551";
        $recipients ="+584120721749";
        $message =" kewin es tremendo giron de ramirez ? ";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message] );
        dd($client);
    }
    public function sendSms($phone,$code)
    {
        
        $account_sid = 'AC13191eced4e5518b813a199bf4327ca8';
        $auth_token = 'ef4158677bbcf0edad8851023791ed15';
        $twilio_number = "+15419063551";
        $recipients =$phone;
        $message = "Bienvenido a cotiseguros. Tu codigo de verificacion es $code ";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message] );
    }

    public function changeMembers(Request $request,$id){
        if( MemberQuote::where("quote_id",$id)->delete() ){
            for ( $i=0 ; $i < $request->input("index"); $i++ ) {
                $member = new MemberQuote();
                $member->status = $request->input("status$i");
                $member->gender = $request->input("gender$i");
                $member->date = Carbon::parse( $request->input("day$i") . "-" . $request->input("mounth$i") . "-" . $request->input("year$i") )->age;//Carbon::parse($request->input("date$i"))->age;
                $member->birthday = $request->input("day$i") . "-" . $request->input("mounth$i") . "-" . $request->input("year$i");
                $member->quote_id = $id;
                $member->save();
            }

            $quote = Quote::find($id);

            return redirect("/cotizador/salud/cotizacion/$quote->phone");
        }
    }

    public function pdf(){
        $pdf = PDF::loadView('cotizador.cotizacion.salud', []);
        return $pdf->download('archivo-pdf.pdf');
    }
    public function deletecotizacion(Request $request)
    {
        //echo " borrar ".$request->id; aja 
        if(Quote::where('id',$request->id)->delete())
            return true;
        else 
            return false;
    }

    public function comparar()
    {
        return view("cotizador.cotizacion.comparar");
    }
}
