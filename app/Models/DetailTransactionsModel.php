<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransactionsModel extends Model
{
    protected $table = 'detail_transaction';

    protected $primaryKey = 'detail_id';

    protected $fillable = ['product_id','quantity'];

}
