<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MiscController extends Controller
{
    public function servicearealist(){
        
        $area = DB::table('serviceareas')->get();

        return response()->json([
            'service_areas' => $area,
        ]);

    }

    public function ads(){
        $ad = DB::table('ads')->get();
        return response()->json([
            'success' => true,
            'ads' => $ad,
        ]);
    }

    public function bloodgroups(){
        
        $bloodgroups = DB::table('bloodgroups')->get();

        return response()->json([
            'bloodgroups' => $bloodgroups,
        ]);

    }
}
