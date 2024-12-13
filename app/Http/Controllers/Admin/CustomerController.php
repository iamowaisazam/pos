<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
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

            $query = Customer::query();

            //Search

            $query->where('company_id',Auth::user()->company_id);

            if($request->has('status') && $request->status != ''){
                $query->where('status',$request->status);
            }

            // if($request->has('company_name') && $request->company_name != ''){
            //     $query->where('company_name',$request->company_name);
            // }

            // if($request->has('customer_name') && $request->customer_name != ''){
            //     $query->where('customer_name',$request->customer_name);
            // }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('customer_name','like','%'.$search.'%')
                   ->orwhere('customer_email','like','%'.$search.'%')
                   ->orwhere('company_name','like','%'.$search.'%')
                   ->orwhere('customer_phone','like','%'.$search.'%')
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
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/customers/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/customers/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $value->id,
                    $value->company_name,
                    $value->customer_name,
                    $value->customer_email,
                    $value->customer_phone,
                    $value->country,
                    $value->state,
                    $value->city,
                    $value->postal_code,
                    $value->street_address,
                    "<div class='switchery-demo'>
                     <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>",
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

        return view('admin.customers.index');
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $data = [];
        if($id == 'create'){

        }else{

            $customer = Customer::find(Crypt::decryptString($id));
            if($customer == false){  
                return back()->with('error','Record Not Found');
            }
            $data['customer'] = $customer;
        }

        

        return view('admin.customers.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        // dd($request->all());

        if($id == "create"){
            $customer = new Customer();
        }else{
            $id = Crypt::decryptString($id);
            $customer = Customer::find($id);
            if($customer == false){  
               return back()->with('error','Record Not Found');
            }
        }

    

        $validator = Validator::make($request->all(), [
            "company_name" => 'required|max:255',
            "customer_name" => 'required|max:255',
            "customer_phone" => 'required|max:255',
            "customer_email" => 'required|email|max:255',
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

        $customer->company_name = $request->company_name;
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_phone = $request->customer_phone;
        $customer->country = $request->country;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;
        $customer->street_address = $request->street_address;
        
        if($id == 'create'){
            $customer->created_at = Carbon::now();
            $customer->created_by = Auth::user()->id;
            $customer->status = 1;
        }else{
            $customer->updated_at = Carbon::now();      
        }
      
        $customer->company_id = Auth::user()->company_id;
        $customer->save();
        
        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Customer::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
