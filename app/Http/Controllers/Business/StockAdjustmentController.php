<?php

namespace App\Http\Controllers\Business;

use App\Models\Unit;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class StockAdjustmentController extends Controller
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

            $query = StockAdjustment::join('products','products.id','=','stockadjustments.product_id')
            ->join('units','units.id','=','products.unit_id')
            ->join('categories','categories.id','=','products.category_id');

            $query->where('stockadjustments.business_id',Auth::user()->business_id);

            if($request->has('sku') && $request->sku != ''){
                $query->where('products.sku',$request->sku);
            }

            if($request->has('category_id') && $request->category_id != ''){
                $query->where('products.category_id',$request->category_id);
            }

            if($request->has('description') && $request->description != ''){
                $query->where('products.description',$request->description);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('products.title','like','%'.$search.'%')
                   ->orwhere('products.description','like','%'.$search.'%')
                   ->orwhere('products.category','like','%'.$search.'%')
                   ->orwhere('products.unit','like','%'.$search.'%')
                   ->orwhere('products.sku','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'stockadjustments.*',
                'products.title as product_title',
                'products.sku',
                'units.title as unit_title',
                'units.short_name as unit_short_name',
            ])
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/business/stockadjustment/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('business/stockadjustment/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                array_push($data,[
                    $action,
                    $value->id,
                    date('d-m-Y', strtotime($value->date)),
                    $value->sku.' - '. $value->product_title,
                    $value->description,
                    $value->qty,
                    $value->type ? 'Stock In' : 'Stock Out',
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


        return view('business.stockadjustment.index',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {

        $data = [
            'products' => Product::where('business_id',Auth::user()->business_id)->get()
        ];

        return view('business.stockadjustment.create',$data);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            "product_id" => "required|max:255",
            "qty" => "required|max:255",
            "price" => "required|max:255",
            "date" => "required|max:255",
            "type" => "required|max:255",
            "description" => "required|max:255",
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $module = StockAdjustment::create([
            'business_id' => Auth::user()->business_id,
            "product_id" => $request->product_id,
            "qty" => $request->qty,
            "price" => $request->price,
            "date" => $request->date,
            "type" => $request->type,
            "description" => $request->description
        ]);

        return redirect(URL::to('/business/stockadjustment/'.Crypt::encryptString($module->id).'/edit'))->with('success','Record Created');

    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = StockAdjustment::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
        }
    
        $data = [
            'model' => $model,
            'products' => Product::where('business_id',Auth::user()->business_id)->get()
        ];

        return view('business.stockadjustment.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $model = StockAdjustment::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "product_id" => "required|max:255",
            "qty" => "required|max:255",
            "price" => "required|max:255",
            "date" => "required|max:255",
            "type" => "required|max:255",
            "description" => "required|max:255",
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $model->product_id = $request->product_id;
        $model->qty = $request->qty;
        $model->price = $request->price;
        $model->date = $request->date;
        $model->type = $request->type;
        $model->description = $request->description;
        $model->save();

        return redirect(URL::to('/business/stockadjustment/'.Crypt::encryptString($model->id).'/edit'))->with('success','Record Updated');


    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = StockAdjustment::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
