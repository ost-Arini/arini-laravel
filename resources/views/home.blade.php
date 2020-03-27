{{-- {{ dd($typelist)}} --}}
{{-- {{ dd($productlist)}} --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Home</h2>
    <br>
    <h4 class="text-center">All products submitted by you and other users</h4><br>
    <div class="text-center">
    <h6 >商品類 </h6>
        <form action="" method="GET">
            <button type="submit" name="type" value="0">全商品類</button>
            @foreach($typelist as $item)
            <button type="submit" name="type" value="{{ $item['type_id'] }}">{{ $item['type_name'] }}</button>
            @endforeach
        </form><br>
    </div>
    <div class="container">
        {{-- @if("type" == 0 ) --}}
            <div class="row">
            @foreach($productlist as $item)
            <?php $imagesource = 'upload/'.$item["product_id"].'/'.$item["product_image"];?>
                <div class="card col-md-4">
                    <img class="card-img-top img-fluid" src="{{ asset($imagesource) }}" alt="" />
                    <div class="card-body">
                        <h5>Product Name : {{ $item["product_name"] }}</h5>
                        <p>Product ID : {{ $item["product_id"] }}</p>
                        <p>Created by : {{ $item["created_by_user_name"] }}</p>
                        <p>Updated by : {{ $item["updated_by_user_name"] }}</p>
                        {{-- @foreach($typelist as $item)
                        <p>Product Type : {{ $item["type_name"] }}</p>
                        @endforeach --}}
                        <?php 
                        $realtype = $item["product_type"] == 1 ? '新品' : 'ユーズド品';
                        echo $realtype;
                      ?>
                    </div>
                </div>
            @endforeach
            </div>
        {{-- @endif --}}
    </div>




    {{-- <div class="row justify-content-center">
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div> --}}
        
    </div>
</div>
@endsection
