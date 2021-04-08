<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel; 
use App\Models\OrderModel; 
use App\Models\TrackOrderStatusModel; 
use Session;
use Crypt;
use View;
use Redirect;

class TrackStatusController extends Controller
{
    public function store(){  
        TrackOrderStatusModel::saveTrackStatus(); 
        return back()->with("success", "Order Status Added Successfully!");  
    }

    public function getTrackStatus($id){ 
        $status = TrackOrderStatusModel::where('fldTrackStatusOrderID', $id)->orderBy('fldTrackStatusCreatedAt', 'DESC')->get(); 
        return response()->json($status);  
    } 

    public function destroy($id){
        TrackOrderStatusModel::destroy($id);
        return back()->with("success", "Order Status Deleted Successfully!");  
    }

}
