<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\Role\RoleModel;
use App\Models\Customer\CustomerModel;

use DB;
use Request;
use Session;
use Crypt;
use View;
use Redirect;


class CustomerController extends Controller
{

    public function __construct()
    {
        //check if admin login
        $this->middleware(function ($request, $next) {
            // dd(Session::all());
            if(Session::has('adminuserID') == NULL) {
                return Redirect::to('/administrator');
            }
             else {
                $decrypt_id = explode("_",Crypt::decryptString(Session::get('adminuserID')));
                $this->userid = $decrypt_id[0];
                $administrator = UserModel::find($this->userid);
                $this->userData = $administrator;
                $roles = RoleModel::where('fldroleid','=',$administrator->fldUserRoles)->first();
                if($roles) {
                    $admin_role = unserialize($roles->fldroleaccess);
                    if(!in_array("customer",$admin_role)) {
                      Session::flash('error','You dont have access to this page.');
                      return Redirect::to('/administrator/dashboard');
                    }
                }
                $active_page = "customer";
                View::share(compact('active_page','admin_role','administrator'));

                return $next($request);
            }
        });
        // , ['except' => array('authenticate','logout')]);
    }

    public function index(){
        $customers = CustomerModel::where('fldcustomerachive','=','1')->get();
        foreach ($customers as $customerss) {
          $agent = UserModel::find($customerss->fldcustomeragentid);
          $customerss->agent = $agent->fldUserFirstname.' '.$agent->fldUserMiddlename.' '.$agent->fldUserLastname;
        }
        $users = UserModel::where('fldUserRoles','=','2')->get();
        return view('administrator.customer.customer', compact('customers','users'));
    }

    public function store(){
      // dd(request::all());
      CustomerModel::saveCustomer(request::get('customerid'));
      return back()->with('success','New customer successfully added.');
    }

    public function updateCustomer($customerid){
      $customer = CustomerModel::find($customerid);
      $users = UserModel::where('fldUserRoles','=','2')->get();
      $agent = UserModel::find($customer->fldcustomeragentid);

      return view('administrator.customer.includes.customerDetails', compact('customer','users'));
    }
    public function addCustomer(){
      $users = UserModel::where('fldUserRoles','=','2')->get();
      return view('administrator.customer.includes.customerDetails', compact('users'));
    }

    public function archiveCustomer($customerid){
      $customer = CustomerModel::find($customerid);
      $customer->fldcustomerachive = 2;
      $customer->save();

      return true;
    }

    public function getCustomerData(){
      $customer = CustomerModel::where('fldcustomerachive','=','1')->get();
      $customers = array();
      // try {
        foreach ($customer as $customerss) {
          $agent = UserModel::find($customerss->fldcustomeragentid);
          $customerss->agent = $agent->fldUserFirstname.' '.$agent->fldUserMiddlename.' '.$agent->fldUserLastname;
          $customerss->customerName = $customerss->fldcustomerfirstname.' '.$customerss->fldcustomermiddlename.' '.$customerss->fldcustomerlastname;
          $customers[] = $customerss;
        }

      // } catch (\Exception $e) {
        // dd($e->getMessage());
      // }

      return response()->json($customers);
    }

}
