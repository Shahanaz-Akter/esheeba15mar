<?php

namespace App\Http\Controllers;

// use Hash;
use Session;
use App\User;
use App\Nurse;
use App\Refer;
use App\Client;
use App\Invoice;
use App\Service;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginpage()
    {
        if (Auth::user()) {
            return redirect('/dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $admin = (($user->usertype == 'superadmin') || ($user->usertype == 'admin')) ? true : false;
            if ($admin) {
                $credentials = $request->only('phone', 'password');
                if (Auth::attempt($credentials, $request->filled('remember'))) {
                    return redirect()->intended('/dashboard');
                }
            }
        }
        return redirect()->back()->with('fail', 'Opps! You Have Entered Invalid Credentials');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function appointments(Request $r)
    {

        $unassigned = Appointment::where('nurse_id', null)->where('appointment_status', '!=', 'cancelled')->OrderBy('created_at', 'DESC')->get();

        if ((empty($r->all()) && sizeof($unassigned)) || $r->show == 'unassigned') {
            return view('admin.appointments')->with('appointments', $unassigned)->with('current', 'unassigned');
        } else if ((empty($r->all()) && !sizeof($unassigned)) || $r->show == 'ongoing') {
            $pending = Appointment::where('appointment_status', '!=', 'completed')->where('appointment_status', '!=', 'cancelled')->where('nurse_id', '!=', null)->OrderBy('created_at', 'DESC')->get();
            return view('admin.appointments')->with('appointments', $pending)->with('current', 'ongoing');
        } else if ($r->show == 'completed') {
            $completed = Appointment::where('appointment_status', 'completed')->OrderBy('created_at', 'DESC')->get();
            return view('admin.appointments')->with('appointments', $completed)->with('current', 'completed');
        } else if ($r->show == 'cancelled') {
            $cancelled = Appointment::where('appointment_status', 'cancelled')->OrderBy('created_at', 'DESC')->get();
            return view('admin.appointments')->with('appointments', $cancelled)->with('current', 'cancelled');
        }
    }

    public function appointmentdetails($id)
    {

        $details = Appointment::where('appointments.id', $id)
            ->join('invoices', 'invoices.invoice_id', '=', 'appointments.invoice_id')
            ->first();

        return view('admin.appointmentdetails')->with('appointment', $details);
    }

    public function unassigned()
    {
        return Appointment::where('nurse_id', null)->where('appointment_status', '!=', 'cancelled')->count();
    }

    public function assign_nurse($invoice, $nurse)
    {

        $app_obj = Appointment::where('invoice_id', $invoice)->first();
        $app_obj->nurse_id = $nurse;

        if ($app_obj->save()) {
            return redirect()->back()->with('success', 'Nurse is Assigned');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function togglepayment($invoice, $paid)
    {

        $app_obj = Invoice::where('invoice_id', $invoice)->first();
        $app_obj->paid = $paid;

        if ($app_obj->save()) {
            return redirect()->back()->with('success', 'Payment Status Updated');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function updatestatus($invoice, $status)
    {

        $app_obj = Appointment::where('invoice_id', $invoice)->first();
        $app_obj->appointment_status = $status;

        if ($app_obj->save()) {
            return redirect()->back()->with('success', 'Appointment Status Updated');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function invoices(Request $r)
    {

        if ((empty($r->all())) || $r->show == 'all') {
            $all = Invoice::all();
            return view('admin.invoices')->with('invoices', $all)->with('current', 'all');
        } else if ($r->show == 'paid') {
            $paid = Invoice::where('paid', 1)->OrderBy('created_at', 'DESC')->get();
            return view('admin.invoices')->with('invoices', $paid)->with('current', 'paid');
        } else if ($r->show == 'unpaid') {
            $unpaid = Invoice::where('paid', 0)->OrderBy('created_at', 'DESC')->get();
            return view('admin.invoices')->with('invoices', $unpaid)->with('current', 'unpaid');
        }
    }

    public function nurses(Request $r)
    {

        if ((empty($r->all())) || $r->show == 'all') {
            $all = Nurse::all();
            return view('admin.nurses')->with('nurses', $all)->with('current', 'all');
        } else if ($r->show == 'inactive') {
            $inactive = Nurse::where('active', 0)->get();
            return view('admin.nurses')->with('nurses', $inactive)->with('current', 'inactive');
        } else if ($r->show == 'active') {
            $active = Nurse::where('active', 1)->get();
            return view('admin.nurses')->with('nurses', $active)->with('current', 'active');
        }
    }

    public function nursedetails($id)
    {
        $nurse = Nurse::where('id', $id)->first();
        return view('admin.nursedetails')->with('nurse', $nurse);
    }

    public function updatepic($usertype, $id, Request $request)
    {

        if ($usertype == 'client') {
            $user = Client::where('id', $id)->first();
        } else if ($usertype == 'nurse') {
            $user = Nurse::where('id', $id)->first();
        }
        $imgname = strtolower(strtotime(Carbon::now()->toDateTimeString()) . '.' . $request->file('image')->extension());
        $store = $request->file('image')->storeAs('profile', $imgname, 'public');
        if ($store) {
            $user->image = '/storage/app/public/profile/' . $imgname;
            if ($user->save()) {
                return redirect()->back()->with('success', 'Profile Picture Updated');
            }
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function updatenurse($id, Request $r)
    {

        $nurse_obj = Nurse::where('id', $id)->first();

        $nurse_obj->email = $r->email;
        $nurse_obj->active = $r->status;
        $nurse_obj->service_area = $r->service_area;
        $nurse_obj->blood_group = $r->blood_group;
        $nurse_obj->sex = $r->sex;
        $nurse_obj->date_of_birth = $r->birthday;
        $nurse_obj->address = $r->address;
        $nurse_obj->current_work_address = $r->workaddress;
        $nurse_obj->specializes = $r->specialist;

        if ($nurse_obj->save()) {
            return redirect()->back()->with('success', 'Profile Information Updated Successfully');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }


    public function deletenurse($id, Request $r)
    {

        Nurse::where('id', $id)->delete();
        return redirect()->back();
    }

    public function clients()
    {
        // Retrieve all clients in descending order based on created_at
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('admin.clients')->with('clients', $clients);
    }

    public function clientdetails($id)
    {
        $client = Client::where('id', $id)->first();
        return view('admin.clientdetails')->with('client', $client);
    }

    public function custom_adding_clients(Request $request)
    {
        $post_data = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|unique:users|max:11',
            'email' => 'nullable|email',
            'blood_group' => 'nullable|string|max:3',
            'service_area' => 'required|string',
            'address' => 'nullable|string',
            'usertype' => 'required|string',
            'password' => 'required|confirmed|min:8'
        ]);

        if ($post_data->fails()) {

            $err = current(current(json_decode($post_data->messages(), true)));

            return response()->json([
                'success' => false,
                'error_msg' => $err,
            ]);
        }

        $user = User::create([
            'phone' => $request->phone,
            'usertype' => $request->usertype,
            'otp' => '1234',
            'password' => Hash::make($request->password),
        ]);

        Client::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'image' => '/public/app/images/profile/default.png',
            'blood_group' => $request->blood_group,
            'service_area' => $request->service_area,
            'address' => $request->address,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth
        ]);

        return redirect()->back();
    }


    public function updateclient($id, Request $r)
    {

        $client_obj = Client::where('id', $id)->first();

        $client_obj->email = $r->email;
        $client_obj->service_area = $r->service_area;
        $client_obj->blood_group = $r->blood_group;
        $client_obj->sex = $r->sex;
        $client_obj->date_of_birth = $r->birthday;
        $client_obj->address = $r->address;

        if ($client_obj->save()) {
            return redirect()->back()->with('success', 'Profile Information Updated Successfully');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function deleteclient($id, Request $r)
    {
        Client::where('id', $id)->delete();
        return redirect()->back();
    }

    public function admins()
    {
        $admins = User::where('usertype', 'superadmin')->orWhere('usertype', 'admin')->get();
        return view('admin.admins')->with('admins', $admins);
    }

    public function admin_add(Request $request)
    {
        $stat = User::create([
            'phone' => $request->phone,
            'usertype' => $request->type,
            'otp' => 1234,
            'verified' => 1,
            'password' => Hash::make('00000000'),
        ]);

        if ($stat) {
            return redirect()->back()->with('success', 'Admin Successfully Added. Default Password is 00000000');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function toggleadmin($id)
    {
        $user = User::where('id', $id)->first();
        $newtype = ($user->usertype == 'superadmin') ? 'admin' : (($user->usertype == 'admin') ? 'superadmin' : null);
        $user->usertype = $newtype;
        if ($user->save()) {
            return redirect()->back()->with('success', 'Admin Type Changed.');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function resetadminpassword($id)
    {
        $user = User::where('id', $id)->first();
        $user->password = Hash::make('00000000');
        if ($user->save()) {
            return redirect()->back()->with('success', 'Password Reset Successful.');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function deleteadmin($id)
    {
        if (User::where('id', $id)->delete()) {
            return redirect()->back()->with('success', 'Admin Account Successfully Deleted.');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function referrals()
    {
        $refers = DB::table('refers')->get();
        return view('admin.referral')->with('referrals', $refers);
    }

    public function add_referral(Request $request)
    {
        $valid_till = ($request->valid_till) ? ($request->valid_till) : null;
        regenerate:
        $code = strtoupper(Str::random(6));
        $exist = Refer::where('refer_code', $code)->first();
        if ($exist) {
            goto regenerate;
        }
        $insert = Refer::create([
            'refer_code' => $code,
            'referer_uid' => Auth::user()->id,
            'off_percentage'  => $request->discount,
            'use_count' => '0',
        ]);
        if ($insert) {
            return redirect()->back()->with('success', 'Referral Added Successfully!');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function update_discount($id, Request $r)
    {
        $refer = Refer::where('id', $id)->first();
        $refer->off_percentage = $r->discount;
        if ($refer->save()) {
            return redirect()->back()->with('success', 'Discount Percentage Successfully Updated!');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function set_validity($id, Request $request)
    {
        $date = ($request->valid_till) ? $request->valid_till : null;
        $refer = Refer::where('id', $id)->first();
        $refer->valid_till = $date;
        if ($refer->save()) {
            return redirect()->back()->with('success', 'Validity Date Successfully Updated!');
        }
        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function ads()
    {
        $ads = DB::table('ads')->get();
        return view('admin.ads')->with('ads', $ads);
    }

    public function new_ads(Request $request)
    {

        $imgname = strtolower(preg_replace("/\s+/", "", $request->title) . '.' . $request->file('banner')->extension());

        $store = $request->file('banner')->storeAs('ads', $imgname, 'public');

        if ($store) {
            $insert = DB::table('ads')->insert([
                'title' => $request->title,
                'ads_banner' => '/storage/app/public/ads/' . $imgname,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            if ($insert) {
                return redirect()->back()->with('success', 'Ads Banner Added Successfully!');
            }

            return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
        }

        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function servicecategories()
    {
        $categories = DB::table('servicecategories')->get();
        return view('admin.servicecategories')->with('servicecategories', $categories);
    }

    public function add_servicecategories(Request $request)
    {

        $imgname = strtolower(preg_replace("/\s+/", "", $request->category) . '.' . $request->file('icon')->extension());

        $store = $request->file('icon')->storeAs('services', $imgname, 'public');

        if ($store) {
            $insert = DB::table('servicecategories')->insert([
                'category' => $request->category,
                'icon' => '/storage/app/public/services/' . $imgname,
            ]);

            if ($insert) {
                return redirect()->back()->with('success', 'Category Added Successfully!');
            }

            return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
        }

        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function servicelist()
    {

        $services = Service::all();
        $categories = DB::table('servicecategories')->get();

        return view('admin.servicelists')->with('servicelists', $services)->with('categories', $categories);
    }

    public function add_service(Request $request)
    {

        $insert = Service::create([
            'category_id' => $request->category,
            'service_name' => $request->service,
            'pricing_scheme' => ucfirst($request->pricing_scheme),
            'unit_price' => $request->unit_price,
        ]);

        if ($insert) {
            return redirect()->back()->with('success', 'Service Added Successfully!');
        }

        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }

    public function serviceareas()
    {
        $areas = DB::table('serviceareas')->get();

        return view('admin.serviceareas')->with('serviceareas', $areas);
    }

    public function add_servicearea(Request $request)
    {

        $insert = DB::table('serviceareas')->insert([
            'area' => ucfirst($request->area),
            'active' => $request->status,
        ]);

        if ($insert) {
            return redirect()->back()->with('success', 'Service Area Added Successfully!');
        }

        return redirect()->back()->with('fail', 'Something Went Wrong. Please Try Again Later!');
    }



    public function logout()
    {

        Session::flush();
        Auth::logout();

        return redirect('/login');
    }
}
