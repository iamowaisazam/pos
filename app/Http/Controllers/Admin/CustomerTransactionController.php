<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Role;
use App\Models\SaleItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class CustomerTransactionController extends Controller
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

            $query = Transaction::Leftjoin('customers','customers.id','=','transactions.customer_id');

            $query->where('transactions.type','customer');
   

            if($request->has('customer') && $request->customer != ''){
                $query->where('customers.id',$request->customer);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('transactions.date','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('transactions.date','<=',$request->edate);
            }

        
            // $search = $request->get('search');
            // if($search != ""){
            //    $query = $query->where(function ($s) use($search) {
            //        $s->where('sales.ref','like','%'.$search.'%')
            //        ->orwhere('customers.customer_name','like','%'.$search.'%')
            //        ->orwhere('sales.tracking_id','like','%'.$search.'%');
            //    });
            // }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'transactions.*',
                'customers.name',
            ])
            ->orderBy('transactions.date','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/customer-transactions/'.Crypt::encryptString($value->id)).'/edit">Edit</a>';
                
                $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/customer-transactions/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                array_push($data,[
                    $value->id,
                    date('d-m-Y', strtotime($value->date)),
                    $value->name,
                    $value->description,
                    $value->debit,
                    $value->credit,
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

        $data['customers'] = Customer::where(['status'=>1])->get();

        return view('admin.customer-transactions.index',$data);
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function create(Request $request)
    {

        $data = [
            'customers' => Customer::all()
        ];
        return view('admin.customer-transactions.create',$data);

    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "date" => 'required|max:255',
            "customer" => 'required|exists:customers,id',
            "type" => 'required|in:debit,credit',
            "amount" => 'required|numeric|min:0.01',
            "description" => 'nullable|string|max:255',
            "details" => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        Transaction::create([
            'type' => 'customer',
            "date" => $request->date,
            "customer_id" => $request->customer,
            "debit" => $request->type == 'debit' ? $request->amount : 0,
            "credit" => $request->type == 'credit' ? $request->amount : 0,
            "description" => $request->description,
            "details" => $request->details
        ]);

        return redirect(URL::to('admin/customer-transactions/'))
        ->with('success','Record Successfully Created');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $data = [];
        $model = Transaction::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $data['model'] = $model;
        $data['customers'] = Customer::query()->get();

        return view('admin.customer-transactions.edit',$data);
    }

    
  


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {

        $id = Crypt::decryptString($id);
        $model = Transaction::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
        }

        $validator = Validator::make($request->all(), [
            "date" => 'required|max:255',
            "customer" => 'required|exists:customers,id',
            "type" => 'required|in:debit,credit',
            "amount" => 'required|numeric|min:0.01',
            "description" => 'nullable|string|max:255',
            "details" => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
            $model->date = $request->date;
            $model->type = 'customer';
            $model->customer_id = $request->customer;
            $model->debit = $request->type == 'debit' ? $request->amount : 0;
            $model->credit = $request->type == 'credit' ? $request->amount : 0;
            $model->description = $request->description;
            $model->details = $request->details;
            $model->save();

        return redirect(URL::to('admin/customer-transactions/'))
        ->with('success','Record Successfully Updated');

    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Transaction::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Deleted'],200);
        }

    }


    
}
