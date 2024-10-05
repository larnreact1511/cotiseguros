<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsurersController extends Controller
{
    //
    public function index()
    {
        $data['insurers'] = DB::table('insurers')->get();
        return view("insurers.insurers",$data);
    }
}
