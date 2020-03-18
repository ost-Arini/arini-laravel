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
                            <th colspan="2">ユーザID</th>
                            <th>ユーザ名</th>
                            <th>メール</th>
                            <th>性別</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ var_dump($userlist)}} --}}
                    @foreach($userlist as $user)
                        <tr>
                            {{-- {{  }} ini mirip dengan echo --}}
                            <th scope="row"> {{ $user['user_id'] }}</th>
                            <td colspan="2"> {{ $user['user_name'] }} </td>
                            <td> {{ $user['email'] }}</td>
                            <td> {{ $user['gender']== 1 ? '男性' : '女性' }}</td>
                            <td><a class="btn btn-info" id="update" href="">更新</a></td>
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