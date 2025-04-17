<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Role;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class PurchaseInvoiceController extends Controller
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

            $query = Purchase::Leftjoin('vendors','vendors.id','=','purchases.vendor_id');

        

            if($request->has('is_paid') && $request->is_paid != ''){
                $query->where('purchases.is_paid',$request->is_paid);
            }

            if($request->has('vendor') && $request->vendor != ''){
                $query->where('purchases.id',$request->vendor);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('purchases.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('purchases.created_at','<=',$request->edate);
            }

            if($request->has('tracking_id') && $request->tracking_id != ''){
                $query->where('purchases.tracking_id',$request->tracking_id);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('purchases.ref','like','%'.$search.'%')
                   ->orwhere('vendors.name','like','%'.$search.'%')
                   ->orwhere('purchases.tracking_id','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'purchases.*',
                'vendors.name as name',
            ])
            ->orderBy('purchases.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/purchaseinvoices/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';

                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/purchaseinvoices/'.Crypt::encryptString($value->id)).'">Delete</a>';


                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/purchaseinvoices/print/'.Crypt::encryptString($value->id)).'">Print</a>';
             
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

        $data['vendors'] = Vendor::where([
            'status'=>1,
        ])->get();

        return view('admin.purchaseinvoices.index',$data);
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function create(Request $request)
    {
        
        $data = [
            'products' => Product::query()->get(),
            'vendors' => Vendor::query()->get(),
        ];

        return view('admin.purchaseinvoices.create',$data);
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
            "vendor_id" => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        // dd($request->all());

        $model = new Purchase();
        $model->date = $request->date;
        $model->due_date = $request->due_date;
        $model->ref = $request->ref;
        $model->is_paid = $request->is_paid;
        $model->description = $request->description;
        $model->vendor_id = $request->vendor_id;

        $model->adjustments = json_encode($request->adjustments ?? []);
       
        $model->subtotal = $request->subtotal;
        $model->grandtotal = $request->grandtotal;
        $model->notes = $request->notes;
        $model->created_at = Carbon::now(); 
        $model->created_by = Auth::user()->id;   
        $model->tracking_id = uniqid();
        $model->save();


        if($request->has('items')){
            foreach ($request->items as $key => $item) {
                PurchaseItem::create([
                    'purchase_id' => $model->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                    'tax' => $item['tax'],
                    'total' => $item['total'],
                    'created_at' => $model->date,
                ]);
            }
        }

        return redirect(URL::to('admin/purchaseinvoices/'.Crypt::encryptString($model->id).'/edit'))
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
        $model = Purchase::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $data = [
            'model' => $model,
            'products' => Product::query()->get(),
            'vendors' => Vendor::query()->get()
        ];
    
     

        return view('admin.purchaseinvoices.edit',$data);
    }

    

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $model = Purchase::find($id);
        if($model == false){  
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


        $model->date = $request->date;
        $model->due_date = $request->due_date;
        $model->ref = $request->ref;
        $model->is_paid = $request->is_paid;
        $model->description = $request->description;
        $model->vendor_id = $request->vendor_id;


        $model->adjustments = json_encode($request->adjustments ?? []);
        $model->notes = $request->notes;
        $model->subtotal = $request->subtotal;
        $model->grandtotal = $request->grandtotal;
        $model->updated_at = Carbon::now();      
        $model->save();

    
        PurchaseItem::where('purchase_id',$model->id)->delete();
        if($request->has('items')){
            foreach ($request->items as $key => $item) {
                PurchaseItem::create([
                    'purchase_id' => $model->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                    'tax' => $item['tax'],
                    'total' => $item['total'],
                    'created_at' => $model->date,
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
        $model = Purchase::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $data['model'] = $model;
        $data['items'] = json_decode($model) ? json_decode($model->items) : [];
     
    
        return view('admin.purchaseinvoices.print',$data);
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Purchase::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
