{{-- {{ dd($input)}} --}}
{{-- {{ dd($product_data)}} --}}

@extends('layouts.app')

@section('title')
<title>Edit Profile Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">確認</h1>
            </div>
            <form id="form" action="{{ route('editproductsuccess', ['product_id'=>$product_id]) }}" method="POST" enctype="multipart/form-data">
            {{-- @foreach ($product_data as $input) --}}
            <?php
            // $newimagesource = 'upload/'.$input["product_id"].'/'.$input["new_product_image"];
            $oldimagesource = 'upload/'.$input["product_id"].'/'.$input["old_product_image"];
            ?>
            <div class="card-body">
                @csrf
                <div class="form-group mt-5">
                    <label for="product_name">新商品名</label>
                    <input id="product_name" type="text" name="product_name" class="form-control" value="{{ $input['product_name'] }}" >
                    <input id="product_id" type="text" name="product_id" class="form-control" value="{{ $input['product_id'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="product_image">新画像 : </label><br>
                    @if($new_product_image == '')
                    <img src="{{ asset($oldimagesource) }}" alt="image" style="width: 150px;">
                    <input id="old_product_image" type="text" name="old_product_image" value="<?= $input["old_product_image"] ?>">
                    <input id="old_product_image_name" type="text" name="old_product_image_name" class="form-control" value="{{ $old_product_image_name }}">
                    @else
                    <img src="{{ asset($pathlaravel) }}" alt="image" style="width: 150px;">
                    <input id="new_product_image" type="text" name="new_product_image" value="{{ $pathlaravel }}">
                    <input id="product_image_name" type="text" name="product_image_name" class="form-control" value="{{ $product_image_name }}">
                    <input id="old_product_image_name" type="text" name="old_product_image_name" class="form-control" value="{{ $old_product_image_name }}">
                    @endif
                  </div>
                <div class="form-group mt-5">
                    <label for="product_type">商品類</label>
                    <select id="product_type" name="product_type" class="form-control" value="<?= $input["product_type"] ?>">
                        <option value="0">選択</option>
                        <option value="1"<?php echo ( $input["product_type"]=='1')?'selected':'' ?>>新品</option>
                        <option value="2"<?php echo ( $input["product_type"]=='2')?'selected':'' ?>>ユーズド品</option>
                      </select>
                </div>
            </div>
            <button type="submit" name="editsubmit" class="btn btn-primary mb-5">編集</button>
            <button type="reset" class="btn btn-danger mb-5">リセット</button>
            </form> 
        </div>
        {{-- @endforeach --}}
    </div>
</div>
@endsection