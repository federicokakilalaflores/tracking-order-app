<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Request;
use Str;

class UserModel extends Model
{
    use HasFactory;
    protected $table = "tbluser";
    protected $primaryKey = "fldUserID";
    public $timestamps = false;

    protected $fillable = [
        'fldUserEmail',
        'fldUserPassword',
    ];

    public static function rules(){
        return [
            'lastname' => 'required|max:255',
            'middlename' => 'max:255',
            'firstname' => 'required|max:255',
            'contact_number' => 'required|min:8|max:12',
            'email' => 'required|email',
            'address' => 'required',
            'roles' => 'required',
            'status' => 'required',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required|min:8|max:255'
        ];
    }

    public static function saveUser($id = null){
        if($id){
            $user = self::find($id);
        }else{
             $user = new self;
        }

        $user->fldUserLastname = Request::get('lastname');
        $user->fldUserFirstname = Request::get('firstname');
        $user->fldUserMiddlename = Request::get('middlename');
        $user->fldUserContactNumber = Request::get('contact_number');
        $user->fldUserEmail = Request::get('email');
        $user->fldUserAddress = Request::get('address');
        $user->fldUserRoles = Request::get('roles');
        $user->fldUserStatus = Request::get('status');
        $user->fldUserPassword = Hash::make(Request::get('password'));
        $user->remember_token = Str::random(10);
        $user->save();
    }

}
