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
            <form id="form" action="/" method="POST">
            @foreach ($product_data as $item)
            <div class="card-body">
                @csrf
                <div class="form-group mt-5">
                    <label for="product_name">商品名</label>
                    <input id="product_name" type="text" name="product_name" class="form-control" value="{{ $item['product_name'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="product_id">商品名</label>
                    <input id="product_id" type="text" name="product_id" class="form-control" value="{{ $item['product_id'] }}" disabled>
                    <input id="product_id" type="text" name="product_id" class="form-control" value="{{ $item['product_id'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="product_type">商品類</label>
                    <input id="product_type" type="text" name="product_id" class="form-control" value="<?php $realtype =  $item['product_type']  == 1 ? '新品' : 'ユーズド品';
                    echo $realtype; ?>" disabled>
                    <input id="product_type" type="text" name="product_type" class="form-control" value="{{ $item['product_type'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="created_at">created_at</label>
                    <input id="created_at" type="text" name="product_id" class="form-control" value="{{ $item['created_at'] }}" disabled>
                    <input id="created_at" type="text" name="created_at" class="form-control" value="{{ $item['created_at'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="created_by_user_name">ユーザ名</label>
                    <input id="created_by_user_name" type="text" name="product_id" class="form-control" value="{{ $item['created_by_user_name'] }}" disabled>
                    <input id="created_by_user_name" type="text" name="created_by_user_name" class="form-control" value="{{ $item['created_by_user_name'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="updated_at">updated_at</label>
                    <input id="updated_at" type="text" name="product_id" class="form-control" value="{{ $item['updated_at'] }}" disabled>
                    <input id="updated_at" type="text" name="updated_at" class="form-control" value="{{ $item['updated_at'] }}" >
                </div>
                <div class="form-group mt-5">
                    <label for="updated_by_user_name">updated_by_user_name</label>
                    <input id="updated_by_user_name" type="text" name="product_id" class="form-control" value="{{ $item['updated_by_user_name'] }}" disabled>
                    <input id="updated_by_user_name" type="text" name="updated_by_user_name" class="form-control" value="{{ $item['updated_by_user_name'] }}" >
                </div>
            </div>
            
        </div>
        @endforeach
    </div>
</div>
@endsection