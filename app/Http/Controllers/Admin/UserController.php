<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Laravel\Ui\Presets\React;

class UserController extends Controller
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
    
        // if(!Auth::user()->permission('users.list')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        if($request->ajax()){

            $query = User::whereNotIn('role_id',[1,3,4]);

            if($request->has('status') && $request->status != ''){
                $query->where('status',$request->status);
            }

            if($request->has('role_id') && $request->role_id != ''){
                $query->where('role_id',$request->role_id);
            }

            //Search
            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('users.name','like','%'.$search.'%')
                   ->orwhere('users.email','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';
                if(Auth::user()->permission('users.view')){
                    $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('admin/users/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';
                }

                if(Auth::user()->permission('users.delete')){
                   $action .= '<a class="mx-1 btn btn-danger" href="'.URL::to('admin/users/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';
                }

                $action .= '</div>';

                $status = $value->status ? 'active' : 'deactive';

                if(Auth::user()->permission('users.edit')){

                    $checked = $value->status ? 'checked' : '';

                    $status = "<div class='switchery-demo'>
                    <input ".$checked." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                       </div>";
                }

                array_push($data,[
                    $value->id,
                    $value->name,
                    $value->email,
                    $value->role->name,
                    $status,
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


        $roles = Role::whereNotIn('id',[1,3,4])->where('status',1)->get();
        
        return view('admin.users.index',compact('roles'));

    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        // if(!Auth::user()->permission('users.create')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        $roles = Role::whereNotIn('id',[1,3,4])->where('status',1)->get();

        return view('admin.users.create',compact('roles'));

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {
        // if(!Auth::user()->permission('users.create')){
        //     return back()->with('warning','You Dont Have Access');
        // }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'role' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);
        
        
        return redirect('/admin/users/index')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        // if(!Auth::user()->permission('users.view')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        $roles = Role::whereNotIn('id',[1,3,4])->where('status',1)->get();

        $user = User::find(Crypt::decryptString($id));
        if($user == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.users.edit',compact('user','roles'));
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
        // if(!Auth::user()->permission('users.edit')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        $id = Crypt::decryptString($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'role' => 'required|exists:roles,id',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        if($user == false){  
           return back()->with('error','Record Not Found');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->created_by = Auth::user()->id;
        $user->created_at = Carbon::now();

        if($request->password){
          $user->password =  Hash::make($request->password);
        }

        $user->save();
        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {
        // if(!Auth::user()->permission('users.delete')){
        //     return back()->with('warning','You Dont Have Access');
        // }
        
        $user = User::find(Crypt::decryptString($id));
        if($user == false){
            return back()->with('warning','Record Not Found');
        }else{
            $user->delete();
            return redirect('/admin/users/index')->with('success','Record Deleted Success'); 
        }

    }


    public function profile(Request $request)
    {

        // if(!Auth::user()->permission('users.profile-view')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        $id = Auth::user()->id;
        $user = User::find($id);
        if($user == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.profile',compact('user'));
    }


    public function profile_update(Request $request)
    {
        // if(!Auth::user()->permission('users.profile-update')){
        //     return back()->with('warning','You Dont Have Access');
        // }

        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255', 
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        if($user == false){  
           return back()->with('error','Record Not Found');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
          $user->password =  Hash::make($request->password);
        }

        $user->save();
        return back()->with('success','Record Updated');

    }


    
}
