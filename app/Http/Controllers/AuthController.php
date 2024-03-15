<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Client;

use App\Nurse;

use Carbon\Carbon;
use Dotenv\Result\Success;

class AuthController extends Controller

{

    public function register(Request $request)
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

        $otp = rand(1000, 9999);
        // $otp = 1234;
        $phone = $request->phone;
        $text = "Your Esheeba App OTP is $otp";

        $user = User::create([
            'phone' => $phone,
            'usertype' => $request->usertype,
            'otp' => $otp,
            'password' => Hash::make($request->password),
        ]);

        if ($request->usertype == 'client') {

            Client::create([
                'phone' => $phone,
                'name' => $request->name,
                'email' => $request->email,
                'image' => '/public/app/images/profile/default.png',
                'blood_group' => $request->blood_group,
                'service_area' => $request->service_area,
                'address' => $request->address,
            ]);
        } else if ($request->usertype == 'nurse') {

            Nurse::create([
                'phone' => $phone,
                'name' => $request->name,
                'email' => $request->email,
                'image' => '/public/app/images/profile/default.png',
                'blood_group' => $request->blood_group,
                'service_area' => $request->service_area,
                'address' => $request->address,
            ]);
        }

        $otpstatus = $this->sendotp($phone, $text);

        // $otpstatus="Success";

