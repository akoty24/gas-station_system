<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Mail\AdminResetPassword;
use App\Models\Device;
use App\Models\Shift;
use DB;
use Carbon\Carbon;
use Mail;

class AdminAuthController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        $fuelTypes = Device::distinct('fuel_type')->pluck('fuel_type');

        $previousShift=Shift::latest()->first();
        if ($previousShift ){
            $previousReadings= $previousShift->readings()->get();
        }
      
        
        return view('Admin.pages.shifts.shift_day' ,get_defined_vars());
    }

    public function login()
    {
        return view('Admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        
        $remember_me = $request->has('remember') ? true : false;

        if( auth()->guard('admin')->attempt(['email' => request('email') , 'password' => request('password')] , $remember_me) )
        {
            
            $admin = Admin::find(adminurl()->id);
            $admin->login_count += 1;
            $admin->last_login_date = date('Y-m-d h:i A');
            $admin->save();
            
            return response()->json(['successMSG' => 'Welcome']);

        }else{
            return response()->json(['errorMSG' => 'Email or password incorrect !']);
        }
    }

    public function logout()
    {
        $admin = Admin::find(adminurl()->id);
        $admin->logout_count += 1;
        $admin->last_logout_date = date('Y-m-d h:i A');
        $admin->save();
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }

    public function forgot_password()
    {
        return view('Admin.forgot_password');
    }

    public function forgot_password_post(Request $request)
    {
        
        $request->validate([
            'email' => 'required'
        ]);

        $admin = Admin::where('email' , $request->email)->first();

        if($admin){
            
            // Create Token From Email address ..
            $token = app('auth.password.broker')->createToken($admin);

            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);


            
            //Send The Email To People ..
            Mail::to($request->email)->send(new AdminResetPassword(['data' => $admin , 'token' => $token]));

            session()->flash('success' , trans('backend.message_sent_to_your_email_please_check_your_inbox'));
            return redirect()->back();

        }else{
            
            session()->flash('error', trans('backend.email_not_found'));
            return redirect()->route('admin.forgot_password');
        }
    }

    public function reset_password($token)
    {
        $check_token = DB::table('password_resets')->where('token' , $token)
            ->where('created_at' , '>' , Carbon::now()->subHours(2))
            ->first();

        if(!empty($check_token)){
            return view('Admin.reset_password' , compact('check_token'));
        }else{
            return redirect()->route('admin.forgot_password');
        }
    }

    public function reset_password_post(Request $request,$token)
    {

        $check_token = DB::table('password_resets')->where('token' , $token)
            ->where('created_at' , '>' , Carbon::now()->subHours(2))
            ->first();
        
        if( !empty($check_token) ){
            $admin = Admin::where('email',$check_token->email)->update([
                'email' => $check_token->email,
                'password' => bcrypt($request->password)
            ]);
            DB::table('password_resets')->where('email', $request->email)->delete();

            // Login After Reset Password 
            auth()->guard('admin')->attempt([
                'email' => $check_token->email, 
                'password' => request('password')
                ], true);

            $admin = Admin::where('email',$check_token->email)->first();
            $admin->login_count += 1;
            $admin->last_login_date = date('Y-m-d h:i A');
            $admin->last_login_date = date('Y-m-d h:i A');
            $admin->save();
            
            return redirect()->route('admin.index');

        }

        dd($check_token);
    }
}
