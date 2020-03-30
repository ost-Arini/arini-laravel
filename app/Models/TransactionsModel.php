<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsModel extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'transaction_id';

    protected $fillable = ['address','memo','transaction_date'];

    public function getTransactionslist() {
        return $this->select()->get()->toArray();
    }
}
