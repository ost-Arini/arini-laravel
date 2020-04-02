{{-- {{dd($input)}} --}}
{{-- {{dd($order)}} --}}
{{-- {{dd($trans)}} --}}
@extends('layouts.app')

@section('title')
<title>Confirm Edit Transaction</title>
@endsection

@section('content')
<div class="container">
    <h2 class="text mt-5">取引編集確認</h2>
    <form action="{{ route('edittranssuccess', ['transaction_id'=>$transaction_id]) }}" method="POST">
    @csrf
        <div class="form-group mt-5">
            <label for="date">注文日 Date</label><br>
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
            <input id="transaction_id" type="hidden" name="transaction_id" class="form-control" value="{{ $input['transaction_id'] }}" >
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
                  {{-- <th></th> --}}
                </tr>
              </thead>
              <tbody>
                  <tr>
                    @for($i=0;$i<count($input['items']);$i++)
                    <?php $imagesource = 'upload/'.$input['items'][$i].'/'.$order["product_image"][$i];?>
                        <td>
                            <input type="hidden" class="form-control" id="items" name="items[]" value="{{$input['items'][$i]}}">
                            {{$order['product_name'][$i]}}</td>
                        <td>
                            <img src="{{ asset($imagesource) }}" style="width:100px;" /></td>
                        <td>
                            <input type="hidden" class="form-control" id="qty" name="qty[]" value="{{$input['qty'][$i]}}">
                            {{$input['qty'][$i]}}
                        </td>
                        {{-- <td>
                            <input type="hidden" id="detail_id" class="form-control" style="" name="detail_id[]" value="{{$input['detail_id'][$i]}}">
                        </td> --}}
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mb-5">編集</button>
        <button type="button" name="cancel" class="btn btn-danger mb-5" onClick="cancelConfirm()">キャンセル</button>
        <!-- bikin alert pake function js -->
        <script>
        function cancelConfirm(){
            var conf = confirm("Are you sure you want to go back? Your update will not be saved");
            if(conf == true) {
                document.location.href = '';
            }
        }
        </script>
    </form>
</div>
@endsection