<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\Role\RoleModel;
use App\Models\CategoryModel;
use Request;
use DB;
use Session;
use Crypt;
use View;
use Redirect;


class RoleController extends Controller
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
                $roles = RoleModel::where('fldroleid','=',$administrator->fldUserRoles)->first();
                if($roles) {
                    $admin_role = unserialize($roles->fldroleaccess);
                    if(!in_array("roles",$admin_role)) {
                      if ($administrator->fldUserRoles != 1) {
                        Session::flash('error','You dont have access to this page.');
                        return Redirect::to('/administrator/dashboard');
                      }
                    }
                }

                $active_page = "roles";
                View::share(compact('active_page','admin_role','administrator'));
                return $next($request);
            }
        }, ['except' => array('authenticate','logout')]);
    }

    public function index(){
        $roles = RoleModel::all();
        foreach($roles as $roless) {
           $access = "";
           $access_array = unserialize($roless->fldroleaccess);
           if ($access_array) {
             if(count($access_array) >=1) {
                 foreach($access_array as $accessRec) {
                    $access .= $accessRec . ", ";
                 }
             }
           $roless->fldroleaccess = substr($access,0,strlen($access)-2);
         }else {
           $roless->fldroleaccess = null;
         }
        }
        return view('administrator.role.role',compact('roles'));
    }
    public function addnewroles(){

        return view('administrator.role.add');
    }
    public function updateRoles($roleid){
        $roles = RoleModel::find($roleid);
        $roles->fldroleaccess = unserialize($roles->fldroleaccess);
        return view('administrator.role.add',compact('roles'));
    }
    public function store(){
        RoleModel::saveRole(Request::get('roleid'));
        return redirect::to('/administrator/role');
    }

}
