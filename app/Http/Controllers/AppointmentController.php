<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewAppointmentEvent;
use App\Appointment;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Nurse;
use App\Client;
use App\Refer;

class AppointmentController extends Controller
{
    public function makeappointment(Request $request){

        $res = Appointment::all();
        $count = $res->count();

        if($count){

            $resp = Appointment::orderBy('invoice_id', 'DESC')->limit(1)->value('invoice_id');
            $data = explode('_', $resp);
            $current = (int)end($data);
            $invoice_id = 'esheeba_'.str_pad(++$current, 4, '0', STR_PAD_LEFT);

        } else {

            $invoice_id = 'esheeba_'.str_pad(++$count, 4, '0', STR_PAD_LEFT);
                    
        }

        if($request->emergency){
            $datearray = explode(',',$request->datetime);
            $date_to_enter = trim(current($datearray));
        } else {
            $datearray = explode(',',$request->datetime);
            $date_to_enter = trim(current($datearray));
            for($i=0; $i<sizeof($datearray); $i++){
                DB::table('scheduledappointments')->insert([
                    'invoice_id' => $invoice_id,
                    'date' => trim($datearray[$i]),
                ]);
            }
           
        }

        Appointment::create([
            'invoice_id' => $invoice_id,
            'client_id' => $request->user()->client->id,
            'appointment_date' => $date_to_enter,
            'service_id' => $request->service_id,
            'unit_count' => $request->unit_count,
            'emergency' => $request->emergency,
            'client_phone' => $request->client_phone,
            'client_address' => $request->client_address,
            'appointment_status' => 'pending',

        ]);

        $coupon = ($request->coupon) ? $request->coupon : null;

        if($coupon){
            $obj = Refer::where('refer_code', $coupon)->first();
            $c = (int)$obj->use_count;
            $obj->use_count = ++$c;
            $obj->save();
        }

        Invoice::create([

            'invoice_id' => $invoice_id,
            'coupon' => $coupon,
            'net_total' => $request->net_total,
            'payment_method' => $request->payment_method,

        ]);

        if(event(new NewAppointmentEvent())){
            return response()->json([
            'success' => true,
            'success_msg' => 'Appointment Successfully Created',
            ]);
        }
    }

    public function pendinglist(Request $request){

        $param = ($request->user()->usertype=='client') ? 'client_id' : (($request->user()->usertype=='nurse') ? 'nurse_id' : null);
        $id = ($request->user()->usertype=='client') ? $request->user()->client->id : (($request->user()->usertype=='nurse') ? $request->user()->nurse->id : null);
        $err = ($request->user()->usertype=='client') ? "You Currently Don't Have Any On Going Appointments!" : (($request->user()->usertype=='nurse') ? "You Currently Don't Have Any Assigned Appointments!" : null);

        $appointment = Appointment::where($param, $id)
                                    ->where('appointment_status', '!=', 'cancelled')
                                    ->where('appointment_status', '!=', 'completed')
                                    ->join('invoices', 'invoices.invoice_id', '=', 'appointments.invoice_id')
                                    ->join('services', 'services.id', '=', 'appointments.service_id')
                                    ->join('servicecategories', 'servicecategories.id', '=', 'services.category_id')
                                    ->orderBy('appointments.appointment_date', 'ASC')
                                    ->select('appointments.invoice_id', 'appointments.emergency', 'appointments.appointment_status', 'appointments.appointment_date', 'servicecategories.icon', 'services.service_name', 'invoices.net_total')
                                    ->get();

        if(sizeof($appointment)){

            return response()->json([
                'success' => true,
                'pending_appointments' => $appointment,
            ]);


        } else {

            return response()->json([
                'success' => false,
                'error_msg' => $err,
            ]);

        }

    }

    public function completedlist(Request $request){

        $param = ($request->user()->usertype=='client') ? 'client_id' : (($request->user()->usertype=='nurse') ? 'nurse_id' : null);
        $id = ($request->user()->usertype=='client') ? $request->user()->client->id : (($request->user()->usertype=='nurse') ? $request->user()->nurse->id : null);

        $appointment = Appointment::where($param, $id)
                                    ->where('appointment_status', 'completed')
                                    ->join('invoices', 'invoices.invoice_id', '=', 'appointments.invoice_id')
                                    ->join('services', 'services.id', '=', 'appointments.service_id')
                                    ->join('servicecategories', 'servicecategories.id', '=', 'services.category_id')
                                    ->orderBy('appointments.appointment_date', 'DESC')
                                    ->select('appointments.invoice_id', 'appointments.emergency', 'appointments.appointment_status', 'appointments.appointment_date', 'servicecategories.icon', 'services.service_name', 'invoices.net_total')
                                    ->get();

        if(sizeof($appointment)){

            return response()->json([
                'success' => true,
                'completed_appointments' => $appointment,
            ]);


        } else {

            return response()->json([
                'success' => false,
                'error_msg' => "You Currently Don't Have Any Completed Appointments!",
            ]);

        }

    }

