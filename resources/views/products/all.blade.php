@extends('layouts.app')

@section('title')
<title>Products Page</title>
@endsection

@section('content')

<div class="container">
    <table id="allproducts" class="table table-sm table-hover" cellspacing="0" width="100%">
        <thead>
           <tr>
              <th>画像</th>
              <th>商品名</th>
              <th>商品 ID</th>
              <th>ユーザ名</th>
              <th>商品類</th>
              <th></th>
              <th></th>
           </tr>
        </thead>
        <tbody>
            @foreach($productlist as $item)
            <?php $imagesource = 'upload/'.$item["product_id"].'/'.$item["product_image"];?>
            <tr>
               <td><img src="{{ asset($imagesource) }}" alt="image cap" class="avatar border rounded-circle" style="width: 150px;height: 150px;margin: 15px;"></td>
               <td>{{ $item['product_name'] }}</td>
               <td>{{ $item['product_id'] }}</td>
               <td>{{ $item['created_by_user_name'] }}</td>
               <td>{{ $item['type_name'] }}</td>
                <td><a class="btn btn-info" id="update" href="/editproduct/{{ $item['product_id'] }}">編集</a></td>
                <td><button class="btn btn-danger" id="delete" onclick="showDeleteModal({{ $item['product_id'] }})">削除</button></td>

                <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteProductModalLabel">削除</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>商品を削除しますか？</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                          <form action="{{ route('deleteproductsuccess') }}" method="POST">
                            @csrf
                            <input type="hidden" value="" id="modalProductId" name="product_id">
                            <button type="submit" class="btn btn-danger">削除</button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>

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
        $('#allproducts').DataTable({
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

    function showDeleteModal(product_id) {
        $('#modalProductId').val(product_id);
        $('#deleteProductModal').modal('show');
    }

</script>

@endsection