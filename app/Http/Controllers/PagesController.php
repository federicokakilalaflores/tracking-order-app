<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\TrackOrderStatusModel;
use App\Models\OrderModel;
use Session;
use Crypt;
use View;
use Redirect;

class PagesController extends Controller
{
    public function index(){
        return view('tracking');
    }

    public function getOrderByTrackNumber($number){

        $result = [];

        // $order = OrderModel::join('tblproduct','tblproduct.fldProductID', '=', 'tblorder.fldOrderProductID')
        // ->join('tbluser','tbluser.fldUserID', '=', 'tblorder.fldOrderCustomerID')
        // ->join('tblcategory','tblcategory.fldCategoryID', '=', 'tblproduct.fldProductCategoryID')
        // ->where('fldOrderTrackNumber', $number)->where('fldOrderStatus', '1')
        // ->first();

        $order = OrderModel::where('fldOrderTrackNumber', $number)->where('fldOrderStatus', '1')
        ->first();

        if(!$order){
            return response()->json();   
        }else{ 
            $product = array();
            foreach (unserialize($order->fldOrderProductID) as $orderdata) {
            $products = ProductModel::find($orderdata);
            array_push($product,$products);
            }
            // dd($order);
            $status = OrderModel::join('tbltrackstatus', 'tbltrackstatus.fldTrackStatusOrderID', '=', 'tblorder.fldOrderID')
            ->where('fldOrderTrackNumber', $number)->where('fldOrderStatus', '1')->orderBy('fldTrackStatusDate', 'DESC')->get();

            $agent = OrderModel::join('tbluser','tbluser.fldUserID', '=', 'tblorder.fldOrderAgentID')
            ->where('fldOrderTrackNumber', $number)->where('fldOrderStatus', '1')
            ->first();

            array_push($result, $product);
            array_push($result, $status);
            array_push($result, $agent);
            array_push($result, $order->fldOrderTrackNumber);

            return response()->json($result);
        }
    }

}
