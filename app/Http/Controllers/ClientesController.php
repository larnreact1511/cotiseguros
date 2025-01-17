<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Models\Docuemntos;

use Illuminate\Http\Request;
use App\Footer;
use App\Quote;
use App\Models\User;
use App\Models\Insurancepolicies;
use App\Models\frequencyofpayments;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\FuncCall;
use App\Coverage;
use App\Insurer;
use Carbon\Carbon;
use App\MemberQuote;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("clientes.login",[
            "footer" => Footer::first(),
        ]);
    }
    public function documentos()
    {
        //
        //$data = DB::table('docuemntos')->where('idusuario',auth()->id())->get();
        //echo "<pre>"; print_r($data); die;
        return view("clientes.documentos",[
            "footer" => Footer::first(),
            "documentos" =>DB::table('docuemntos')->where('idusuario',auth()->id())->get()
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientes $clientes)
    {
        //
    }

    function update1()
    {
        $insurancepolicies = DB::table('insurancepolicies')->get();
        foreach ($insurancepolicies as $insurancepolicie )
        {
            $id =$insurancepolicie->id;
            $idcoverages = $insurancepolicie->idcoverages;
            $count =  DB::table('coveragesres')->where('id',$idcoverages);
            if($count->count() > 0 )
            {
               

                $coverage = $count->get();
                $coverage = $coverage[0]->coverage;
                $data =array(
                    
                    'idcoverages'=>$coverage
                ); 
                DB::table('insurancepolicies')->where('id',$id)->update($data);
                //echo $coverage .'  ';
            }
            else
            {
                echo ' no '. $id;
            }
        }
        
    }

    public function uploadFile(Request $request) 
    {
        $imagen =array();
        if ($files =  $request->file('imagen'))
        {
            foreach ( $files  as $file )
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                Docuemntos::where('idusuario', auth()->id())->delete();
                if ($file->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>auth()->id()
                        ]);            
                }   
            }
        }
        return back();
       
    }
    public function uploadFile2(Request $request) 
    {
        if ($idcliente =  $request->idcliente)
        {
            $user = DB::table('clientes')->where('id',$idcliente)->get();
            $idusuario =$user[0]->idusuario;
            if ($documento1 =  $request->file('documento1'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento1->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'Cedula');
                Docuemntos::where($delete)->delete();
                if ($documento1->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'Cedula',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'created_at'=>date('Y-m-d')
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');
                    
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                    
            }
            
            if ($documento2 =  $request->file('documento2'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento2->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento2');
                Docuemntos::where($delete)->delete();
                if ($documento2->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento2',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);  
                    session()->flash('message', 'Documento cargado con éxito');     
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($documento3 =  $request->file('documento3'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento3->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento3');
                Docuemntos::where($delete)->delete();
                if ($documento3->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento3',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');         
                }
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($documento4 =  $request->file('documento4'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento4->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento4');
                Docuemntos::where($delete)->delete();
                if ($documento4->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento4',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
        }
        else
            session()->flash('error_documentos', 'No se puede verificar información del cliente, para realizar el pago');

        return back();   
    }
    public function uploadFilecontrato(Request $request) 
    {
        if ($idcliente =  $request->idcliente)
        {
            $user = DB::table('clientes')->where('id',$idcliente)->get();
            $idusuario =$user[0]->idusuario;
            if ($contrato1 =  $request->file('contrato1'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($contrato1->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'contrato1');
                Docuemntos::where($delete)->delete();
                if ($contrato1->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'contrato1',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'created_at'=>date('Y-m-d'),
                            'tipo'=>1
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');
                    
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                    
            }
            
            if ($contrato2 =  $request->file('contrato2'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($contrato2->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'contrato2');
                Docuemntos::where($delete)->delete();
                if ($contrato2->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'contrato2',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'tipo'=>1
                        ]);  
                    session()->flash('message', 'Documento cargado con éxito');     
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($contrato3 =  $request->file('contrato3'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($contrato3->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'contrato3');
                Docuemntos::where($delete)->delete();
                if ($contrato3->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'contrato3',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'tipo'=>1
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');         
                }
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($contrato4 =  $request->file('contrato4'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($contrato4->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'contrato4');
                Docuemntos::where($delete)->delete();
                if ($contrato4->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'contrato4',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'tipo'=>1
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
        }
        else
            session()->flash('error_documentos', 'No se puede verificar información del cliente, para realizar el pago');

        return back();   
    }
    public function uploadFile3(Request $request) 
    {
        if ($idusuario =  $request->idcliente)
        {
            if ($documento1 =  $request->file('documento1'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento1->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'Cedula');
                Docuemntos::where($delete)->delete();
                if ($documento1->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'Cedula',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario,
                            'created_at'=>date('Y-m-d')
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');
                    
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                    
            }
            
            if ($documento2 =  $request->file('documento2'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento2->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento2');
                Docuemntos::where($delete)->delete();
                if ($documento2->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento2',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);  
                    session()->flash('message', 'Documento cargado con éxito');     
                }   
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($documento3 =  $request->file('documento3'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento3->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento3');
                Docuemntos::where($delete)->delete();
                if ($documento3->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento3',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);   
                    session()->flash('message', 'Documento cargado con éxito');         
                }
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
            if ($documento4 =  $request->file('documento4'))
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento4->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $delete=array('idusuario'=>$idusuario,'tipodocumento'=>'documento4');
                Docuemntos::where($delete)->delete();
                if ($documento4->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>'documento4',
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$idusuario
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
            }
        }
        else
            session()->flash('error_documentos', 'No se puede verificar información del cliente, para realizar el pago');

        return back();   
    }
    public function perfilcliente(Request $request)
    {
        $data['idcliente']=$request->id; 
        $info =$this->inforcliente($request->id);
        $data['documentos']=$info['documentos'];
        $data['contrato']=$info['contrato'];
        $data['info']=$info['info'];
        $data['quotes']=$info['quotes'];
        $data['quotes2']=$info['quotes2'];
        $data['keyqrrandon']=$info['keyqrrandon'];
        $data['codeqr']=$info['codeqr'];
        $data['provinces'] =\Lang::get('provinces')["provinces"];
        $data['frequencies']=DB::table('frequencies')->get();
        return view("admin.documentosclientesadmin",$data);
    }
    function actualizardatos(Request $request)
    {
        if ($idcliente2 =  $request->idcliente2)
        {
            if ( ( DB::table('clientes')->where('cedula',$request->cedula)->where('idusuario','!=',$idcliente2) ->count() ) >0 )
            {
                session()->flash('message', 'El número de cédula que intenta ingresar ya pertenece a otro cliente'); echo "a"; 
            }
            else if ( ( DB::table('clientes')->where('rif',$request->cedula)->where('idusuario','!=',$idcliente2) ->count() ) >0 )
            {
                session()->flash('message', 'El número de rif que intenta ingresar ya pertenece a otro cliente'); echo "b";
            }
            else
            {
                $numero =  $request->code.$request->numerotelefono;
                $data =array(
                    'updated_at'=>date("Y-m-d H:i:s"),
                    'nombre'=>@$request->nombre,
                    'apellido'=>@$request->apellido,
                    'nacionalidad'=>@$request->nacionalidad,
                    'cedula'=>@$request->cedula,
                    'rif'=>@$request->rif,
                    'fecha_nacimiento'=>@$request->fecha_nacimiento,
                    'numerotelefono'=>$numero,
                    'nombrecontacto'=>@$request->nombrecontacto,
                    'telefonococontacto'=>@$request->telefonococontacto,
                    'cedulacontacto'=>@$request->cedulacontacto,
                ); 
                if ( (DB::table('clientes')->where('idusuario',$idcliente2)->update($data)) )
                {
                    //echo "c";
                    $data2 =array(
                        'updated_at'=>date('Y-m-d'),
                        'name'=>$request->nombre,
                        'lastname'=>$request->apellido,
                        'phone'=>$numero
                        
                    );
                    if ( (DB::table('users')->where('id',$request->idcliente2)->update($data2)) )
                        session()->flash('message', 'Datos actualizados con éxito');
                    else
                        session()->flash('message', 'No se pudo actualizar datos del cliente');

                    //
                    if ($documentopersonal =  $request->file('documentopersonal'))
                    {
                        //echo "d";
                        $cn=0; //echo "<pre>"; print_r($documentopersonal); die;
                        $nombredocumentopersonal =$request->input("nombredocumentopersonal");
                        foreach ($documentopersonal as $documento)
                        {
                            $image_name=md5(rand(1000,10000));
                            $ext = strtolower($documento->getClientOriginalExtension() );
                            $image_full_name=$image_name.'.'.$ext;
                            $upload_path ='public/documentos/';
                            $imagen_url = $upload_path.$image_full_name;
                            $tipo ='documentopersonal';
                            if ( $nombredocumentopersonal[$cn] )
                                $tipo =$nombredocumentopersonal[$cn];
                            if ($documento->move(public_path('documentos'),$image_full_name))
                            {
                                $imagen[]=$imagen_url;
                                Docuemntos::insert(
                                    [
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'documentonombre'=>$image_full_name,
                                        'tipodocumento'=>$tipo,
                                        'documentonombre'=>'documentos/'.$image_full_name,
                                        'idusuario'=>$request->idcliente2,
                                        'tipo'=>0,
                                        'id_insurancepolicies'=>0
                                    ]);    
                                session()->flash('message', 'Documento cargado con éxito');              
                            } 
                            else
                                session()->flash('error_documentos', 'No se pudo subir algunos documentos');

                            $cn ++;
                        }
                    } 
                    else
                    {
                       
                    }
                }
                else
                {
                    session()->flash('error_datos', 'No se pudo actualizar datos del cliente');
                }       
            }
        }
        else
            session()->flash('error_datos', 'No se puede verificar información del cliente, para actualizar');
        return back();
    }
    public function inforcliente($id)
    {
       
        $data['info'] = DB::table('clientes')->where('id',$id)->get();
        $info = $data['info'];
        if ( $info[0]->codeqr)
        {
            $codeqr =$info[0]->codeqr;
            QrCode::size(300)->generate('https://cotiseguros.com.ve/asegurado/'.$codeqr, '../public/qrcodes/'.$codeqr.'.svg');
        }
        $busdocumento =array('idusuario'=>$data['info'][0]->idusuario, 'tipo'=>0 );
        $buscontrato =array('idusuario'=>$data['info'][0]->idusuario, 'tipo'=>1 );
        $documentoscliente =array('idusuario'=>$data['info'][0]->idusuario);
        $data['documentoscliente'] = DB::table('docuemntos')->where($documentoscliente)->get();
        $data['documentos'] = DB::table('docuemntos')->where($busdocumento)->get();
        $data['contrato'] = DB::table('docuemntos')->where($buscontrato)->get();
        $data['quotes'] =DB::table('quote_clients')->join('quotes', 'quote_clients.idquote', '=', 'quotes.id')->where('quote_clients.idusuario',$data['info'][0]->idusuario)->select('quotes.id', 'quotes.coverage', 'quotes.state')->get();
        $algo =rand(1000, 1000000);
        $numerotelefono=$data['info'][0]->numerotelefono;
        //$data['keyqrrandon']=Hash::make($numerotelefono);
        $data['keyqrrandon']=md5( time() );
        $data['codeqr']=$data['info'][0]->codeqr;
        $can=0;
        $datosc=[];
        if ( (DB::table('insurancepolicies')->where('idusuario',$data['info'][0]->idusuario)->count()) >0  )
        {
            $busc= array(
                'idusuario'=>$data['info'][0]->idusuario,
                'id_quote'=>0
            );
            $polizas = DB::table('insurancepolicies')->where($busc)->get();
            foreach ($polizas as $p)
            {
                //echo "<pre>"; print_r($p);
                $poliza = json_decode($p->policies);
                $vec = (array)$poliza;
                //echo "<pre>"; print_r($vec);
                if  (  (count($vec) > 0) && !(is_null($vec['coverages']->coverage) )) 
                {
                    $datosc[$can]=array(
                        'id' =>$p->id_quote,
                        'coverage' =>$vec['coverages']->coverage,
                        'name' =>$vec['name'],
                        'id_insurancepolicies' =>$p->id
                    );
                    $can++;
                }
                
            }
        }
        $data['quotes2']=$datosc;
        return $data;
    }
    public function verpagos(Request $request)
    {
        $pagos = DB::table('frequencyofpayments')
        ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
        ->where('frequencyofpayments.fechainicio', '<',date('Y-m-d') )
        ->select('frequencyofpayments.id','frequencyofpayments.fechainicio','frequencyofpayments.fechafin','frequencyofpayments.montoestimado', 'payments.montopago', 'payments.photo_payment','payments.fechapago')
        ->get();
        //echo "<pre>"; print_r($pagos);
        if ( count($pagos) > 0  )
        {
            $responce['pay']=true;
            $responce['payments'] =$pagos;
        }
        else
        {
            $responce['pay']=false;
            $responce['payments'] =[];
        }
        return response()->json($responce);
    }
    public function createclientedesdequote(Request $request )
    {
        $responce=[];
        $quote = DB::table('quotes')->where('id',$request->id)->get();
        $vbuscar =array(
            'nombre'=>trim($quote[0]->name),
            'apellido'=>trim($quote[0]->last_name),
            'numerotelefono'=>trim($quote[0]->phone),
        );
        if ( (DB::table('users')->where('email',$quote[0]->email)->count()) > 0)
        {
            $responce['save']=false;
            $responce['mjs']='El correo ya existe registado a un usuario';
        }
        else if ( (DB::table('clientes')->where($vbuscar)->count()) > 0)
        {
                $responce['save']=false;
                $responce['mjs']='Este Usuario ya es cliente ';
        }
        else
        {
            $vinsert =array(
                'nombre'=>trim($quote[0]->name),
                'apellido'=>trim($quote[0]->last_name),
                'numerotelefono'=>trim($quote[0]->phone),
                'created_at'=>date('Y-m-d'),
            );
            if (DB::table('clientes')->insert($vinsert)) // creocliente
            {
                $clienteagreado = DB::table('clientes')->where($vinsert)->get();
                $user =array(
                    'role_id'=>4,
                    'name'=>$quote[0]->name,
                    'email'=>$quote[0]->email,
                    'password' => Hash::make($quote[0]->phone),
                    'phone'=>$quote[0]->phone,
                    'lastname'=>$quote[0]->last_name
                );
                //echo "<pre>"; print_r($user); die;
                if (DB::table('users')->insert($user))
                {
                    $usurioagreado =DB::table('users')->where($user)->get();
                    DB::table('clientes')->where('id',$clienteagreado[0]->id)->update(array( 'idusuario'=>$usurioagreado[0]->id));
                    DB::table('quotes')->where('id',$request->id)->update(array( 'state'=>3));
                    $quote_clients =array(
                        'idusuario'=>$usurioagreado[0]->id,
                        'idquote'=>$request->id,
                        'updated_at'=>date('Y-m-d')

                    );
                    DB::table('quote_clients')->insert($quote_clients);
                    $responce['save']=true;
                    $responce['ultimousuario']=$usurioagreado[0]->id;
                    $responce['mjs']='Cliente y usuario  creado, recuerd;e que la clave es el nro. De teléfono';
                }
                else
                {
                    $responce['save']=false;
                    $responce['mjs']='No se pudo crear el usuario';
                }
                
            }
            else
            {
                $responce['save']=false;
                $responce['mjs']='';
            }
        }
        return response()->json($responce);
    }
    public function listarclientes_1(Request $request)
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
                $query->where('name', 'LIKE', "%$value%");
                    //->orWhere('email', 'LIKE', "%$value%")
                    //->orWhere('coverage', 'LIKE', "%$value%");      
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
        
        foreach( $Quote  as $q)
        {
        
            $datos[$i]['id'] = $q->id;
            $datos[$i]['name'] = $q->name.' '.$q->last_name;
            //$datos[$i]['last_name'] = $q->last_name;
            $datos[$i]['phone'] = $q->phone;
            $datos[$i]['email'] = $q->email;
            $datos[$i]['coverage'] = $q->coverage;
            //$datos[$i]['state'] = $q->state;
            //$datos[$i]['province'] = $q->province;
            $datos[$i]['memberquote'] = $q->memberquote;
            $datos[$i]['coverages'] = $q->coverages;

            $i++;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = $count;
        $dataresponce['recordsFiltered'] = $count;
        $dataresponce['data'] = $datos;
        return response()->json($dataresponce);
    }
    public function addgrupupe($id)
    {
        if (DB::table('clientes')->where('id',$id)->count() > 0)
        {
            $data['cliente']=DB::table('clientes')->where('id',$id)->get();
            $data['companys']=DB::table('company')->get();
            return view("admin.addgrupupe",$data);
        }
        
    }
    public function groupeemploye(Request $request)
    {
        //dd($request->idempresa, $request->idempleado);
        if ( isset($request->idempresa) && isset($request->idempleado) )
        {
            DB::table('company_client')->insertGetId(
                [
                    'created_at' => date("Y-m-d H:i:s"),
                    'idcompany' => $request->idempresa,
                    'idclient' => $request->idempleado,
                    
                ]);
                
                session()->flash('message', 'Empleado agregado a empresa con exito');
                return back();
        }
        else{
            session()->flash('message', 'NO se pudo agregar empleado a empresa');
            return back();
        }
        
    }
    public function listaclientes()
    {
        return view("admin.listadoclientes");
    }
    public function eliminarclietne($id)
    {
        $cliente = DB::table('clientes')->where('id',$id)->get();
        $idusuario = $cliente[0]->idusuario;
        DB::table('clientes')->where('clientes.id',$id)->delete();
        DB::table('users')->where('users.id',$idusuario)->delete();

        $dataresponce['resullt'] = true;
        return response()->json($dataresponce);
    }
    public function deletselct(Request $request)
    {
        if ( $request->input('data') )
        {
            $data = $request->input('data'); 
            foreach($data as $d)
            {
                $cliente = DB::table('clientes')->where('id',$d)->get();
                $idusuario = $cliente[0]->idusuario;
                DB::table('clientes')->where('clientes.id',$d)->delete();
                DB::table('users')->where('users.id',$idusuario)->delete();
            }
        }
        $dataresponce['resullt'] = true;
        return response()->json($dataresponce);
    }
    public function listarclientes(Request $request)
    {
        $users = DB::table('users')->where('role_id',5)->get();
        foreach ($users as $u)
        {
            $idusuario =$u->id;
            if ( (DB::table('clientes')->where('idusuario',$idusuario)->count()) >0  )
            {
                // ya es cliente no pasa nada
            }
            else
            {
                $agregarcliente = DB::table('clientes')->insertGetId(
                    [
                        'created_at'=>date("Y-m-d H:i:s"),
                        'nombre'=>$u->name,
                        'cedula' =>'',
                        'estado' =>1,
                        'idusuario' =>$idusuario,
                        'rif' =>''
                    ]);
            }
        }
        
        $search = $request->input('search'); 
        $datos=[];
        $limit = $request->input('length');
        $start = $request->input('start');

        $order = $request->input('order');
        $column =$order[0]['column'];
        $dir =$order[0]['dir'];

        $orderBy ='id';
        switch ($column) {
            case 0:
                $orderBy ='id';
                break;
            case 1:
                $orderBy ='nombre';
                break;
            case 2:
                $orderBy ='apellido';
                break;
            case 3:
                $orderBy ='cedula';
                break;
            case 4:
                $orderBy ='numerotelefono';
                break;
            case 5:
                $orderBy ='email';
                    break;
            case 6:
                $orderBy ='estado';
                    break;
        }
        if ($search['value']=='')
        {
            $clientes =DB::table('clientes')
            ->select('clientes.id',
            'clientes.nombre',
            'clientes.apellido',
            'clientes.numerotelefono',
            'clientes.cedula',
            'clientes.rif',
            'clientes.estado',
            'clientes.tipocliente',
            'clientes.idusuario',
            'users.email')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id')
            ->skip($start)
            ->take($limit)
            ->orderBy($orderBy, 'desc')
            ->get();
    
            $recordsTotal =DB::table('clientes')
            ->select('clientes.id',
            'clientes.nombre',
            'clientes.apellido',
            'clientes.numerotelefono',
            'clientes.cedula',
            'clientes.rif',
            'clientes.estado',
            'clientes.tipocliente',
            'clientes.idusuario',
            'users.email')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id')
            ->orderBy('id', 'desc')
            ->get();
        }
        else
        {
            $value =$search['value']; 
            $clientes =DB::table('clientes')
            ->select('clientes.id',
            'clientes.nombre',
            'clientes.apellido',
            'clientes.numerotelefono',
            'clientes.cedula',
            'clientes.rif',
            'clientes.estado',
            'clientes.tipocliente',
            'clientes.idusuario',
            'users.email')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id')
            ->orWhere('clientes.nombre', 'LIKE', "%$value%")
            ->orWhere('clientes.apellido', 'LIKE', "%$value%")
            ->orWhere('clientes.numerotelefono', 'LIKE', "%$value%")
            ->orWhere('clientes.cedula', 'LIKE', "%$value%")
            ->orWhere('users.email', 'LIKE', "%$value%")
            ->skip($start)
            ->take($limit)
            ->orderBy($orderBy, 'desc')
            ->get();

            $recordsTotal =DB::table('clientes')
            ->select('clientes.id',
            'clientes.nombre',
            'clientes.apellido',
            'clientes.numerotelefono',
            'clientes.cedula',
            'clientes.rif',
            'clientes.estado',
            'clientes.tipocliente',
            'clientes.idusuario',
            'users.email')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id')
            ->orWhere('clientes.nombre', 'LIKE', "%$value%")
            ->orWhere('clientes.apellido', 'LIKE', "%$value%")
            ->orWhere('clientes.numerotelefono', 'LIKE', "%$value%")
            ->orWhere('clientes.cedula', 'LIKE', "%$value%")
            ->orWhere('users.email', 'LIKE', "%$value%")
            ->skip($start)
            ->take($limit)
            ->orderBy('id', 'desc')
            ->get();

            $count =  DB::table('users')->where('role_id',5)->count();
        }
        $i = 0;
        foreach ($clientes as $cliente => $c) {
            
            $nestedData['id']               = $c->id;
            $nestedData['nombre']           = $c->nombre;
            $nestedData['apellido']         = $c->apellido;
            $nestedData['phone']            = $c->numerotelefono;
            $nestedData['cedula']           = $c->cedula;
            $nestedData['numerotelefono']   = $c->numerotelefono;
            $nestedData['email']            = $c->email;
            $nestedData['estado']            = $c->estado;
            $nestedData['tipocliente']            = $c->tipocliente;
            if ($c->tipocliente ==1)
                $nestedData['company'] =$this->getcompanyclient($c->idusuario);
            else
                $nestedData['company'] ='';

            $datos[] = $nestedData;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] =$recordsTotal->count();
        $dataresponce['recordsFiltered'] = $recordsTotal->count();
        $dataresponce['data'] = $datos;
        return response()->json($dataresponce);
    }
    public function getcompanyclient($id)
    {
        
        $company= DB::table('company_client')
        ->select('company.companyname')
        ->leftJoin('company', 'company_client.idcompany', '=', 'company.id')
        ->where('company_client.idclient',$id);
        if ($company->count() > 0) 
        {
            $companyname = $company->get();
            return  $companyname[0]->companyname ;
        }
            
        else
            return '';
    }
    public function contactoseguros()
    {
        $data['insurers'] = Insurer::select(["*"])->get();
        return view("clientes.contactoseguros",$data);
    }
    public function conctactocotiseguros()
    {
        $data['insurers'] = Insurer::select(["*"])->get();
        return view("clientes.contactoscotiseguros",$data);
    }
    public function guardarcontacto(Request $request)
    {
        if ( isset($request->conta_id) )
        {
            DB::table('contactoseguros')->where('conta_id',$request->conta_id )->update([
                'conta_idseguro' =>$request->conta_idseguro,
                'conta_nrowhat' =>$request->conta_nrowhat,
                'conta_nrocall' =>$request->conta_nrocall,
                'conta_servicio' =>$request->conta_servicio,
                'created_at'=>date("Y-m-d H:i:s")
            ]);
        }
        else
        {
            $agregarcliente = DB::table('contactoseguros')->insertGetId(
            [
                'conta_idseguro' =>$request->conta_idseguro,
                'conta_nrowhat' =>$request->conta_nrowhat,
                'conta_nrocall' =>$request->conta_nrocall,
                'conta_servicio' =>$request->conta_servicio,
                'created_at'=>date("Y-m-d H:i:s")
            ]);
        }
        return back();
    }
    public function contactocotiseguro(Request $request)
    {
        if ( isset($request->cotiseguros_id) )
        {
            DB::table('contactocotiseguros')->where('id',$request->cotiseguros_id )->update([
                'nombre' =>$request->nombre,
                'cedula' =>$request->cedula,
                'rif' =>$request->rif,
                'whatssap' =>$request->whatssap,
                'llamada'=>$request->llamada,
            ]);
        }
        else
        {
            $agregarcliente = DB::table('contactocotiseguros')->insertGetId(
            [
                'nombre' =>$request->nombre,
                'cedula' =>$request->cedula,
                'rif' =>$request->rif,
                'whatssap' =>$request->whatssap,
                'llamada'=>$request->llamada,
            ]);
        }
        return back();
    }
    public function listarcontactos(Request $request)
    {
        
        $data=[];
        $search = $request->input('search'); 
        if ($search['value']=='')
        {
            $contactoseguros = DB::table('contactoseguros')
            ->leftJoin('insurers','contactoseguros.conta_idseguro', '=', 'insurers.id')
            ->select(
            'contactoseguros.conta_id',
            'contactoseguros.conta_idseguro',
            'contactoseguros.conta_nrowhat',
            'contactoseguros.conta_nrocall',
            'contactoseguros.conta_servicio',
            'insurers.name')
            ->skip($request->input('start'))->take($request->input('length'))
            ->orderBy('contactoseguros.conta_id', 'DESC')
            ->get();
        }
        else
        {
            $contactoseguros = DB::table('contactoseguros')
            ->leftJoin('insurers','contactoseguros.conta_idseguro', '=', 'insurers.id')
            ->Where('insurers.name', 'LIKE', "%$value%")
            ->select(
            'contactoseguros.conta_id',
            'contactoseguros.conta_idseguro',
            'contactoseguros.conta_nrowhat',
            'contactoseguros.conta_nrocall',
            'contactoseguros.conta_servicio',
            'insurers.name')
            ->skip($request->input('start'))->take($request->input('length'))
            ->orderBy('contactoseguros.conta_id', 'DESC')
            ->get();
        }
        
        if ( $contactoseguros->count() > 0)
        {
            $i=0;
            
            foreach ($contactoseguros as $contactos => $conta)
            {
                
                $datos[$i]['id'] = $conta->conta_id;
                $datos[$i]['seguro'] = $conta->name;
                $datos[$i]['idseguro'] = $conta->conta_idseguro;
                $datos[$i]['whatsap'] = $conta->conta_nrowhat;
                $datos[$i]['llamada'] = $conta->conta_nrocall;
                $datos[$i]['servicio'] = $conta->conta_servicio;
                $i++;
            }
            $data= $datos;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = $contactoseguros->count() >0 ? $contactoseguros->count() : 0;
        $dataresponce['recordsFiltered'] = $contactoseguros->count() >0 ? $contactoseguros->count() : 0;
        $dataresponce['data'] = $data;
        return response()->json($dataresponce);
    }
    public function listarpersonal(Request $request)
    {
        
        $data=[];
        $search = $request->input('search');  // $conta_id
        if ($search['value']=='')
        {
            $contactoseguros = DB::table('contactocotiseguros')
            ->select(
            'contactocotiseguros.id',
            'contactocotiseguros.nombre',
            'contactocotiseguros.cedula',
            'contactocotiseguros.rif',
            'contactocotiseguros.whatssap',
            'contactocotiseguros.llamada')
            ->skip($request->input('start'))->take($request->input('length'))
            ->orderBy('contactocotiseguros.id', 'DESC')
            ->get();
        }
        else
        {
            $contactoseguros = DB::table('contactocotiseguros')
            ->Where('contactocotiseguros.nombre', 'LIKE', "%$value%")
            ->orWhere('contactocotiseguros.cedula', 'LIKE', "%$value%")
            ->orWhere('contactocotiseguros.rif', 'LIKE', "%$value%")
            ->orWhere('contactocotiseguros.whatssap', 'LIKE', "%$value%")
            ->orWhere('contactocotiseguros.llamada', 'LIKE', "%$value%")
            ->select(
                'contactocotiseguros.id',
                'contactocotiseguros.nombre',
                'contactocotiseguros.cedula',
                'contactocotiseguros.rif',
                'contactocotiseguros.whatssap',
                'contactocotiseguros.llamada')
            ->skip($request->input('start'))->take($request->input('length'))
            ->orderBy('contactocotiseguros.id', 'DESC')
            ->get();
        }
        
        if ( $contactoseguros->count() > 0)
        {
            $i=0;
            
            foreach ($contactoseguros as $contactos => $conta)
            {
                
                $datos[$i]['id'] = $conta->id;
                $datos[$i]['nombre'] = $conta->nombre;
                $datos[$i]['cedula'] = $conta->cedula;
                $datos[$i]['rif'] = $conta->rif;
                $datos[$i]['whatssap'] = $conta->whatssap;
                $datos[$i]['llamada'] = $conta->llamada;
                $i++;
            }
            $data= $datos;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = $contactoseguros->count() >0 ? $contactoseguros->count() : 0;
        $dataresponce['recordsFiltered'] = $contactoseguros->count() >0 ? $contactoseguros->count() : 0;
        $dataresponce['data'] = $data;
        return response()->json($dataresponce);
    }
    public function pagospendientes()
    {
        return view("admin.listadopagospendientes");
    }
    public function listarpagospendientesclientes (Request $request)
    {
        $fecha_actual = date("Y-m-d");
        $dosmeses= date("Y-m-d",strtotime($fecha_actual."+ 2 month"));
        $search = $request->input('search'); 
        if ($search['value']=='')
        {
             
            $frequencyofpayments = DB::table('frequencyofpayments')
            ->leftJoin('insurancepolicies', 'frequencyofpayments.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->leftJoin('clientes', 'insurancepolicies.idusuario', '=', 'clientes.idusuario')
            ->where('frequencyofpayments.fechainicio','<',$dosmeses)
            ->where('frequencyofpayments.estadodepago',0)
            ->select(
                'frequencyofpayments.id',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'frequencyofpayments.montoestimado',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono')
            ->skip($request->input('start'))->take($request->input('length'))
            ->orderBy('frequencyofpayments.fechainicio', 'DESC')
            ->get();
            $count = DB::table('frequencyofpayments')
            ->leftJoin('insurancepolicies', 'frequencyofpayments.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->leftJoin('clientes', 'insurancepolicies.idusuario', '=', 'clientes.idusuario')
            ->where('frequencyofpayments.fechainicio','<',$dosmeses)
            ->where('frequencyofpayments.estadodepago',0)
            ->select(
                'frequencyofpayments.id',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'frequencyofpayments.montoestimado',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono')
            ->count(); 
        }
        else
        {
            $value =$search['value'];
            $frequencyofpayments = DB::table('frequencyofpayments')
            ->leftJoin('insurancepolicies', 'frequencyofpayments.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->leftJoin('clientes', 'insurancepolicies.idusuario', '=', 'clientes.idusuario')
            //->where('frequencyofpayments.fechainicio','<',$dosmeses)
            ->where('frequencyofpayments.estadodepago',0)
            ->Where('clientes.numerotelefono', 'LIKE', "%$value%")
            ->orWhere('clientes.nombre', 'LIKE', "%$value%")
            ->select(
                'frequencyofpayments.id',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'frequencyofpayments.montoestimado',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono')
            ->orderBy('frequencyofpayments.fechainicio', 'DESC')
            ->get();
            $count = DB::table('frequencyofpayments')
            ->leftJoin('insurancepolicies', 'frequencyofpayments.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->leftJoin('clientes', 'insurancepolicies.idusuario', '=', 'clientes.idusuario')
            ->where('frequencyofpayments.fechainicio','<',$dosmeses)->where('frequencyofpayments.estadodepago',0)
            ->orWhere('clientes.numerotelefono', 'LIKE', "%$value%")
            ->orWhere('clientes.nombre', 'LIKE', "%$value%")
            ->select(
                'frequencyofpayments.id',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'frequencyofpayments.montoestimado',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono')
            ->count(); 
        }
        
        $responce['fechafin']=$dosmeses;
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = $count;
        $dataresponce['recordsFiltered'] = $count;
        $dataresponce['data'] = $frequencyofpayments;
        return response()->json($dataresponce);
        return response()->json($responce);
    }
    public function agregarcuotacliente(Request $request)
    {
        //echo " llega la cuota ".$request->idquote." con el cliente ".$request->idusuario;
        if (($request->idquote) &&($request->idusuario))
        {
            $quote_clients =array(
                'idusuario'=>$request->idusuario,
                'idquote'=>$request->idquote,
                'updated_at'=>date('Y-m-d')
            );
            if ( DB::table('quote_clients')->insert($quote_clients))
                $resul= array('resul'=>true,'mjs'=>'Cotizacón agreda con éxito');
            else
                $resul= array('resul'=>false,'mjs'=>'Cotizacón no se pudo agregar'); 
        }
        else
        {
            $resul= array('resul'=>false,'mjs'=>'Cotizacón no se pudo agregar'); 
        }
        return response()->json($resul);
    }
    public function agregarpagos(Request $request)
    {
        if ($request->idcliente3)
        {
            if ( isset($request->idquote2) && ($request->idquote2 > 0) && (($request->pagoeditar == 0) || ($request->pagoeditar =='' )) ) // nuuevo pago
            {
                $vinsert =array(
                    'idusuario'=>trim($request->idusuario),
                    'idquote'=>trim($request->idquote2),
                    'idadmin'=>trim($request->idadmin),
                    'fechapago'=>trim($request->fechapago),
                    'montopago'=>trim($request->montopago),
                    'id_frequencyofpayments'=>trim($request->idfrecuenciapagar),
                    'created_at'=>date('Y-m-d'),

                );
                if (DB::table('payments')->insert($vinsert))
                {
                    if ($photo_payment =  $request->file('photo_payment'))
                    {
                        $pay = DB::table('payments')->where($vinsert)->get();
                        $image_name=md5(rand(1000,10000));
                        $ext = strtolower($photo_payment->getClientOriginalExtension() );
                        $image_full_name=$image_name.'.'.$ext;
                        $imagen_url = 'documentos/'.$image_full_name;
                        if ($photo_payment->move(public_path('documentos'),$image_full_name))
                        {
                            DB::table('payments')->where('id',$pay[0]->id)->update(array( 'photo_payment'=>$imagen_url));   
                            session()->flash('message', 'Se guardo con extio');
                        }   
                        else
                            session()->flash('error_datos', 'Se agregó el pago de la cotización, pero no se pudo subir el comprobante de pago');       
                    }
                } 
                else
                    session()->flash('error_datos', 'No se pudo agregar el pago a la cotización, intente de nuevo ');  
            }
            else if ( isset($request->pagoeditar) && ($request->pagoeditar > 0) ) 
            {
                $upate =array(
                    
                    'idadmin'=>trim($request->idadmin),
                    'fechapago'=>trim($request->fechapago),
                    'montopago'=>trim($request->montopago),
                    'updated_at'=>date('Y-m-d'),

                );
                DB::table('payments')->where('id',$request->pagoeditar )->update($upate);
                session()->flash('message', 'Se guardo con extio');
                if ($photo_payment =  $request->file('photo_payment'))
                {
                    $image_name=md5(rand(1000,10000));
                    $ext = strtolower($photo_payment->getClientOriginalExtension() );
                    $image_full_name=$image_name.'.'.$ext;
                    $imagen_url = 'documentos/'.$image_full_name;
                    if ($photo_payment->move(public_path('documentos'),$image_full_name))
                    {
                        DB::table('payments')->where('id',$request->pagoeditar)->update(array( 'photo_payment'=>$imagen_url));   
                        session()->flash('message', 'Se guardo con extio');
                    }   
                    else
                        session()->flash('error_datos', 'Se agregó el pago de la cotización, pero no se pudo subir el comprobante de pago');       
                }    
            }
            else
            {
                session()->flash('error_datos', 'No se encontró información');   
            } 
        }
        else
        {
            session()->flash('error_datos', 'No se puede verificar información del cliente, para realizar el pago');
        }
        return back();
    }
    public function calcularcuotas(Request $request)
    {
        
        $frecuencia =$request->frecuencia;
        //$idcotizacionpagar =$request->idcotizacionpagar;
        $montocotizacionpagar=$request->montocotizacionpagar;
        $vector=[];
        if ( @$request->frecuencia)
        {
            if ( @$request->fechainicio )
                $fecha_actual = $request->fechainicio;
            else
                $fecha_actual = date("Y-m-d");
    
            switch ($request->frecuencia) 
            {
                case 1: // anual
                    $fechafinal = date("Y-m-d",strtotime($fecha_actual."+ 1 year"));
                    $vector[0] =array(
                        'fechaini'=>$fecha_actual,
                        'fechafin'=>$fechafinal,
                    );
                    break;
                case 2: //semestral
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
                    for ($d=0; $d < 2; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                        );
                        $fecha_actual= $fechafinal; 
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
                    }
                    break;
                case 4: //trimestral
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                    for ($d=0; $d < 4; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                            'd'=>$d,
                        );
                        $fecha_actual= $fechafinal;
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                    }
                    break;
                case 12: // mensual
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 1 month"));
                    for ($d=0; $d < 12; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                        );
                        $fecha_actual= $fechafinal;
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 1 month")); 
                        
                    }

                    break;
            } 
            $responce["result"]=true;
        }
        else
            $responce["result"]=false;
        
        $responce["data"] =$vector;
        //$responce["idcotizacionpagar"] =$idcotizacionpagar;
        //$responce["idcotizacionpagar"] =$idcotizacionpagar;
        $responce["id_insurancepolicies"] =$request->id_insurancepolicies;
        return response()->json($responce);
       
    }   
    public function frecuenciapagos(Request $request)
    {
        $orden=0; 
        //dd($request);
        /*
        if (DB::table('frequencyofpayments')->find(\DB::table('frequencyofpayments')->where('id_insurancepolicies',$request->id_insurancepolicies)->max('id')) )
            $orden =floatval($frequencyofpayments->orden) + 1;
        */

        $fechaincio =$request->fechainici;
        $fechafin =$request->fechafin;
        $monto =$request->monto;
        $idadmin =$request->idadmin;
        for ( $i=0; $i < count($fechaincio); $i++ )
        {
            $vec=array(
                'created_at'=>date('Y-m-d'),
                'idquote'=>$request->idquote,
                'fechainicio'=>$fechaincio[$i],
                'fechafin'=>$fechafin[$i],
                'montoestimado'=> $monto[$i] >0 ? $monto[$i] :0,
                'idadmin'=>$idadmin,
                'id_insurancepolicies'=>$request->id_insurancepolicies,
                'estadodepago'=>0,
                'orden'=>$orden
            );
            DB::table('frequencyofpayments')->insert($vec);
        }
        session()->flash('message', 'Fechas de pago generadas');
        return back();
    }
    public function modificardatosquote(Request $request )
    {
      $quote=array(
        'phone'=>$request->numeronuevo,
        'email'=>$request->correonuevo);
        if ( (DB::table('quotes')->where('id',$request->idquotemodificar)->update($quote)) )
            $res['resul']=true;
        else
            $res['resul']=false;
        
        return response()->json($res);
    }
    public function qrurl(Request $request)
    {
        if ( (DB::table('clientes')->where('codeqr',$request->code)->count()) >0  )
        {
            $datacliente= DB::table('clientes')->where('codeqr',$request->code)->get();
            $data['polizas'] = DB::table('insurancepolicies')->where('idusuario',$datacliente[0]->idusuario)->get();
            $data['bloqueado'] =$this->moroso($datacliente[0]->idusuario);
            $data['datacliente'] =$datacliente;
            $busdocumento =array('idusuario'=>$datacliente[0]->idusuario, 'tipo'=>0 );
            $data['documentos'] = DB::table('docuemntos')->where($busdocumento)->get();
            $buscarcontratos =array('idusuario'=>$datacliente[0]->idusuario, 'tipo'=>1 );
            $data['contratos'] = DB::table('docuemntos')->where($buscarcontratos)->get();
            $buscarsalud= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>1);
            $data['salud'] =DB::table('insurancepolicies')
            //->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarsalud)
            ->select(
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario', 
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                //'coverages.coverage',
                'insurers.name',
                'insurers.image',
                'insurers.id as idinsurers',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                //'coverages.id'
                )->get();    
            $buscarautos= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>2);
            $data['autos'] =DB::table('insurancepolicies')
            //->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarautos)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                //'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                //'coverages.id'
                )->get(); 
            $buscarempresa= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>3);
            $data['empresa'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarempresa)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                //'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                //'coverages.id'
                )->get(); 
            $data['footer'] = Footer::first();

            // salud
            if (DB::table('contactocotiseguros')->count() > 0)
            {
                $conctactos = DB::table('contactocotiseguros')->get();
                foreach ($conctactos as $conctac => $c) {
               
                    $nestedData['id']        = $c->id;
                    $nestedData['nombre']    = $c->nombre;
                    $nestedData['cedula']    = $c->cedula;
                    $nestedData['rif']       = $c->rif;
                    $nestedData['whatssap']  = $c->whatssap;
                    $nestedData['llamada']   = $c->llamada;
                    $datos[] = $nestedData;
                }
            }
            $data['contactocotiseguros'] =  $datos;
            return view("cotizador.vistaqr",$data);
        }
        else
        {
            echo " ese code no existe";
        }
    }
    public function usuarios()
    {
        
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;
            
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            if ( floatval($role_id) ==1 ) // es admin
            {
                session()->flash('message', 'Usuario no permitido');
                return back();
            }
            else if ( floatval($role_id) ==6 ) // 5 es verificador en dev, en produccion es 6
            {
                return view("clientes.buscarcliente",[
                    "footer" => Footer::first(),
                    "salud" => [],
                    "empresa" => [],
                    "autos" => []
                ]);
            }
            else if ( floatval($role_id) ==5 ) // 4 es cliente en deve en produccion es 5
            {
                
                $data["footer"]=Footer::first();
                $data["user"]=$clientes;
                return view("clientes.clienteasegurado",$data);
            }
            else
            {
                return back();
            }
        }
        else
            return view("errors.nologin");
        
    }
    //
    public function mispolizascliente()
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $data['polizas'] = DB::table('insurancepolicies')->where('idusuario',auth()->id() )->get();
            $buscarsalud= array(
                'idusuario'=>auth()->id(),
                'tipopoliza'=>1);
            $data['salud'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarsalud)
            ->select(
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario', 
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'coverages.coverage',
                'insurers.name',
                'insurers.id as idinsurers',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'coverages.id')->get();    
            $buscarautos= array(
                'idusuario'=>auth()->id(),
                'tipopoliza'=>2);
            $data['autos'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarautos)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 
            $buscarempresa= array(
                'idusuario'=>auth()->id(),
                'tipopoliza'=>3);
            $data['empresa'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarempresa)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 

            $data["footer"]=Footer::first();
            $data["user"]=$clientes;
            return view("clientes.clientepolizas",$data);
        }
        else
            return view("errors.nologin");
        
    }
    public function clientesalud()
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $data["footer"]=Footer::first();
            $data["user"]=$clientes;
            $buscarsalud= array(
                'idusuario'=>auth()->id(),
                'tipopoliza'=>1);
            $data['salud'] =DB::table('insurancepolicies')
            //->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarsalud)
            ->select(
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario', 
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                //'coverages.coverage',
                'insurers.name',
                'insurers.image',
                'insurers.id as idinsurers',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                //'coverages.id'
                )->get();  //dd($data);
            return view("clientes.clientepolizassalud",$data);

            // datacliente coverage
        }
        else
            return view("errors.nologin");
        
    }
    public function clienteauto()
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $data["footer"]=Footer::first();
            $data["user"]=$clientes;
            $buscarautos= array(
                'idusuario'=>auth()->id() ,
                'tipopoliza'=>2);
            $data['autos'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarautos)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurers.image',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 
            return view("clientes.clientepolizasauto",$data);
        }
        else
            return view("errors.nologin");
        
    }

    public function clientepatrimonio()
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $data["footer"]=Footer::first();
            $data["user"]=$clientes;
            $buscarempresa= array(
                'idusuario'=>auth()->id(),
                'tipopoliza'=>3);
            $data['empresa'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarempresa)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurers.image',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 
            return view("clientes.clientepolizaspatrimonio",$data);
        }
        else
            return view("errors.nologin");
        
    }
    public function sinisestros()
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;

            $data["footer"]=Footer::first();
            $data['user'] =  DB::table('clientes')->where('idusuario',auth()->id())->get(); 
            $data['accidents'] = DB::table('accidents')->where('idusuario',auth()->id())->get();
            $data['insurers'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where('insurancepolicies.idusuario',auth()->id())
            ->select(
                'coverages.coverage',
                'insurers.name',
                'insurers.id as id_insurers',
                'insurers.image',
                'insurancepolicies.id as id_insurancepolicies',
                )->get(); 
                            
                            
            return view("clientes.missiniestros",$data);
        }
        else
            return view("errors.nologin");
        
    }
    //
    public function siniestro($id)
    {
        if (auth()->id())
        {
            $users =  DB::table('users')->where('id',auth()->id())->get();
            $role_id =$users[0]->role_id;
            $data["footer"]=Footer::first();
            $data['accidents'] =  DB::table('accidents')
            ->join('insurancepolicies', 'accidents.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->where('accidents.id',$id)
            ->where('accidents.idusuario',auth()->id())
            ->select(
                'accidents.id as id_accidents',
                'accidents.descripcion',
                'accidents.monto',
                'accidents.montopagado',
                'accidents.estado',

                'insurers.name',
                'insurers.note',
                'insurers.plazos',
                'coverages.coverage',
                )
            ->get(); 
                            
            return view("clientes.siniestro",$data);
        }
        else
            return view("errors.nologin");
    }
    //
    function moroso($id)
    {
        $moroso =true;
        $insurancepolicies = DB::table('insurancepolicies')
        ->leftJoin('frequencyofpayments', 'insurancepolicies.id', '=', 'frequencyofpayments.id_insurancepolicies')
        ->where('idusuario',$id)
        ->where('frequencyofpayments.estadodepago',1)
        ->select('frequencyofpayments.estadodepago','frequencyofpayments.fechainicio','frequencyofpayments.fechafin','frequencyofpayments.id')
        ->get();
        //dd($insurancepolicies);
        if ( count($insurancepolicies)>0 )
        {
            foreach ($insurancepolicies as $c)
            {
               
                if (($c->fechafin ) <= (date('Y-m-d')))
                {
                    //echo  $c->id." comparo ".$c->fechainicio." ".date('Y-m-d')."<br>";
                    if ($c->estadodepago ==1)
                    {
                        $moroso =false;  //echo " negartivo "."<br>";
                    }   
                        
                    else
                    {
                        $moroso =true;  //echo " positivo "."<br>";
                    }
                       
                }
                
            }
        }
        //echo $moroso; die;
        return $moroso;
    }
    public function clienteasegurado(Request $request)
    {
        if ( (DB::table('clientes')->where('cedula',$request->buscarcedulaasegurado)->count()) >0  )
        {
            $datacliente= DB::table('clientes')->where('cedula',$request->buscarcedulaasegurado)->get();
            $data['polizas'] = DB::table('insurancepolicies')->where('idusuario',$datacliente[0]->idusuario)->get();
            $data['datacliente'] =$datacliente;
            $busdocumento =array('idusuario'=>$datacliente[0]->idusuario, 'tipo'=>0 );
            $data['documentos'] = DB::table('docuemntos')->where($busdocumento)->get();
            $buscarcontratos =array('idusuario'=>$datacliente[0]->idusuario, 'tipo'=>1 );
            $data['contratos'] = DB::table('docuemntos')->where($buscarcontratos)->get();
            $buscarsalud= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>1);
            $data['salud'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarsalud)
            ->select(
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario', 
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'coverages.id')->get();    
            $buscarautos= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>2);
            $data['autos'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarautos)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 
            $buscarempresa= array(
                'idusuario'=>$datacliente[0]->idusuario,
                'tipopoliza'=>3);
            $data['empresa'] =DB::table('insurancepolicies')
            ->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where($buscarempresa)
            ->select(
                'insurancepolicies.idcoverages', 
                'insurancepolicies.idinsurers', 
                'insurancepolicies.id as id_poliza', 
                'insurancepolicies.comentario',
                'coverages.coverage',
                'insurers.name',
                'insurancepolicies.tipopoliza',
                'insurancepolicies.id as id_insurancepolicies',
                'insurancepolicies.descripcionpoliza',
                'coverages.id')->get(); 
            $data['footer'] = Footer::first();
            $data['cedulabuscar']=@$request->buscarcedulaasegurado;
            //echo "<pre>"; print_r($data); die;
            session()->flash('message', 'Cliente encontrado');
            return view("clientes.buscarcliente",$data);
        }
        else
        {
            $data['footer']=Footer::first();
            $data['salud']=[];
            $data['cedulabuscar']=@$request->buscarcedulaasegurado;
            $data['empresa']=[];
            $data['autos']=[];
            session()->flash('message', 'Cliente No encontrado');
            return view("clientes.buscarcliente",$data);
        }
    }
    
    public function mispolizas()
    {
        if (auth()->id())
        {
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            
            $insurancepolicies =  DB::table('insurancepolicies')
            ->leftJoin('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->leftJoin('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where('insurancepolicies.idusuario',auth()->id())
            ->select('insurancepolicies.tipopoliza',
            'insurancepolicies.descripcionpoliza',
            'insurancepolicies.id',
            'insurers.name',
            'insurancepolicies.comentario',
            'coverages.coverage')
            ->get();
            //echo "<pre>"; print_r($insurancepolicies); die;
            return view("clientes.mispolizas",[
                "footer" => Footer::first(),
                "polizas" => $insurancepolicies,
                "user" => $clientes,
                // "url" =>'http://127.0.0.1:8000/', 
                "url" =>'https://dev.cotiseguros.com.ve/',
            ]);
        }
        else
            return view("errors.nologin");
  
    }
    public function missninestros()
    {
        if (auth()->id())
        {
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get(); 
            $accidents =  DB::table('accidents')->where('idusuario',auth()->id())->get();
            return view("clientes.missiniestros",[
                "footer" => Footer::first(),
                "accidents" => $accidents,
                "user" => $clientes
            ]);
        }
        else
            return view("errors.nologin");
        
    }
    public function misdatos()
    {
       
        if (auth()->id())
        {
            $users =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $clientes =  DB::table('clientes')
            ->leftJoin('users', 'users.id', '=', 'clientes.idusuario')
            ->where('clientes.idusuario',auth()->id())
            ->select('clientes.nombre',
            'clientes.apellido',
            'clientes.cedula',
            'clientes.numerotelefono',
            'clientes.nombrecontacto',
            'clientes.apellidocontacto',
            'clientes.telefonococontacto',
            'clientes.cedulacontacto',
            'users.email')
            ->get();
            $memberquotes = DB::table('member_quotes')
            ->leftJoin('insurancepolicies', 'member_quotes.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->where('insurancepolicies.idusuario', '=',auth()->id() )
            ->select('member_quotes.status',
            'member_quotes.gender',
            'member_quotes.date',
            'member_quotes.birthday')
            ->get();    
            return view("clientes.misdatos",[
                "footer" => Footer::first(),
                "url" =>'https://cotiseguros.com.ve/',
                "clientes" => $clientes,
                "memberquotes" =>$memberquotes,
                "user" => $users
            ]);
        }
        else
            return view("errors.nologin");
    }
    public function misdatosparte2()
    {
       
        if (auth()->id())
        {
            $users =  DB::table('clientes')->where('idusuario',auth()->id())->get();
            $clientes =  DB::table('clientes')
            ->leftJoin('users', 'users.id', '=', 'clientes.idusuario')
            ->where('clientes.idusuario',auth()->id())
            ->select('clientes.nombre',
            'clientes.apellido',
            'clientes.cedula',
            'clientes.numerotelefono',
            'clientes.nombrecontacto',
            'clientes.apellidocontacto',
            'clientes.telefonococontacto',
            'clientes.cedulacontacto',
            'users.email')
            ->get();
            $memberquotes = DB::table('member_quotes')
            ->leftJoin('insurancepolicies', 'member_quotes.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->where('insurancepolicies.idusuario', '=',auth()->id() )
            ->select('member_quotes.status',
            'member_quotes.gender',
            'member_quotes.date',
            'member_quotes.birthday')
            ->get();    
            return view("clientes.misdatos2parte",[
                "footer" => Footer::first(),
                "url" =>'https://cotiseguros.com.ve/',
                "clientes" => $clientes,
                "memberquotes" =>$memberquotes,
                "user" => $users
            ]);
        }
        else
            return view("errors.nologin");
    }
    public function actualizarmisdatos(Request $request)
    {
        $accliente =array(
            'nombre'=>@$request->nombre,
            'apellido'=>@$request->apellido,
            'cedula'=>@$request->letra1.'-'.@$request->cedula,
            'numerotelefono'=>@$request->code1.@$request->numerotelefono,
            'nombrecontacto'=>@$request->nombrecontacto,
            'apellidocontacto'=>@$request->apellidocontacto,
            'telefonococontacto'=>@$request->code2.@$request->nrotelefonocontacto,
            'cedulacontacto'=>@$request->letra2.@$request->cedulacontacto);
            
            if ( (DB::table('clientes')->where('idusuario',auth()->id())->update($accliente)) )
                session()->flash('message', 'Datos actualizados con éxito');
            else
                session()->flash('error_datos', 'No se pudo actualizar datos del cliente');
        return back();
    }
    public function mispagos()
    {
        
        if (auth()->id())
        {
            $clientes =  DB::table('clientes')->where('idusuario',auth()->id())->get(); 
            $insurancepolicies =  DB::table('insurancepolicies')
            ->leftJoin('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
            ->leftJoin('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
            ->where('insurancepolicies.idusuario',auth()->id())
            ->select('insurancepolicies.tipopoliza',
            'insurancepolicies.descripcionpoliza',
            'insurancepolicies.id',
            'insurers.name',
            'insurancepolicies.comentario',
            'coverages.coverage')
            ->get();
            return view("clientes.mispagos",[
                "url" =>'https://cotiseguros.com.ve/',
                "footer" => Footer::first(),
                "polizas" => $insurancepolicies,
                "user" => $clientes
            ]);
        }
        else
            redirect("/");
    }

    function generateqr(Request $request )
    {
    
        $vec=array(
            'codeqr'=>$request->keyqrrandon
        );
        DB::table('clientes')->where('idusuario',$request->idcliente4)->update($vec);
        session()->flash('message', 'QR Generado con éxito');
        return back();
    }

    public function adminstracionclientes(Request $request)
    {
        $coverages = Coverage::select(["*"])->groupBy("coverage")->orderBy("coverage","ASC")->get();
        $insurers = Insurer::select(["*"])->get();
        $data['info'] = DB::table('clientes')->where('id', $request->id)->get();
        $insurancepolicies =DB::table('insurancepolicies')
        //->join('coverages', 'insurancepolicies.idcoverages', '=', 'coverages.id')
        ->join('insurers', 'insurancepolicies.idinsurers', '=', 'insurers.id')
        ->where('insurancepolicies.idusuario',$data['info'][0]->idusuario)
        ->where('insurancepolicies.estado','=',0)
        ->select('insurancepolicies.idcoverages',
        'insurancepolicies.idinsurers','insurers.name',
        'insurancepolicies.tipopoliza','insurancepolicies.id as id_insurancepolicies')->get();    
        //dd($insurancepolicies);
        $info =$this->inforcliente($request->id);
        
       return view("admin.adminstracionliente2",[
        
            "info" =>$info['info'],
            "codeqr" =>$info['codeqr'],
            "documentoscliente"=>$info['documentos'],
            "keyqrrandon"=>$info['keyqrrandon'],
            "coverages" => $coverages,
            "insurers" => $insurers,
            "idcliente"=>$data['info'][0]->idusuario,
            "nombrecontacto"=>$data['info'][0]->nombrecontacto,
            "cedulacontacto"=>$data['info'][0]->cedulacontacto,
            "telefonococontacto"=>$data['info'][0]->telefonococontacto,
            "insurancepolicies"=>$insurancepolicies,
            "provinces" =>\Lang::get('provinces')["provinces"],
            "frequencies"=>DB::table('frequencies')->get()] );
    }
    public function polizassalud(Request $request)
    {
        $idmontosalud =$request->input("idmontosalud"); // monto de la poliza
        $idsegurosalud =$request->input("idsegurosalud"); // seguro de la poiza
        $insurancepolicies = DB::table('insurancepolicies')->insertGetId(
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'idusuario'=>$request->idclientesalud,
                'idadmin'=>$request->idaminsalud,
                'idcoverages' =>$idmontosalud,
                'idinsurers' =>$idsegurosalud,
                'comentario'=>''
            ]);
        if ($documentossalud =  $request->file('documentossalud'))
        {
            $cn=0;$comen=0;
            $nombredocumentosalud =$request->input("nombredocumentosalud");
            foreach ($documentossalud as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $tipo ='documento';
                if ( $nombredocumentosalud[$cn] )
                    $tipo =$nombredocumentosalud[$cn];
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->idclientesalud,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$insurancepolicies
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');

                $cn ++;
            }
        }  
        $comentariosalud =$request->input("comentariosalud");
        if ( count($comentariosalud) >0 )
        {
            foreach ( $comentariosalud as $c )
            {   
                $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                    [
                        'created_at'=>date("Y-m-d H:i:s"),
                        'id_insurancepolicies'=>$insurancepolicies,
                        'comentario'=>$c,
                        'idadmin'=>$request->idaminsalud,
                        'idusuario'=>$request->idclientesalud,
                    ]);
            }
        }
        $patologiacomentadas =$request->input("patologiacomentadas");
        if ( count($patologiacomentadas) >0 )
        {
            foreach ( $patologiacomentadas as $c )
            {   
                $patologiasi = DB::table('patologia')->insertGetId(
                    [
                        'pat_id_poliza'=>$insurancepolicies,
                        'pat_descripcion'=>$c,
                        'pat_idadmin'=>$request->idaminsalud,
                        'pat_idusuario'=>$request->idclientesalud,
                        'pat_status'=>1,
                        'created_at'=>date("Y-m-d H:i:s"),
                    ]);
            }
        }
        $patologiasnocomentadas =$request->input("patologiasnocomentadas");
        if ( count($patologiasnocomentadas) >0 )
        {
            foreach ( $patologiasnocomentadas as $c )
            {   
                $patologiasi = DB::table('patologia')->insertGetId(
                    [
                        'pat_id_poliza'=>$insurancepolicies,
                        'pat_descripcion'=>$c,
                        'pat_idadmin'=>$request->idaminsalud,
                        'pat_idusuario'=>$request->idclientesalud,
                        'pat_status'=>0,
                        'created_at'=>date("Y-m-d H:i:s"),
                    ]);
            }
        }
        for ( $i=0 ; $i <= $request->input("index"); $i++ ) 
        {
           
            $day = $request->input("day_$i");
            $mounth = $request->input("mounth_$i");
            $birthday = $request->input("birthday_$i");
            if ( floatval( $day)  < 10 )
                 $day ='0'. $day;

            if ( floatval($mounth)  < 10 )
                $mounth ='0'.$mounth;

            if ( strlen($birthday)  < 4 )
                $birthday =2000;

            $member = new MemberQuote();
            $member->status = $request->input("status_$i");
            $member->gender = $request->input("gender_$i");
            $member->date = Carbon::parse( $day . "-" . $mounth . "-" . $birthday )->age;
            $member->birthday = $day . "-" . $mounth . "-" . $birthday;
            $member->quote_id = 0; 
            $member->id_insurancepolicies = $insurancepolicies;
            $member->day =$day;
            $member->month =$mounth;
            $member->year =$birthday ;
            $member->save();
        }
        session()->flash('message', 'Poliza agregada con éxito');    
        return back();
    }
    public function polizasuato(Request $request)
    {
        //dd($request);
        $idmontoautos =$request->input("idmontoautos"); // monto de la poliza
        $idseguroautos =$request->input("idseguroautos"); // seguro de la poiza
       
        $insurancepolicies = DB::table('insurancepolicies')->insertGetId(
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'idusuario'=>$request->idclienteautos,
                'idadmin'=>$request->idaminautos,
                'idcoverages' =>$idmontoautos,
                'idinsurers' =>$idseguroautos,
                'comentario'=>'',
                'descripcionpoliza'=>$request->nroplaca.' Modelo : '.$request->modelo,
                'tipopoliza' =>2,
            ]);
            $comentarioautos =$request->input("comentarioautos");
            if ( count($comentarioautos) >0 )
            {
                foreach ( $comentarioautos as $c )
                {   
                    $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'id_insurancepolicies'=>$insurancepolicies,
                            'comentario'=>$c,
                            'idadmin'=>$request->idaminautos,
                            'idusuario'=>$request->idclienteautos,
                        ]);
                }
            }
        if ($documentosautos =  $request->file('documentosautos'))
        {
            $cn=0;
            $nombredocumentosautos =$request->input("nombredocumentosautos");
            foreach ($documentosautos as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;

                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    $tipo ='documento';
                    if ( $nombredocumentosautos[$cn] )
                        $tipo =$nombredocumentosautos[$cn];
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->idclienteautos,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$insurancepolicies
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                $cn++;
            }
        }  
        
        
        session()->flash('message', 'Poliza agregada con éxito');    
        return back();
    }
    public function polizaempresas(Request $request)
    {
        $idmontoempresa =$request->input("idmontoempresa"); // monto de la poliza
        $idseguroempresa =$request->input("idseguroempresa"); // seguro de la poiza
        $insurancepolicies = DB::table('insurancepolicies')->insertGetId(
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'idusuario'=>$request->idclienteempresa,
                'idadmin'=>$request->idaminempresa,
                'idcoverages' =>$idmontoempresa,
                'idinsurers' =>$idseguroempresa,
                'comentario' =>'',
                'descripcionpoliza'=>$request->nombreempresa.' Representante :  '.$request->representante,
                'tipopoliza' =>3,
                'dimensiones' =>@$request->input("dimensiones"),
                'ubicacion' =>@$request->input("ubicacion"),
            ]);
            $comentarioempresa =$request->input("comentarioempresa");
            if ( count($comentarioempresa) >0 )
            {
                foreach ( $comentarioempresa as $c )
                {   
                    $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'id_insurancepolicies'=>$insurancepolicies,
                            'comentario'=>$c,
                            'idadmin'=>$request->idaminempresa,
                            'idusuario'=>$request->idclienteempresa,
                        ]);
                }
            }
        if ($documentosempresa =  $request->file('documentosempresa'))
        {
            $cn=0;
            $nombredocumentosempresa =$request->input("nombredocumentosempresa");
            foreach ($documentosempresa as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    $tipo ='documento';
                    if ( $nombredocumentosempresa[$cn] )
                        $tipo =$nombredocumentosempresa[$cn];
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->idclienteempresa,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$insurancepolicies
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                $cn++;
            }
        }  
        //dd($request);
        
        session()->flash('message', 'Poliza agregada con éxito');    
        return back();
    }
    public function pagospolizas(Request $request)
    {
        if ( (DB::table('frequencyofpayments')->where('id_insurancepolicies',$request->idpoliza)->count()) >0  )
        {
            $data['frecuencias'] =true;
            $data['data'] =DB::table('frequencyofpayments')
            ->leftJoin('payments', 'frequencyofpayments.id', '=', 'payments.id_frequencyofpayments')
            ->where('frequencyofpayments.id_insurancepolicies',$request->idpoliza)
            ->select(
                'frequencyofpayments.id',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'frequencyofpayments.montoestimado',
                'frequencyofpayments.estadodepago',
                'payments.montopago',
                'payments.photo_payment',
                'payments.fechapago')
            ->get();
        }
        else
        {
            $data['frecuencias'] =false;
            $data['data']=[];
        }
        return response()->json($data);
    }
    public function pagospolizascolectivos(Request $request)
    {
        if ( (DB::table('company_frequencies_detail')->where('id_company',$request->idpoliza)->count()) >0  )
        {
            $data['frecuencias'] =true;
            $data['data'] =DB::table('company_frequencies_detail')
            ->leftJoin('company_payments', 'company_frequencies_detail.id', '=', 'company_payments.id_frequencyofpayments')
            ->where('company_frequencies_detail.id_company',$request->idpoliza)
            ->select(
                'company_frequencies_detail.id',
                'company_frequencies_detail.fechainicio',
                'company_frequencies_detail.fechafin',
                'company_frequencies_detail.montoestimado',
                'company_frequencies_detail.estadodepago',
                'company_payments.montopago',
                'company_payments.photo_payment',
                'company_payments.fechapago')
            ->get();
        }
        else
        {
            $data['frecuencias'] =false;
            $data['data']=[];
        }
        return response()->json($data);
    }
    public function consultpaymentscompanies(Request $request)
    {
        if ( (DB::table('company_frequencies_detail')->where('id_company',$request->idpoliza)->count()) >0  )
        {
            $data['frecuencias'] =true;
            
            
            $data['data'] =DB::table('company_frequencies_detail')
            ->leftJoin('company_payments', 'company_frequencies_detail.id', '=', 'company_payments.id_frequencyofpayments')
            ->where('company_frequencies_detail.id_company',$request->idpoliza)
            ->select(
                'company_frequencies_detail.id',
                'company_frequencies_detail.fechainicio',
                'company_frequencies_detail.fechafin',
                'company_frequencies_detail.montoestimado',
                'company_frequencies_detail.estadodepago',
                'company_frequencies_detail.orden',
                'company_payments.montopago',
                'company_payments.photo_payment',
                'company_payments.fechapago')
            ->get();
            
        }
        else
        {
            $data['frecuencias'] =false;
            $data['data']=[];
        }
        return response()->json($data);
    }

    public function editarfrecuenciapago(Request $request)
    {
        if ( isset($request->id)  )
        {
            $edit =array(
                'fechainicio'=>trim($request->fechainici),
                'fechafin'=>trim($request->fechafin),
                'idadmin'=>trim($request->fechafin),        
            );
            DB::table('frequencyofpayments')->where('id',$request->id)->update($edit);
        }
        $data['resul'] =true;
        return response()->json($data);
    }
    public function guardarpagpendiente(Request $request)
    {
        if( ( $request->idclientefp ) && ( $request->id_insurancepoliciesfp ) && ( $request->idadminfp ))
        {
            $cbox = $request->input('cbox');
            if (   (isset($cbox)) && (count($cbox)> 0)  )
            {
                $fechafin = $request->input('fechafin'); 
                $monto = $request->input('monto');
                $photo_payment =  $request->file('photo_payment');
                $frequencyofpayments = $request->input('frequencyofpayments');
                for ( $i=0; $i < count($fechafin); $i++ )
                {
                    if (in_array($i, $cbox))
                    {
                        if ( floatval($monto[$i]) >=0  )
                        {
                            $mon = $monto[$i] ? $monto[$i] : 0;
                            $vinsert =array(
                                'idusuario'=>trim($request->idclientefp),
                                'idquote'=>0,
                                'idadmin'=>trim($request->idadminfp),
                                'fechapago'=>date("Y-m-d H:i:s"),
                                'montopago'=> $mon,
                                'id_frequencyofpayments'=>trim($frequencyofpayments[$i]),
                                'created_at'=>date("Y-m-d H:i:s"),
                                'photo_payment'=>''
                            );
                           
                            if( $idisnet =DB::table('payments')->insertGetId($vinsert))
                            {
                                if ($mon > 0)
                                {
                                    if (array_key_exists($i, $photo_payment)) 
                                    {
                                        if ($photo_payment[$i]) 
                                        {
                                            $photo =$photo_payment[$i];
                                            $image_name=md5(rand(1000,10000));
                                            $ext = strtolower($photo->getClientOriginalExtension() );
                                            $image_full_name=$image_name.'.'.$ext;
                                            $imagen_url = 'documentos/'.$image_full_name;
                                            if ($photo->move(public_path('documentos'),$image_full_name))
                                            {
                                                DB::table('payments')->where('id',$idisnet)->update(array( 'photo_payment'=>$imagen_url));   
                                                
                                            }      
                                        } 
                                    }
                                }
                                DB::table('frequencyofpayments')->where('id',$frequencyofpayments[$i])->update(array( 'estadodepago'=>1));   
                                session()->flash('message', 'Se guardo con extio');
                            }
                        }
                        
                    }
                }
            }
            else
            {
                session()->flash('error_datos', 'Debe seleccionar el pago a efectuar');   
            }
            
        }
        return back();
    }
    public function pagostes()
    {
        $empleados=DB::table('company_client')
                ->select(

                    'frequencyofpayments.orden',
                    'frequencyofpayments.fechafin',
                    'frequencyofpayments.fechainicio',
                    'frequencyofpayments.montoestimado',
                    
                )
                ->leftJoin('insurancepolicies', 'company_client.idclient', '=', 'insurancepolicies.idusuario')
                ->leftJoin('frequencyofpayments', 'insurancepolicies.id', '=', 'frequencyofpayments.id_insurancepolicies')
                ->where('company_client.idcompany',3)
                ->get();  

        dd($empleados);
    }
    public function guardarpagpendientecolectivos(Request $request)
    {
            $cbox = $request->input('cbox');
            if (   (isset($cbox)) && (count($cbox)> 0)  )
            {
                $fechafin = $request->input('fechafin'); 
                $fechainicio = $request->input('fechainicio'); 
                $monto = $request->input('monto');
                $photo_payment =  $request->file('photo_payment');
                $frequencyofpayments = $request->input('frequencyofpayments');
                
                $empleados=DB::table('company_client')
                ->select(

                    'frequencyofpayments.orden',
                    'frequencyofpayments.id',
                    'frequencyofpayments.fechafin',
                    'frequencyofpayments.fechainicio',
                    'frequencyofpayments.montoestimado',
                    
                )
                ->leftJoin('insurancepolicies', 'company_client.idclient', '=', 'insurancepolicies.idusuario')
                ->leftJoin('frequencyofpayments', 'insurancepolicies.id', '=', 'frequencyofpayments.id_insurancepolicies')
                ->where('company_client.idcompany',$request->idcompany)
                ->get();    
                
                //dd($fechafin) ;
                for ( $i=0; $i < count($fechafin); $i++ )
                {
                    $imagen_url ='';
                    if (in_array($i, $cbox))
                    {
                       
                        if ( floatval($monto[$i]) >=0  )
                        {
                            //echo ' monto mayor a 0 ';
                            $mon = $monto[$i] ? $monto[$i] : 0;
                            $vinsert =array(
                                'idusuario'=>0,
                                'idquote'=>0,
                                'idadmin'=>0,
                                'fechapago'=>date("Y-m-d H:i:s"),
                                'montopago'=> $mon,
                                'id_frequencyofpayments'=>trim($frequencyofpayments[$i]),
                                'created_at'=>date("Y-m-d H:i:s"),
                                'photo_payment'=>''
                            );
                            
                            if( $idisnet =DB::table('company_payments')->insertGetId($vinsert))
                            {
                                if ($mon > 0)
                                {
                                    //dd('',$monto,$photo_payment,$i);
                                    if (isset($photo_payment))
                                    {
                                        if (array_key_exists($i, $photo_payment)) 
                                        {
                                            if ($photo_payment[$i]) 
                                            {
                                                $photo =$photo_payment[$i];
                                                $image_name=md5(rand(1000,10000));
                                                $ext = strtolower($photo->getClientOriginalExtension() );
                                                $image_full_name=$image_name.'.'.$ext;
                                                $imagen_url = 'documentos/'.$image_full_name;
                                                if ($photo->move(public_path('documentos'),$image_full_name))
                                                {
                                                    DB::table('company_payments')->where('id',$idisnet)->update(array( 'photo_payment'=>$imagen_url));   
                                                    
                                                }      
                                            } 
                                        }
                                    }
                                    
                                }
                                DB::table('company_frequencies_detail')->where('id',$frequencyofpayments[$i])->update(array( 'estadodepago'=>1));   
                                
                            }
                            
                            foreach ($empleados as $empleado)
                            {
                                
                                if( ($empleado->fechainicio==$fechainicio[$i]) && ($empleado->fechafin == $fechafin[$i]))
                                {
                                    $vinsert =array(
                                        'idusuario'=>0,
                                        'idquote'=>0,
                                        'idadmin'=>0,
                                        'fechapago'=>date("Y-m-d H:i:s"),
                                        'montopago'=> $mon,
                                        'id_frequencyofpayments'=>trim($empleado->id),
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'photo_payment'=>''
                                    );
                                   
                                    if( $idisnet =DB::table('payments')->insertGetId($vinsert))
                                    {
                                        if ($mon > 0)
                                        {
                                            DB::table('payments')->where('id',$idisnet)->update(array( 'photo_payment'=>$imagen_url));     
                                        }
                                        DB::table('frequencyofpayments')->where('id',$empleado->id)->update(array( 'estadodepago'=>1));   
                                        
                                    }
                                }
                            }
                        }
                        
                    }
                    else
                    {
                        session()->flash('message', 'NO se pudo realizar pagos -error01');
                        //echo " no esta el id ".$i." en coxb ";
                        //print_r($cbox);
                        //dd($cbox,$i,$fechafin);
                        //return back();
                    }
                }
            }
            else
            {
                session()->flash('message', 'NO se pudo realizar pagos -error02');
                return back();
            }
            session()->flash('message', 'Pagos realizados con exito');
            return back();
    }
    public function eliminarfrecuecia(Request $request)
    {
        $edita =array(
            'estadodepago' =>0
           );
        DB::table('payments')->where('id_frequencyofpayments',$request->id)->delete();
        DB::table('frequencyofpayments')->where('id',$request->id)->update($edita);
        $res['result']=true;
        session()->flash('message', 'Frecuencia eliminada con exito');
        return response()->json($res);
    }
    public function gudardarsinisestro(Request $request)
    {
        //dd($request);
        $descripcionsiniestro =$request->input("descripcionsiniestro"); // monto de la poliza
        $montosiniestro =$request->input("montosiniestro"); // seguro de la poiza
        $accidents = DB::table('accidents')->insertGetId(
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'idusuario'=>$request->idusuariosiniestro,
                'idadmin'=>$request->idadminsinisestro,
                'descripcion' =>$descripcionsiniestro,
                'monto' =>$montosiniestro,
                'estado' =>$request->input("estadosiniestro"),
                'id_insurancepolicies' =>$request->input("id_insurancepoliciesaccidentes")
            ]);
        if ($documentossiniestro =  $request->file('documentossiniestro'))
        {
            $cn=0;
            $nombredocumentossiniestro =$request->input("nombredocumentossiniestro");
            foreach ($documentossiniestro as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    $tipo ='documento';
                    if ( $nombredocumentossiniestro[$cn] )
                        $tipo =$nombredocumentossiniestro[$cn];
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->idusuariosiniestro,
                            'tipo'=>5,
                            'id_insurancepolicies'=>$request->input("id_insurancepoliciesaccidentes"),
                            'id_accidente'=>$accidents
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                $cn++;
            }
        }  
        //dd($request);
        
        session()->flash('message', 'Siniestro agregada con éxito');    
        return back();
    }
    function buscarsiniestros (Request $request)
    {
        if ( (DB::table('accidents')->where('id_insurancepolicies',$request->id_insurancepolicies)->count()) >0  )
        {
            $accidents= DB::table('accidents')->where('id_insurancepolicies',$request->id_insurancepolicies) ->orderBy('accidents.id', 'DESC')->get();
            $i=0;
            $doc=[];
            foreach ($accidents as $acc )
            {
                $docuemntos =  DB::table('docuemntos')->where('id_accidente',$acc->id)->get();
                foreach ($docuemntos as $docc)
                {
                    $doc[$i] =array(
                        'tipodocumento'=>$docc->tipodocumento,
                        'id_accidente'=>$docc->id_accidente,
                        'documentonombre'=>$docc->documentonombre);
                    $i++;
                }
                
            }
            $data['accidents'] =true;
            $data['data'] =$accidents;
            $data['datadoc'] =$doc;
            
        }
        else
        {
            $data['accidents'] =false;
            $data['data'] =[];
            $data['datadoc'] =[];
            $data['id'] =$request->id_insurancepolicies;
        }
        return response()->json($data);
    }
    public function gudardarsinisestroeditar(Request $request)
    {
        //dd($request);
        $descripcionsiniestro =$request->input("descripcionsiniestroeditar"); // monto de la poliza
        $montosiniestro =$request->input("montosiniestroeditar"); // seguro de la poiza
        $montopagadoeditar =$request->input("montopagadoeditar"); 
        if ($request->input("idsiniestroeditar"))
        {
            $accidents =array( 
                'updated_at'=>date("Y-m-d H:i:s"),
                'descripcion' =>$descripcionsiniestro,
                'monto' =>$montosiniestro,
                'montopagado' =>$montopagadoeditar,
                'estado' =>$request->input("estadosiniestroeditar"),
                'id_insurancepolicies' =>$request->input("id_insurancepoliciesaccidentes"));
            DB::table('accidents')->where('id',$request->input("idsiniestroeditar"))->update($accidents);
            if ($documentossiniestro =  $request->file('documentossiniestro'))
            {
                $cn=0;
                $nombredocumentossiniestro =$request->input("nombredocumentossiniestro");
                foreach ($documentossiniestro as $documento)
                {
                    $image_name=md5(rand(1000,10000));
                    $ext = strtolower($documento->getClientOriginalExtension() );
                    $image_full_name=$image_name.'.'.$ext;
                    $upload_path ='public/documentos/';
                    $imagen_url = $upload_path.$image_full_name;
                    if ($documento->move(public_path('documentos'),$image_full_name))
                    {
                        $imagen[]=$imagen_url;
                        $tipo ='documento';
                        if ( $nombredocumentossiniestro[$cn] )
                            $tipo =$nombredocumentossiniestro[$cn];
                        Docuemntos::insert(
                            [
                                'created_at'=>date("Y-m-d H:i:s"),
                                'documentonombre'=>$image_full_name,
                                'tipodocumento'=>$tipo,
                                'documentonombre'=>'documentos/'.$image_full_name,
                                'idusuario'=>$request->idusuariosiniestro,
                                'tipo'=>5,
                                'id_insurancepolicies'=>$request->input("id_insurancepoliciesaccidentes"),
                                'id_accidente'=>$request->input("idsiniestroeditar")
                            ]);    
                        session()->flash('message', 'Documento cargado con éxito');              
                    } 
                    else
                        session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                    $cn++;
                }
            }  
            //dd($request);
            
            session()->flash('message', 'Siniestro agregada con éxito');    
        }
        else
        {
            session()->flash('message', 'EL siniestro no se pudo actualizar');  
        }
       
        return back();
    }
    public function borrardocumento($id)
    {
        $delete=array('id'=>$id);
        if (Docuemntos::where($delete)->delete())
            $res['result']=true;
        else
            $res['result']=false;

        return response()->json($res);
    }
    public function eliminarqr($id)
    {
        $accidents =array('codeqr'=>'');
        DB::table('clientes')->where('id',$id)->update($accidents);
        $res['result']=true;
        session()->flash('message', 'Codigo QR eliminado con exito');
        return response()->json($res);
    }
    public function test()
    {
        return view("clientes.test");
    }
    public function generarimgqr ()
    {
        QrCode::generate('aaaaaaaaaaaaaaaaaa', '../public/qrcodes/qrcode.svg');
    } 
    public function editarpoliza($idinsurancepolicies)
    {
        $insurancepolicies =DB::table('insurancepolicies')->where('id',$idinsurancepolicies)->get();
        $docuemntos =DB::table('docuemntos')->where('id_insurancepolicies',$idinsurancepolicies)->get(); 

        if ($docuemntos->count() > 0 )
        {
            foreach ( $docuemntos  as $member_quote => $d)
            {
                $nestedData['id']               = $d->id;
                $nestedData['documentonombre']  = $d->documentonombre;
                $nestedData['tipodocumento']    = $d->tipodocumento;
                $nestedData['url']              = $d->url;
                $nestedData['tipo']              = $d->tipo;
                $documentos[] = $nestedData;
            }
        }

        $comentario =DB::table('comentariospolizas')->where('id_insurancepolicies',$idinsurancepolicies)->get();

        if ($comentario->count() > 0 )
        {
            foreach ( $comentario  as $comentari => $c)
            {
                $nestedData['id']               = $c->id;
                $nestedData['comentario']           = $c->comentario;
                $coment[] = $nestedData;
            }
        }
        $member_quotes =DB::table('member_quotes')->where('id_insurancepolicies',$idinsurancepolicies)->get();

        
        if ($member_quotes->count() > 0 )
        {
            foreach ( $member_quotes  as $member_quote => $c)
            {
                $nestedData['id']               = $c->id;
                $nestedData['status']           = $c->status;
                $nestedData['gender']         = $c->gender;
                $nestedData['date']            = $c->date;
                $nestedData['birthday']           = $c->birthday;
                $nestedData['day']   = $c->day;
                $nestedData['month']            = $c->month;
                $nestedData['year']            = $c->year;
                $nestedData['total']            = $c->total;
                $member[] = $nestedData;
            }
        }

        $patologiasi =DB::table('patologia')->where(
        [
            'pat_id_poliza' => $idinsurancepolicies,
            'pat_status' => 1
        ]
        )->get();
        if ($patologiasi->count() > 0 )
        {
            foreach ( $patologiasi  as $psi => $p)
            {
                $nestedData['id']           = $p->pat_id;
                $nestedData['descripcion']  = $p->pat_descripcion;
                $declarada[] = $nestedData;
            }
        }

        $patologiano =DB::table('patologia')->where(
        [
            'pat_id_poliza' => $idinsurancepolicies,
            'pat_status' => 0
        ]
        )->get();
        if ($patologiano->count() > 0 )
        {
            foreach ( $patologiano  as $pno => $p)
            {
                $nestedData['id']               = $p->pat_id;
                $nestedData['descripcion']  = $p->pat_descripcion;
                $nodeclarada[] = $nestedData;
            }
        }
        $res['documentos']= $docuemntos->count() > 0 ? $documentos: [];
        $res['insurers']=$insurancepolicies->count() > 0 ? $insurancepolicies: [];
        $res['comentario']=$comentario->count() > 0 ? $coment: [];
        $res['member']=$member_quotes->count() > 0 ? $member: [];

        $res['declarada']=$patologiasi->count() > 0 ? $declarada: [];
        $res['nodeclarada']=$patologiano->count() > 0 ? $nodeclarada: [];

        return response()->json($res);
    }  
    public function eliminarparentesco($id)
    {
        $eliminarparentesco =array('id'=>$id);
        DB::table('member_quotes')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function eliminardocumento($id)
    {
        $docuemntos =array('id'=>$id);
        DB::table('docuemntos')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function eliminarcomentario($id)
    {
        $comentariospolizas =array('id'=>$id);
        DB::table('comentariospolizas')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function eliminardelcarada($id)
    {
        $patologia =array('id'=>$id);
        DB::table('patologia')->where('pat_id',$id)->delete();
        $res['result']=true;
       
        return response()->json($res);
    }
    public function eliminarnodeclarada($id)
    {
        $patologia =array('id'=>$id);
        DB::table('patologia')->where('pat_id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function eliminarpoliza($id)
    {
       
        DB::table('insurancepolicies')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function addparentesco(Request $request){
        for ( $i=0 ; $i <= $request->input("index"); $i++ ) 
        {
           
            $day = $request->input("day_$i");
            $mounth = $request->input("mounth_$i");
            $birthday = $request->input("birthday_$i");
            if ( floatval( $day)  < 10 )
                 $day ='0'. $day;

            if ( floatval($mounth)  < 10 )
                $mounth ='0'.$mounth;

            if ( strlen($birthday)  < 4 )
                $birthday =2000;

            $member = new MemberQuote();
            $member->status = $request->input("status_$i");
            $member->gender = $request->input("gender_$i");
            $member->date = Carbon::parse( $day . "-" . $mounth . "-" . $birthday )->age;
            $member->birthday = $day . "-" . $mounth . "-" . $birthday;
            $member->quote_id = 0; 
            $member->id_insurancepolicies = $request->polisaeditar1;
            $member->day =$day;
            $member->month =$mounth;
            $member->year =$birthday ;
            $member->save();
        }
        return back();
    }
    public function adddocumentos(Request $request){
        if ($documentopersonal2 =  $request->file('documentopersonal2'))
        {
            $cn=0;$comen=0;
            $nombredocumentopersonal2 =$request->input("nombredocumentopersonal2");
            foreach ($documentopersonal2 as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                $tipo ='documento';
                if ( $nombredocumentopersonal2[$cn] )
                    $tipo =$nombredocumentopersonal2[$cn];
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->polisaidusuario2,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$request->polisaeditar2
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');

                $cn ++;
            }
        } 
        return back();
    }
    public function addcomentario(Request $request){
        $comentariosalud2 =$request->input("comentariosalud2");
        if ( count($comentariosalud2) >0 )
        {
            foreach ( $comentariosalud2 as $c )
            {   
                $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                    [
                        'created_at'=>date("Y-m-d H:i:s"),
                        'id_insurancepolicies'=>$request->polisaeditar3,
                        'comentario'=>$c,
                        'idadmin'=>$request->polisaeditaradmin3,
                        'idusuario'=>$request->polisaidusuario3,
                    ]);
            }
        }
        return back();
    }
    public function addpatologiasi(Request $request){
        $patologiacomentadas2 =$request->input("patologiacomentadas2");
        //dd($patologiacomentadas2);
        if ( count($patologiacomentadas2) >0 )
        {
            foreach ( $patologiacomentadas2 as $c )
            {   
                $patologiasi = DB::table('patologia')->insertGetId(
                    [
                        'pat_id_poliza'=>$request->polisaeditar4,
                        'pat_descripcion'=>$c,
                        'pat_idadmin'=>$request->polisaeditaradmin4,
                        'pat_idusuario'=>$request->polisaidusuario4,
                        'pat_status'=>1,
                        'created_at'=>date("Y-m-d H:i:s"),
                    ]);
            }
        }
        return back();
    }
    public function addpatologiano(Request $request){
        $patologiasnocomentadas2 =$request->input("patologianocomentadas2");
        if ( count($patologiasnocomentadas2) >0 )
        {
            foreach ( $patologiasnocomentadas2 as $c )
            {   
                $patologiasi = DB::table('patologia')->insertGetId(
                    [
                        'pat_id_poliza'=>$request->polisaeditar5,
                        'pat_descripcion'=>$c,
                        'pat_idadmin'=>$request->polisaeditaradmin5,
                        'pat_idusuario'=>$request->polisaidusuario5,
                        'pat_status'=>0,
                        'created_at'=>date("Y-m-d H:i:s"),
                    ]);
            }
        }
        return back();
    }

    public function editmodeloautos(Request $request)
    {
       $edita =array(
        'descripcionpoliza' =>$request->nroplacaedit.' Modelo : '.$request->modeloedit,
       );
       DB::table('insurancepolicies')->where('id',$request->poliatuedit1)->update($edita);
       return back();
    }
    public function editardocumentosauto(Request $request)
    {
        if ($documentosautoseditardd =  $request->file('documentosautoseditardd'))
        {
            $cn=0;
            $nombredocumentosautoseditardd =$request->input("nombredocumentosautoseditardd");
            foreach ($documentosautoseditardd as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    $tipo ='documento';
                    if ( $nombredocumentosautoseditardd[$cn] )
                        $tipo =$nombredocumentosautoseditardd[$cn];
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->usuarioadminpoliatuedit2,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$request->poliatuedit2
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                $cn++;
            }
        } 
        return back();
    }
    public function editarcomentariosagregar(Request $request)
    {
        $comentarioautoseditadd =$request->input("comentarioautoseditadd"); 
        if ( count($comentarioautoseditadd) >0 )
        {
            foreach ( $comentarioautoseditadd as $c )
            {   
                $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                    [
                        'created_at'=>date("Y-m-d H:i:s"),
                        'id_insurancepolicies'=>$request->poliatuedit3,
                        'comentario'=>$c,
                        'idadmin'=>$request->adminpoliatuedit3,
                        'idusuario'=>$request->usuarioadminpoliatuedit3,
                    ]);
            }
        }
        return back();
    }

    public function editarempresa(Request $request)
    {
        $edita =array(
            'descripcionpoliza' =>$request->nombreempresaedita.' Representante : '.$request->representanteedit,
            'dimensiones' =>$request->dimensionesedit,
            'ubicacion' =>$request->ubicacionedit
           );
        DB::table('insurancepolicies')->where('id',$request->polizaempresaedit1)->update($edita);
        return back();
    }
    public function editarempresadocumentos(Request $request)
    {
        if ($documentosempresaeditar =  $request->file('documentosempresaeditar'))
        {
            $cn=0;
            $nombredocumentosempresaeditar =$request->input("nombredocumentosempresaeditar");
            foreach ($documentosempresaeditar as $documento)
            {
                $image_name=md5(rand(1000,10000));
                $ext = strtolower($documento->getClientOriginalExtension() );
                $image_full_name=$image_name.'.'.$ext;
                $upload_path ='public/documentos/';
                $imagen_url = $upload_path.$image_full_name;
                
                if ($documento->move(public_path('documentos'),$image_full_name))
                {
                    $imagen[]=$imagen_url;
                    $tipo ='documento';
                    if ( $nombredocumentosempresaeditar[$cn] )
                        $tipo =$nombredocumentosempresaeditar[$cn];
                    Docuemntos::insert(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'documentonombre'=>$image_full_name,
                            'tipodocumento'=>$tipo,
                            'documentonombre'=>'documentos/'.$image_full_name,
                            'idusuario'=>$request->usuarioempresapoliza2,
                            'tipo'=>1,
                            'id_insurancepolicies'=>$request->polizaempresaedit2
                        ]);    
                    session()->flash('message', 'Documento cargado con éxito');              
                } 
                else
                    session()->flash('error_documentos', 'No se pudo subir algunos documentos');
                $cn++;
            }
        }
        
        return back();
    }
    public function editarempresacomentarios(Request $request)
    {
       
        $comentarioempresaeditar =$request->input("comentarioempresaeditar");
            if ( count($comentarioempresaeditar) >0 )
            {
                foreach ( $comentarioempresaeditar as $c )
                {   
                    $comentariospolizas = DB::table('comentariospolizas')->insertGetId(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'id_insurancepolicies'=>$request->polizaempresaedit3,
                            'comentario'=>$c,
                            'idadmin'=>$request->adminempresapoliza3,
                            'idusuario'=>$request->usuarioempresapoliza3,
                        ]);
                }
            }
        return back();
    }
    public function eliminarpersonal($id)
    {
        $eliminarparentesco =array('id'=>$id);
        DB::table('contactocotiseguros')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }
    public function eliminarcontacto($id)
    {
        $eliminarparentesco =array('id'=>$id);
        DB::table('contactoseguros')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }

    public function importarusuarios()
    {
        return view("admin.importarusuarios");
    }
    public function cargarProductos(Request $request)
    {
        $archivo = $request->file('excel');
        $disponibles = array("xlsx", "xls");
        $file_name = Str::random(30);
        $ext = strtolower($archivo->getClientOriginalExtension());

        if (!in_array($ext, $disponibles)) {
            return response()->json(array("result" => false, "msg" => "Documento invalida, por favor suba un excel valido"), 200);
        }
        $file_full_name = $file_name . '.' . $ext;
        $upload_path = 'plantillas/';
        $file_url = $upload_path . $file_full_name;
        $success = $archivo->move($upload_path, $file_full_name);
        $collection = (new FastExcel)->import($file_url);

        for ($i = 1; $i < sizeof($collection); $i++) {

            $iva = $collection[$i]['iva'] ?  $collection[$i]['iva']  : 0;
            $precioiva = (floatval(@$collection[$i]['precio']) * floatval($iva))/100;
            $precivoventa = floatval($collection[$i]['precio'])+ floatval($precioiva); 
            Productos::create([
                'nombre'=>@$collection[$i]['nombre'],
                'descripcion_corta'=> utf8_encode(@$collection[$i]['descripcion_corta'])    ,
                'descripcion_larga'=>utf8_encode(@$collection[$i]['descripcion_larga']),
                'precio_unitario'=>@$collection[$i]['precio'],
                'iva'=>@$collection[$i]['iva'],
                'precio_venta'=>$precivoventa,
                'imagen'=>@$collection[$i]['img'],
                'cantidad'=>@$collection[$i]['cantidad'],
                'tipo'=>@$collection[$i]['tipo'],
                'proveedor'=>@$collection[$i]['proveedor'],
            ]);
        }
        $data['proveedores']= DB::table('proveedores')->get();
        return view('productos.subirproductos',$data);  
    }
    public function importausu(Request $request)
    {
        $archivo = $request->file('excel');
        $disponibles = array("xlsx", "xls");
        $file_name = Str::random(30);
        $ext = strtolower($archivo->getClientOriginalExtension());
        $data=[];
        if (!in_array($ext, $disponibles)) {
            $data['message']='Documento invalida, por favor suba un excel valido';
        }
        else{
            $file_full_name = $file_name . '.' . $ext;
            $upload_path = 'plantillas/';
            $file_url = $upload_path . $file_full_name;
            $success = $archivo->move($upload_path, $file_full_name);
            $collection = (new FastExcel)->import($file_url);
           
            for ($i = 0; $i < sizeof($collection); $i++) 
            {
                
                $nombre = $collection[$i]['nombre'] ;
                $apellido = $collection[$i]['apellido'] ;
                $email = $collection[$i]['email'] ;
                $clave = $collection[$i]['clave'] ;
                $cedula = $collection[$i]['cedula'] ;
                $role = $collection[$i]['roles'] ;
                $telefono = $collection[$i]['telefono'] ;
                $fecha_nacimiento = @$collection[$i]['fecha_nacimiento'] ;
                if ($collection[$i]['estado'] )
                    $locacion = $collection[$i]['estado'] ;
                else
                    $locacion =0;
                
                
                if (($nombre !='') && ($apellido !='') && ($email !='')&& ($clave !='') && ($cedula !='') && ($role !='') && ($telefono !='') )
                {
                    $users = DB::table('users')->where('email',$email)->get();
                   
                    if ( $users->count() > 0 )
                    {
                       $id_usario =$users[0]->id;
                       $cliente = DB::table('clientes')->where('idusuario',$id_usario)->get();
                       if ( $cliente->count() > 0)
                       {
                            $id_cliente =$cliente[0]->id;
                            $datauser =array(
                                'role_id' => 5,
                                'name' => $nombre,
                                'lastname' =>$apellido ,
                                'phone' =>$telefono
                               );
                               DB::table('users')->where('id',$id_usario)->update($datauser);
                            //
                            $datacliente =array(
                            
                                'nombre' => $nombre,
                                'apellido' =>$apellido ,
                                'cedula' => $cedula,
                                'numerotelefono' => $telefono,
                                'estado' =>1,
                                'rif' =>'',
                                'fecha_nacimiento' =>@$fecha_nacimiento,
                                'locacion' => $locacion
                               );
                               DB::table('clientes')->where('id',$id_cliente)->update($datacliente);
                       }
                       else
                       {

                       }
                    }
                    else
                    {
                        
                        $User = DB::table('users')->insertGetId(
                            [
                                'role_id' => 5,
                                'name' => $nombre,
                                'lastname' =>$apellido ,
                                'email' => $email,
                                'password' => bcrypt($clave),
                                'phone' =>$telefono
                            ]);
                        $user_roles = DB::table('user_roles')->insertGetId(
                            [
                                'user_id' => $User,
                                'role_id' => 5
                            ]);
                            
                            $clientes = DB::table('clientes')->insertGetId(
                                [
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'nombre' => $nombre,
                                    'apellido' =>$apellido ,
                                    'cedula' => $cedula,
                                    'numerotelefono' => $telefono,
                                    'estado' =>1,
                                    'idusuario' => $User,
                                    'rif' =>'',
                                    'fecha_nacimiento' =>@$fecha_nacimiento,
                                    'locacion' => $locacion
                                ]);
                           
                    }
                }
            }
                
            $data['message']='Productos cargados con exito';
        }
        session()->flash('message', 'Usuarios cargado con exito');
        return back();
    }

    public function nombredocumento(Request $request)
    {
        $edita =array(
            'tipodocumento' =>$request->nombrenuevo,
           );
        DB::table('docuemntos')->where('id',$request->id)->update($edita);
        $data['result'] =true;
        return $data;
    }
    
    
    

    public function birthdaydate ()
    {
       
        return view("admin.birthdaydate");
    }
    public function listbirthdaydate (Request $request)
    {
       
        $mes =date('m');
        $year =date('Y');

        $mes_actual =$year.'-'.$mes.'-01';
       
        $fin_de_mes = date("Y-m-d",strtotime($mes_actual."+ 1 month")); 
       
        $clientes = DB::table('clientes')
        //->whereBetween('fecha_nacimiento', [$from, $to])
        ->get();
        $con =0;
        $data =[];
        foreach ( $clientes as $cliente => $cli)
        {
            if ($cli->fecha_nacimiento)
            {
                //1988-07-24
                $mes_cumple = substr($cli->fecha_nacimiento, 5, 2); 
                if ($mes_cumple ==$mes )
                {
                    $datos['id'] = $cli->id;
                    $datos['nombre'] = $cli->nombre;
                    $datos['apellido'] = $cli->apellido;
                    $datos['fecha_nacimiento'] = $cli->fecha_nacimiento;
                    $datos['numerotelefono'] = $cli->numerotelefono;
                    $data[]=$datos;
                    $con++;
                }
            }
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal']       =   $con;
        $dataresponce['recordsFiltered']    =   $con;
        $dataresponce['data']               =   $data;
        return response()->json($dataresponce);
    }

    public function renovarpoliza(Request $request)
    {
        
        $idpolozarenovar = $request->idpolozarenovar;
        $montorenovarpoliza = $request->montorenovarpoliza;

        $seguro = $request->seguro;
        $frequencierenovacion = $request->frequencierenovacion;

        $frecuencias = $request->frecuencias;
       
        $frequencierenovacion = $request->fechainicirenovacion;

        $fechainicio = $request->fechainicio;
        // pasar a terminada la poliza y renovada frequencyofpayments
        $insurancepolicie = DB::table('insurancepolicies')->where('id',$idpolozarenovar)->get();
        $data =array('estado'=>2);
        DB::table('insurancepolicies')->where('id',$idpolozarenovar)->update($data);
        //
        $tipopoliza =$insurancepolicie[0]->tipopoliza;
        $comentario =$insurancepolicie[0]->comentario;
        $descripcionpoliza =$insurancepolicie[0]->descripcionpoliza;
        $idusuario =$insurancepolicie[0]->idusuario;
        $idadmin =$insurancepolicie[0]->idadmin;
        $dimensiones =$insurancepolicie[0]->dimensiones;
        $ubicacion =$insurancepolicie[0]->ubicacion;
        $idinsurers =$insurancepolicie[0]->idinsurers;
        //
        $montorenovarpoliza = $request->montorenovarpoliza;
        if ($seguro=='no')
        {
            
            $segurorenovacion = $request->segurorenovacion;
            $polisarenovada = DB::table('insurancepolicies')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'idusuario'=>$idusuario,
                    'idadmin'=>$idadmin,
                    'idcoverages' =>$montorenovarpoliza,
                    'idinsurers' =>$segurorenovacion,
                    'tipopoliza'=>$tipopoliza,
                    'dimensiones' =>$dimensiones,
                    'ubicacion' =>$ubicacion,
                    'comentario'=>$comentario,
                ]);
        }
        else
        {
            $polisarenovada = DB::table('insurancepolicies')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'idusuario'=>$idusuario,
                    'idadmin'=>$idadmin,
                    'idcoverages' =>$montorenovarpoliza,
                    'idinsurers' =>$idinsurers,
                    'tipopoliza'=>$tipopoliza,
                    'dimensiones' =>$dimensiones,
                    'ubicacion' =>$ubicacion,
                    'comentario'=>$comentario,
                ]);
        }
        $orden=0; 
       
        if (DB::table('frequencyofpayments')->find(\DB::table('frequencyofpayments')->where('id_insurancepolicies',$idpolozarenovar)->max('id')) )
            $orden =$orden + 1;
        
        $fechaincio =$request->fechainicirenovacion;
        $fechafin =$request->fechafinrenovacion;
        $monto =$request->montorenovacion;
        $idadmin =0;
        for ( $i=0; $i < count($fechaincio); $i++ )
        {
            $vec=array(
                'created_at'=>date('Y-m-d'),
                'idquote'=>0,
                'fechainicio'=>$fechaincio[$i],
                'fechafin'=>$fechafin[$i],
                'montoestimado'=> $monto[$i] >0 ? $monto[$i] :0,
                'idadmin'=>0,
                'id_insurancepolicies'=>$polisarenovada,
                'estadodepago'=>0,
                'orden'=>$orden
            );
            DB::table('frequencyofpayments')->insert($vec);
        }
        // comentarios
        $comentariospolizas = DB::table('comentariospolizas')->where('id_insurancepolicies',$idpolozarenovar)->get();

        foreach ( $comentariospolizas as $c)
        {
            $add = DB::table('comentariospolizas')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'id_insurancepolicies'=>$polisarenovada,
                    'comentario'=>$c->comentario,
                    'idadmin'=>$c->idadmin,
                    'idusuario'=>$c->idusuario,
                ]);
        }
        // documentos
        $documentos = DB::table('docuemntos')->where('id_insurancepolicies',$idpolozarenovar)->get();
        foreach ( $documentos as $c)
        {
            $add = DB::table('docuemntos')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'id_insurancepolicies'=>$polisarenovada,
                    'documentonombre'=>$c->documentonombre,
                    'tipodocumento'=>$c->tipodocumento,
                    'url'=>$c->url,
                    'idusuario'=>$c->idusuario,
                    'tipo'=>$c->tipo,
                    'id_accidente'=>$c->id_accidente,
                ]);
        }
        // patologia
        $patologia = DB::table('patologia')->where('pat_id_poliza',$idpolozarenovar)->get();
        foreach ( $patologia as $c)
        {
            $add = DB::table('patologia')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'pat_id_poliza'=>$polisarenovada,
                    'pat_descripcion'=>$c->pat_descripcion,
                    'pat_status'=>$c->pat_status,
                    'pat_idusuario'=>$c->pat_idusuario,
                    'pat_idadmin'=>$c->pat_idadmin,
                ]);
        }
        // member_quotes
        $member_quotes =DB::table('member_quotes')->where('id_insurancepolicies',$idpolozarenovar)->get();
        foreach ( $member_quotes as $c)
        {
            $add = DB::table('member_quotes')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'id_insurancepolicies'=>$polisarenovada,
                    'status'=>$c->status,
                    'gender'=>$c->gender,
                    'date'=>$c->date,
                    'birthday'=>$c->birthday,
                    'quote_id'=>$c->quote_id,
                    'day'=>$c->day,
                    'month'=>$c->month,
                    'year'=>$c->year,
                    'total'=>$c->total,
                ]);
        }
        session()->flash('message', 'Poliza renovada con exito');    
        return back();
    }

    public function continuidad(Request $request)
    {
        if ( isset($request->idpolizacontinuidad) && isset($request->segurocontinuidad) )
        {
            $data =array('idinsurers'=>$request->segurocontinuidad);
            DB::table('insurancepolicies')->where('id',$request->idpolizacontinuidad)->update($data);
            session()->flash('message', 'Continuidad generada con exito');    
            return back();
        }
        else
        {
            session()->flash('message', 'porfavor intentelo de nuevo');    
            return back();
        }
    }
    //----

    public function colectivos()
    {
        return view("admin.colectivos");
    }
    public function importgroups(Request $request)
    {
        $archivo = $request->file('excel');
        $disponibles = ["xlsx", "xls"];
        $ext = strtolower($archivo->getClientOriginalExtension());

        if (!in_array($ext, $disponibles)) {
            return back()->with('message', 'Documento inválido, por favor suba un excel válido');
        }

        $file_name = Str::random(30) . '.' . $ext;
        $upload_path = 'plantillas/';
        $archivo->move($upload_path, $file_name);
        
        $collection = (new FastExcel)->import($upload_path . $file_name);

        // Verificar cabeceras
        $requiredHeaders = ['nombre', 'apellido', 'email', 'clave', 'cedula', 'roles', 'telefono', 'id_colectivo'];
        
        if (!$this->validateHeaders($collection, $requiredHeaders)) {
            return back()->with('message', 'El archivo no contiene todas las cabeceras requeridas.');
        }

        foreach ($collection as $row) {
            // Validar que las columnas requeridas no estén vacías
            if (!empty(array_filter($row))) {
                // Extraer datos con verificación
                $nombre = $row['nombre'] ?? '';
                $apellido = $row['apellido'] ?? '';
                $email = $row['email'] ?? '';
                $clave = $row['clave'] ?? '123456789';
                $cedula = $row['cedula'] ?? '';
                $role = $row['roles'] ?? '';
                $telefono = $row['telefono'] ?? '';
                $companyid = $row['id_colectivo'] ?? '';
                $fecha_nacimiento = @$row['fecha_nacimiento'];
                $locacion = @$row['estado'] ?: 0;

                // Comprobar si el usuario existe
                $user = DB::table('users')->where('email', $email)->first();

                if ($user) {
                    // Actualizar usuario y cliente
                    DB::table('users')->where('id', $user->id)->update([
                        'name' => $nombre,
                        'lastname' => $apellido,
                        'phone' => $telefono,
                    ]);

                    // Actualizar cliente
                    if ($cliente = DB::table('clientes')->where('idusuario', $user->id)->first()) {
                        DB::table('clientes')->where('id', $cliente->id)->update([
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'cedula' => $cedula,
                            'numerotelefono' => $telefono,
                            'estado' => 1,
                            'rif' => '',
                            'fecha_nacimiento' => @$fecha_nacimiento,
                            'locacion' => $locacion,
                        ]);
                    }
                    
                } else {
                    // Crear nuevo usuario
                    $userId = DB::table('users')->insertGetId([
                        'role_id' => 5,
                        'name' => $nombre,
                        'lastname' => $apellido,
                        'email' => $email,
                        'password' => bcrypt($clave),
                        'phone' => $telefono,
                    ]);

                    // Crear nuevo cliente
                    DB::table('clientes')->insertGetId([
                        'created_at' => now(),
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'cedula' => $cedula,
                        'numerotelefono' => $telefono,
                        'estado' => 1,
                        'idusuario' => $userId,
                        'rif' => '',
                        'fecha_nacimiento' => @$fecha_nacimiento,
                        'locacion' => $locacion,
                        'tipocliente' => 1
                    ]);

                    // Relacionar el cliente con la empresa
                    DB::table('company_client')->insertGetId([
                        'created_at' => now(),
                        'idcompany' => (int)$companyid, // Asegúrate de que esto sea un entero
                        'idclient' => (int)$userId, // Asegúrate de que esto sea un entero
                    ]);
                }
            }
        }

        return back()->with('message', 'Colectivos cargados con éxito');
    }

    private function validateHeaders($collection, array $requiredHeaders)
    {
        if (empty($collection)) {
            return false;
        }

        // Obtener las cabeceras del primer registro
        return !array_diff($requiredHeaders, array_keys($collection[0]));
    }
    
    
    public function insuredgroups ()
    {
        return view("admin.insuredgroups");
    }
    public function insuredgroupsforid ($id)
    {
        $data['id']=$id;
        return view("admin.insuredgroups",$data);
    }
    public function removefromthecollective($id)
    {
        DB::table('company_client')->where('idclient',$id)->delete();
        return back();
    }
    public function listgroups(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $idcompany = $request->input('idcompany');
        $order = $request->input('order', [['column' => 0, 'dir' => 'desc']]);
        // Mapeo de columnas
        $columns = ['id', 'companyname', 'rifcompany', 'adresscompany', 'notecompany'];
        $orderBy = $columns[$order[0]['column']] ?? 'id';
        // Construcción de la consulta base

        
        $query = DB::table('company_client')
            ->select(
                'clientes.id',
                'clientes.idusuario',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono',
                'clientes.cedula',
                'clientes.rif',
                'clientes.estado',
                'company.companyname as company',
                'users.email'
            )
            ->leftJoin('clientes', 'clientes.idusuario', '=', 'company_client.idclient')
            ->leftJoin('company', 'company_client.idcompany', '=', 'company.id')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id');
        // Filtrado por idcompany
        if ($idcompany > 0) {
            $query->where('company_client.idcompany', $idcompany);
        }
        // Filtrado por búsqueda
        if (!empty($search['value'])) {
            $value = '%' . $search['value'] . '%';
            $query->where(function ($subQuery) use ($value) {
                $subQuery->where('clientes.nombre', 'LIKE', $value)
                    ->orWhere('clientes.apellido', 'LIKE', $value)
                    ->orWhere('clientes.numerotelefono', 'LIKE', $value)
                    ->orWhere('clientes.cedula', 'LIKE', $value)
                    ->orWhere('clientes.rif', 'LIKE', $value)
                    ->orWhere('users.email', 'LIKE', $value)
                    ->orWhere('company.companyname', 'LIKE', $value);
            });
        }
        // Obtener datos paginados y ordenados
        $listcompanys = $query->skip($start)->take($limit)->orderBy($orderBy, 'desc')->get();
        // Contar registros totales
        $recordsTotal = DB::table('company_client')
            ->leftJoin('clientes', 'clientes.idusuario', '=', 'company_client.idclient')
            ->leftJoin('company', 'company_client.idcompany', '=', 'company.id')
            ->leftJoin('users', 'clientes.idusuario', '=', 'users.id')
            ->when($idcompany > 0, function ($q) use ($idcompany) {
                return $q->where('company.id', $idcompany);
            })
            ->count();

        // Preparar datos para la respuesta
        $datos = [];
        foreach ($listcompanys as $c) {
            $datos[] = [
                'id' => $c->id,
                'nombre' => $c->nombre,
                'apellido' => $c->apellido,
                'phone' => $c->numerotelefono,
                'cedula' => $c->cedula,
                'numerotelefono' => $c->numerotelefono,
                'email' => $c->email,
                'estado' => $c->estado,
                'company' => $c->company,
                'idusuario' => $c->idusuario,
            ];
        }
        return response()->json([
            'draw' => (int)$request->input('draw'),
            'recordsTotal' => (int)$recordsTotal,
            'recordsFiltered' => (int)$recordsTotal,
            'data' => $datos,
        ]);
    }

    public function insuredpolicies($id)
    {
        if ( DB::table('company')->where('id',$id)->count() > 0  )
        {
            $data['company']=DB::table('company')->where('id',$id)->get();
            $data['id']=$id;
            $data['insurers'] = Insurer::select(["*"])->get();
            $data['insurancepolicies'] =DB::table('company_insurers')
            ->join('insurers', 'company_insurers.insurersid', '=', 'insurers.id')
            ->where('company_insurers.companyid',$id)
            ->select('insurers.name','company_insurers.idcoverages','company_insurers.companyid')->count(); 
            return view("admin.insuredpolicies",$data);
        }
            
        else
            return back();
    }
    public function addpolicesgruop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'companyID' => 'required',
            'mnontocobertura' => 'required',
            'segurocobertura' => 'required',
            
          ],
          [
            'companyID.required' => 'El indentificador de empresa es requerido',
            'mnontocobertura.required' => 'El monto es requerido',
            'segurocobertura.required' => 'El seguro es requerido',
          ]
        );
        if ($validator->fails()) {
            return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);		
          }
        $colectivos = DB::table('company_client')
        ->select(
            'clientes.idusuario as idusuario')
        ->leftJoin('clientes', 'clientes.idusuario', '=', 'company_client.idclient')
        ->where('company_client.idcompany',$request->companyID)
        ->get();

        foreach($colectivos as $colectivo)
        {
            $insurancepolicies = DB::table('insurancepolicies')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'idusuario'=>$colectivo->idusuario,
                    'idadmin'=>0,
                    'idcoverages' =>$request->mnontocobertura,
                    'idinsurers' =>$request->segurocobertura,
                    'comentario'=>''
                ]);
        }
        DB::table('company_insurers')->insertGetId(
            [
                'created_at'=>date("Y-m-d H:i:s"),
                'insurersid' =>$request->segurocobertura,
                'companyid' =>$request->companyID,
                'idcoverages' =>$request->mnontocobertura,
                
            ]);
        
        return response()->json([
            'result'=>'success',
            'data'=>$colectivos,
            'message'=>'polizas agrega con exito']);
    }
    // crear frecuencias de pago a colectivos
    public function frequentcollectivepayments($id) 
    {
        if ( DB::table('company')->where('id',$id)->count() > 0  )
        {
            $data['company']=DB::table('company')->where('id',$id)->get();
            $data['id']=$id;
            $data['insurers'] = Insurer::select(["*"])->get();
            $data['frequencies'] =DB::table('frequencies')->get();
            $coverages = Coverage::select(["*"])->groupBy("coverage")->orderBy("coverage","ASC")->get();
            $insurers = Insurer::select(["*"])->get();
            $data['insurancepolicies'] =DB::table('company_insurers')
            ->join('insurers', 'company_insurers.insurersid', '=', 'insurers.id')
            ->where('company_insurers.companyid',$id)
            ->select('insurers.name','company_insurers.idcoverages','company_insurers.companyid')->get(); 
            
            return view("admin.frequentcollectivepayments",$data);
        }
            
        else
            return back();
    }
    public function makefrequentpayments($id) 
    {
        if ( DB::table('company')->where('id',$id)->count() > 0  )
        {
            $data['company']=DB::table('company')->where('id',$id)->get();
            $data['id']=$id;
            $data['insurers'] = Insurer::select(["*"])->get();
            $data['frequencies'] =DB::table('frequencies')->get();
            $coverages = Coverage::select(["*"])->groupBy("coverage")->orderBy("coverage","ASC")->get();
            $insurers = Insurer::select(["*"])->get();
            $data['insurancepolicies'] =DB::table('company_insurers')
            ->join('insurers', 'company_insurers.insurersid', '=', 'insurers.id')
            ->where('company_insurers.companyid',$id)
            ->select('insurers.name','company_insurers.idcoverages','company_insurers.companyid')->get(); 
            
            return view("admin.makefrequentpayments",$data);
        }
            
        else
            return back();
    }
    // calcular frecuencias de pagos a colectivos
    public function collectivequotas(Request $request)
    {
        
        $frecuencia =$request->frecuencia;
        $montocotizacionpagar=$request->montocotizacionpagar;
        $vector=[];
        if ( @$request->frecuencia)
        {
            if ( @$request->fechainicio )
                $fecha_actual = $request->fechainicio;
            else
                $fecha_actual = date("Y-m-d");
    
            switch ($request->frecuencia) 
            {
                case 1: // anual
                    $fechafinal = date("Y-m-d",strtotime($fecha_actual."+ 1 year"));
                    $vector[0] =array(
                        'fechaini'=>$fecha_actual,
                        'fechafin'=>$fechafinal,
                    );
                    break;
                case 2: //semestral
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
                    for ($d=0; $d < 2; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                        );
                        $fecha_actual= $fechafinal; 
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 6 month"));
                    }
                    break;
                case 4: //trimestral
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                    for ($d=0; $d < 4; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                            'd'=>$d,
                        );
                        $fecha_actual= $fechafinal;
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
                    }
                    break;
                case 12: // mensual
                    $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 1 month"));
                    for ($d=0; $d < 12; $d++)
                    {
                        
                        $vector[$d] =array(
                            'fechaini'=>$fecha_actual,
                            'fechafin'=>$fechafinal,
                        );
                        $fecha_actual= $fechafinal;
                        $fechafinal  =date("Y-m-d",strtotime($fecha_actual."+ 1 month")); 
                        
                    }

                    break;
            } 
            $responce["result"]=true;
        }
        else
            $responce["result"]=false;
        
        $responce["data"] =$vector;
        $responce["id_insurancepolicies"] =$request->id_insurancepolicies;
        return response()->json($responce);
       
    } 
    // guardar frecuencia de pago a colectivos, seleccionada la empresa id_insurancepolicies
    public function savecollectivequotas(Request $request)
    {
        $orden=0; 
        $validator = Validator::make($request->all(), [
            'idcompany' => 'required',
            
          ],
          [
            'idcompany.required' => 'El indentificador de empresa es requerido',
          ]
        );
        if ($validator->fails()) {
            return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);		
          }
        // guardar fecha de pago para las empresas
        $fechaincio =$request->fechainici;
        $fechafin =$request->fechafin;
        $monto =$request->monto;
        $idadmin =0; $orden2=1;
        for ( $i=0; $i < count($fechaincio); $i++ )
        {
            $vec=array(
                'created_at'=>date('Y-m-d'),
                'idquote'=>0,
                'fechainicio'=>$fechaincio[$i],
                'fechafin'=>$fechafin[$i],
                'montoestimado'=> $monto[$i] >0 ? $monto[$i] :0,
                'idadmin'=>$idadmin,
                'id_company'=>$request->idcompany,
                'estadodepago'=>0,
                'orden'=>$orden2
            );
            $orden2 ++;
            DB::table('company_frequencies_detail')->insert($vec);
        }
        // guardar fecha de pago para los colectivos de las empresas  
        $colectivos = DB::table('company_client')
        ->select(
            'clientes.idusuario as idusuario','insurancepolicies.id as insurancepoliciesID')
        ->leftJoin('clientes', 'clientes.idusuario', '=', 'company_client.idclient')
        ->leftJoin('insurancepolicies', 'insurancepolicies.idusuario', '=', 'company_client.idclient')
        ->where('company_client.idcompany',$request->idcompany)
        ->get();
        	
        $vec=array(
            'created_at'=>date('Y-m-d'),
            'companyid'=>$request->idcompany,
            'frecuenci'=>0,
        );
        DB::table('company_frequencies')->insert($vec);   
        foreach($colectivos as $colectivo)
        {
            $fechaincio =$request->fechainici;
            $fechafin =$request->fechafin;
            $monto =$request->monto;
            $idadmin =0;
            $orden=0;
            for ( $i=0; $i < count($fechaincio); $i++ )
            {
                $vec=array(
                    'created_at'=>date('Y-m-d'),
                    'idquote'=>0,
                    'fechainicio'=>$fechaincio[$i],
                    'fechafin'=>$fechafin[$i],
                    'montoestimado'=> $monto[$i] >0 ? $monto[$i] :0,
                    'idadmin'=>$idadmin,
                    'id_insurancepolicies'=>$colectivo->insurancepoliciesID,
                    'estadodepago'=>0,
                    'orden'=>$orden
                );
                DB::table('frequencyofpayments')->insert($vec);
                $orden++;
            }
        }
        return response()->json(['result'=>'success','message'=>'Proceso exitoso']);
    }

    public function amountcoverages ()
    {
        $data =DB::table('insurancepolicies')
        ->leftJoin('coverages', 'coverages.id', '=', 'insurancepolicies.idcoverages')
        ->select('insurancepolicies.id as insurancepoliciesid','coverages.coverage', 
        'coverages.id as coveragesID', 
        'insurancepolicies.idcoverages as idcoverages')
        ->get();
        foreach ($data as $d)
        {
            if ($d->coverage)
            {
                $dataupdate=array(
                    'idcoverages'=>$d->coverage
                );
                DB::table('insurancepolicies')->where('id',$d->coverage)
                ->update($dataupdate);
            }
            else
            {       
                if (DB::table('coveragesres5')->where('id',$d->idcoverages)->count() > 0 )
                {
                    $conv = DB::table('coveragesres5')->where('id',$d->idcoverages)->get();
                    $dataupdate=array(
                        'idcoverages'=>$conv[0]->coverage
                    );
                    DB::table('insurancepolicies')->where('id',$d->insurancepoliciesid)
                    ->update($dataupdate);
                }   
            }
        }
    } 
    public  function viewmaturities()
    {
        return view("admin.viewmaturities");
    }
    public function maturities2(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('length');
        $start = $request->input('start');
        $draw = $request->input('draw');

        // Construir la consulta base
        $query = DB::table('insurancepolicies')
            ->leftJoin('frequencyofpayments', 'frequencyofpayments.id_insurancepolicies', '=', 'insurancepolicies.id')
            ->leftJoin('clientes', 'clientes.idusuario', '=', 'insurancepolicies.idusuario')
            ->select(
                'insurancepolicies.idcoverages',
                'frequencyofpayments.fechainicio',
                'frequencyofpayments.fechafin',
                'clientes.cedula',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.numerotelefono'
            );

        // Aplicar filtros de búsqueda si existen
        if (!empty($search['value'])) {
            $value = $search['value'];
            $query->where(function ($q) use ($value) {
                $q->orWhere('clientes.numerotelefono', 'LIKE', "%$value%")
                ->orWhere('clientes.nombre', 'LIKE', "%$value%")
                ->orWhere('clientes.apellido', 'LIKE', "%$value%")
                ->orWhere('clientes.cedula', 'LIKE', "%$value%");
            });
        }

        // Obtener los registros
        $insurancepolicies = $query->orderBy('frequencyofpayments.fechainicio', 'DESC')
            ->skip($start)
            ->take($limit)
            ->get();

        // Contar los registros totales
        $totalRecords = DB::table('insurancepolicies')->count();
        
        // Contar los registros filtrados
        $filteredRecords = $query->count();

        // Preparar los datos para la respuesta
        $data = [];
        foreach ($insurancepolicies as $conta) {
            $data[] = [
                'cedula' => $conta->cedula,
                'fechainicio' => $conta->fechainicio,
                'fechafin' => $conta->fechafin,
                'nombre' => $conta->nombre,
                'apellido' => $conta->apellido,
                'numerotelefono' => $conta->numerotelefono,
                'idcoverages' => $conta->idcoverages,
            ];
        }

        // Construir la respuesta final
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }
}
