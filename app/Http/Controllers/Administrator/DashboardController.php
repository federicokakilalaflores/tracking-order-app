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


class DashboardController extends Controller
{

    public function __construct(){

        //check if admin login
        $this->middleware(function ($request, $next) {
            if(!Session::has('adminuserID')) {
                return Redirect::to('/administrator');
            }
             else {
                $decrypt_id = explode("_",Crypt::decryptString(Session::get('adminuserID')));
                $this->userid = $decrypt_id[0];
                $administrator = UserModel::find($this->userid);
                $this->userData = $administrator;
                $active_page = "dashboard";
                View::share(compact('active_page','administrator'));

                $roles = RoleModel::where('fldroleid','=',$administrator->fldUserRoles)->first();
                $admin_role = unserialize($roles->fldroleaccess);

                $active_page = "dashboard";
                View::share(compact('active_page','admin_role','administrator'));

                return $next($request);
            }
        });
        // }, ['except' => array('loginForm','authenticate','logout')]);
    }

   public function index(){

        $active_page = "dashboard";
        $countorder = [];
        if ($this->userData->fldUserRoles == 1) {
          $orderList = OrderModel::orderBy('fldOrderCreatedAt', 'DESC')->limit(10)->get(); 
          $totalCustomer = CustomerModel::where('fldcustomerachive', '1')->count();
          $totalProduct = ProductModel::count('fldProductID');
          $totalOrder = OrderModel::count('fldOrderID');
          $totalDelivery = OrderModel::where('fldOrderStatus','=',1)->count(); 
        } else {
          $orderList = OrderModel::where('fldOrderAgentID','=',$this->userid)->orderBy('fldOrderCreatedAt', 'DESC')->limit(10)->get(); 
          $totalCustomer = OrderModel::where('fldOrderAgentID','=',$this->userid)->distinct('fldOrderCustomerID')->count();
          $totalProduct = ProductModel::count('fldProductID');
          $totalOrder = OrderModel::where('fldOrderAgentID',$this->userid)->count('fldOrderID');
          $totalDelivery = OrderModel::where('fldOrderStatus','=',1)->where('fldOrderAgentID',$this->userid)->count();
        } 
        $orders = [];

      
          
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
            array_push($orders, $order); 

          }
  
        return view('administrator.dashboard', compact('orders', 'totalCustomer', 'totalProduct', 'totalOrder', 'active_page', 'totalDelivery'));
    }



}
