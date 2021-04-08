<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class RoleModel extends Model
{
    protected $table = "tblrole";
    protected $primaryKey = "fldroleid";
    public $timestamps = false;

    public static function saveRole($id = null){

        if($id){
            $roles = self::find($id);
        }else{
             $roles = new self;
        }

        $roles->fldrolename = Request::get('name');
        $roles->fldroleaccess = Request::has('access') ? serialize(Request::get('access')) : serialize([]);
        $roles->save();
    }

}
