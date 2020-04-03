{{-- {{ dd($input)}} --}}
{{-- {{ dd($temp_image)}} --}}
{{-- {{ dd($datatype)}} --}}

@extends('layouts.app')

@section('title')
<title>Submit New Product Page</title>
@endsection

@section('content')
<div class="container">
    <h2 class="text mt-5">新規確認</h2>

    {{-- <div id="error"><p id="messages" style="color:red"></p></div> --}}
    <!-- ke confirmationpage dulu ga langsung input ke database-->
    <form id="form" action="{{ route('submitsuccess') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group mt-5">
            <label for="product_name">商品名</label>
            <input id="product_name" type="text" name="product_name" class="form-control" value="{{ $input['product_name'] }}" disabled>
            <input id="product_name" type="hidden" name="product_name" class="form-control" value="{{ $input['product_name'] }}">
        </div>

        <div class="form-group mt-5">
            <label for="product_image">画像</label><br>
            <input id="product_image" type="hidden" name="product_image" class="form-control" value="{{ $pathlaravel }}">
            <input id="product_image_name" type="hidden" name="product_image_name" class="form-control" value="{{ $product_image_name }}">
            <img src="{{ $pathlaravel }}" width="500">
        </div>

        <div class="form-group mt-5">
            <label for="product_type">商品類:</label>
            <select id="product_type" name="product_type" class="form-control">
                @foreach ($datatype as $type)
                    <option name="product_type" value="{{$type['type_id']}}" {{$input['product_type'] == $type['type_id'] ? "selected" : ""}} disabled>{{$type['type_name']}}</option>
                @endforeach  
            </select>
            <input id="product_type" type="hidden" name="product_type" class="form-control" value="{{ $input['product_type'] }}">
        </div>

        <div class="form-group mt-5">
            <label for="stock">在庫</label>
            <input id="stock" type="number" name="stock" class="form-control" value="{{ $input['stock'] }}" disabled>
            <input id="stock" type="hidden" name="stock" class="form-control" value="{{ $input['stock'] }}">
        </div>

        <button type="submit" name="submit" class="btn btn-primary mb-5">登録</button>
        <button type="reset" class="btn btn-danger mb-5">リセット</button>
        
    </form>    
</div>
@endsection