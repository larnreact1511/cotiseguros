<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['idquote'] =$request->id;
        return view("notas.crearnota",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }
    public function createnote(Request $request)
    {
        $data =array(
            'created_at'=>date('y-m-d'),
            'idusuario'=>$request->idusuario,
            'fecha_notificiacion'=>$request->fecha_notificiacion,
            'notificacion'=>$request->notificacion,
            "id_quote"=>$request->idquote
        );
        
        if (DB::table('notifications')->insert($data)) 
        {
            $responce['result'] =true;
            $responce['mjs']='Nota agregada con éxito';
        }
        else
        {
            $responce['result'] =true;
            $responce['mjs']='No se pudo agregar la nota';
        }
        return response()->json($responce);
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
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifications $notifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifications $notifications)
    {
        //
    }
    public function vernotasanteriores(Request $request)
    {
        if (@$request->id)
        {
            $b =array('id_quote'=>$request->id);
            $data =DB::table('notifications')->where($b)->get();
            $i=0;
            $responce['result']=true;
            //echo "<pre>"; print_r($data); die;
            foreach( $data  as $d)
            {
                $u =array('id'=>$d->idusuario);
                $user =DB::table('users')->where($u)->get();
                $datos[$i]['idusuario'] =$d->idusuario;
                $datos[$i]['fecha_notificiacion'] =$d->fecha_notificiacion;
                $datos[$i]['notificacion'] =$d->notificacion;
                $datos[$i]['id_quote'] =$d->id_quote;
                $datos[$i]['name'] =$user[0]->name.' '.$user[0]->lastname;
                $i++;
            }
            $responce['data']=$datos;
        }
        else
        {
            $responce['result']=false;
            $responce['data']=[];
        }
        return response()->json($responce);
    }
}
