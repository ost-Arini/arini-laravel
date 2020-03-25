@extends('layouts.app')

@section('title')
<title>Products Page</title>
@endsection

@section('content')

<div class="container">
    <h2 class="text-center">全商品</h2>
    <br>
    <h4 class="text-center">全ユーザの履歴商品</h4>

    <form action="/search" method="POST">
        {{-- @csrf --}}
        <input type="text" class="form-control" name="search" placeholder="検索...">
        {{-- <button type="submit" class="btn btn-primary">検索<button> --}}
    </form>
    <br>
    
    <div class="container">
        <div class="row">
        @foreach($productlist as $item)
        <?php $imagesource = 'upload/'.$item["product_id"].'/'.$item["product_image"];?>
            <div class="card col-md-4">
                <img class="card-img-top" src="{{ $imagesource }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">商品名 : {{ $item['product_name'] }}</h5>
                    <p class="card-text">商品 ID : {{ $item['product_id'] }}</p>
                    <p class="card-text">ユーザ名 : {{ $item['created_by_user_name'] }}</p>
                    <p class="card-text">商品類 : <?php $realtype =  $item['product_type']  == 1 ? '新品' : 'ユーズド品';
                    echo $realtype; ?></p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection