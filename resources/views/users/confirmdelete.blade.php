@extends('layouts.app')

@section('title')
<title>Confirm Delete User</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Confirm Delete User</h1>
            </div>

            <div class="card-body">
                <table cellpadding='8'>
                    <tr>
                        <th class="text-right">Name</th>
                        <td> {{ $users->user_name }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">Email</th>
                        <td> {{ $users->email }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">Full name</th>
                        <td> {{ $users->real_name }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">Birthday</th>
                        <td> {{ $users->birthday }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">Gender</th>
                        <td> {{ $users->gender == 1 ? '男性' : '女性' }} </td>
                    </tr>
                    {{-- <tr>
                        <td><a class="btn btn-info" id="update" href="/edit/{{ auth()->user()->user_id }}">更新</a></td>
                        <td><a class="btn btn-danger" id="delete" href="">削除</a></td>
                    </tr> --}}
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection