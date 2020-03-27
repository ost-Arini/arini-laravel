<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesModel extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'product_type';

    public function getTypeslist() {
        return $this->select()->get()->toArray();
    }
}
