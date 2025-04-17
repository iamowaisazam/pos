<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $settings = Setting::pluck('value','field')->toArray();

        if(request()->isMethod('post')) {

            $data = Setting::pluck('value','field')->toArray();
       
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

            Setting::where('field','name')->update(['value' =>$request->name]);
            Setting::where('field','email')->update(['value' =>$request->email]);
            Setting::where('field','contact')->update(['value' =>$request->contact]);
            Setting::where('field','website')->update(['value' =>$request->website]);
            Setting::where('field','details')->update(['value' =>$request->details]);

            if ($request->file('icon')) {

                if ( $settings['icon']  && file_exists(public_path('uploads/' . $settings['icon']))) {
                    unlink(public_path('uploads/' . $settings['icon']));
                }

                $fileName = time() . '_' . $request->file('icon')->getClientOriginalName();
                $filePath = public_path('uploads');
                $request->file('icon')->move($filePath, $fileName);
                Setting::where('field','icon')->update(['value' =>$fileName]);
            }

            if($request->file('logo')){
                if ( $settings['logo']  && file_exists(public_path('uploads/' . $settings['logo']))) {
                    unlink(public_path('uploads/' . $settings['logo']));
                }
                $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                $filePath = public_path('uploads');
                $request->file('logo')->move($filePath, $fileName);
                Setting::where('field','logo')->update(['value' =>$fileName]);
            }

            return back()->with('success','Record Updated');
        }

        $data = [
            'settings' => $settings
        ];

        return view('admin.settings.general',$data);
    }




    public function address(Request $request)
    {

        $settings = Setting::pluck('value','field')->toArray();

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

            Setting::where('field','country')->update(['value' =>$request->country]);
            Setting::where('field','state')->update(['value' =>$request->state]);
            Setting::where('field','city')->update(['value' =>$request->city]);
            Setting::where('field','postal_code')->update(['value' =>$request->postal_code]);
            Setting::where('field','street_address')->update(['value' =>$request->street_address]);

            return back()->with('success','Record Updated');
        }

       $data = [
            'settings' => $settings
        ];

        return view('admin.settings.address',$data);
        
    }

    public function theme(Request $request)
    {

        $settings = Setting::pluck('value','field')->toArray();
        

        if(request()->isMethod('post')) {

            $data = Setting::pluck('value','field')->toArray();
        
            // $validator = Validator::make($request->all(),[
            //     'name' => 'nullable|max:100',
            //     'logo' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            //     'icon' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            //     'email' => 'nullable|max:100',
            //     'details' => 'nullable|max:1000',
            // ]);

            // if ($validator->fails()) {
            //     return back()
            //     ->withErrors($validator)
            //     ->withInput();
            // }

            Setting::where('field','primary_color')->update(['value' =>$request->primary_color]);
            Setting::where('field','secondry_color')->update(['value' =>$request->secondry_color]);
            Setting::where('field','sidebar_text_color')->update(['value' =>$request->sidebar_text_color]);
            Setting::where('field','sidebar_background_color')->update(['value' =>$request->sidebar_background_color]);
            Setting::where('field','sidebar_active_color')->update(['value' =>$request->sidebar_active_color]);
            Setting::where('field','contrast_color')->update(['value' =>$request->contrast_color]);
            Setting::where('field','topbar_text_color')->update(['value' =>$request->topbar_text_color]);
            Setting::where('field','topbar_background_color')->update(['value' =>$request->topbar_background_color]);

        

            return back()->with('success','Record Updated');

        }


        $data = [
            'settings' => $settings
        ];

        return view('admin.settings.theme',$data);
        
    }
  
 
    
}