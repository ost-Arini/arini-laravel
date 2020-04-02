<?php

//App walaupun di foldernya pake huruf kecil, tapi karena udah di namespace jadi harus pake huruf besar
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\UsersModel as Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Auth;

class UsersController extends Controller
{
    
    public function index(Request $request) {
        //manggil class, pake new
        $user = new Users();
        $data = $user->getUserlist();
        return view('users/users', ['userlist'=>$data]);
    }

    //Users ini adalah user yg udah login, dijadiin variabel $users
    public function show(Users $users){
        //di compact dijadiin data
        return view('users/profile', compact('users'));
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
            $input = $request->input();
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            
            $rules = [
                'real_name' => ['required', 'string'],
            ];
    
            $messages = [
                'real_name.required' => config('glossary.register.real_name').'を入力してください。',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
            // if post, disini baru update user
            return view('users/confirm', ['user_id'=>$user_id, 'input'=>$input, 'userdata'=>$user_data]);
            }
        }
    }
    
    //confirmation abis di masukin usersnya
    public function profile_edit_success(Request $request, $user_id) {
        //post
        $finduser = Users::find($user_id);
        $finduser->real_name=$request->real_name;
        if($request->password != ''){
            $finduser->password=Hash::make($request->password);
        }
        $finduser->save();
        // return view('users/editsuccess');
        return redirect()->route('users')->with('alert', '編集完了')->with('type', '編集');
    }
    

    public function confirmdelete(Request $request){
        $deleteuser = Users::find($request->user_id);
        $deleteuser->delete_flag=1;
        $deleteuser->save();
        // return view('users.includes.modals.successModal');
        //with itu ngesave ke session (sessionflash) untuk sekali aja (direfresh ilang)
        return redirect()->route('users')->with('alert', '削除完了')->with('type', '削除');
    }

   
}

