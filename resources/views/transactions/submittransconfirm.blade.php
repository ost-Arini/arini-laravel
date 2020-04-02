{{-- {{ dd($items)}} --}}

{{-- {{ dd($product_name.length)}} --}}

@extends('layouts.app')

@section('title')
<title>Submit New Transaction Page</title>
@endsection

@section('content')
<div class="container">
    <h2 class="text mt-5">取引登録確認</h2>
    <form action="{{route('submittranssuccess')}}" method="POST">
    @csrf
        <div class="form-group mt-5">
            <label for="date">注文日</label><br>
            <input id="date" type="hidden" name="date" value="<?php 
            $orgDate = $input['date'];
            $newDate = date("yy-m-d", strtotime($orgDate));
            echo $newDate; ?>" class="form-control">
            <?php 
            $orgDate = $input['date'];
            $newDate = date("d F Y", strtotime($orgDate));
            echo $newDate; ?>
        </div>

        <div class="form-group mt-5">
            <label for="address">住所</label><br>
            <input id="address" type="hidden" name="address" value="{{$input['address']}}" class="form-control">
            {{$input['address']}}
        </div>

        <div class="form-group mt-5">
            <label for="memo">メモ</label><br>
            <input id="memo" type="hidden" name="memo" value="{{$input['memo']}}" class="form-control">
            {{$input['memo']}}
        </div>

        <div class="form-group mt-5">
            <table cellpadding="5">
              <thead>
                <tr>       
                  <th>商品名</th>
                  <th>画像</th> 
                  <th>数量</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    @for($i=0;$i<count($items);$i++)
                    <?php $imagesource = 'upload/'.$items[$i].'/'.$order["product_image"][$i];?>
                    <td>
                        <input type="hidden" class="form-control" id="items" name="items[]" value="{{$items[$i]}}">
                        {{$order['product_name'][$i]}}</td>
                    <td><img src="{{ asset($imagesource) }}" style="width:100px;" /></td>
                    <td>
                        <input type="hidden" class="form-control" id="qty" name="qty[]" value="{{$qty[$i]}}">
                        {{$qty[$i]}}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>


        <button type="submit" name="submit" class="btn btn-primary mb-5">登録</button>
        <button type="button" name="cancel" class="btn btn-danger mb-5" onClick="cancelConfirm()">キャンセル</button>
        <!-- bikin alert pake function js -->
        <script>
        function cancelConfirm(){
            var conf = confirm("登録をキャンセルしますか？");
            if(conf == true) {
                document.location.href = '';
            }
        }
        </script>
    </form>
</div>
@endsection