<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\UsersModel as Users;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('auth\register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
            
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request){
        $rules = [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'real_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'integer'],
        ];

        $messages = [
            'user_name.required' => config('glossary.register.user_name').'を入力してください。',
            'email.required' => config('glossary.register.email').'を入力してください。',
            'real_name.required' => config('glossary.register.real_name').'を入力してください。',
            'password.required' => config('glossary.register.password').'を入力してください。',
            'birthday.required' => config('glossary.register.birthday').'を入力してください。',
            'gender.required' => config('glossary.register.gender').'を入力してください。',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('register')->withErrors($validator)->withInput();
        } 
        else {
            $users = new Users();
            $users->user_name = $request->user_name;
            $users->user_role = 1;
            $users->email = $request->email;
            $users->real_name = $request->real_name;
            $users->password = Hash::make($request->password);
            $users->birthday = $request->birthday;
            $users->gender = $request->gender;
            $users->save();
            return redirect('login')->with('message', 'アカウント作成しました');
        }
        
    }
}
