<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\Role\RoleModel;
use DB;
use Session;
use Crypt;
use View;
use Redirect;


class ProductController extends Controller
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
                    if(!in_array("product_categories",$admin_role)) {
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
        $active_page = "product";
        $categories = CategoryModel::all();
        return view('administrator.products', compact('categories', 'active_page'));
    }

    public function getProductList(){
        $products = ProductModel::join('tblcategory','tblproduct.fldProductCategoryID', '=', 'tblcategory.fldCategoryID')->get();
        return response()->json($products);
    }

    public function store(){
         ProductModel::saveProduct();
         return back()->with("success", "Product Added Successfully!");
    }

    public function destroy($id){
        ProductModel::destroy($id);
        return response()->json(["success" => "Product Deleted Sucessfully!"]);
    }

    public function show($id){
        $product =  ProductModel::join('tblcategory','tblproduct.fldProductCategoryID', '=', 'tblcategory.fldCategoryID')->where('tblproduct.fldProductID', $id)->first();
        return response()->json($product);
    }

    public function update($id){
        ProductModel::saveProduct($id);
        return back()->with("success", "Product Updated Successfully!");
    }

}
