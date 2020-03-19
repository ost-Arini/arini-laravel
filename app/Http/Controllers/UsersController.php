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
    }

    // public function profile_edit(Users $users){
    //     return view('users.profileedit', compact('users'));
    // }

    public function profile_edit(Request $request, $user_id) {
        if ($request->isMethod('get')) 
        {
            //view profile page only
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            return view('users/edit', ['user_id'=>$user_id, 'userdata'=>$user_data]);
        } 
        if($request->isMethod('post')) {
            // if post
            //disni baru update user]
            // $user_update = DB::table('users')->where('id', 1)->update();
            $input = $request->input();
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            return view('users/confirm', ['user_id'=>$user_id, 'input'=>$input, 'userdata'=>$user_data]);
            // return redirect()->route('confirm', ['user_id'=>$user_id, 'input'=>$input]);
            // return view('users/confirm');
        }
    }
    //confirmation abis di masukin usersnya
    public function profile_edit_confirm(Request $request, $user_id) {
    //post
    }

   
}

