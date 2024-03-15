<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Client;
use Carbon\Carbon;
use App\Nurse;
use App\Appointment;

class ProfileController extends Controller
{
    public function myinfo(Request $request){

        if($request->user()->usertype=='client'){

            $user = $request->user()->client;

            return response()->json([
                'success' => true,
                'usertype'=> 'client',
                'info' => [
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'image' => $user['image'],
                    'email' => $user['email'],
                    'sex' => $user['sex'],
                    'birthday' => $user['date_of_birth'],
                    'bloodgroupid' => $user['blood_group'],
                    'bloodgroup' => ($user['blood_group']) ? (DB::table('bloodgroups')->where('id', $user['blood_group'])->value('group')) : null,
                    'serviceareaid' => $user['service_area'],
                    'servicearea' => ($user['service_area']) ? (DB::table('serviceareas')->where('id', $user['service_area'])->value('area')) : null,
                    'address' => $user['address'],
                ],
            ]);
    
        } else if($request->user()->usertype=='nurse') {

            $user = $request->user()->nurse;

            $ratingsum = Appointment::where('nurse_id', $request->user()->nurse->id)->sum('rating');
            $count = Appointment::where('nurse_id', $request->user()->nurse->id)->count('rating');

            if($ratingsum > 0 && $count > 0){
                $avg = $ratingsum / $count;
            } else {
                $avg = null;
            }
   
            return response()->json([
                'success' => true,
                'usertype'=> 'nurse',
                'info' => [
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'image' => $user['image'],
                    'rating' => round($avg, 2),
                    'email' => $user['email'],
                    'sex' => $user['sex'],
                    'birthday' => $user['date_of_birth'],
                    'bloodgroupid' => $user['blood_group'],
                    'bloodgroup' => ($user['blood_group']) ? (DB::table('bloodgroups')->where('id', $user['blood_group'])->value('group')) : null,
                    'serviceareaid' => $user['service_area'],
                    'servicearea' => ($user['service_area']) ? (DB::table('serviceareas')->where('id', $user['service_area'])->value('area')) : null,
                     'address' => $user['address'],
                     'workaddress' => $user['current_work_address'],
                     'specialized' => $user['specializes'],
                ],
            ]);
    
        }
    }

    public function updateinfo(Request $request){

        $post_data = Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'nullable|email',
            'date_of_birth'=>'required|string',
            'sex'=>'required|string',
            'blood_group'=>'nullable|string',
            'service_area'=>'required|string',
            'address'=>'required|string',
        ]);

        if($post_data->fails()){

            $err = current(current(json_decode($post_data->messages(), true)));

            return response()->json([
                    'success' => false,
                    'error_msg' => $err,
                ]);
        
        }

        if($request->user()->usertype=='client'){

            $stat = DB::table('clients')->where('id', $request->user()->client->id)
                        ->update([
                                'name'=>$request->name,
                                'email'=>$request->email,
                                'date_of_birth'=>date('Y-m-d', strtotime($request->date_of_birth)),
                                'sex'=>$request->sex,
                                'blood_group'=>$request->blood_group,
                                'service_area'=>$request->service_area,
                                'address'=>$request->address,                      
                            ]);

        } else if($request->user()->usertype=='nurse'){

            $stat = DB::table('nurses')->where('id', $request->user()->nurse->id)
                        ->update([
                                'name'=>$request->name,
                                'email'=>$request->email,
                                'date_of_birth'=>date('Y-m-d', strtotime($request->date_of_birth)),
                                'sex'=>$request->sex,
                                'blood_group'=>$request->blood_group,
                                'service_area'=>$request->service_area,
                                'address'=>$request->address,
                                'current_work_address'=>$request->workaddress,
                                'specializes'=>$request->specialized,                      
                            ]);

        }

        if($stat){

            return response()->json([
                'success' => true,
                'success_msg' => 'Profile Information Updated',
            ]);
            
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'Same Information Given',
            ]);
            
        }

    }

    public function uploadprofilepic(Request $request){

        if($request->user()->usertype=='client'){
            $user = Client::where('id', $request->user()->client->id)->first();
        } else if($request->user()->usertype=='nurse') {
            $user = Nurse::where('id', $request->user()->nurse->id)->first();
        }

        $post_data = Validator::make($request->all(),[
           'image' => 'required|image|mimes:jpg,png,jpeg',

        ]);

        if($post_data->fails()){

            $err = current(current(json_decode($post_data->messages(), true)));

            return response()->json([
                    'success' => false,
                    'error_msg' => $err,
                ]);
        
        }

        $imgname = strtolower(strtotime(Carbon::now()->toDateTimeString()).'.'.$request->file('image')->extension());
        $store = $request->file('image')->storeAs('profile', $imgname, 'public');
        if($store){
            $user->image = '/storage/app/public/profile/'.$imgname;
            if($user->save()){
                return response()->json([
                    'success' => true,
                    'success_msg' => 'Profile Picture Successfully Updated',
                ]);
            } else{
                return response()->json([
                    'success' => false,
                    'success_msg' => 'Profile Picture Could not be Updated',
                ]);

            }
        }
       
    }
}
