<?php

namespace App\Utilities;

use App\Models\Consignment;
use App\Models\ConsignmentItem;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ConsigmentUtility 
{

    
static public function get_job_number(){

    $Consignment = Consignment::select(['id','job_number','job_number_prefix'])
    ->orderBy('job_number','desc')->first();

    if($Consignment){
        $maxJobNumber = $Consignment->job_number + 1;
        return $maxJobNumber;
    }else{
        return '1';
    }   

}

static public function get_job_number_with_prefix(){

    $Consignment = Consignment::select(['id','job_number','job_number_prefix'])
    ->orderBy('job_number','desc')->get();

    if(count($Consignment) > 0){
        
        $maxJobNumber = intval($Consignment->first()->job_number) + 1;
        return $maxJobNumber.'/34-24';

    }else{
        return '1'.'/34-24';
    }   

}


static public function create_job($data){

    $job = Consignment::create([
        "job_number" => ConsigmentUtility::get_job_number(),
        "job_number_prefix" => ConsigmentUtility::get_job_number_with_prefix(),
        "customer_id" => $data['customer_id'],
        "exporter_id" => $data['exporter_id'],
        "description" => null,
        "currency" => $data['currency'],
        "job_date" => Carbon::now(),
        'status' => 1,
        'created_by' => $data['created_by'],
    ]); 

    return $job;
}



static public function update_consignment_item($id,$data){

    
    $qty = 0;
    $total = 0; 
    if(!empty($data)){
        $ids = array_column($data,'id');
        foreach($data as $key => $item){
            $product = Product::find($item['product_id']);
            if($item['id']){
                ConsignmentItem::where('id',$item['id'])->update([
                    'product_id' => $item['product_id'],
                    'consignment_id' =>$id,
                    'name' => $product->name,
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'unit' => $item['unit'],
                    'total' => $item['qty'] * $item['price'],
                ]);
            }else{
               $new_record = ConsignmentItem::create([
                    'product_id' => $item['product_id'],
                    'consignment_id' => $id,
                    'name' =>  $product->name,
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'unit' => $item['unit'],
                    'total' => $item['qty'] * $item['price'],
                    'status' => 1,
                ]);
                array_push($ids,$new_record->id);
            }

            $qty += $item['qty'];
            $total += $item['qty'] * $item['price'];
        }

        ConsignmentItem::where('consignment_id',$id)->whereNotIn('id',$ids)->delete();
    }else{
        ConsignmentItem::where('consignment_id',$id)->delete();
    }


    Consignment::where('id',$id)->update([
          "invoice_value" => $total,
          "total_quantity" => $qty,
    ]);

}



static public function update_consignment($id,$data){


    Consignment::where('id',$id)->update([
        "lcbtitno" =>  $data['lcbtitno'],
        "description" => null,
        "machine_number" => $data['machine_number'],
        "job_date" => $data['job_date'],
        'your_ref' => $data['your_ref'],
        
        'port' => $data['port'],
        'port_of_shippment' => $data['port'],
        'eiffino' => $data['eiffino'],

        'freight' => $data['freight'],
        'ins_rs' => $data['ins_rs'],
        'landing_charges' => $data['landing_charges'],
        'us' =>  $data['us'],
        'lc_no' => $data['lc_no'],
        'lc_date' => $data['lc_date'],
        'vessel' => $data['vessel'],
        'igmno' => $data['igmno'],
        'igm_date' => $data['igm_date'],
        "blawbno" => $data['blawbno'],
        "bl_awb_date" =>  $data['bl_awb_date'],
        
        'country_origion' => $data['country_origion'],
        'rate_of_exchange' => $data['rate_of_exchange'],
        'master_agent' => $data['master_agent'],
        'other_agent_agent' => $data['other_agent_agent'],
        'due_date' => $data['due_date'],
        'package_type' => $data['package_type'],
        'no_of_packages' => $data['no_of_packages'],
        'index_no' => $data['index_no'],
        'gross' => $data['gross'],
        'nett' => $data['nett'],
        'documents' => $data['documents'],
    ]);


}


static public function CreateChallanIntimation(){


}

static public function get_setting($name){

    $res = Setting::select('value')->where('field',$name)->first();
    if($res){
      return $res->value;
    }else{
       return false;         
    }
}





}