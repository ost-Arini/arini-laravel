@extends('layouts.app')

@section('title')
<title>Submit New Product Page</title>
@endsection

@section('content')
<div class="container">
    <h2 class="text mt-5">新規登録</h2>

    {{-- <div id="error"><p id="messages" style="color:red"></p></div> --}}
    <!-- ke confirmationpage dulu ga langsung input ke database-->
    <form id="form" action="{{ route('submitconfirm') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group mt-5">
            <label for="product_name">商品名</label>
            <input id="product_name" type="text" name="product_name" class="form-control">
        </div>

        <div class="form-group mt-5">
            <label for="product_image">画像</label>
            <input id="product_image" type="file" name="product_image" class="form-control">
        </div>

        <div class="form-group mt-5">
            <label for="product_type">商品類:</label>
            <select id="product_type" name="product_type" class="form-control">
            <option value="0">選択</option>
            <option value="1">新品</option>
            <option value="2">ユーズド品</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary mb-5">登録</button>
        <button type="reset" class="btn btn-danger mb-5">リセット</button>
        
    </form>    
</div>
  
@endsection