<?php

namespace App\Http\Controllers;

use App\Models\Insurancepolicies;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class InsurancepoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Insurancepolicies  $insurancepolicies
     * @return \Illuminate\Http\Response
     */
    public function show(Insurancepolicies $insurancepolicies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insurancepolicies  $insurancepolicies
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurancepolicies $insurancepolicies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Insurancepolicies  $insurancepolicies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurancepolicies $insurancepolicies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insurancepolicies  $insurancepolicies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurancepolicies $insurancepolicies)
    {
        //
    }
    public function aprobarpoliza(Request $request)
    {
        if ((@$request->adminstrador) && (@$request->id_quote) && (@$request->quote)  && (@$request->idusuario))
        {
            $busquote =array('quoteid'=>$request->quoteid,'id_quote'=>$request->id_quote);
            if ( (DB::table('insurancepolicies')->where($busquote)->count()) > 0)
            {
                $res['resul']=false;
                $res['mjs']='El CLiente ya tiene dicha poliza agregada'; 
            }
            else
            {
                $vect=array('created_at'=>date('Y-m-d'),
                'idusuario'=>$request->idusuario,
                'id_quote'=>$request->id_quote,
                'idadmin'=>$request->adminstrador,
                'policies'=>json_encode($request->quote),
                'quoteid'=>$request->quoteid);
                
                if (Insurancepolicies::insert($vect) )
                {
                    $res['resul']=true;
                    $res['mjs']='Se aplico con exito';
                }
                    
                else
                {
                    $res['resul']=false;
                    $res['mjs']='No se pudo aplicar la aprobación';    
                }
            }
            
                
        }
        else
        {
            $res['resul']=false;    
            $res['mjs']='No se pudo aplicar la aprobación';    
        }
        return response()->json($res);
    }
}
