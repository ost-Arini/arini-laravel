<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypesModel as Types;
use Illuminate\Support\Facades\Validator;
use Auth;

class TypesController extends Controller
{
    public function show(Request $request){
        if(Auth::user()->user_role == 2){
            $types = new Types();
            $datatype =$types->getTypeslist();
            return view('/typelist', ['datatype' => $datatype]);
        } else {
            return view('error');
        }
    }

    public function add(Request $request){
        $rules = [
            'type_name' => ['required', 'string'],
        ];

        $messages = [
            'type_name.required' => '商品類名を入力してください。',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        else {
            $types = new Types();
            $types->type_name = $request->type_name;
            $types->save();
            return redirect()->route('addtype')->with('alert', '追加完了')->with('type', '追加登録');
        }
    }
}
