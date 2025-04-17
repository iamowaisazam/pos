<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use App\Utilities\ConsigmentUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Mpdf\Tag\Select;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function customerLedger(Request $request)
    {

        if($request->ajax()){

            $query = Customer::query();

      

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('name','like','%'.$search.'%')
                   ->orwhere('email','like','%'.$search.'%')
                   ->orwhere('company_name','like','%'.$search.'%')
                   ->orwhere('phone','like','%'.$search.'%')
                   ->orwhere('country','like','%'.$search.'%')
                   ->orwhere('city','like','%'.$search.'%')
                   ->orwhere('state','like','%'.$search.'%')
                   ->orwhere('postal_code','like','%'.$search.'%')
                   ->orwhere('street_address','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'customers.*',
                DB::raw('(SELECT SUM(grandtotal) FROM sales WHERE sales.customer_id = customers.id) AS total_sales'),

                DB::raw('(SELECT SUM(debit) FROM transactions WHERE transactions.customer_id = customers.id) AS debitTran'),
                
                DB::raw('(SELECT SUM(credit) FROM transactions WHERE transactions.customer_id = customers.id) AS creditTran')
            ])
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/reports/customerLedgerDetail/'.Crypt::encryptString($value->id)).'">View</a>';

                $action .= '</div>';

                $total = $value->total_sales;
                $total = $total + $value->creditTran;
                $total = $total - $value->debitTran;

                array_push($data,[
                    $value->id,
                    $value->name,
                    $value->email,
                    $value->phone,
                    number_format($total,2),
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

        $data = [];
        return view('admin.reports.customerLedger',$data);

    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function customerLedgerDetail(Request $request,$id)
    {

        $data = [];
        $customer = Customer::find(Crypt::decryptString($id));
        if($customer == false){  
            return back()->with('error','Record Not Found');
        }


        if($request->ajax()){


                $sql = "select 
                        id, 
                        'sales' as type,
                        date,
                        'SaleInvoice' as description,
                        '0' as credit,
                        grandtotal as debit 
                        from sales 
                        WHERE customer_id =".$customer->id."

                        UNION
    
                        SELECT 
                            id, 
                            'trasaction' AS type, 
                            date, 
                            description, 
                            credit, 
                            debit 
                        FROM transactions 
                        WHERE customer_id = " . $customer->id . "
                        
                        ORDER BY date ASC
                            
                        ";
                $res = DB::select(DB::raw($sql));


                $runningBalance = 0;
                $data = [];
                foreach ($res as $key => $value) {

                    $action = '';

                    if($value->type == 'sales'){
                        $value->description = 'SaleInvoice-#'.$value->id;
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/saleinvoices/print/'.Crypt::encryptString($value->id)).'">View</a>';
                    }

                    if($value->type == 'trasaction'){
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/customer-transactions/'.Crypt::encryptString($value->id)).'/edit">View</a>';
                    }

                    // Convert values to numbers
                    $credit = floatval($value->credit);
                    $debit = floatval($value->debit);

                    // Calculate running balance
                    $runningBalance += $credit;
                    $runningBalance -= $debit;

                    array_push($data,[
                        $key + 1,
                        date('d-m-Y', strtotime($value->date)),
                        $value->description,
                        number_format($value->credit,2),
                        number_format($value->debit,2),
                        number_format($runningBalance),
                        $action
                    ]);  

                }

                return response()->json([
                    "draw" => $request->draw,
                    "recordsTotal" => count($data),
                    "recordsFiltered" => count($data),
                    'data'=> $data,
                ]);
                
        }

        $data['model'] = $customer;
        return view('admin.reports.customerLedgerDetail',$data);


    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function vendorLedger(Request $request)
    {

        if($request->ajax()){

            $query = Vendor::query();

      

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('name','like','%'.$search.'%')
                   ->orwhere('email','like','%'.$search.'%')
                   ->orwhere('company_name','like','%'.$search.'%')
                   ->orwhere('phone','like','%'.$search.'%')
                   ->orwhere('country','like','%'.$search.'%')
                   ->orwhere('city','like','%'.$search.'%')
                   ->orwhere('state','like','%'.$search.'%')
                   ->orwhere('postal_code','like','%'.$search.'%')
                   ->orwhere('street_address','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'vendors.*',
                DB::raw('(SELECT SUM(grandtotal) FROM purchases WHERE purchases.vendor_id = vendors.id) AS total_sales'),

                DB::raw('(SELECT SUM(debit) FROM transactions WHERE transactions.vendor_id = vendors.id) AS debitTran'),
                
                DB::raw('(SELECT SUM(credit) FROM transactions WHERE transactions.vendor_id = vendors.id) AS creditTran')
            ])
            ->orderBy('id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';

                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/reports/vendorLedgerDetail/'.Crypt::encryptString($value->id)).'">View</a>';

                $action .= '</div>';

                $total = $value->total_sales;
                $total = $total + $value->creditTran;
                $total = $total - $value->debitTran;

                array_push($data,[
                    $value->id,
                    $value->name,
                    $value->email,
                    $value->phone,
                    number_format($total,2),
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

        $data = [];
        return view('admin.reports.vendorLedger',$data);

    }

     /**
     * Create a new controller instance.
     * @return void
     */
    public function vendorLedgerDetail(Request $request,$id)
    {

        $data = [];
        $vendor = Vendor::find(Crypt::decryptString($id));
        if($vendor == false){  
            return back()->with('error','Record Not Found');
        }


        if($request->ajax()){


                $sql = "select 
                        id, 
                        'purchases' as type,
                        date,
                        'PurchaseInvoice' as description,
                        '0' as credit,
                        grandtotal as debit 
                        from purchases 
                        WHERE vendor_id =".$vendor->id."

                        UNION
    
                        SELECT 
                            id, 
                            'trasaction' AS type, 
                            date, 
                            description, 
                            credit, 
                            debit 
                        FROM transactions 
                        WHERE vendor_id = " . $vendor->id . "
                        
                        ORDER BY date ASC
                            
                        ";
                $res = DB::select(DB::raw($sql));


                $runningBalance = 0;
                $data = [];
                foreach ($res as $key => $value) {

                    $action = '';

                    if($value->type == 'purchases'){
                        $value->description = 'PurchaseInvoice-#'.$value->id;
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/purchaseinvoices/print/'.Crypt::encryptString($value->id)).'">View</a>';
                    }

                    if($value->type == 'trasaction'){
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/vendor-transactions/'.Crypt::encryptString($value->id)).'/edit">View</a>';
                    }

                    // Convert values to numbers
                    $credit = floatval($value->credit);
                    $debit = floatval($value->debit);

                    // Calculate running balance
                    $runningBalance += $credit;
                    $runningBalance -= $debit;

                    array_push($data,[
                        $key + 1,
                        date('d-m-Y', strtotime($value->date)),
                        $value->description,
                        number_format($value->credit,2),
                        number_format($value->debit,2),
                        number_format($runningBalance),
                        $action
                    ]);  

                }

                return response()->json([
                    "draw" => $request->draw,
                    "recordsTotal" => count($data),
                    "recordsFiltered" => count($data),
                    'data'=> $data,
                ]);
                
        }

        $data['model'] = $vendor;
        return view('admin.reports.vendorLedgerDetail',$data);


    }


      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function saleReport(Request $request)
    {

        if($request->ajax()){

            $query = Sale::Leftjoin('customers','customers.id','=','sales.customer_id');

         

            if($request->has('is_paid') && $request->is_paid != ''){
                $query->where('sales.is_paid',$request->is_paid);
            }

            if($request->has('customer') && $request->customer != ''){
                $query->where('customers.id',$request->customer);
            }

            if($request->has('sdate') && $request->sdate != ''){
                $query->where('sales.created_at','>=',$request->sdate);
            }

            if($request->has('edate') && $request->edate != ''){
                $query->where('sales.created_at','<=',$request->edate);
            }

            if($request->has('tracking_id') && $request->tracking_id != ''){
                $query->where('sales.tracking_id',$request->tracking_id);
            }

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('sales.ref','like','%'.$search.'%')
                   ->orwhere('customers.name','like','%'.$search.'%')
                   ->orwhere('sales.tracking_id','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'sales.*',
                'customers.name',
            ])
            ->orderBy('sales.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';
                $action .= '<a target="_blank" class="mx-1 btn btn-success" href="'.URL::to('/admin/saleinvoices/print/'.Crypt::encryptString($value->id)).'">Print</a>';
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

        $data['customers'] = Customer::where([
            'status'=>1,
      
        ])->get();

        return view('admin.reports.saleReport',$data);
    }
    

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function purchaseReport(Request $request)
    {

        if($request->ajax()){

            $query = Purchase::Leftjoin('vendors','vendors.id','=','purchases.vendor_id');

          

            if($request->has('is_paid') && $request->is_paid != ''){
                $query->where('purchases.is_paid',$request->is_paid);
            }

            if($request->has('vendor') && $request->vendor != ''){
                $query->where('vendors.id',$request->vendor);
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
                'vendors.name',
            ])
            ->orderBy('vendors.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-end">';
                $action .= '<a target="_blank" class="mx-1 btn btn-success" href="'.URL::to('/admin/purchaseinvoices/print/'.Crypt::encryptString($value->id)).'">Print</a>';
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

        return view('admin.reports.purchaseReport',$data);
    }

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function inventoryReport(Request $request)
    {

        if($request->ajax()){

            $query = Product::join('categories','categories.id','=','products.category_id')
            ->join('units','units.id','=','products.unit_id');

          

            $search = $request->get('search');
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('products.title','like','%'.$search.'%')
                   ->orwhere('products.sku','like','%'.$search.'%')
                   ->orwhere('categories.title','like','%'.$search.'%')
                   ->orwhere('units.title','like','%'.$search.'%')
                   ->orwhere('products.short_description','like','%'.$search.'%');
               });
            }
            
            $count = $query->count();       
            $users = $query->skip($request->start)
            ->take($request->length)
            ->select([
                'products.*',
                'units.title as unit_name',
                'categories.title as category_name',
                DB::raw('(SELECT SUM(quantity) FROM sale_items WHERE sale_items.product_id = products.id) as total_sales'),
                DB::raw('(SELECT SUM(quantity) FROM purchase_items WHERE purchase_items.product_id = products.id) as total_purchases'),
                DB::raw('(
                    SELECT SUM(
                        CASE 
                            WHEN type = 1 THEN qty 
                            WHEN type = 0 THEN -qty 
                            ELSE 0 
                        END
                    ) FROM stockadjustments 
                    WHERE stockadjustments.product_id = products.id
                ) as total_adjustments'),
            ])
            ->orderBy('products.id','desc')
            ->get();

            $data = [];
            foreach ($users as $key => $value) {

                $action = '<div class="text-center">';
                $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/reports/inventoryReportDetail/'.Crypt::encryptString($value->id)).'">View</a>';
                $action .= '</div>';

                $total = 0;
                $total = $total + $value->total_purchases;
                $total = $total - $value->total_sales;
                $total = $total + $value->total_adjustments;

                
                array_push($data,[
                    $value->id,
                    $value->title.' - '.$value->sku,
                    $value->category_name,
                    $value->unit_name,
                    $total,
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
            'status'=> 1,
        ])->get();

        return view('admin.reports.inventoryReport',$data);
    }


    

   /**
     * Create a new controller instance.
     * @return void
     */
    public function inventoryReportDetail(Request $request,$id)
    {   
 

        if($request->ajax()){

            $id = Crypt::decryptString($id);
            $product = Product::find($id);

            $sql = "SELECT 
            purchase_id AS id, 
            CAST('purchase' AS CHAR) COLLATE utf8mb4_unicode_ci AS module,
            created_at AS date,
            CAST('Purchase Invoice' AS CHAR) COLLATE utf8mb4_unicode_ci AS description,
            CAST('0' AS SIGNED) AS stock_out,
            CAST(quantity AS SIGNED) AS stock_in
            FROM purchase_items 
            WHERE product_id = ".$product->id."

            UNION

            SELECT 
                sale_id AS id, 
                CAST('sale' AS CHAR) COLLATE utf8mb4_unicode_ci AS module, 
                created_at AS date, 
                CAST('Sale Invoice' AS CHAR) COLLATE utf8mb4_unicode_ci AS description,
                CAST(quantity AS SIGNED) AS stock_out,
                CAST('0' AS SIGNED) AS stock_in
            FROM sale_items 
            WHERE product_id = ".$product->id."

            UNION

            SELECT 
                id, 
                CAST('adjustment' AS CHAR) COLLATE utf8mb4_unicode_ci AS module,
                date, 
                CAST('Adjustment' AS CHAR) COLLATE utf8mb4_unicode_ci AS description,
                CAST(
                    CASE 
                        WHEN type = 0 THEN qty 
                        ELSE '0' 
                    END AS SIGNED
                ) AS stock_out,
                CAST(
                    CASE 
                        WHEN type = 1 THEN qty 
                        ELSE '0' 
                    END AS SIGNED
                ) AS stock_in
            FROM stockadjustments 
            WHERE product_id = ".$product->id."

        ORDER BY date ASC";
            
            $res = DB::select(DB::raw($sql));


            $balance = 0;
            $data = [];
            foreach ($res as $key => $value) {

                    $action = '';
                    $balance  = $balance + $value->stock_in;
                    $balance  = $balance - $value->stock_out;

                    if($value->module == 'adjustment'){
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/stockadjustment/'.Crypt::encryptString($value->id)).'/edit">View</a>';
                    }

                    if($value->module == 'purchase'){
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/purchaseinvoices/print/'.Crypt::encryptString($value->id)).'">View</a>';
                    }

                    if($value->module == 'sale'){
                      
                        $action .= '<a class="mx-1 btn btn-info" href="'.URL::to('/admin/saleinvoices/print/'.Crypt::encryptString($value->id)).'">View</a>';
                    }

                    array_push($data,[
                        $key + 1,
                        date('d-m-Y', strtotime($value->date)),
                        $value->description,
                        $value->stock_in,
                        $value->stock_out,
                        $balance,
                        $action
                    ]);  

            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                'data'=> $data,
            ]);

        }


        $data = [
            'model' => Product::find(Crypt::decryptString($id)),
        ];
    
        return view('admin.reports.inventoryReportDetail',$data);

    }



    


    


    
}

