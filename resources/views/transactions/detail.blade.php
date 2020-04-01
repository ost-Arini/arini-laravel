{{-- {{dd($detail)}} --}}
{{-- {{dd($translist)}} --}}
@extends('layouts.app')

@section('title')
<title>All Transaction</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">詳細</h1>
            </div>
            <div class="card-body">
                @foreach($translist as $item)
                <div>
                    <label for="transaction_id">取引ID :</label>
                    {{$item['transaction_id']}}
                </div>
                <div>
                    <label for="address">住所 :</label>
                    {{$item['address']}}
                </div>
                <div>
                    <label for="memo">メモ :</label>
                    {{$item['memo']}}
                </div>
                <div>
                    <label for="status">ステータス :</label>
                    <?php
                    if($item["status"] == 1){
                      echo '準備中';
                    }elseif($item["status"] == 2){
                      echo '完成';
                    }elseif($item["status"] == 3){
                      echo '解消された';
                    }else {
                      echo 'ローディング';
                    }
                    ?>
                </div>
                <div>
                    <label for="date">注文日 :</label>
                    {{-- {{$item['transaction_date']}} --}}
                    <?php 
                    $orgDate = $item['transaction_date'];
                    $newDate = date("d F Y", strtotime($orgDate));
                    echo $newDate; ?>
                </div>
                <div>
                    <label for="created_by_user_name">登録者:</label>
                    {{$item['created_by_user_name']}}
                </div>
                @endforeach
            </div>
            <div>
                <table id="alltrans" class="table table-sm table-hover" cellspacing="0" width="100%">
                    <thead>
                       <tr>
                          <th>画像</th>
                          <th>商品名</th>
                          <th>数量</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $item)
                        <?php $imagesource = 'upload/'.$item['product_id'].'/'.$item['product_image'];?>
                        <tr>
                            <td><img src="{{ asset($imagesource) }}" style="width:100px;" /></td>
                            <td>{{ $item['product_name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                <table>
                <a href="{{route('edittrans', ['transaction_id'=> $item['transaction_id']])}}" class="btn btn-primary">編集</a>
                @if($item["status"] != 2)
                    <form action="{{route('deletetrans')}}" method="POST">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{$transaction_id}}">
                        <input type='hidden' name="flag" value="1">
                        <input type="submit" name="submit" class="btn btn-info" value="取消">
                    </form>
                    <form action="{{route('deletetrans')}}" method="POST">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{$transaction_id}}">
                        <input type='hidden' name="flag" value="2">
                        <input type="submit" name="submit" class="btn btn-danger" value="削除">
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection