@extends('layouts.app')

@section('title')
<title>User List Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h1>User List</h1>
            </div>

            <div class="card-body">
                <table cellpadding='8' id='userlist' class="display">
                    <thead class="thead-dark">
                        <tr>
                            <th >ユーザ名</th>
                            <th>名前</th>
                            <th>メール</th>
                            <th>生年月日</th>
                            <th>性別</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ var_dump($userlist)}} --}}
                    @foreach($userlist as $user)
                        <tr>
                            {{-- {{  }} ini mirip dengan echo --}}
                            <th> {{ $user['user_name'] }}</th>
                            <td> {{ $user['real_name'] }} </td>
                            <td> {{ $user['email'] }}</td>
                            <td> {{ $user['birthday'] }}</td>
                            <td> {{ $user['gender']== 1 ? '男性' : '女性' }}</td>
                            <td><a class="btn btn-info" id="update" href="/edit/{{ $user['user_id'] }}">編集</a></td>
                            <td>
                              @if($user['user_id'] !== auth()->user()->user_id)
                              <button class="btn btn-danger" id="delete" onclick="showDeleteModal({{ $user['user_id'] }})">削除</button>
                              @endif
                            </td>
                            
                            {{-- tabindex -1 itu maksudnya layernya di belakang --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel">削除</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>ユーザを削除しますか？</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                      <form action="{{ route('deleteproductsuccess') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="" id="modalUserId" name="user_id">
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
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#userlist').DataTable({
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


</script>
<script>
      function showDeleteModal(user_id) {
        // alert(user_id);
        $('#modalUserId').val(user_id);
        $('#exampleModal').modal('show');
    }
</script>
@endsection