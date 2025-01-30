<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Transaction;
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
                'customers.*',
            ])
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/business/customers/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                   
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('business/customers/'.Crypt::encryptString($value->id)).'">Delete</a>';

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

        

        return view('business.customers.index');
    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function create(Request $request)
    {
        return view('business.customers.create');  
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "company_name" => 'nullable|max:255',
            "name" => 'required|max:255',
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
        
        $customer = new Customer();

        $customer->company_name = $request->company_name;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->country = $request->country;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;
        $customer->street_address = $request->street_address;

        $customer->created_at = Carbon::now();
        $customer->created_by = Auth::user()->id;
        $customer->business_id = Auth::user()->business_id;
        $customer->save();

        return redirect('business/customers/'.Crypt::encryptString($customer->id).'/edit')
        ->with('success','Record Updated');

    }



    /**
     * Create a new controller instance.
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $data = [];
        $customer = Customer::find(Crypt::decryptString($id));
        if($customer == false){  
            return back()->with('error','Record Not Found');
        }

        $data['model'] = $customer;
        

        return view('business.customers.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $customer = Customer::find($id);
        if($customer == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "company_name" => 'nullable|max:255',
            "name" => 'required|max:255',
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

        $customer->company_name = $request->company_name;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;

        $customer->country = $request->country;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;
        $customer->street_address = $request->street_address;
        $customer->updated_at = Carbon::now();      
        $customer->save();
        
        return redirect('/business/customers')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function destroy($id)
    {

        $data = Customer::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{

            if(Sale::where('customer_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            if(Transaction::where('customer_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }

}

