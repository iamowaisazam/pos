<?php

namespace App\Utilities;

use App\Models\Consignment;
use App\Models\ConsignmentItem;
use App\Models\Payorder;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;


class PayorderUtility 
{


    static public function create($data=[
        "date" => '',
        "consignment_id" => '',
        "items" => '',
        "footer" => '',
        "created_by" => '',
    ]){

        $con = Consignment::find($data['consignment_id']);
        $order = Payorder::create([
            "consignment_details" => json_encode($con->toArray()),
            "date" => $data['date'],
            "consignment_id" => $data['consignment_id'],
            "items" => json_encode($data['items']),
            "footer" => json_encode($data['footer']),
            "header" => json_encode([]),
            "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
        ]);

        return $order;

    }


        
    static public function update($id,$data=[
        "date" => '',
        "consignment_id" => '',
        "items" => '',
        "footer" => '',
        "created_by" => '',
    ]){

       
        $con = Consignment::find($data['consignment_id']);
        $order = Payorder::where('id',$id)->update([
            "consignment_details" => json_encode($con->toArray()),
            "date" => $data['date'],
            "consignment_id" => $data['consignment_id'],
            "items" => json_encode($data['items']),
            "footer" => json_encode($data['footer']),
            "created_by" => User::where('status',1)->where('role_id',2)->inRandomOrder()->first()->id,
        ]);

        return $order;

    }











}