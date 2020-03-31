<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsModel extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = 'transaction_id';

    protected $fillable = ['address','memo','transaction_date'];

    public function getTransactionslist() {
        return $this->select()->where('delete_flag',0)->get()->toArray();
    }

    public function getTranslist($transaction_id) {
        return $this->select()->where('transaction_id',$transaction_id)->where('delete_flag',0)->get()->toArray();
    }

    //select * from transaction
    //join detail_transaction on transaction.transaction_id = detail_transaction.transaction_id
    //where transaction.transaction_id = $transaction_id AND 
    //transaction.delete_flag = 0
    public function getDetailslist($transaction_id) {
        return $this
        ->join('detail_transaction','transaction.transaction_id', 'detail_transaction.transaction_id')
        ->join('products', 'detail_transaction.product_id', 'products.product_id')
        ->select()
        ->where('transaction.transaction_id', $transaction_id)
        ->where('transaction.delete_flag',0)
        ->get()->toArray();
    }
    
}
