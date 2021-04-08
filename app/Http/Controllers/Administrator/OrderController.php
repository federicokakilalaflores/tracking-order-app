<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\TrackOrderStatusModel;
use App\Models\OrderModel;
use App\Models\Role\RoleModel;
use App\Models\Customer\CustomerModel;
use Session;
use Crypt;
use View;
use Redirect;
use Request;

class OrderController extends Controller
{
    public function __construct()
    {
        //check if admin login
        $this->middleware(function ($request, $next) {
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
                    if(!in_array("order",$admin_role)) {
                      Session::flash('error','You dont have access to this page.');
                      return Redirect::to('/administrator/dashboard');
                    }
                }
                $active_page = "dashboard";
                View::share(compact('active_page','admin_role','administrator'));

                return $next($request);
            }
        }, ['except' => array('authenticate','logout')]);
    }

    public function index(){
         $active_page = "order";
         // $customers = UserModel::where('fldUserRoles', '3')->get();
         $customers = array();
         $customerss = CustomerModel::where('fldcustomerachive','=','1')->get();
         foreach ($customerss as $customer) {
           $agent = UserModel::find($customer->fldcustomeragentid);
           $customer->agent = $agent->fldUserFirstname.' '.$agent->fldUserMiddlename.' '.$agent->fldUserLastname;
           $customer->customerName = $customer->fldcustomerfirstname.' '.$customer->fldcustomermiddlename.' '.$customer->fldcustomerlastname;
           $customers[] = $customer;
         }

         $products = ProductModel::all();
         $agents = UserModel::where('fldUserRoles', '2')->where('fldUserStatus', 'active')->get();
        return view('administrator.order.orders', compact('customers', 'products', 'agents', 'active_page'));
    }

    public function getOrderList(){
        $orderList = OrderModel::all();
        // dd(unserialize($orderList[0]->fldOrderProductID));
        $orderResult = [];
        if ($this->userData->fldUserRoles == 1) {
          $orderList = OrderModel::all();
        } else {
          $orderList = OrderModel::join('tblcustomer','tblcustomer.fldcustomerid', '=', 'tblorder.fldOrderCustomerID') 
          ->where('tblorder.fldOrderAgentID','=',$this->userid)->get();
        }
          $orderResult = [];
            foreach($orderList as $order){

                $orderProduct = unserialize($order->fldOrderProductID);
                $orderQuantity = unserialize($order->fldOrderQuantity);
                $orderDateReceived = unserialize($order->fldOrderDateReceived);
                $orderCustomPrice = unserialize($order->fldOrderCustomPrice);
                $orderCustomer = CustomerModel::find($order->fldOrderCustomerID);
                $orderAgent = UserModel::find($order->fldOrderAgentID);
                $product = [];
                for($i=0; $i < count($orderProduct); $i++){
                    $product[] = ProductModel::join('tblcategory','tblproduct.fldProductCategoryID', '=', 'tblcategory.fldCategoryID')
                    ->where('fldProductID',$orderProduct[$i])->first();
                } 

                $order->fldOrderProductList = $product;
                $order->fldOrderQuantity = $orderQuantity;
                $order->fldOrderDateReceived = $orderDateReceived;
                $order->fldOrderCustomPrice = $orderCustomPrice;
                $order->fldOrderCustomerList =  $orderCustomer;
                $order->fldOrderAgentList =  $orderAgent;
                array_push($orderResult, $order);

            }
            return response()->json($orderResult);
    }

    public function create(){
        $customers = UserModel::where('fldUserRoles', '3')->get();
        $products = ProductModel::all();
        $agents = UserModel::where('fldUserRoles', '2')->get();
        return view('administrator.order.create_order', compact('customers', 'products', 'agents'));
    }

    public function store(){
        OrderModel::saveOrder();
        return back()->with("success", "Order Added Successfully!");
    }

    public function trackOrderPage(){
        $active_page = "track_order";
        return view('administrator.order.track_orders', compact('active_page'));
    }

    public function showTrackOrder($id){

        $order = OrderModel::find($id);

            $orderProduct = unserialize($order->fldOrderProductID);
            $orderQuantity = unserialize($order->fldOrderQuantity);
            $orderDateReceived = unserialize($order->fldOrderDateReceived);
            $orderCustomPrice = unserialize($order->fldOrderCustomPrice);
            $orderCustomer = CustomerModel::find($order->fldOrderCustomerID);
            $orderAgent = UserModel::find($order->fldOrderAgentID);
            $product = [];
            for($i=0; $i < count($orderProduct); $i++){
                $product[] = ProductModel::join('tblcategory','tblproduct.fldProductCategoryID', '=', 'tblcategory.fldCategoryID')
                ->where('fldProductID',$orderProduct[$i])->first();
            }

            $order->fldOrderProductList = $product;
            $order->fldOrderQuantity = $orderQuantity;
            $order->fldOrderDateReceived = $orderDateReceived;
            $order->fldOrderCustomPrice = $orderCustomPrice;
            $order->fldOrderCustomerList =  $orderCustomer;
            $order->fldOrderAgentList =  $orderAgent;

        return view('administrator.order.show_track_order', compact('order'));
    }

    public function updateOrderStatus(){
        OrderModel::updateStatus();
        $status = Request::get('status') == 2 ? 'Received' : 'Delivering';
        return response()->json(["success" => "Order Status was Set to " . $status]);
    }

}
