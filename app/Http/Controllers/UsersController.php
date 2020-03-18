<?php

//App walaupun di foldernya pake huruf kecil, tapi karena udah di namespace jadi harus pake huruf besar
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\UsersModel as Users;
use Auth;

class UsersController extends Controller
{
    public function index(Request $request) {
        //manggil class, pake new
        $user = new Users();
        $data = $user->getUserlist();
        return view('users/users', ['userlist'=>$data]);
    }

    // public function profile(){
    //     // $id = $_SESSION['user_id'];
    //     $users = DB::table('users')->where('user_id',);
    //     return view('users/profile', ['users' => $users]);
    // }

    //Users ini adalah user yg udah login, dijadiin variabel $users
    public function show(Users $users){
        //di compact dijadiin data
        return view('users.profile', compact('users'));
        // $users = Auth::users();
        // return view('layouts.app', compact('users'));
        // return $users;
    }
}
