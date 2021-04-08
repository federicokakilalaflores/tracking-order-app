<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = "tblcategory"; 
    protected $primaryKey = "fldCategoryID";
    public $timestamps = false;

    public static function saveCategory($id = null){

        if($id){
            $category = self::find($id);
        }else{
             $category = new self; 
        }
        
        $category->fldCategoryName = Request::get('name');
        $category->fldCategoryDescription = Request::get('description');
        $category->save(); 

    }

}
