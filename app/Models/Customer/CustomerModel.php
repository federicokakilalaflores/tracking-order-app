<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Request;
use Str;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = "tblcustomer";
    protected $primaryKey = "fldcustomerid";
    public $timestamps = false;

    public static function saveCustomer($id = null){
      
        if($id){
           $customer = self::find($id);
        }else{
           $customer = new self;
        }

        $customer->fldcustomerfirstname = Request::get('firstname');
        $customer->fldcustomermiddlename = Request::get('middlename');
        $customer->fldcustomerlastname = Request::get('lastname');
        $customer->fldcustomeremail = Request::get('email');
        $customer->fldcustomercontactnumber = Request::get('contact_number');
        $customer->fldcustomeraddress = Request::get('address');
        $customer->fldcustomeragentid = Request::get('agent');
        $customer->save();
    }

}
