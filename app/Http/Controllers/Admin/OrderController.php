<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
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

class OrderController extends Controller
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

            $query = Order::Leftjoin('customers','customers.id','=','orders.customer_id');

            $query->where('orders.company_id',Auth::user()->company_id);

            if($request->has('status') && $request->status != ''){
                $query->where('orders.status',$request->status);
            }

            if($request->has('is_paid') && $request->is_paid != ''){
                $query->where('orders.is_paid',$request->is_paid);
            }

            if($request->has('customer') && $request->customer != ''){
                $query->where('customers.id',$request->customer);
            }

            if($request->has('tracking_id') && $request->tracking_id != ''){
                $query->where('orders.tracking_id',$request->tracking_id);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('orders.ref','like','%'.$search.'%')
                   ->orwhere('customers.customer_name','like','%'.$search.'%')
                   ->orwhere('orders.tracking_id','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'orders.*',
                'customers.customer_name as customername',
            ])
            ->orderBy('orders.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/orders/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/orders/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $action,
                    "<div class='switchery-demo'>
                     <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>",
                    $value->id,
                    date('d-m-Y', strtotime($value->created_at)),
                    $value->tracking_id,
                    $value->customername,
                    $value->is_paid ? 'Paid' : 'Unpaid',
                    $value->total,
                ]);        
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }

        $data['customers'] = Customer::where(['status'=>1,'company_id' => Auth::user()->company_id])->get();


        return view('admin.orders.index',$data);
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

            $order = Order::find(Crypt::decryptString($id));
            if($order == false){  
                return back()->with('error','Record Not Found');
            }
            $data['order'] = $order;
            
        }

        $data['products'] = Product::where(['status'=>1,'company_id' => Auth::user()->company_id])->get();
        $data['customers'] = Customer::where(['status'=>1,'company_id' => Auth::user()->company_id])->get();

        return view('admin.orders.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        if($id == "create"){
            $order = new Order();
        }else{
            $id = Crypt::decryptString($id);
            $order = Order::find($id);
            if($order == false){  
               return back()->with('error','Record Not Found');
            }
        }

        $validator = Validator::make($request->all(), [
            // "company_name" => 'required|max:255',
            // "customer_name" => 'required|max:255',
            // "customer_phone" => 'required|max:255',
            // "customer_email" => 'required|email|max:255',
            // 'country' => 'nullable|max:100',
            // 'state' => 'nullable|max:100',
            // 'city' => 'nullable|max:100',
            // 'postal_code' => 'nullable|max:100',
            // 'street_address' => 'nullable|max:100',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $order->date = $request->date;
        $order->ref = $request->ref;
        
        $order->is_paid = $request->is_paid;
        $order->description = $request->description;

        $order->customer_id = $request->customer;
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->customer_contact = $request->customer_contact;
        $order->customer_country = $request->customer_country;
        $order->customer_state = $request->customer_state;
        $order->customer_city = $request->customer_city;
        $order->customer_postalcode = $request->customer_postalcode;
        $order->customer_address = $request->customer_address;

        $order->items = json_encode($request->items ?? []);

        $order->subtotal = $request->subtotal;
        $order->discount = $request->discount ?? 0;
        $order->tax = $request->tax ?? 0;
        $order->total = $request->total;
        
        if($id == 'create'){
            $order->created_at = Carbon::now();
            $order->created_by = Auth::user()->id;
            $order->status = 1;
            $order->tracking_id = uniqid();
        }else{
            $order->updated_at = Carbon::now();      
        }

        $order->company_id = Auth::user()->company_id;
        $order->save();

        return redirect(URL::to('admin/orders/'.Crypt::encryptString($order->id).'/edit'))->with('success','Record Updated');

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
