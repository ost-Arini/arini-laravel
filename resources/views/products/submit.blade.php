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
            <input id="product_name" type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror">
            @error('product_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mt-5">
            <label for="product_image">画像</label>
            <input id="product_image" type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror">
            @error('product_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mt-5">
            <label for="product_type">商品類:</label>
            <select id="product_type" name="product_type" class="form-control @error('product_type') is-invalid @enderror">
                <option value="">選択</option>
                @foreach($datatype as $item)
                <option value="{{ $item['type_id']}}">{{$item['type_name']}}</option>
                @endforeach
            </select>
            @error('product_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mt-5">
            <label for="stock">在庫</label>
            <input id="stock" type="number" name="stock" class="form-control @error('stock') is-invalid @enderror">
            @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" name="submit" class="btn btn-primary mb-5">登録</button>
        <button type="reset" class="btn btn-danger mb-5">リセット</button>
        
    </form>    
</div>
  
@endsection