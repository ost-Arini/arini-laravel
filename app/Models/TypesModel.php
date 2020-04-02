<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypesModel extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'type_id';

    protected $fillable = ['type_name'];

    public $timestamps = false; //biar ga otomatis updated at

    public function getTypeslist() {
        return $this->select()->get()->toArray();
    }
}