    public function cancelledlist(Request $request){

        $param = ($request->user()->usertype=='client') ? 'client_id' : (($request->user()->usertype=='nurse') ? 'nurse_id' : null);
        $id = ($request->user()->usertype=='client') ? $request->user()->client->id : (($request->user()->usertype=='nurse') ? $request->user()->nurse->id : null);

        $appointment = Appointment::where($param, $id)
                                    ->where('appointment_status', 'cancelled')
                                    ->join('invoices', 'invoices.invoice_id', '=', 'appointments.invoice_id')
                                    ->join('services', 'services.id', '=', 'appointments.service_id')
                                    ->join('servicecategories', 'servicecategories.id', '=', 'services.category_id')
                                    ->orderBy('appointments.appointment_date', 'DESC')
                                    ->select('appointments.invoice_id', 'appointments.emergency', 'appointments.appointment_status', 'appointments.appointment_date', 'servicecategories.icon', 'services.service_name', 'invoices.net_total')
                                    ->get();

        if(sizeof($appointment)){

            return response()->json([
                'success' => true,
                'cancelled_appointments' => $appointment,
            ]);


        } else {

            return response()->json([
                'success' => false,
                'error_msg' => "You Currently Don't Have Any Cancelled Appointments!",
            ]);

        }

    }

    public function appointmentdetails($invoice, Request $request){

        $param = ($request->user()->usertype=='client') ? 'appointments.client_id' : (($request->user()->usertype=='nurse') ? 'appointments.nurse_id' : null);
        $paramid = ($request->user()->usertype=='client') ? $request->user()->client->id : (($request->user()->usertype=='nurse') ? $request->user()->nurse->id : null);

        $appointment = Appointment::where($param, $paramid)
                                    ->where('appointments.invoice_id', $invoice)
                                    ->join('clients', 'clients.id', '=', 'appointments.client_id')
                                    ->join('services', 'services.id', '=', 'appointments.service_id')
                                    ->join('servicecategories', 'servicecategories.id', '=', 'services.category_id')
                                    ->join('invoices', 'invoices.invoice_id', '=', 'appointments.invoice_id')
                                    ->select( 'servicecategories.icon', 'services.service_name', 'appointments.invoice_id', 'appointments.appointment_date', 'invoices.coupon', 'invoices.net_total', 'clients.name', 'appointments.client_phone', 'appointments.client_address', 'invoices.payment_method', 'invoices.paid', 'appointments.appointment_status')
                                    ->first();

        if($appointment){
            return response()->json([
                'success' => true,
                'appointment_details' => $appointment,
            ]);            
        } else {
            return response()->json([
                'success' => false,
                'error_msg' => "No Appointment Details Found",
            ]);            
        }

    }

    public function scheduledetails($invoice){
        $details = DB::table('scheduledappointments')->where('invoice_id', $invoice)->orderBy('date', 'ASC')->get();
        return response()->json([
            'success'=> true,
            'schedules'=>$details,
        ]);
    }

    public function markascomplete($invoice){

        $appointment = Appointment::where('invoice_id', $invoice)->first();
        $appointment->appointment_status = 'completed';
        $inv = Invoice::where('invoice_id', $invoice)->first();
        $inv->paid = 1;
        

        if(!$appointment->emergency){

            $scheduleupdated = DB::table('scheduledappointments')->where('invoice_id', $invoice)->update(array('completed' => 1));

            if($appointment->save() && $inv->save() && $scheduleupdated){
                return response()->json([
                    'success' => true,
                    'success_msg' => 'Service has been marked as Completed.',
                ]);
            }

            return response()->json([
                'success' => false,
                'success_msg' => 'Service could not be marked as Completed.',
            ]);

        } else if($appointment->save() && $inv->save()){
            return response()->json([
                'success' => true,
                'success_msg' => 'Service has been marked as Completed.',
            ]);
        }

        return response()->json([
            'success' => false,
            'success_msg' => 'Service could not be marked as Completed.',
        ]);
        

    }

    public function singleschedulecomplete($id, Request $request){

        $single = DB::table('scheduledappointments')->where('id', $id)->update(['completed'=>1]);
        if($single){
            return response()->json([
                'success'=>true,
                'success_msg'=>'This Unit has been Completed.',
            ]);
        }

    }

    public function ratestatus($invoice){

        $stat = Appointment::where('invoice_id', $invoice)->value('rating');

        return response()->json([
            'success' => ($stat) ? true : false,
            'rating' => $stat,
        ]);

    }

    public function rate(Request $request){

        $app = Appointment::where('invoice_id', $request->invoice_id)->first();
        $app->rating = $request->rating;

        return response()->json([
            'success' => ($app->save()) ? true : false,
        ]);

    }

}
