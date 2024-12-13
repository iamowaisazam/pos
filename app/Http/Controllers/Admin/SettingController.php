<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\StoreCategory;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class SettingController extends Controller
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

    public function general(Request $request)
    {
        

        if(request()->isMethod('post')) {
       
            $validator = Validator::make($request->all(),[
                'name' => 'nullable|max:100',
                'logo' => 'nullable|max:100',
                'email' => 'nullable|max:100',
                'details' => 'nullable|max:1000',
            ]);

            if ($validator->fails()) {
                return back()
                ->withErrors($validator)
                ->withInput();
            }

            $company = Company::where('id',Auth::user()->company_id)->first();
            $company->name = $request->name;
            $company->logo = $request->logo;
            $company->email = $request->email;
            $company->details = $request->details;
            $company->save();

            return back()->with('success','Record Updated');

        }


        $data = [
            'company' => Company::find(Auth::user()->company_id),
        ];

        return view('admin.settings.general',$data);
        
    }


    public function address(Request $request)
    {

        if(request()->isMethod('post')) {
       
            $validator = Validator::make($request->all(),[
                'country' => 'nullable|max:100',
                'state' => 'nullable|max:100',
                'city' => 'nullable|max:100',
                'postal_code' => 'nullable|max:100',
                'street_address' => 'nullable|max:100',
            ]);

            if ($validator->fails()) {
                return back()
                ->withErrors($validator)
                ->withInput();
            }

            $company = Company::where('id',Auth::user()->company_id)->first();
            $company->country = $request->country;
            $company->state = $request->state;
            $company->city = $request->city;
            $company->postal_code = $request->postal_code;
            $company->street_address = $request->street_address;
            $company->save();

            return back()->with('success','Record Updated');

        }

        $data = [
         'company' => Company::find(Auth::user()->company_id),
        ];

        // dd($data);

        return view('admin.settings.address',$data);
        
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function update(Request $request)
    // {

    //     foreach ($request->data as $key => $value) {
    //             Setting::where('field',$key)->update(["value" => $value]);
    //     }
    //     return back()->with('success','Record Updated');
    // }
  
    
}