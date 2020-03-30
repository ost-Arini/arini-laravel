{{-- {{ dd($data)}} --}}

@extends('layouts.app')

@section('title')
<title>Submit New Transaction Page</title>
@endsection

@section('content')
<script src="{{ asset('bootstrap/js/select2.min.js')}}"></script>
<link href="{{ asset('bootstrap/css/select2.min.css')}}" rel="stylesheet">

<div class="container">
    <h2 class="text mt-5">Transaction Form</h2>
    {{-- <div id="error"><p id="errormsg" style="color:red"></p></div> --}}
    
    <form id="form" action="{{ route('submittransconfirm') }}" method="POST">
        @csrf
        <div class="form-group mt-5">
            <label for="date">Transaction Date</label>
            <input type="text" id="datepicker" class="form-control" name="date">
        </div>
        <div class="form-group mt-5">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
        <div class="form-group mt-5">
            <label for="memo">Memo</label>
            <textarea class="form-control" id="memo" name="memo"></textarea>
        </div>
        <div class="form-group mt-5 item_list">
            <table id="transaction_table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <div id="transaction_detail">
                    <!-- buat itung value perkara looping product name -->
                    <input type="hidden" id="count" value="3">
                    @for($i=1;$i<=3;$i++)
                        <tr>
                            <td>
                            <select class="js-example-basic-single form-control" id="items{{$i}}" style="width:300px;" name="items[]">
                                    <option value="0">Select product</option>
                                    @foreach($data as $item)
                                        <option value="{{$item['product_id']}}">{{$item['product_name']}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" id="qty" class="form-control" style="" name="qty[]"></td>
                            <td class="text-center"><button type="button" id="delete_row" onclick="deleterow(this)">delete row</button></td>
                        </tr>
                    @endfor
                    </div>
                </tbody>
            </table>
        </div>
        <div><button type="button" id="add_row" onclick="addRow()">Add row</button></div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary mb-5" onclick="validate()">Submit</button>
        <button type="reset" class="btn btn-danger mb-5">Reset</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        //default 3 row
        for (let index = 1; index <=3; index++) {
            // bukan array jadi tinggal ditambah index aja
            $('#items'+index).select2();
        }
        $( "#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
    });

    function addRow(){
        //nyari value dari countnya
        var flag = $('#count').val();
        var index = flag+1;
        var product = '<td><select class="js-example-basic-single form-control" id="items'+index+'" style="width:300px;" name="items[]"><option value="0">Select product</option>@foreach($data as $item)<option value="{{$item['product_id']}}">{{$item['product_name']}}</option>@endforeach</select></td>';
        
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
