{{-- {{ dd($typelist)}} --}}
{{-- {{ dd($productlist)}} --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Home</h2>
    <br>
    <h4 class="text-center">全商品リスト</h4><br>
    <div class="text-center">
    <h6 >商品類 </h6>
        <form action="" method="POST">
            @csrf
        <a class="btn btn-info" href="{{route('home')}}">全商品類</a>
            {{-- <button type="submit" name="type" value="0">全商品類</button> --}}
            @foreach($typelist as $item)
            <button class="btn btn-info type="submit" name="type" value="{{ $item['type_id'] }}">{{ $item['type_name'] }}</button>
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
                        <h5>商品名 : {{ $item["product_name"] }}</h5>
                        <p>商品ID : {{ $item["product_id"] }}</p>
                        <p>ユーザ名 : {{ $item["created_by_user_name"] }}</p>
                        <p>編集者 : {{ $item["updated_by_user_name"] }}</p>
                        <p>商品類 : {{ $item["type_name"] }}</p>
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
