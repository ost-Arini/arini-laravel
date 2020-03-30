<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionsModel as Transactions;
use App\Models\ProductsModel as Products;

class TransactionsController extends Controller
{
    public function submittrans() {
        $products = new Products();
        $data =$products->getProductlist();
        return view('transactions/submitnew', ['data' => $data]);
    }

    public function submitconfirm(Request $request) {
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
