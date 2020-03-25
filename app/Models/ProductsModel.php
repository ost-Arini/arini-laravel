<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    //biar semua field ini bisa diisi berbarengan dalam 1 klik tombol submit
    protected $fillable = ['product_name','product_image','product_type'];

    public function getProductlist() {
        return $this->select()->where('delete_flag',0)->get()->toArray();
    }
}
