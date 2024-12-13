<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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

            $query = Product::query();

            $query->where('company_id',Auth::user()->company_id);

            if($request->has('status') && $request->status != ''){
                $query->where('status',$request->status);
            }

            if($request->has('sku') && $request->sku != ''){
                $query->where('sku',$request->sku);
            }

            if($request->has('category') && $request->category != ''){
                $query->where('category',$request->category);
            }

            if($request->has('description') && $request->description != ''){
                $query->where('description',$request->description);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('title','like','%'.$search.'%')
                   ->orwhere('description','like','%'.$search.'%')
                   ->orwhere('category','like','%'.$search.'%')
                   ->orwhere('unit','like','%'.$search.'%')
                   ->orwhere('sku','like','%'.$search.'%');
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

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/products/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/products/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $action,
                    "<div class='switchery-demo'>
                     <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>",
                    $value->id,
                    $value->title,
                    $value->sku,
                     $value->unit,
                    $value->short_description,
                    $value->price,
                    $value->category
                ]);        
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }

        return view('admin.products.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {

        return view('admin.products.create');
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            "title" => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $slug = strtolower($request->title);
        $slug = preg_replace('/[\s_]+/', '-', $slug);
        $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
        $slug = trim($slug, '-');

        $product = Product::create([
            'company_id' => Auth::user()->company_id,
            'title' => $request->title,
            'slug' => $slug
        ]);

        return redirect(URL::to('/admin/products/'.Crypt::encryptString($product->id).'/edit'))->with('success','Product Created');

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
        $data['product'] = $product;

        return view('admin.products.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $product = Product::find($id);
        if($product == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "title" => 'required|max:255',
            "short_description" => 'nullable|max:255',
            "sku" => 'nullable|max:100',
            "price" => 'required|max:100',
            "unit" => 'nullable|max:100',
            "long_description" => 'nullable|max:1000',
            "image" => 'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $slug = strtolower($request->title);
        $slug = preg_replace('/[\s_]+/', '-', $slug);
        $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
        $slug = trim($slug, '-');


        $product->title = $request->title;
        $product->slug = $slug;
        $product->short_description = $request->short_description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->unit = $request->unit;
        $product->category = $request->category;
        $product->long_description = $request->long_description;
        // $product->image = $request->image;
        $product->save();

        // dd($request->all());
        
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
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
