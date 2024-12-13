<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
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

class CompanyController extends Controller
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

            $query = User::join('companies','companies.user_id','=','users.id');

            $query->where('users.role_id',2);

            if($request->has('status') && $request->status != ''){
                $query->where('users.status',$request->status);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('companies.name','like','%'.$search.'%')
                   ->orwhere('users.name','like','%'.$search.'%');
                //    ->orwhere('company_name','like','%'.$search.'%')
                //    ->orwhere('customer_phone','like','%'.$search.'%')
                //    ->orwhere('country','like','%'.$search.'%')
                //    ->orwhere('city','like','%'.$search.'%')
                //    ->orwhere('state','like','%'.$search.'%')
                //    ->orwhere('postal_code','like','%'.$search.'%')
                //    ->orwhere('street_address','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
              'companies.*',
              'users.id as userid',
              'users.name as username',
              'users.email as useremail',
              
            ])
            ->orderBy('companies.created_at','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-success" href="'.URL::to('/admin/companies/logged/'.Crypt::encryptString($value->userid)).'">Logged As</a>';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/companies/'.Crypt::encryptString($value->userid)).'">View</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/companies/'.Crypt::encryptString($value->userid)).'">Delete</a>';

                $action .= '</div>';

                $status = $value->status ? 'checked' : '';

                array_push($data,[
                    $action,
                    "<div class='switchery-demo'>
                    <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
                    </div>",
                    $value->userid,
                    $value->username,
                    $value->useremail,
                    $value->name,
                    date('d-m-Y', strtotime($value->created_at)),
                ]); 

            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                'data'=> $data,
            ]);
        }

        return view('admin.companies.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        return view('admin.companies.create');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

    
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

        Company::create([
            'name' => $request->company_name,
            'user_id' => $user->id,
        ]);
        
        
        return redirect('/admin/companies')->with('success','Record Created Success'); 
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {
        
        $user = User::find(Crypt::decryptString($id));
        if($user == false){  
            return back()->with('error','Record Not Found');
        }

        $data = [
            'user' => $user,
        ];

        return view('admin.companies.view',$data);

    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logged(Request $request,$id)
    {
        
        $user = User::find(Crypt::decryptString($id));
        if($user == false){  
            return back()->with('error','Record Not Found');
        }

        Auth::login($user);
        return redirect(URL::to('admin/dashboard'))->with('success', 'Logged in as ' . $user->name);
    }

    


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        $data = User::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }

    }


    
}
