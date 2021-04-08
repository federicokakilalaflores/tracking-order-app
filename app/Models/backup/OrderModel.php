<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = "tblorder";
    protected $primaryKey = "fldOrderID"; 
    public $timestamps = false;

    public static function generateTrackingNumber($length, $seed){
        $token = "TRN-"; 
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);      // Call once. Good since $application_id is unique.

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;  
    }

    public static function saveOrder($id = null){

        if($id){ 
            $order = self::find($id);
        }else{
             $order = new self;  
        }
        
        $latestOrder = self::orderBy('fldOrderCreatedAt','DESC')->first();

        $order->fldOrderNumber = $latestOrder ? '#ORN'.str_pad($latestOrder->fldOrderID + 1, 8, "0", STR_PAD_LEFT): '#ORN'.str_pad(1, 8, "0", STR_PAD_LEFT);      
        $order->fldOrderQuantity = Request::get('quantity');
        $order->fldOrderDateReceived = Request::get('date_received'); 
        $order->fldOrderCustomerID = Request::get('customer_id');
        $order->fldOrderProductID = Request::get('product_id');
        $order->fldOrderAgentID = Request::get('agent_id');
        $order->fldOrderTrackNumber =  $latestOrder ? self::generateTrackingNumber(9,$latestOrder->fldOrderID) : self::generateTrackingNumber(9,1); 
        $order->fldOrderStatus = 1;  
        $order->fldOrderCustomPrice = Request::get('custom_price') ?  Request::get('custom_price'): NULL;     
        $order->save(); 

    }

    public static function updateStatus(){
        $orders = self::where('fldOrderTrackNumber', '=', Request::get('number'))->get();
       
        foreach($orders as $order){
            $order->fldOrderStatus = Request::get('status');
            $order->save();  
        }
    }



}
