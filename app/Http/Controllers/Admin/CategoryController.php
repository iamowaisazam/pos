<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

class CategoryController extends Controller
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
     * @return void
     */
    public function index(Request $request)
    {

        if($request->ajax()){

            $query = Category::query();

 

            if($request->has('status') && $request->status != ''){
                $query->where('status',$request->status);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('title','like','%'.$search.'%');
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

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/categories/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/categories/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                array_push($data,[
                    $value->id,
                    $value->title,
                    date('d-m-Y', strtotime($value->created_at)),
                    $value->status ? 'Enable' : 'Disable',
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

        return view('admin.categories.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {

        return view('admin.categories.create');
    }


    public function store(Request $request){

            $validator = Validator::make($request->all(), [
                "title" => 'required|max:255',
                "status" => 'required|in:0,1|max:255',
                "description" => 'nullable|max:255',
                'thumbnail' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($validator->fails()) {
                return back()
                ->withErrors($validator)
                ->withInput();
            }
            
            $model = Category::create([
                'title' => $request->title,
                'status' => $request->status,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'created_by' => Auth::user()->id,
            ]);

            if ($request->file('thumbnail')) {
                $fileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
                $filePath = public_path('uploads');
                $request->file('thumbnail')->move($filePath, $fileName);
                $model->thumbnail = $fileName;
                $model->save();
            }

            return redirect(URL::to('/admin/categories/'.Crypt::encryptString($model->id).'/edit'))->with('success','Record Created');

    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = Category::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
        }
        $data['model'] = $model;

        return view('admin.categories.edit',$data);
    }

  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $model = Category::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "title" => 'required|max:255',
            "status" => 'required|in:0,1|max:255',
            "description" => 'nullable|max:255',
            'thumbnail' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $model->title = $request->title;
        $model->status = $request->status;
        $model->description = $request->description;
        $model->save();

        if ($request->file('thumbnail')) {
            if ($model->thumbnail && file_exists(public_path('uploads/' . $model->thumbnail))) {
                unlink(public_path('uploads/' . $model->thumbnail));
            }    
            $fileName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
            $filePath = public_path('uploads');
            $request->file('thumbnail')->move($filePath, $fileName);
            $model->thumbnail = $fileName;
            $model->save();
        }

        return redirect('/admin/categories/')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Category::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{

            if(Product::where('category_id',$data->id)->count() > 0 ){
                return response()->json(['message' =>'Cannot Delete This Record Is Used Somewhere'],400);
            }

            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
