<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsModel as Products;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function submit() {
        return view('products/submit');
    }



    public function submitconfirm(Request $request) {
        //bikin folder temp, kalo belum ada, bikin pake mkdir > cek dulu pake if file exists
        $path = public_path().'\upload\temp';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $input = $request->input();
        $filename = request()->product_image->getClientOriginalName();
        $product_image = $request->file('product_image')->move($path, $filename);
        $laravelpath = 'upload/temp'.'/'.$filename;
        return view('products/submitconfirm', ['input'=>$input, 'product_image'=>$product_image, 'pathlaravel'=> $laravelpath, 'product_image_name'=>$filename]);
    }


    public function submitsuccess(Request $request){
            $products = new Products();
            $products->product_name = $request->product_name;
            $products->product_image = $request->product_image_name;
            $products->product_type = $request->product_type;
            $products->created_by_user_id = auth()->user()->user_id;
            $products->created_by_user_name = auth()->user()->user_name;
            $products->save();
            // ^ disave dulu baru dapet product id nya
            $product_id = $products->product_id;
            //tentuin path2nya
            $oldpath = public_path('upload\temp\\'.$request->product_image_name);
            $path =  public_path('upload\\'.$product_id.'\\'.$request->product_image_name);
            $folder =  public_path('upload\\'.$product_id);
            //bikin folder dlu
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            //move file dari old path ke path baru
            rename($oldpath, $path);
            return view('products/submitsuccess');
        // };
    }

    public function allproducts(Request $request) {
        $products = new Products();
        $data = $products->getProductlist();
        return view('products/all', ['productlist'=>$data]);
    }

    public function yourproducts() {
        return view('products/your');
    }
}
