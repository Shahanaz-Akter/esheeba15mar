<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Service;


class ServiceController extends Controller
{
    public function servicecategories(){
        return response()->json([
            'success' => true,
            'services_categories' => DB::table('servicecategories')->get(),
        ]);
    }

    public function services($categoryid){
        
        $services = DB::table('services')->where('category_id', $categoryid)->get();

        if($services){

              return response()->json([
                'success' => true,
                'services' => $services,
            ]);

        } else {

            return response()->json([
                'success' => false,
                'error_msg' => "No Services Available",
            ]);
        }

    

    }


} 
