<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
// use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use Redirect;
use Crypt;
use View;

class AuthenticationController extends Controller
{


    public function loginForm(){
        return view('administrator.login_form');
    }

    public function authenticate(){

        $password = Request::get('password');
        $email = Request::get('email');
        $user_check = UserModel::where('fldUserEmail','=',$email)->count();
        if($user_check == 1){
            $user = UserModel::where('fldUserEmail','=',$email)->first();
            if(Hash::check($password,$user->fldUserPassword)){


              $encrypt_id = Crypt::encryptString($user->fldUserID."_TrackingApp");
              Session::put('adminuserID',$encrypt_id);
              return Redirect::to('/administrator/dashboard');


            }else{
              // Session::flash('error','Account doesnt exist.');
              return Redirect::to('/administrator')->with('error','Account doesnt exist.');
            }
        }else{
          // Session::flash('error','Account doesnt exist.');
          return Redirect::to('/administrator')->with('error','Account doesnt exist.');
        }

    }

    public function logout(){
        Session::flush();
        return Redirect::to('administrator');
    }


}
