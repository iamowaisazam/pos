<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
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
     * @return void
     */
    public function login()
    {
        if (Auth::check()){
            return redirect('/business/dashboard');
        }
        
        return view('business.login');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login_submit(Request $request)
    {
        if (Auth::check()){
            return redirect('/business/dashboard'); 
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
                return redirect('/business/dashboard'); 
            }

        } else {

            return back()
            ->withErrors([
                "email" => ["Wrong Email Or Password"],
                "password" => ["Wrong Email Or Password"]
            ])->withInput();

        }


    }

    /**
     * 
     * Create a new controller instance.
     * @return void
     */
    public function register()
    {
        if (Auth::check()){
            return redirect('/business/dashboard');
        }
        return view('business.register');

    }

        /**
     * Create a new controller instance.
     * @return void
     */
    public function register_submit(Request $request)
    {
        if (Auth::check()){
            return redirect('/business/dashboard');
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email',$request->email)->first();
        if($user){
            return back()
                ->withErrors([
                    "email" => ["Email Already Linked With Other Account"],
                    "password" => [""]
                ])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $business = Business::create([
            'user_id' => $user->id
        ]);

        Auth::login($user);

        return redirect('/business/dashboard')->with('success','You Account Is Successfully Create');

    }


    public function logout()
    {
        Auth::logout();
        return redirect('/business/login');
    }


    
}
