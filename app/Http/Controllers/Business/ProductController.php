<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Models\StockAdjustment;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class ProductController extends Controller
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

            $query = Product::Leftjoin('categories','categories.id','=','products.category_id')
            ->Leftjoin('units','units.id','=','products.unit_id');

            $query->where('products.business_id',Auth::user()->business_id);

            if($request->has('status') && $request->status != ''){
                $query->where('products.status',$request->status);
            }

            if($request->has('sku') && $request->sku != ''){
                $query->where('products.sku',$request->sku);
            }

            if($request->has('category_id') && $request->category_id != ''){
                $query->where('products.category_id',$request->category_id);
            }

            if($request->has('unit_id') && $request->unit_id != ''){
                $query->where('products.unit_id',$request->unit_id);
            }

        
            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('products.title','like','%'.$search.'%')
                   ->orwhere('products.sku','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'products.*',
                'categories.title as category_title',
                'units.short_name as unit_title',
            ])
            ->orderBy('products.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/business/products/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('business/products/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';
                
                array_push($data,[
                    $action,
                    $value->status ? 'Enable' : 'Disable',
                    $value->id,
                    $value->category_title,
                    $value->title,
                    $value->sku,
                    $value->unit_title,
                    $value->price,
                ]);        
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }

        $data = [
            'categories' => Category::where('business_id',Auth::user()->business_id)->get(),
            'units' => Unit::where('business_id',Auth::user()->business_id)->get(),
        ];

        return view('business.products.index',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {
        
        $data = [
            'categories' => Category::where('business_id',Auth::user()->business_id)->get(),
            'units' => Unit::where('business_id',Auth::user()->business_id)->get(),
        ];

        return view('business.products.create',$data);
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            "title" =>'required|max:255',
            "sku" =>'required|max:100',
            "short_description" =>'nullable|max:255',
            "price" =>'required|max:100',
            "purchase_price" =>'required|max:100',
            "status" =>'required|in:0,1|max:255',
            "unit_id" =>'required|max:100',
            "category_id" =>'required|max:100',
            "long_description" =>'nullable|max:1000',
            "image" =>'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        // dd($request->all());

        $model = Product::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'sku' => $request->sku,
            'price' => $request->price,
            'purchase_price' => $request->purchase_price,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'long_description' => $request->long_description,
            'business_id' => Auth::user()->business_id,
        ]);


        if ($request->file('thumbnail')) {
         
            $fileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
            $filePath = public_path('uploads');
            $request->file('thumbnail')->move($filePath, $fileName);
            $model->thumbnail = $fileName;
            $model->save();
        }

        return redirect(URL::to('/business/products/'.Crypt::encryptString($model->id).'/edit'))->with('success','Product Created');

    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $product = Product::find(Crypt::decryptString($id));
        if($product == false){  
            return back()->with('error','Record Not Found');
        }

        $data = [
            'categories' => Category::where('business_id',Auth::user()->business_id)->get(),
            'units' => Unit::where('business_id',Auth::user()->business_id)->get(),
            'product' => $product
        ];

        return view('business.products.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $model = Product::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "title" => 'required|max:255',
            "sku" => 'required|max:100',
            "short_description" => 'nullable|max:255',
            "price" => 'required|max:100',
            "purchase_price" => 'required|max:100',
            "status" => 'required|in:0,1|max:255',
            "unit_id" => 'nullable|max:100',
            "category_id" => 'nullable|max:100',
            "long_description" => 'nullable|max:1000',
            "image" => 'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $model->title = $request->title;
        $model->short_description = $request->short_description;
        $model->sku = $request->sku;
        $model->price = $request->price;
        $model->purchase_price = $request->purchase_price;
        $model->unit_id = $request->unit_id;
        $model->status = $request->status;
        $model->category_id = $request->category_id;
        $model->long_description = $request->long_description;
        $model->save();

        if($request->file('thumbnail')) {

            if ($model->thumbnail && file_exists(public_path('uploads/' . $model->thumbnail))) {
                unlink(public_path('uploads/' . $model->thumbnail));
            }    
          
            $fileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
            $filePath = public_path('uploads');
            $request->file('thumbnail')->move($filePath, $fileName);
            $model->thumbnail = $fileName;
            $model->save();
        }
        
        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Product::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{

            if(PurchaseItem::where('product_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            if(SaleItem::where('product_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }

            if(StockAdjustment::where('product_id',$data->id)->count() > 0){
                return response()->json(['message' => 'Record Not Deleted Its Used Somewhere'],400);
            }


            $data->delete();
            return response()->json(['message' => 'Record  Deleted'],200);
        }

    }


    
}
