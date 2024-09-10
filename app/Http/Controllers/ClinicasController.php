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

class ClinicasController extends Controller
{
    //
    public function index()
    {


    }
    public function addclinic()
    {
        return view("clinicas.addclinic");
    }
    //
    public function clinicssave(Request $request)
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
                $seguro = $collection[$i]['seguro'] ;
                $estado = $collection[$i]['estado'] ;
                $municipio = $collection[$i]['municipio'] ;
                $ciudad = $collection[$i]['ciudad'] ;
                
                if (($nombre !='') && ($seguro !='') && ($estado !='')&& ($municipio !='') && ($ciudad !='')  )
                {
                    $dataestado = explode("-", $estado);
                    $datamunicipio = explode("-",$municipio);
                    $dataciudad = explode("-", $ciudad);
                    
                    $cant = count($dataestado);
                    $canmunicipio = count($datamunicipio);
                    $canciudad = count($dataciudad);
                    for ( $d =0; $d < $cant ; $d++)
                    {
                        $idestado=intval($dataestado[$d]);
                        
                        $existeestado = DB::table('estados')
                        ->where('id_estado',$idestado)
                        ->count();
                        if ( intval($existeestado) >0)
                        {
                            echo ' estado '.$idestado.' ';
                            if ( intval($canmunicipio ) >0)
                            {
                                for ( $m =0; $m < $canmunicipio ; $m++)
                                {
                                    $idmunicipio = intval($datamunicipio[$m]);
                                    $idmunicipio = trim($idmunicipio); 
                                    $idestado = trim($idestado);
                                    $existemunicipio = DB::table('municipios')
                                    ->where('id_municipio',$idmunicipio)
                                    ->where('id_estado',$idestado)
                                    ->count();
                                    //echo ' municipio '.$idmunicipio.' '.$existemunicipio.' ';
                                    if ( intval($existemunicipio) > 0)
                                    {
                                        
                                        if ( intval($canciudad ) >0)
                                        {
                                            for ( $c =0; $c < $canciudad ; $c++)
                                            {
                                                $idcuidad =intval($dataciudad[$c]);
                                                $existecuidad = DB::table('ciudades')
                                                ->where('id_ciudad',$idcuidad)
                                                ->where('id_estado',$idestado)
                                                ->count(); 
                                                if ( intval($existecuidad) > 0)
                                                {
                                                    $vec =array(    
                                                        'id_seguro' =>intval($seguro) ,
                                                        'id_poliza' => 0,
                                                        'id_estado' =>intval($idestado),
                                                        'id_municipio' => intval($idmunicipio),
                                                        'id_ciudad' =>intval($idcuidad),
                                                        'direccion' =>'',
                                                        'nombre' => $nombre
                                                    ); 
                                                    DB::table('clinicasservicios')->insert($vec);
                                                }
                                                
                                            }  
                                        }
                                        else
                                        {
                                            $vec =array(    
                                                'id_seguro' =>intval($seguro) ,
                                                'id_poliza' => 0,
                                                'id_estado' =>intval($idestado),
                                                'id_municipio' => intval($idmunicipio),
                                                'id_ciudad' =>0,
                                                'direccion' =>'',
                                                'nombre' => $nombre
                                            );
                                            DB::table('clinicasservicios')->insert($vec);
                                        }
                                    }
                                   

                                }
                            }
                            else
                            {
                                $vec =array(    
                                    'id_seguro' =>floatval($seguro) ,
                                    'id_poliza' => 0,
                                    'id_estado' =>floatval($d),
                                    'id_municipio' => 0,
                                    'id_ciudad' =>0,
                                    'direccion' =>'',
                                    'nombre' => $nombre
                                );
                                DB::table('clinicasservicios')->insert($vec);
                            }
                        }
                    }
                }
            }
                
            $data['message']='Productos cargados con exito';
        }
        session()->flash('message', 'Clinicas cargadas con exito');
        return back();
    }
    public function clinicas()
    {
        $data['estados'] = DB::table('estados')->get();
        $data['insurers'] = Insurer::select(["*"])->get();
        return view("clinicas.clinicas",$data);
    }
    public function modifyclinic($id)
    {
        if ( DB::table('clinicasservicios')->where('id',$id)->count())
        {
            $data['estados'] = DB::table('estados')->get();
           
            $data['insurers'] = Insurer::select(["*"])->get();
            $data['clinica'] = DB::table('clinicasservicios')->where('id',$id)->get();
            $data['municipios'] = DB::table('municipios')->where('id_estado',$data['clinica'][0]->id_estado )->get();
            $data['ciudades'] = DB::table('ciudades')->where('id_estado',$data['clinica'][0]->id_estado )->get();
            //dd($data);
            return view("clinicas.editarclinica",$data);
        }
        else
            return back();
        
    }
    public function changeselectestado($id)
    {
       $listmunicipios = DB::table('municipios')->where('id_estado',$id)->get();
       $listciudades = DB::table('ciudades')->where('id_estado',$id)->get();
       $datam =[];
       $datec =[];
       foreach(  $listmunicipios as  $muni => $m)
       {
            $data1['id']  = $m->id_municipio;    
            $data1['text']  = $m->municipio;

            $datam[]=$data1;
       }
       foreach(  $listciudades as  $ciu => $c)
       {
            $data2['id']  = $c->id_ciudad;    
            $data2['text']  = $c->ciudad;

            $datec[]=$data2;
       }
       $res['municipios'] = $datam;
       $res['ciudades'] = $datec;
       return response()->json($res);
    } 
    function agregarclinica(Request $request)
    {
        //  
        if ( isset($request->id_clinica)){
            session()->flash('message', 'Clinica Actulizada con exito');

            $edita =array(
                    'id_seguro'=>@$request->id_seguro,
                    'id_poliza'=>0,
                    'id_estado'=>@$request->id_estado,
                    'id_municipio'=>@$request->id_municipio,
                    'id_ciudad'=>@$request->id_ciudad,
                    'direccion'=>@$request->direccion,
                    'nombre'=>@$request->nombre,
               );
            DB::table('clinicasservicios')->where('id',@$request->id_clinica)->update($edita);
        }
        else
        {
            $agregarcliente = DB::table('clinicasservicios')->insertGetId(
                [
                    
                    'id_seguro'=>@$request->id_seguro,
                    'id_poliza'=>0,
                    'id_estado'=>@$request->id_estado,
                    'id_municipio'=>@$request->id_municipio,
                    'id_ciudad'=>@$request->id_ciudad,
                    'direccion'=>@$request->direccion,
                    'nombre'=>@$request->nombre,
                    
                ]);
                session()->flash('message', 'Clinica Agregada con exito');
        }
        
        return redirect('listado-de-clinicas');
    }  

    public function jsonclinics(Request $request)
    {
        
        $data = [];
        $search = $request->input('search'); 
        $buscarid_estado = $request->input('buscarid_estado'); 
        $busarid_municipio = $request->input('busarid_municipio'); 
        $buscarid_ciudad = $request->input('buscarid_ciudad'); 
        $buscarid_seguro = $request->input('buscarid_seguro'); 
        
        // Inicializar la consulta
        $clinicasservicios = DB::table('clinicasservicios')
            ->leftJoin('estados', 'clinicasservicios.id_estado', '=', 'estados.id_estado')
            ->leftJoin('ciudades', 'clinicasservicios.id_ciudad', '=', 'ciudades.id_ciudad')
            ->leftJoin('municipios', 'clinicasservicios.id_municipio', '=', 'municipios.id_municipio')
            ->leftJoin('insurers', 'clinicasservicios.id_seguro', '=', 'insurers.id')
            ->select(
                'clinicasservicios.id as id_clinica',
                'clinicasservicios.nombre',
                'clinicasservicios.direccion',
                'ciudades.ciudad',
                'estados.estado',
                'municipios.municipio',
                'ciudades.id_ciudad',
                'estados.id_estado',
                'municipios.id_municipio',
                'insurers.name as nombreseguro'
            );
        
        // Filtrado por búsqueda
        if (!empty($search['value'])) {
            $value = $search['value'];
            $clinicasservicios->where(function ($query) use ($value) {
                $query->where('clinicasservicios.nombre', 'LIKE', "%$value%")
                      ->orWhere('ciudades.ciudad', 'LIKE', "%$value%")
                      ->orWhere('municipios.municipio', 'LIKE', "%$value%")
                      ->orWhere('insurers.name', 'LIKE', "%$value%");
            });
        }
        
        // Filtrado por IDs
        if ($buscarid_seguro > 0) {
            $clinicasservicios->where('clinicasservicios.id_seguro', $buscarid_seguro);
        }
        
        if ($buscarid_estado > 0) {
            $clinicasservicios->where('clinicasservicios.id_estado', $buscarid_estado);
        }
        
        if ($busarid_municipio > 0) {
            $clinicasservicios->where('clinicasservicios.id_municipio', $busarid_municipio);
        }
        
        if ($buscarid_ciudad > 0) {
            $clinicasservicios->where('clinicasservicios.id_ciudad', $buscarid_ciudad);
        }
        
        // Paginación y ordenamiento
        $clinicasservicios = $clinicasservicios
            ->skip($request->input('start'))
            ->take($request->input('length'))
            ->orderBy('clinicasservicios.id', 'DESC')
            ->get();
        
        // Preparar los datos para la respuesta
        if ($clinicasservicios->count() > 0) {
            foreach ($clinicasservicios as $cli) {
                $datos = [
                    'id' => $cli->id_clinica,
                    'nombre' => $cli->nombre,
                    'direccion' => $cli->direccion,
                    'ciudad' => $cli->ciudad,
                    'estado' => $cli->estado,
                    'municipio' => $cli->municipio,
                    'id_ciudad' => $cli->id_ciudad,
                    'id_estado' => $cli->id_estado,
                    'id_municipio' => $cli->id_municipio,
                    'nombre_seguro' => $cli->nombreseguro,
                ];
                $data[] = $datos;
            }
        }
        
        // Preparar la respuesta final
        $dataresponce = [
            'draw' => $request->input('draw'),
            'recordsTotal' => DB::table('clinicasservicios')->count(),
            'recordsFiltered' => $clinicasservicios->count(),
            'data' => $data,
        ];
        
        return response()->json($dataresponce);
    }
    public function eliminarclinica($id)
    {
        $eliminarparentesco =array('id'=>$id);
        DB::table('clinicasservicios')->where('id',$id)->delete();
        $res['result']=true;
        return response()->json($res);
    }

    public function datoseditarclinica($id)
    {
        $listmunicipios = DB::table('municipios')->where('id_estado',$id)->get();
        $listciudades = DB::table('ciudades')->where('id_estado',$id)->get();
        $datam =[];
        $datec =[];
        foreach(  $listmunicipios as  $muni => $m)
        {
             $data1['id']  = $m->id_municipio;    
             $data1['text']  = $m->municipio;
 
             $datam[]=$data1;
        }
        foreach(  $listciudades as  $ciu => $c)
        {
             $data2['id']  = $c->id_ciudad;    
             $data2['text']  = $c->ciudad;
 
             $datec[]=$data2;
        }
        $res['municipios'] = $datam;
        $res['ciudades'] = $datec;
        return response()->json($res);
    }
    public function listofclinics()
    {
        $data['estados'] = DB::table('estados')->get();
        $data['insurers'] = Insurer::select(["*"])->get();
        return view("clinicas.listadoclinicas",$data);
    }
}
