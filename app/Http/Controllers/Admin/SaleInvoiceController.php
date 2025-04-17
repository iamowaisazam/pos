<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Role;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class SaleInvoiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
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

            $query = Sale::Leftjoin('customers','customers.id','=','sales.customer_id');

  

            if($request->has('status') && $request->status != ''){
                $query->where('sales.status',$request->status);
            }

            if($request->has('is_paid') && $request->is_paid != ''){
                $query->where('sales.is_paid',$request->is_paid);
            }

            if($request->has('customer') && $request->customer != ''){
                $query->where('customers.id',$request->customer);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('sales.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('sales.created_at','<=',$request->edate);
            }

            if($request->has('tracking_id') && $request->tracking_id != ''){
                $query->where('sales.tracking_id',$request->tracking_id);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('sales.ref','like','%'.$search.'%')
                   ->orwhere('customers.customer_name','like','%'.$search.'%')
                   ->orwhere('sales.tracking_id','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'sales.*',
                'customers.name',
            ])
            ->orderBy('sales.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/saleinvoices/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/saleinvoices/'.Crypt::encryptString($value->id)).'">Delete</a>';
                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/saleinvoices/print/'.Crypt::encryptString($value->id)).'">Print</a>';
             
                $action .= '</div>';

                array_push($data,[
                    $value->id,
                    date('d-m-Y', strtotime($value->created_at)),
                    $value->tracking_id,
                    $value->name,
                    $value->is_paid ? 'Paid' : 'Unpaid',
                    number_format($value->grandtotal,2),
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

        $data['customers'] = Customer::where([
            'status'=>1,
        ])->get();

        return view('admin.saleinvoices.index',$data);
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function create(Request $request)
    {
        
        $data = [
            'products' => Product::query()->get(),
            'customers' => Customer::query()->get(),
        ];

        return view('admin.saleinvoices.create',$data);
    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "description" => 'max:255',
            "ref" => 'nullable|max:255',
            "date" => 'required|max:255',
            "date_date" => 'nullable|max:255',
            "is_paid" => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $sale = new Sale();
        $sale->date = $request->date;
        $sale->due_date = $request->due_date;
        $sale->ref = $request->ref;
        $sale->is_paid = $request->is_paid;
        $sale->description = $request->description;
        $sale->customer_id = $request->customer;

        $sale->adjustments = json_encode($request->adjustments ?? []);
       
        $sale->subtotal = $request->subtotal;
        $sale->grandtotal = $request->grandtotal;
        $sale->notes = $request->notes;
        $sale->created_at = Carbon::now(); 
        $sale->created_by = Auth::user()->id;   
        $sale->tracking_id = uniqid();
        
        $sale->save();


        if($request->has('items')){
            foreach ($request->items as $key => $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                    'tax' => $item['tax'],
                    'total' => $item['total'],
                    'created_at' => $sale->date,
                ]);
            }
        }

        return redirect(URL::to('admin/saleinvoices/'.Crypt::encryptString($sale->id).'/edit'))
        ->with('success','Order Successfully Created Please Add Some Other Details.');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $data = [];
        $sale = Sale::find(Crypt::decryptString($id));
        if($sale == false){  
            return back()->with('error','Record Not Found');
        }

        $data['sale'] = $sale;
        $data['products'] = Product::query()->get();
        $data['customers'] = Customer::query()->get();

        return view('admin.saleinvoices.edit',$data);
        
    }

    
  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        // dd($request->all());

    
        $id = Crypt::decryptString($id);
        $sale = Sale::find($id);
        if($sale == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "description" => 'max:255',
            "ref" => 'nullable|max:255',
            "date" => 'required|max:255',
            "is_paid" => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }


        $sale->date = $request->date;
        $sale->due_date = $request->due_date;
        $sale->ref = $request->ref;
        $sale->is_paid = $request->is_paid;
        $sale->description = $request->description;
        $sale->customer_id = $request->customer;


        $sale->adjustments = json_encode($request->adjustments ?? []);
        $sale->notes = $request->notes;
        $sale->subtotal = $request->subtotal;
        $sale->grandtotal = $request->grandtotal;
        $sale->updated_at = Carbon::now();      
        $sale->save();

    
        SaleItem::where('sale_id',$sale->id)->delete();
        if($request->has('items')){
            foreach ($request->items as $key => $item) {
                SaleItem::create([
                    
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                    'tax' => $item['tax'],
                    'total' => $item['total'],
                    'created_at' => $sale->date,
                ]);
            }
        }

        return back()->with('success','Order Updated');

    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function print(Request $request,$id)
    {
        $data = [];
        $sale = Sale::find(Crypt::decryptString($id));
        if($sale == false){  
            return back()->with('error','Record Not Found');
        }

        $data['sale'] = $sale;
        $data['items'] = json_decode($sale) ? json_decode($sale->items) : [];
        $data['products'] = Product::query()->get();
        $data['customers'] = Customer::query()->get();

        return view('admin.saleinvoices.print',$data);
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Sale::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
