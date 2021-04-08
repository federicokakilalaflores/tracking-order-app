<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use File;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "tblproduct";
    protected $primaryKey = "fldProductID";
    public $timestamps = false;

    public static function saveProduct($id = null){

        if($id){
          $product = self::find($id);
        }else{
          $product = new self;
        }

        $product->fldProductName = Request::get('name');
        $product->fldProductDescription = Request::get('description');
        $product->fldProductPrice = Request::get('price');
        $product->fldProductCategoryID = Request::get('category_id');
        $product->save();

        $destinationPath = public_path()."/images/products";
        $microtime = microtime(true) * 1000;

        if(!File::exists($destinationPath)) {
           File::makeDirectory($destinationPath, $mode = 0777, true, true);
         }

         if (Request::file('product_image') !== null) {
            if (Request::has('product_image') && Request::file('product_image') != null) {
              $productImage = Request::file('product_image');
              $productImage_name = Request::get('name').'_'.$product->fldProductID .'_'.$microtime.$productImage->getClientOriginalExtension();
              $productImage->move($destinationPath, $productImage_name);
            }else {
              $productImage_name = null;
            }
            $product->fldProductImage = $productImage_name;
            $product->save();
          }


    }

}
