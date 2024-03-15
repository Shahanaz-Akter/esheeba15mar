<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Refer;
use App\Invoice;

use Carbon\Carbon;

use Illuminate\Support\Str;

class ReferController extends Controller
{
    public function checkcoupon($coupon, Request $request){

        $referral = Refer::where('refer_code', $coupon)->first();
        $invalid = Invoice::where('coupon', $coupon)
                        ->join('appointments', 'appointments.invoice_id', '=', 'invoices.invoice_id')
                        ->join('clients', 'clients.id', '=', 'appointments.client_id')
                        ->where('clients.id', $request->user()->client->id)
                        ->get(); 

        if(sizeof($invalid)){
            return response()->json([
                'success' => false,
                'error_msg' => 'You have already used this Coupon',
            ]);            
        }

        if($referral && !($referral->referer_uid==$request->user()->id)){

            if($referral->valid_till){

                if($referral->valid_till > Carbon::now()->toDateString()){
                    return response()->json([
                        'success' => true,
                        'success_msg' => 'Coupon is Valid',
                        'discount_percentage' => $referral->off_percentage,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'error_msg' => 'Coupon is Invalid',
                    ]);
                }  
    
            } else {
    
                return response()->json([
                    'success' => true,
                    'success_msg' => 'Coupon is Valid',
                    'discount_percentage' => $referral->off_percentage,
                ]);
    
            }

        } else {
            return response()->json([
                'success' => false,
                'error_msg' => 'Coupon is Invalid',
            ]);
        }  

    }

    public function generaterefer(Request $request){

        regenerate:
        $code = strtoupper(Str::random(8));
        $exist = Refer::where('refer_code', $code)->first();

        if($exist){
            goto regenerate;
        }

        $refer = Refer::create([
            'refer_code' => $code,
            'referer_uid' => $request->user()->id,
            'off_percentage'  => '20',
            'use_count' => '0',
        ]);

        return response()->json([
            'success' => true,
            'refer_code' => $code,
            'used' => 0,
        ]);
    }  
    
    public function myrefercode(Request $request){
        $refer  = Refer::where('referer_uid', $request->user()->id)->first();
        if($refer){
           return response()->json([
            'success' => true,
            'refer_code' => $refer->refer_code,
            'used' => $refer->use_count,
        ]); 
        } else {
            return $this->generaterefer($request);
        }
        
    }
}