        if ($otpstatus == "Success") {

            return response()->json([
                'success' => true,
                'success_msg' => 'OTP is sent',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'OTP is not sent',
            ]);
        }
    }

    public function login(Request $request)
    {

        if (!\Auth::attempt($request->only('phone', 'password'))) {
            return response()->json([
                'success' => false,
                'error_msg' => 'Login Information is Invalid.'
            ]);
        }

        $user = User::where('phone', $request['phone'])->first();

        if ($user->verified) {

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'success_msg' => "Login information matched",
                'access_token' => $token,
                'token_type' => 'Bearer',
                'usertype' => $user->usertype,
            ]);
        } else {

            return response()->json([
                'success' => false,
                'verified' => false,
                'usertype' => $user->usertype,
                'error_msg' => 'Phone Number is not Verified',
            ]);
        }
    }


    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'success_msg' => 'Successfully Logged Out from this Device',
        ]);
    }


    public function sendotp($phone, $text)
    {

        $otpcurl = curl_init();
        curl_setopt_array($otpcurl, array(
            CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS => array('api_key' => env('SMS_API_KEY'), 'msg' => $text, 'to' => $phone),
            CURLOPT_POSTFIELDS => array('api_key' => '0k4pEM8Atavv3W1c5af3vEYUB99j9kCZ5rYb84ZE', 'msg' => $text, 'to' => $phone),

        ));
        $otpresponse = json_decode(curl_exec($otpcurl), true);
        $request_id = $otpresponse['data']['request_id'];
        curl_close($otpcurl);


        $reportcurl = curl_init();
        curl_setopt_array($reportcurl, array(
            CURLOPT_URL => "https://api.sms.net.bd/report/request/$request_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => '0k4pEM8Atavv3W1c5af3vEYUB99j9kCZ5rYb84ZE'),
        ));
        $reportresponse = json_decode(curl_exec($reportcurl), true);
        $status = $reportresponse['msg'];
        curl_close($reportcurl);

        return $status;
    }

    public function verifyotp(Request $request)
    {

        $user = User::where('phone', $request->phone)->first();

        if ($user->otp == $request->otp) {

            $user->verified = 1;
            $user->save();

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'success_msg' => 'OTP is verified',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'usertype' => $user->usertype,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error_msg' => 'Incorrect OTP',
            ]);
        }
    }

    public function forgotpassword(Request $request)
    {

        $phone = $request->phone;
        $user = User::where('phone', $request->phone)->first();

        if ($user) {

            $otp = rand(1000, 9999);
            // $otp = 1234;
            $text = "Your Esheeba App Password Recovery OTP is $otp";
            $token = hash_hmac('sha256', $otp, $phone);

            DB::table('password_resets')->where('phone', $phone)->delete();

            $reset_request = DB::table('password_resets')->insert([
                'phone' => $phone,
                'otp' => $otp,
                'token' => $token,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            if ($reset_request) {

                $otpstatus = $this->sendotp($phone, $text);
                // $otpstatus="Success";

            } else {

                return response()->json([
                    'success' => false,
                    'error_msg' => 'Password Recovery Request Failed',
                ]);
            }

            if ($otpstatus == "Success") {

                return response()->json([
                    'success' => true,
                    'success_msg' => 'OTP is sent',
                    'token' => $token,
                ]);
            } else {

                return response()->json([
                    'success' => false,
                    'error_msg' => 'OTP is not sent',
                ]);
            }
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'No Associated User Found for this Phone Number',
            ]);
        }
    }

    public function forgotpassword_verifyotp($token, Request $request)
    {

        $phone = $request->phone;

        $usr_pw_reset = DB::table('password_resets')->where('phone', $phone)->first();

        if ($usr_pw_reset) {

            $matched = hash_equals($token, $usr_pw_reset->token) && hash_equals(hash_hmac('sha256', $request->otp, $request->phone), $usr_pw_reset->token) && empty($usr_pw_reset->used_at);

            if ($matched) {

                $user = User::where('phone', $request->phone)->first();
                $user->verified = 1;
                $user->save();

                $new_token = hash_hmac('sha256', $usr_pw_reset->token, 'proceed_to_password_reset');

                return response()->json([
                    'success' => true,
                    'success_msg' => 'OTP is Verified',
                    'new_token' => $new_token,
                ]);
            } else {

                return response()->json([
                    'success' => false,
                    'error_msg' => 'Incorrect OTP'
                ]);
            }
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'Unknown Phone'
            ]);
        }
    }


    public function forgotpassword_resetpassword($token, Request $request)
    {

        $phone = $request->phone;
        $user = User::where('phone', $request->phone)->first();
        $usr_pw_reset = DB::table('password_resets')->where('phone', $phone)->first();

        $matched = hash_equals($token, hash_hmac('sha256', $usr_pw_reset->token, 'proceed_to_password_reset')) && empty($usr_pw_reset->used_at);

        if ($matched) {
            $post_data = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8'
            ]);

            if ($post_data->fails()) {

                $err = current(current(json_decode($post_data->messages(), true)));

                return response()->json([
                    'success' => false,
                    'error_msg' => $err,
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('phone', $phone)->update(['used_at' => Carbon::now()->toDateTimeString()]);

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'success_msg' => 'Password Successfully Recovered',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'usertype' => $user->usertype,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error_msg' => 'Hash Did not Match',
            ]);
        }
    }

    public function resendotp($for, Request $request)
    {

        $phone = $request->phone;

        if ($for == 'forgotpassword') {

            return $this->forgotpassword($request);
        } else if ($for == 'postregistration') {

            $user = User::where('phone', $request->phone)->first();

            $otp = rand(1000, 9999);
            // $otp = 1234;
            $phone = $request->phone;
            $text = "Your Esheeba App OTP is $otp";

            $user->otp = $otp;
            $user->save();

            $otpstatus = $this->sendotp($phone, $text);



            // $otpstatus="Success";

            if ($otpstatus == "Success") {

                return response()->json([
                    'success' => true,
                    'success_msg' => 'OTP is sent'
                ]);
            } else {

                return response()->json([
                    'success' => false,
                    'error_msg' => 'OTP is not sent'
                ]);
            }
        }
    }

    public function sendotp_changepw(Request $request)
    {

        $phone = $request->user()->phone;
        $otp = rand(1000, 9999);
        // $otp = 1234;
        $text = "Your Esheeba App Password Reset OTP is $otp";

        DB::table('password_resets')->where('phone', $phone)->delete();


        $reset_request = DB::table('password_resets')->insert([

            'phone' => $phone,
            'otp' => $otp,
            'created_at' => Carbon::now()->toDateTimeString(),

        ]);

        if ($reset_request) {

            $otpstatus = $this->sendotp($phone, $text);
            // $otpstatus="Success";

        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'Password Recovery Request Failed',
            ]);
        }

        if ($otpstatus == "Success") {

            return response()->json([
                'success' => true,
                'success_msg' => 'OTP is sent',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'OTP is not sent',
            ]);
        }
    }

    public function resendotp_changepw(Request $request)
    {

        return $this->sendotp_changepw($request);
    }

    public function verifyotp_changepw(Request $request)
    {

        $status = $request->otp == DB::table('password_resets')->where('phone', $request->user()->phone)->value('otp');

        if ($status) {

            return response()->json([
                'success' => true,
                'success_msg' => 'OTP Matched',
            ]);
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'OTP did not Match',
            ]);
        }
    }

    public function changepw(Request $request)
    {

        $user = User::where('phone', $request->user()->phone)->first();

        if (Hash::check($request->old_password, $request->user()->password)) {

            $post_data = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8'
            ]);

            if ($post_data->fails()) {
                $err = current(current(json_decode($post_data->messages(), true)));

                return response()->json([
                    'success' => false,
                    'error_msg' => $err,
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('phone', $request->user()->phone)->update(['used_at' => Carbon::now()->toDateTimeString()]);

            $request->user()->currentAccessToken()->delete();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'success_msg' => 'Password Reset Successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'usertype' => $user->usertype,
            ]);
        } else {

            return response()->json([
                'success' => false,
                'error_msg' => 'Old Password did not Match',
            ]);
        }
    }
}
