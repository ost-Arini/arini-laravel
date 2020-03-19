@extends('layouts.app')

@section('title')
<title>User List Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h1>User List</h1>
            </div>

            <div class="card-body">
                <table cellpadding='8'>
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="2">ユーザ名</th>
                            <th>名前</th>
                            <th>メール</th>
                            <th>生年月日</th>
                            <th>性別</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ var_dump($userlist)}} --}}
                    @foreach($userlist as $user)
                        <tr>
                            {{-- {{  }} ini mirip dengan echo --}}
                            <th scope="row"> {{ $user['user_name'] }}</th>
                            <td colspan="2"> {{ $user['real_name'] }} </td>
                            <td> {{ $user['email'] }}</td>
                            <td> {{ $user['birthday'] }}</td>
                            <td> {{ $user['gender']== 1 ? '男性' : '女性' }}</td>
                            {{-- <td><a class="btn btn-info" id="update" href="">更新</a></td> --}}
                        </tr>
                    @endforeach
                    </tbody>
                    {{-- @php
                        
                    @endphp --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection