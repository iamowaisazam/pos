<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
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
                'logo' => 'nullable|mimes:jpg,jpeg,png|max:2048',
                'email' => 'nullable|max:100',
                'details' => 'nullable|max:1000',
            ]);

            if ($validator->fails()) {
                return back()
                ->withErrors($validator)
                ->withInput();
            }

            $business = Business::where('id',Auth::user()->business_id)->first();
            $business->name = $request->name;
            $business->email = $request->email;
            $business->contact = $request->contact;
            $business->website = $request->website;
            $business->details = $request->details;
            $business->save();

            if ($request->file('icon')) {
                if ($business->icon && file_exists(public_path('uploads/' . $business->icon))) {
                    unlink(public_path('uploads/' . $business->icon));
                }    
                $fileName = time() . '_' . $request->file('icon')->getClientOriginalName();
                $filePath = public_path('uploads');
                $request->file('icon')->move($filePath, $fileName);
                $business->icon = $fileName;
                $business->save();
            }


            if ($request->file('logo')) {

                if ($business->logo && file_exists(public_path('uploads/' . $business->logo))) {
                    unlink(public_path('uploads/' . $business->logo));
                }

                $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                $filePath = public_path('uploads');
                $request->file('logo')->move($filePath, $fileName);
                $business->logo = $fileName;
                $business->save();
            }

            return back()->with('success','Record Updated');

        }


        $data = [
            'business' => Business::find(Auth::user()->business_id),
        ];

        return view('business.settings.general',$data);
        
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

            $business = Business::where('id',Auth::user()->business_id)->first();
            $business->country = $request->country;
            $business->state = $request->state;
            $business->city = $request->city;
            $business->postal_code = $request->postal_code;
            $business->street_address = $request->street_address;
            $business->save();

            return back()->with('success','Record Updated');

        }

        $data = [
         'business' => Business::find(Auth::user()->business_id),
        ];

        // dd($data);

        return view('business.settings.address',$data);
        
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