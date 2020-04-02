{{-- {{dd($datatype)}} --}}
@extends('layouts.app')

@section('title')
<title>All Types</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">商品類</h1>
            </div>

            <div class="card-body">
                <table id="alltype" class="table table-sm table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>商品類ID</th>
                        <th>商品類名</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datatype as $item)
                        <tr>
                            <td>{{$item['type_id']}}</td>
                            <td>{{$item['type_name']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer text-center">
                <button class="btn btn-info" id="delete" onclick="showAddModal()">商品類追加</button>
                <div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addTypeModalLabel">商品類追加</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('addtype')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="type_name" class="col-md-4 col-form-label text-md-right">商品名</label>
                                    <div class="col-md-6">
                                        <input id="modalTypeId" type="text" name="type_name" class="form-control @error('type_name') is-invalid @enderror">
                                        @error('type_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    <button type="submit" class="btn btn-info">追加</button>
                                </div>
                            {{-- <p>商品類名:</p>
                            <input type="text" value="" id="modalTypeId" name="type_name"> --}}
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                          {{-- <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info">追加</button>
                          </form> --}}
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#alltype').DataTable({
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

    function showAddModal(transaction_id) {
        $('#modalTypeId');
        $('#addTypeModal').modal('show');
    }

</script>
@endsection