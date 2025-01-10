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

class CompanyController extends Controller
{
    //
    public function addcompany()
    {
        $data['companys'] =DB::table('company')->get();
        return view("admin.addcompany",$data);
    }

    public function infocompany($id){

        $company = DB::table('company')->where('id',$id) ->get();   
        return response()->json(['result'=>'success','data'=>$company]);
    }
    function saveaddcompany(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'companyname' => 'required',
            'rifcompany' => 'required',
            
          ],
          [
            'companyname.required' => 'El campo nombre es requerido',
            'rifcompany.required' => 'El campo rif es requerido',
          ]
        );
          
          if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
            }else{
              return redirect('agregar-empresa')
                    ->withErrors($validator)
                    ->withInput();
            }			
          }
          $data= array(
            'companyname'=>@$request->companyname,
            'rifcompany'=>@$request->rifcompany,
            'adresscompany'=>@$request->adresscompany,
            'notecompany'=>@$request->notecompany,
            'created_at'=>date("Y-m-d H:i:s"),
            
        );
          if ($request->idempresa >0 )
          {
            
            DB::table('company')
            ->where('id',$request->idempresa)
            ->update($data);
            return response()->json(['result'=>'success','message'=>'Empresa actulizada con exito']);
          }
          else
          {
            DB::table('company')->insertGetId($data);
            return response()->json(['result'=>'success','message'=>'Empresa agrega con exito']);
          }
          
          
    }
    public function listcompany()
    {
        return view("admin.listcompany");
    }
    public function getcompanys(Request $request)
    {
        
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
                $orderBy ='companyname';
                break;
            case 2:
                $orderBy ='rifcompany';
                break;
            case 3:
                $orderBy ='adresscompany';
                break;
            case 4:
                $orderBy ='notecompany';
                break;
        }
        if ($search['value']=='')
        {
            $company =DB::table('company')
            ->skip($start)
            ->take($limit)
            ->orderBy($orderBy, 'desc');
            
            $listcompanys =$company->get();
            $recordsTotal =$company->count();

        }
        else
        {
            $value =$search['value']; 
            $company =DB::table('company')
            ->orWhere('company.companyname', 'LIKE', "%$value%")
            ->orWhere('company.rifcompany', 'LIKE', "%$value%")
            ->orWhere('company.adresscompany', 'LIKE', "%$value%")
            ->orWhere('company.notecompany', 'LIKE', "%$value%")
            ->skip($start)
            ->take($limit)
            ->orderBy($orderBy, 'desc');

            $listcompanys =$company->get();
            $recordsTotal =$company->count();

            $count =  DB::table('users')->where('role_id',5)->count();
        }
        $i = 0;
        foreach ($listcompanys as $cliente => $c) {
               
            $nestedData['id']               = $c->id;
            $nestedData['companyname']      = $c->companyname;
            $nestedData['rifcompany']       = $c->rifcompany;
            $nestedData['adresscompany']    = $c->adresscompany;
            $nestedData['notecompany']      = $c->notecompany;
           
            $datos[] = $nestedData;
        }
        $dataresponce['draw'] = $request->input('draw');
        $dataresponce['recordsTotal'] =$recordsTotal;
        $dataresponce['recordsFiltered'] = $recordsTotal;
        $dataresponce['data'] = $datos;
        return response()->json($dataresponce);
    }
}
