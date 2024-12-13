<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

 
 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login()
    {
        if (Auth::check()){

            // $role_id = Auth::user()->role_id;
            // if ($role_id == 0) {
                return redirect('/admin/dashboard');
            // } else {
            //     return redirect('/admin/login');
            // }
        }
        
        return view('admin.login');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login_submit(Request $request)
    {
        if (Auth::check()){
            return redirect('/admin/dashboard'); 
       }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);
        
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::where('email',$request->email)->first();
        if($user == null){
            return back()
                ->withErrors([
                    "email" => ["Wrong Email Or Password"],
                    "password" => ["Wrong Email Or Password"]
                ])->withInput();
        }

        if(Hash::check($request->password, $user->password)) {
            
            if (Auth::attempt([
                'email' =>$request->email,
                'password' => $request->password])){
                 return redirect('/admin/dashboard'); 
            }

        } else {

               return back()
                ->withErrors([
                    "email" => ["Wrong Email Or Password"],
                    "password" => ["Wrong Email Or Password"]
                ])->withInput();
        }


    }


    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }


    
}
