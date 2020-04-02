{{-- {{ dd($data)}} --}}

@extends('layouts.app')

@section('title')
<title>Submit New Transaction Page</title>
@endsection

@section('content')
<script src="{{ asset('bootstrap/js/select2.min.js')}}"></script>
<link href="{{ asset('bootstrap/css/select2.min.css')}}" rel="stylesheet">

<div class="container">
    <h2 class="text mt-5">取引登録</h2>
    {{-- <div id="error"><p id="errormsg" style="color:red"></p></div> --}}
    
    <form id="form" action="{{ route('submittransconfirm') }}" method="POST">
        @csrf
        <div class="form-group mt-5">
            <label for="date">注文日</label>
            <input type="text" id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date">
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-5">
            <label for="address">住所</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"></textarea>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-5">
            <label for="memo">メモ</label>
            <textarea class="form-control" id="memo" name="memo"></textarea>
        </div>
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

                    @for($i=1;$i<=3;$i++)
                        <tr>
                            <td>
                                <select id="items{{$i}}" name="items[]" class="js-example-basic-single form-control" style="width:300px;">
                                    @foreach($data as $item)
                                        <option value="{{$item['product_id']}}">{{$item['product_name']}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" id="qty" name="qty[]" required class="form-control @error('qty.'.$i) is-invalid @enderror">
                                @error('qty.'.$i)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td class="text-center"><button type="button" id="delete_row" onclick="deleterow(this)">コラム削除</button>
                            </td>
                        </tr>
                    @endfor
                    </div>
                </tbody>
            </table>
        </div>
        <div><button type="button" id="add_row" onclick="addRow()">コラム追加</button></div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary mb-5" onclick="validate()">登録</button>
        <button type="reset" class="btn btn-danger mb-5">リセット</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        //default 3 row
        for (let index = 1; index <=3; index++) {
            // bukan array jadi tinggal ditambah index aja
            $('#items'+index).select2();
        }
        $( "#datepicker").datepicker({ dateFormat: 'dd-mm-yy',autoclose: true, todayHighlight: true  });
    });

    function addRow(){
        //nyari value dari countnya
        var flag = $('#count').val();
        var index = flag+1;
        index = index + Math.floor(Math.random() * 100);
        var product = '<td><select class="js-example-basic-single form-control" id="items'+index+'" style="width:300px;" name="items[]">@foreach($data as $item)<option value="{{$item['product_id']}}">{{$item['product_name']}}</option>@endforeach</select></td>';
        
        $('#transaction_table').append('<tr>'+product+'<td><input type="number" id="qty" name="qty[]" required class="form-control @error('qty.'.$i) is-invalid @enderror">@error('qty.'.$i)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td class="text-center"><button type="button" id="delete_row" onclick="deleterow(this)">コラム削除</button></td></tr>');

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
