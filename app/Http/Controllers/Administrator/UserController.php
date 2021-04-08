<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
// use Illuminate\Http\Request;
use App\Models\Role\RoleModel;
use Request;
use Validator;
use Session;
use Crypt;
use View;
use Redirect;


class UserController extends Controller
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
                    if(!in_array("user",$admin_role)) {
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
        $active_page = "user";
        $roles = RoleModel::all();
        return view('administrator.users', compact('active_page','roles'));
    }

    public function getUserList(){
        $user = UserModel::join('tblrole','tbluser.fldUserRoles','tblrole.fldroleid')->get();
        $users = array();
        foreach ($user as $user_data) {
          $user_data->actionID = $user_data->fldUserRoles;
          $users[] = $user_data;
        }
        return response()->json($users);
    }

    public function store(Request $request){

        if (!Request::has('userid')) {
          $validator = Validator::make(Request::all(), UserModel::rules());
            if ($validator->fails()) {
                return back()->with('error', "Please Fill up the fields correctly.")
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        UserModel::saveUser(Request::get('userid'));
        if(Request::has('userid')){
          return back()->with("success", "User Updated Successfully!");
        }else{
          return back()->with("success", "User Added Successfully!");
        }

    }
    public function deleteUserProcess($userid){
      $userdata = UserModel::find($userid);
      $userdata->delete();

      return true;
    }

    public function usetUpdate($userid){
      $userdata = UserModel::find($userid);
      $roles = RoleModel::all();
      return view('administrator.includes.userdetails',compact('userdata','roles'));
    }

}
