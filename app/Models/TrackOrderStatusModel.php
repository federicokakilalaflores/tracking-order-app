<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class TrackOrderStatusModel extends Model
{
    use HasFactory;
    protected $table = "tbltrackstatus";
    protected $primaryKey = "fldTrackStatusID";  
    public $timestamps = false; 

    public static function saveTrackStatus($id = null){

        if($id){ 
            $trackStatus = self::find($id); 
        }else{
             $trackStatus = new self;   
        }
        
        $trackStatus->fldTrackStatusDate =  Request::get('date'); 
        $trackStatus->fldTrackStatusPlace = Request::get('place'); 
        $trackStatus->fldTrackStatusMessage = Request::get('status'); 
        $trackStatus->fldTrackStatusOrderID = Request::get('order_id'); 
        $trackStatus->save(); 

    }

    

}
