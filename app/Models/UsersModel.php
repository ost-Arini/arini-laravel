<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    //biar semua field ini bisa diisi berbarengan dalam 1 klik tombol submit
    protected $fillable = ['user_name','email','real_name','password','birthday','gender'];

    public function getUserlist() {
        return $this->select()->get()->toArray();
    }
}
