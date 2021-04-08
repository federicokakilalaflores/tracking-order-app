<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\Role\RoleModel;
use Session;
use Crypt;
use View;
use Redirect;



class CategoryController extends Controller
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
                $roles = RoleModel::where('fldroleid','=',$administrator->fldUserRoles)->first();
                if($roles) {
                    $admin_role = unserialize($roles->fldroleaccess);
                    if(!in_array("product",$admin_role)) {
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
        $active_page = "category";
        return view('administrator.categories', compact('active_page'));
    }

    public function getCategoryList(){
        $categories = CategoryModel::all();
        return response()->json($categories);
    }

    public function store(){
        CategoryModel::saveCategory();
        return back()->with("success", "Category Added Successfully!");
    }

    public function show($id){
        $category =  CategoryModel::find($id);
        return response()->json($category);
    }

    public function update($id){
        CategoryModel::saveCategory($id);
        return back()->with("success", "Category Updated Successfully!");
    }

    public function destroy($id){
        CategoryModel::destroy($id);
        return response()->json(["success" => "Category Deleted Sucessfully!"]);
    }

}
