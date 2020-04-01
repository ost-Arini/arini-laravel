{{-- {{dd($translist)}} --}}
{{-- {{dd($detaillist)}} --}}
{{-- {{dd($productlist)}} --}}
@extends('layouts.app')

@section('title')
<title>Edit Transaction</title>
@endsection

@section('content')
<script src="{{ asset('bootstrap/js/select2.min.js')}}"></script>
<link href="{{ asset('bootstrap/css/select2.min.css')}}" rel="stylesheet">
<div class="container">
    <h2 class="text mt-5">取引編集</h2>
    <form id="form" action="{{ route('edittransconfirm', ['transaction_id'=>$transaction_id]) }}" method="POST">
        @csrf
        @foreach($translist as $item)
        <div class="form-group mt-5">
            <label for="date">注文日 Date</label>
            <input type="text" id="datepicker" class="form-control" name="date" value="<?php 
            $orgDate = $item['transaction_date'];
            $newDate = date("d F Y", strtotime($orgDate));
            echo $newDate; ?>">
        </div>
        <div class="form-group mt-5">
            <label for="address">住所</label>
            <textarea class="form-control" id="address" name="address">{{$item['address']}}</textarea>
            <input id="transaction_id" type="hidden" name="transaction_id" class="form-control" value="{{ $item['transaction_id'] }}" >
        </div>
        <div class="form-group mt-5">
            <label for="memo">メモ</label>
            <textarea class="form-control" id="memo" name="memo">{{$item['memo']}}</textarea>
        </div>
        @endforeach
        <div class="form-group mt-5 item_list">
            <table id="transaction_table">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>数量</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <div id="transaction_detail">
                    <!-- buat itung value perkara looping product name -->
                    <input type="hidden" id="count" value="3">

                    @for($i=0;$i<count($detaillist);$i++)
                        <tr>
                            <td>
                            <select class="js-example-basic-single form-control" id="items{{$i}}" style="width:300px;" name="items[]">
                                    @foreach($productlist as $item2)
                                        <option value="{{$item2['product_id']}}" {{$detaillist[$i]['product_id'] == $item2['product_id'] ? "selected" : "" }}>{{$item2['product_name']}}</option>
                                    @endforeach
                            </select>
                            </td>
                            <td>
                                <input type="number" id="qty" class="form-control" style="" name="qty[]" value="{{$detaillist[$i]['quantity']}}">
                                <input type="hidden" id="detail_id" class="form-control" style="" name="detail_id[]" value="{{$detaillist[$i]['detail_id']}}"></td>
                            <td class="text-center"><button type="button" id="delete_row" onclick="deleterow(this)">コラム削除</button></td>
                        </tr>
                    @endfor
                    </div>
                </tbody>
            </table>
        </div>
        <div><button type="button" id="add_row" onclick="addRow()">コラム追加</button></div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary mb-5" onclick="validate()">編集</button>
        <button type="reset" class="btn btn-danger mb-5">リセット</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        //default 3 row
        for (let index = 0; index <=3; index++) {
            // bukan array jadi tinggal ditambah index aja
            $('#items'+index).select2();
        }
        $( "#datepicker").datepicker({ dateFormat: 'dd-mm-yy',autoclose: true, todayHighlight: true  });
    });

    function addRow(){
        //nyari value dari countnya
        var flag = $('#count').val();
        var index = flag+1;
        var product = '<td><select class="js-example-basic-single form-control" id="items'+index+'" style="width:300px;" name="items[]"><option value="0">Select product</option>@foreach($productlist as $item2)<option value="{{$item2['product_id']}}">{{$item2['product_name']}}</option>@endforeach</select></td>';
        
        $('#transaction_table').append('<tr>'+product+'<td><input type="number" id="qty" class="form-control"  name="qty[]"></td><td class="text-center"><button type="button" id="delete_row" onclick="deleterow(this)">delete row</button></td></tr>');
        $('#items'+index).select2();
        index++;
        document.getElementById('count').value++;
    };

    function deleterow(r) {      
        // delete row (index-0). 
        var index = $('#count').val();
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("transaction_table").deleteRow(i);
        if(index==1)
        {
            //kalo di delete sampe habis, biar ga jadi NaN (not a number)
            document.getElementById('count').value=0;
        } else {
            //kalo nggak ya futsuuni ngurang
            document.getElementById('count').value--;
        }
    }; 
</script>
@endsection