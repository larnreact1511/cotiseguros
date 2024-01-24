<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Gd\Shapes\EllipseShape;
use File;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\FuncCall;
use App\Coverage;
use App\Insurer;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\clientes;
use App\Models\Docuemntos;
use App\Footer;
use App\Quote;
use App\Models\User;
use App\Models\Insurancepolicies;
use App\Models\frequencyofpayments;
use Illuminate\Support\Facades\Hash;
use App\MemberQuote;


class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coverages = Coverage::select(["*"])->groupBy("coverage")->orderBy("coverage","ASC")->get();
        $insurers = Insurer::select(["*"])->get();
        return view("admin.empresas",[
            "coverages" => $coverages,
            "insurers" => $insurers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(empresa $empresa)
    {
        //
    }
    public function listarempresas(Request $request)
    {
       
        $search = $request->input('search'); 
        if ($search['value']=='')
        {
            $empresas = DB::table('empresas')->get();
            $count =DB::table('empresas')->count();
        }
        else
        {
            $value =$search['value']; 
            $empresas = DB::table('empresas')
            ->where('nombreempresa', 'LIKE', "%$value%")
            ->orWhere('rifempresa', 'LIKE', "%$value%")
            ->orWhere('razonsocial', 'LIKE', "%$value%")
            ->get();
            $count = DB::table('empresas')
            ->where('nombreempresa', 'LIKE', "%$value%")
            ->orWhere('rifempresa', 'LIKE', "%$value%")
            ->orWhere('razonsocial', 'LIKE', "%$value%")
            ->count();
        }
       
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] = $count;
        $dataresponce['recordsFiltered'] = $count;
        $dataresponce['data'] = $empresas;
        return response()->json($dataresponce);
    }
    public function datosempresa(Request $request)
    {
        
        if ( @$request->idempresa)
        {
            $vec=array(
                'updated_at'=>date("Y-m-d H:i:s"),
                'nombreempresa'=>$request->nombreempresa,
                'rifempresa'=>$request->rifempresa,
                'razonsocial'=>$request->razonsocial
            );
            
            if (DB::table('empresas')->where('id',$request->idempresa )->update($vec))
            {
                session()->flash('message', 'Se guardo con extio');
            }
            else
            {
                session()->flash('message', 'No se guardo con extio');
            }
            
        }
        else
        {
            $vec=array(
                'created_at'=>date("Y-m-d H:i:s"),
                'nombreempresa'=>$request->nombreempresa,
                'rifempresa'=>$request->rifempresa,
                'razonsocial'=>$request->razonsocial
            );
            if (DB::table('empresas')->insert($vec))
            {
                session()->flash('message', 'Se guardo con extio');
            }
            else
            {
                session()->flash('message', 'No se guardo con extio');
            }
        }
        return back();
    }
    
    public function crearpolizaapemresa(Request $request)
    {
        //dd($request);
        $rows = Excel::toArray( [] ,$request->file('afiliados'));
        //echo "<pre>";
       //print_r($rows);
        $empleados =$rows[0];
        //print_r($empleados);
       //return back();
       for ($i=1; $i< count($empleados) ; $i++)
       {
            $cedula =$empleados[$i][0];
            $nombre =$empleados[$i][1];
            $apellido =$empleados[$i][2];
            $correo =$empleados[$i][3];
            $code =$empleados[$i][4];
            $telefono =$empleados[$i][5];

            $busc=array('email'=>$correo);
            if(  (DB::table('users')->where($busc)->count()) > 0)
            {
                // ya esxite el usuario solo actualiza
            }
            else
            {
                // no exite el usuario se crea
                //$nrocel ='+'+trim($code)+trim($telefono);
                /*
                $user =array(
                    'created_at'=>date("Y-m-d H:i:s"),
                    'role_id'=>4,
                    'name'=>$nombre,
                    'email'=>$correo,
                    'password'=>'$2y$10$mb2jPNeGwMt82BLnI65W.uVl4zif6KFvC3z1xpr7fM/l2nkKNx2wa',
                    'phone'=>'+584247574613',
                    'lastname'=>$apellido,
                );
                echo "<pre>"; print_r($user); die;
                */
                $user = DB::table('users')->insertGetId(
                [
                    'created_at'=>date("Y-m-d H:i:s"),
                    'role_id'=>4,
                    'name'=>$nombre,
                    'email'=>$correo,
                    'password'=>'$2y$10$mb2jPNeGwMt82BLnI65W.uVl4zif6KFvC3z1xpr7fM/l2nkKNx2wa',
                    'phone'=>'+584247574613',
                    'lastname'=>$apellido,
                ]);
                if ($user)
                {
                    $agregarcliente = DB::table('clientes')->insertGetId(
                        [
                            'created_at'=>date("Y-m-d H:i:s"),
                            'nombre'=>$nombre,
                            'apellido'=>@$apellido,
                            'cedula' =>$cedula,
                            'estado' =>1,
                            'idusuario' =>$user,
                            'rif' =>''
                        ]);
                    if ($agregarcliente)
                    {
                        $idmontoempresa =$request->input("mnontocobertura"); // monto de la poliza
                        $idseguroempresa =$request->input("segurocobertura"); // seguro de la poiza
                        if  (!($comentario =$request->input("comentarioempresa")))
                            $comentario ='';
                        $insurancepolicies = DB::table('insurancepolicies')->insertGetId(
                            [
                                'created_at'=>date("Y-m-d H:i:s"),
                                'idusuario'=>$user,
                                'idadmin'=>1,
                                'idcoverages' =>$idmontoempresa,
                                'idinsurers' =>$idseguroempresa,
                                'comentario' =>$comentario,
                                'descripcionpoliza'=>'',
                                'tipopoliza' =>3,
                            ]);
                        if($insurancepolicies)
                        {
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
                                    if ($i==1)
                                    {
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
                                                    'idusuario'=>$user,
                                                    'tipo'=>1,
                                                    'id_insurancepolicies'=>$insurancepolicies
                                                ]);    
                                            //session()->flash('message', 'Documento cargado con éxito');              
                                        } 
    
                                    }
                                    else
                                    {
                                        $imagen[]=$imagen_url;
                                        $tipo ='documento';
                                        Docuemntos::insert(
                                            [
                                                'created_at'=>date("Y-m-d H:i:s"),
                                                'documentonombre'=>$image_full_name,
                                                'tipodocumento'=>$tipo,
                                                'documentonombre'=>'documentos/'.$image_full_name,
                                                'idusuario'=>$user,
                                                'tipo'=>1,
                                                'id_insurancepolicies'=>$insurancepolicies
                                            ]); 
                                    }
                                    
                                    $cn++;
                                }
                            }
                        }
                    }
                }
            }
                
       }
       return back();
    }
}
