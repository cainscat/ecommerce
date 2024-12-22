<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Mail;
use App\Mail\RegisterMail;

class AuthController extends Controller
{
    public function login_admin()
    {
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1)
        {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1,
            'status' => 0, 'is_delete' => 0], $remember))
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return redirect()->back()->with('error', "Please enter currect email and password");
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if(empty($checkEmail))
        {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));

            $json['status'] = true;
            $json['message'] = "Your Account Successfully Created. Please Verify Your Email Address!";
        }
        else
        {
            $json['status'] = false;
            $json['message'] = "This Email Already Register! Please Choose Another!";
        }
        echo json_encode($json);
    }

    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', "Email Successfully Verified");
    }

}
