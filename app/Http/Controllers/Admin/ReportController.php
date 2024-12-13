<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Mpdf\Tag\Select;

class ReportController extends Controller
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
    public function jobtracking(Request $request)
    {

        // if($request->ajax()){

        //     $query = Challan::join('customers','customers.id','=','delivery_challans.customer_id')
        //     ->join('consignments','consignments.id','=','delivery_challans.consignment_id');

        //     //Search
        //     if($request->has('status') && $request->status != ''){
        //         $query->where('delivery_challans.status',$request->status);
        //     }

        //     if($request->has('job_number') && $request->job_number != ''){
        //         $query->where('consignments.job_number',explode('/',$request->job_number)[0]);
        //     }

        //     if($request->has('company_name') && $request->company_name != ''){
        //         $query->where('customers.company_name','like','%'.$request->company_name.'%');
        //     }

        //     if($request->has('customer_name') && $request->customer_name != ''){
        //         $query->where('customers.customer_name','like','%'.$request->customer_name.'%');
        //     }

        //     if($request->has('lc_no') && $request->lc_no != ''){
        //         $query->where('consignments.lc_no',$request->lc_no);
        //     }

            

        //     $search = $request->get('search');
        //     if($search != ""){
        //        $query = $query->where(function ($s) use($search) {
        //            $s->where('customers.customer_name','like','%'.$search.'%')
        //            ->orwhere('customers.company_name','like','%'.$search.'%')
        //            ->orwhere('consignments.lc_no','like','%'.$search.'%');                   
        //        });
        //     }
            
        //     $count = $query->count();
            
            
        //     $users = $query->skip($request->start)
        //     ->select([
        //         'delivery_challans.*',
        //         'consignments.job_number_prefix',
        //         'consignments.invoice_value',
        //         'consignments.lc_no',
        //         'customers.customer_name',
        //         'customers.company_name',
        //     ])
        //     ->take($request->length)
        //     ->orderBy('delivery_challans.id','desc')
        //     ->get();


        //     $data = [];
        //     foreach ($users as $key => $value) {

        //         $action = '<div class="text-end">';

        //             $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Print</a>';
                    
        //             $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Delete</a>';

        //         $action .= '</div>';

        //         $status = $value->status ? 'checked' : '';
                

        //         array_push($data,[
        //             $value->id,
        //             date('d-m-Y', strtotime($value->created_at)),
        //             $value->job_number_prefix,
        //             $value->customer->company_name,
        //             $value->customer->customer_name,
        //             $value->invoice_value,
        //             $value->lc_no,
        //             "<div class='switchery-demo'>
        //              <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
        //             </div>",
        //             $action,
        //         ]);        
        //     }

        //     return response()->json([
        //         "draw" => $request->draw,
        //         "recordsTotal" => $count,
        //         "recordsFiltered" => $count,
        //         'data'=> $data,
        //     ]);
        // }


        $consignments = Consignment::all();

        return view('admin.reports.jobtracking',compact('consignments'));

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function jobstatus(Request $request)
    {

        // if($request->ajax()){

        //     $query = Challan::join('customers','customers.id','=','delivery_challans.customer_id')
        //     ->join('consignments','consignments.id','=','delivery_challans.consignment_id');

        //     //Search
        //     if($request->has('status') && $request->status != ''){
        //         $query->where('delivery_challans.status',$request->status);
        //     }

        //     if($request->has('job_number') && $request->job_number != ''){
        //         $query->where('consignments.job_number',explode('/',$request->job_number)[0]);
        //     }

        //     if($request->has('company_name') && $request->company_name != ''){
        //         $query->where('customers.company_name','like','%'.$request->company_name.'%');
        //     }

        //     if($request->has('customer_name') && $request->customer_name != ''){
        //         $query->where('customers.customer_name','like','%'.$request->customer_name.'%');
        //     }

        //     if($request->has('lc_no') && $request->lc_no != ''){
        //         $query->where('consignments.lc_no',$request->lc_no);
        //     }

            

        //     $search = $request->get('search');
        //     if($search != ""){
        //        $query = $query->where(function ($s) use($search) {
        //            $s->where('customers.customer_name','like','%'.$search.'%')
        //            ->orwhere('customers.company_name','like','%'.$search.'%')
        //            ->orwhere('consignments.lc_no','like','%'.$search.'%');                   
        //        });
        //     }
            
        //     $count = $query->count();
            
            
        //     $users = $query->skip($request->start)
        //     ->select([
        //         'delivery_challans.*',
        //         'consignments.job_number_prefix',
        //         'consignments.invoice_value',
        //         'consignments.lc_no',
        //         'customers.customer_name',
        //         'customers.company_name',
        //     ])
        //     ->take($request->length)
        //     ->orderBy('delivery_challans.id','desc')
        //     ->get();


        //     $data = [];
        //     foreach ($users as $key => $value) {

        //         $action = '<div class="text-end">';

        //             $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Print</a>';
                    
        //             $action .= '<a class="delete_btn mx-1 btn btn-danger" data-id="'.URL::to('admin/delivery-challans/'.Crypt::encryptString($value->id)).'">Delete</a>';

        //         $action .= '</div>';

        //         $status = $value->status ? 'checked' : '';
                

        //         array_push($data,[
        //             $value->id,
        //             date('d-m-Y', strtotime($value->created_at)),
        //             $value->job_number_prefix,
        //             $value->customer->company_name,
        //             $value->customer->customer_name,
        //             $value->invoice_value,
        //             $value->lc_no,
        //             "<div class='switchery-demo'>
        //              <input ".$status." data-id='".Crypt::encryptString($value->id)."' type='checkbox' class=' is_status js-switch' data-color='#009efb'/>
        //             </div>",
        //             $action,
        //         ]);        
        //     }

        //     return response()->json([
        //         "draw" => $request->draw,
        //         "recordsTotal" => $count,
        //         "recordsFiltered" => $count,
        //         'data'=> $data,
        //     ]);
        // }


        $consignments = Consignment::all();

        return view('admin.reports.jobstatus',compact('consignments'));

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function customerstatement(Request $request)
    {

        
        $consignments = Consignment::all();
        return view('admin.reports.customerstatement',compact('consignments'));

    }

    

    
    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {


        if(request()->job_number != ''){

            

            $consignment = Consignment::where('job_number_prefix',request()->job_number)->first();
            if(!$consignment){
                return back()->with('warning','Consignment Not Found');
            }

            if($consignment->challan){
                return back()->with('warning','Challan Is Already Generated');
            }
            $data = [
                'model' => $consignment,
            ];
            
            return view('admin.delivery-challans.create',$data);
        }
      

        return view('admin.delivery-challans.create');
       
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

       $challan = Challan::create([
            "consignment_id" => $request->consignment_id,
            "customer_id" => $request->customer_id, 
            'status' => 1,
            'created_by' => Auth::user()->id,
        ]);

        return redirect('/admin/delivery-challans')->with('success','Record Created Success'); 
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $model = Consignment::find(Crypt::decryptString($id));
        if($model == false){  
            return back()->with('error','Record Not Found');
         }


         $data = [
            'customers' => Customer::where('status',1)->get(),
            'model' => $model,
            'currencies' => Currency::DATA,
        ];

        return view('admin.consignments.edit',$data);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function show(Request $request,$id)
    {

        // $model = Challan::find(Crypt::decryptString($id));
        // if($model == false){  
        //   return back()->with('error','Record Not Found');
        // }

        $data = [
            // 'model' => $model,
        ];

        return view('admin.delivery-challans.print',$data);
  
    }



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {
        $id = Crypt::decryptString($id);
        $model = Consignment::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $model->customer_id = $request->customer_id;
        $model->blawbno = $request->blawbno;
        $model->lcbtitno = $request->lcbtitno;
        $model->description = $request->description;
        $model->invoice_value = $request->invoice_value;
        $model->currency = $request->currency;
        $model->machine_number = $request->machine_number;


        $model->your_ref = $request->your_ref;
        $model->port = $request->port;
        $model->eiffino = $request->eiffino;
        $model->import_exporter_messers = $request->import_exporter_messers;
        $model->consignee_by_to = $request->consignee_by_to;
        $model->freight = $request->freight;
        $model->ins_rs = $request->ins_rs;
        $model->us = $request->us;
        $model->lc_no = $request->lc_no;
        $model->vessel = $request->vessel;
        $model->igmno = $request->igmno;
        $model->port_of_shippment = $request->port_of_shippment;
        $model->country_origion = $request->country_origion;
        $model->rate_of_exchange = $request->rate_of_exchange;
        $model->master_agent = $request->master_agent;
        $model->due_date = $request->due_date;
        $model->gross = $request->gross;
        $model->nett = $request->nett;
        $model->demands_received = $request->data ? json_encode($request->data) : null;
        $model->documents = $request->documents ? json_encode($request->documents) : null;

        $model->save();


        return back()->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {

        $data = Challan::find(Crypt::decryptString($id));
        if($data == false){
            return response()->json(['message' => 'Record Not Found'],400);
        }else{
            $data->delete();
            return response()->json(['message' => 'Record Not Deleted'],200);
        }


    }


    
}

