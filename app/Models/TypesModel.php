<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesModel extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'type_id';

    public function getTypeslist() {
        return $this->select()->get()->toArray();
    }
}
