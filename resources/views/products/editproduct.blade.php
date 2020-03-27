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
                <h1 class="text-center">編集</h1>
            </div>
            <form id="form" action="{{ route('editconfirm', ['product_id'=>$product_id]) }}" method="POST" enctype="multipart/form-data">
            @foreach ($product_data as $item)
            <?php $imagesource = 'upload/'.$item["product_id"].'/'.$item["product_image"];?>
            <div class="card-body">
                @csrf
                <div class="form-group mt-5">
                    <label for="product_name">商品名</label>
                    <input id="product_name" type="text" name="product_name" class="form-control" value="{{ $item['product_name'] }}" >
                    <input id="product_id" type="text" name="product_id" class="form-control" value="{{ $item['product_id'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="new_product_image">Product Image : </label><br>
                    <img src="{{ asset($imagesource) }}" alt="image" style="width: 150px;">
                    <input id="new_product_image" type="file" name="new_product_image" class="form-control">
                    <input id="old_product_image" type="text" name="old_product_image" class="form-control" value="<?= $item["product_image"] ?>">
                  </div>
                <div class="form-group mt-5">
                    <label for="product_type">商品類</label>
                    <select id="product_type" name="product_type" class="form-control" value="<?= $item["product_type"] ?>">
                        <option value="0">選択</option>
                        <option value="1"<?php echo ( $item["product_type"]=='1')?'selected':'' ?>>新品</option>
                        <option value="2"<?php echo ( $item["product_type"]=='2')?'selected':'' ?>>ユーズド品</option>
                      </select>
                </div>
            </div>
            <button type="submit" name="editsubmit" class="btn btn-primary mb-5">編集</button>
            <button type="reset" class="btn btn-danger mb-5">リセット</button>
            </form> 
        </div>
        @endforeach
    </div>
</div>
@endsection