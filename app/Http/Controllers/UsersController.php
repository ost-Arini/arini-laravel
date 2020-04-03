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
    public function show(Request $request, $user_id){
        $user = new Users();
        $data = $user->getUserlist();
        if($user_id != ''){
            $user_data = Users::where('user_id', $user_id)->get()->toArray();
            if($user_data != NULL){
                return view('users/profile', ['user_id'=>$user_id, 'userdata'=>$user_data]);
            } else {
                return redirect()->route('users')->with("errormessage", "レコードが見つかりません");
            }
        } 
        else {
            return view('users/profile');
        }
        
    }

   
    public function profile_edit(Request $request, $user_id) {
        $user = new Users();
        $data = $user->getUserlist();
        if ($request->isMethod('get')) {
            if($user_id != '') { //kalo user id nya ada di link
                $user_data = Users::where('user_id', $user_id)->get()->toArray();
                if($user_data != NULL){ //kalo user id nya ada di database
                    //view profile page only
                    return view('users/edit', ['user_id'=>$user_id, 'userdata'=>$user_data]);
                } else { //kalo user id nya ga ada di database
                    return redirect()->route('users')->with("errormessage", "レコードが見つかりません");
                }
            } else { //kalo user id nya ga ada di link
                return view('users/users', ['userlist'=>$data]);
            }
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

