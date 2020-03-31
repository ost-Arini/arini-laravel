{{-- {{dd($translist)}} --}}
@extends('layouts.app')

@section('title')
<title>All Transaction</title>
@endsection

@section('content')
<div class="container">
    <table id="alltrans" class="table table-sm table-hover" cellspacing="0" width="100%">
        <thead>
           <tr>
              <th>注文ID</th>
              <th>注文日</th>
              <th>住所</th>
              <th>メモ</th>
              <th>注文者</th>
              <th>ステータス</th>
              <th></th>
           </tr>
        </thead>
        <tbody>
            @foreach($translist as $item)
            <tr>
                <td>{{ $item['transaction_id'] }}</td>
                <td><?php 
                    $orgDate = $item['transaction_date'];
                    $newDate = date("d F Y", strtotime($orgDate));
                    echo $newDate; ?></td>
                <td>{{ $item['address'] }}</td>
                <td>{{ $item['memo'] }}</td>
                <td>{{ $item['created_by_user_name'] }}</td>
                <td><?php
                    if($item["status"] == 1){
                      echo '過程中';
                    }elseif($item["status"] == 2){
                      echo '解消されました';
                    }elseif($item["status"] == 3){
                      echo '完成';
                    }else {
                      echo 'ローディング';
                    }
                    ?> </td>
                <td><a class="btn btn-info" id="update" href="{{route('detailtrans', ['transaction_id'=> $item['transaction_id']])}}">詳細</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(Session::get('alert'))
    <div class="modal fade" id="successModal"  role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">{{Session::get('type')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{Session::get('alert')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#successModal').modal('show');
    </script>
    @endif
</div>




<script>
    $(document).ready( function () {
        $('#alltrans').DataTable({
            "oLanguage": {
                "sSearch": "検索:",
                "sZeroRecords": "レコードがありません",
                "oPaginate":{
                    "sFirst": "最初",
                    "sLast": "最後",
                    "sNext": "次へ",
                    "sPrevious": "前へ",
                },
                "sInfo": "_TOTAL_ 件 から_START_ ～ _END_",
                "sInfoEmpty": "0レコード",
                "sLengthMenu": "表示 _MENU_ 件"
            }
        });
    } );

    function showDeleteModal(transaction_id) {
        $('#modaltransId').val(product_id);
        $('#deleteTransModal').modal('show');
    }

</script>

@endsection