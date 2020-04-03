<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    //biar semua field ini bisa diisi berbarengan dalam 1 klik tombol submit
    protected $fillable = ['product_name','product_image','product_type','stock'];

    //
    public function getProductlist($type = null) {

        if($type != ''){
            return $this->join('types', 'products.product_type', '=', 'types.type_id')->select()->where('delete_flag',0)->where('product_type',$type)->get()->toArray();
        } else{
            return $this->join('types', 'products.product_type', '=', 'types.type_id')->select()->where('delete_flag',0)->get()->toArray();
        }
    }
}
