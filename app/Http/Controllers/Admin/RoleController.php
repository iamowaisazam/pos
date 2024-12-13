<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
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


class RoleController extends Controller
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

        if(!Auth::user()->permission('roles.list')){
            return back()->with('warning','You Dont Have Access');
        }
     
        if($request->ajax()){

            $query = Role::query();
            $query->whereNotIn('id',[1,3,4]);

            //Search
            $search = $request->get('search')['value'];
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('roles.name','like','%'.$search.'%')
                   ->orwhere('roles.id','like','%'.$search.'%');
               });
            }

            $count = $query->get();
            $records = $query->skip($request->start)
            ->take($request->length)->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($records as $key => $value) {

              

                $action = '<div class="text-end">';

                if(Auth::user()->permission('roles.view')){
                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('admin/roles/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';
                }

                if(Auth::user()->permission('roles.delete')){
                    $action .= '<a class="mx-1 btn btn-danger" href="'.URL::to('admin/roles/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';
                }


                $status = $value->status ? 'Active' : 'Deactive';

                if(Auth::user()->permission('roles.edit')){
                    $selected = $value->status ? 'checked' : '';
                    $status = "<div class='switchery-demo'><input ".$selected." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>";
                }
                    

                $action .= '</div>';

                array_push($data,[
                    $value->id,
                    $value->name,
                    $status,
                    $action,
                 ]);

            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => count($count),
                "recordsFiltered" => count($count),
                'data'=> $data,
            ]);
        }

        return view('admin.roles.index');
    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        if(!Auth::user()->permission('roles.create')){
            return back()->with('warning','You Dont Have Access');
        }

        $permissions = Permission::where('status',1)->get();
        
        return view('admin.roles.create',compact('permissions'));
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        if(!Auth::user()->permission('roles.create')){
            return back()->with('warning','You Dont Have Access');
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|max:255',
           

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Role::create([
            'name' => $request->name,
            'status' => 1,
            'permissions' => $request->permissions ? implode(',',$request->permissions) : '',
            'created_at' => Carbon::now(),
            'updated_at' => NULL,
            'created_by' => Auth::user()->id,
        ]);
        
        
        
        return redirect('/admin/roles/index')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {

        if(!Auth::user()->permission('roles.view')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Role::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

         $permissions = Permission::where('status',1)->get();

        //  dd($permissions);

        return view('admin.roles.edit',compact('model','permissions'));
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        if(!Auth::user()->permission('roles.edit')){
            return back()->with('warning','You Dont Have Access');
        }

        $id = Crypt::decryptString($id);
        $model = Role::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'max:255',
                Rule::unique('roles')->ignore($id),
            ],
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $model->name = $request->name;
        $model->updated_by = Auth::user()->id;
        $model->updated_at = Carbon::now();
        $model->permissions = $request->permissions ? implode(',',$request->permissions) : '';
        $model->save();

        return redirect('admin/roles/index')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {

        if(!Auth::user()->permission('roles.delete')){
            return back()->with('warning','You Dont Have Access');
        }

        $model = Role::find(Crypt::decryptString($id));
        if($model == false){
            return back()->with('warning','Record Not Found');
        }else{

            if(User::where('role_id',$model->id)->first()){
                return back()->with('warning','Can Not Delete This Roles Its Used In Users');
            }

            $model->delete();
            return redirect('/admin/roles/index')->with('success','Record Deleted Success'); 
        }

    }



    

}
