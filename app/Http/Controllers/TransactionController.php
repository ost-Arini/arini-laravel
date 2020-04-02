<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionsModel as Transaction;
use App\Models\ProductsModel as Products;
use App\Models\DetailTransactionsModel as Detail_transaction;

use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function submittrans() {
        $products = new Products();
        $data =$products->getProductlist();
        return view('transactions/submitnew', ['data' => $data]);
    }


    public function submitconfirm(Request $request) {
        $rules = [
            'date' => ['required', 'string'],
            'address' => ['required', 'string'],
            'qty' => ['required'],
        ];

        $messages = [
            'date.required' => '注文日を入力してください。',
            'address.required' => '住所を入力してください。',
            'qty.required' => '数量を入力してください。',
        ];

        for ($i=0; $i <count($request->qty) ; $i++) { 
            $rules['qty.'.$i] = 'required';
            $messages['qty.'.$i.'.required'] = '数量を確認してください';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $input = $request->input();
            $items = $request->items;
            $qty = $request->qty;

            $order["product_name"] = [];
            $order["product_image"] = [];
            foreach($input['items'] as $item) {
                $product = Products::select("product_name", "product_image")->where('product_id', $item)->first();
                array_push($order["product_name"], $product->product_name );
                array_push($order["product_image"], $product->product_image );
            }
            return view('transactions/submittransconfirm', ['input'=>$input, 'order'=>$order,'qty'=>$qty, 'items'=>$items]);
        }
    }


    public function submittranssuccess(Request $request) {
        $transaction = new Transaction();
        $transaction->address = $request->address;
        $transaction->memo = $request->memo;
        $transaction->transaction_date = $request->date;
        $transaction->status = 1;
        $transaction->created_by_user_id = auth()->user()->user_id;
        $transaction->created_by_user_name = auth()->user()->user_name;
        $transaction->save();
        $alert = '登録完了';
        $type = '登録';
        $items = $request->items;
        for($i=0;$i < count($items); $i++){
            $detail = new Detail_transaction();
            $detail->transaction_id = $transaction->transaction_id;
            $detail->product_id = $request->items[$i];
            $detail->quantity = $request->qty[$i];
            $detail->created_by_user_id = auth()->user()->user_id;
            $detail->created_by_user_name = auth()->user()->user_name;
            $detail->save();
        }
        // return view('transactions/submittranssuccess');
        return redirect()->route('alltrans')->with('alert', $alert)->with('type', $type);
    }


    public function display(Request $request){
        $transaction = new Transaction();
        $data = $transaction->getTransactionslist();
        return view('transactions/alltrans', ['translist'=>$data]);
    }


    public function detail(Request $request, $transaction_id){
        $detail = new Transaction();
        $data = $detail->getDetailslist($transaction_id);
        $translist = $detail->getTranslist($transaction_id);
        return view('transactions/detail', ['transaction_id'=>$transaction_id, 'translist'=>$translist , 'detail'=>$data]);
    }


    public function delete(Request $request){
        $trans = Transaction::find($request->transaction_id);
        if($request->flag == 1){
            //cancel
            $trans->status=2;
            $alert = '取消完了';
            $type = '取消';
        } else{
            //delete
            $trans->delete_flag=1; 
            $alert = '削除完了';
            $type = '削除';
        }
        $trans->save();
        return redirect()->route('alltrans')->with('alert', $alert)->with('type', $type);
    }


    public function edit(Request $request, $transaction_id){
        if($request->isMethod('get')){
            $list = new Transaction();
            $detaillist = $list->getDetailslist($transaction_id);
            $translist = $list->getTranslist($transaction_id);
            $products = new Products();
            $productlist =$products->getProductlist();
            
            return view('transactions/edittrans',['transaction_id'=>$transaction_id, 'detaillist'=>$detaillist, 'translist'=>$translist, 'productlist'=>$productlist]);
        }
        if($request->isMethod('post')){
            $rules = [
                'date' => ['required', 'string'],
                'address' => ['required', 'string'],
                'qty' => ['required'],
            ];
    
            $messages = [
                'date.required' => '注文日を入力してください。',
                'address.required' => '住所を入力してください。',
                'qty.required' => '数量を入力してください。',
            ];
    
            for ($i=0; $i <count($request->qty) ; $i++) { 
                $rules['qty.'.$i] = 'required';
                $messages['qty.'.$i.'.required'] = '数量を確認してください';
            }
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $input = $request->input();
                $trans = Transaction::where('transaction_id', $transaction_id)->get()->toArray();

                $order["product_name"] = [];
                $order["product_image"] = [];
                foreach($input['items'] as $item) {
                    $product = Products::select("product_name", "product_image")->where('product_id', $item)->first();
                    array_push($order["product_name"], $product->product_name );
                    array_push($order["product_image"], $product->product_image );
                }

                return view('transactions/edittransconfirm', ['transaction_id'=>$transaction_id, 'trans'=>$trans, 'input'=>$input, 'order'=>$order]);
            }
        }
    }


    public function editsuccess(Request $request, $transaction_id){
        $transaction = Transaction::find($transaction_id);
        $transaction->address = $request->address;
        $transaction->memo = $request->memo;
        $transaction->transaction_date = $request->date;
        $transaction->updated_by_user_id = auth()->user()->user_id;
        $transaction->updated_by_user_name = auth()->user()->user_name;
        $transaction->save();
        $alert = '編集完了';
        $type = '編集';

        Detail_transaction::where('transaction_id', $transaction_id)->update(['delete_flag' => 1]);
        for($i=0;$i < count($request->items); $i++){
            $detail = new Detail_Transaction();
            $detail->transaction_id = $transaction_id;
            $detail->product_id = $request->items[$i];
            $detail->quantity = $request->qty[$i];
            $detail->created_by_user_id = auth()->user()->user_id;
            $detail->created_by_user_name = auth()->user()->user_name;
            $detail->updated_by_user_id = auth()->user()->user_id;
            $detail->updated_by_user_name = auth()->user()->user_name;
            $detail->save();
        }
        return redirect()->route('alltrans')->with('alert', $alert)->with('type', $type);
    }
}
