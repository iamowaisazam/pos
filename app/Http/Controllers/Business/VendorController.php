<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class VendorController extends Controller
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
    public function index(Request $request)
    {

        if($request->ajax()){

            $query = Vendor::query();

            //Searc
            $query->where('business_id',Auth::user()->business_id);

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('name','like','%'.$search.'%')
                   ->orwhere('email','like','%'.$search.'%')
                   ->orwhere('company_name','like','%'.$search.'%')
                   ->orwhere('phone','like','%'.$search.'%')
                   ->orwhere('country','like','%'.$search.'%')
                   ->orwhere('city','like','%'.$search.'%')
                   ->orwhere('state','like','%'.$search.'%')
                   ->orwhere('postal_code','like','%'.$search.'%')
                   ->orwhere('street_address','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'vendors.*',
            ])
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/business/vendors/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                   
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('business/vendors/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';


                array_push($data,[
                    $value->id,
                    $value->name,
                    $value->email,
                    $value->phone,
                    $action,
                ]);        
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }

        

        return view('business.vendors.index');
    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function create(Request $request)
    {

        return view('business.vendors.create');  
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => 'required|max:255',
            "company_name" => 'nullable|max:255',
            "phone" => 'nullable|max:255',
            "email" => 'nullable|email|max:255',
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

        $vendor = new Vendor();
        $vendor->company_name = $request->company_name;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->country = $request->country;
        $vendor->state = $request->state;
        $vendor->city = $request->city;
        $vendor->postal_code = $request->postal_code;
        $vendor->street_address = $request->street_address;
        $vendor->created_at = Carbon::now();
        $vendor->created_by = Auth::user()->id;
        $vendor->business_id = Auth::user()->business_id;
        $vendor->save();

        return redirect('business/vendors/')
        ->with('success','Record Created Successfully');

    }



    /**
     * Create a new controller instance.
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $data = [];
        $vendor = Vendor::find(Crypt::decryptString($id));
        if($vendor == false){  
            return back()->with('error','Record Not Found');
        }
        $data['model'] = $vendor;
        

        return view('business.vendors.edit',$data);
    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $vendor = Vendor::find($id);
        if($vendor == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "name" => 'nullable|max:255',
            "company_name" => 'required|max:255',
            "phone" => 'nullable|max:255',
            "email" => 'nullable|email|max:255',
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

        $vendor->company_name = $request->company_name;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->country = $request->country;
        $vendor->state = $request->state;
        $vendor->city = $request->city;
        $vendor->postal_code = $request->postal_code;
        $vendor->street_address = $request->street_address;
        $vendor->updated_at = Carbon::now();      
        $vendor->save();
        
        return redirect('/business/vendors')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function destroy($id)
    {

        $data = Vendor::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{

            if(Purchase::where('vendor_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            if(Transaction::where('vendor_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            $data->delete();
            return response()->json(['message' => 'Record Deleted'],200);
        }

    }

   

    
}
