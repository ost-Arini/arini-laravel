@extends('layouts.app')

@section('title')
<title>Profile Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">マイページ</h1>
            </div>

            <div class="card-body">
                <table cellpadding='8'>
                    <tr>
                        <th class="text-right">ユーザ名</th>
                        <td> {{ $users->user_name }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">メール</th>
                        <td> {{ $users->email }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">名前</th>
                        <td> {{ $users->real_name }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">生年月日</th>
                        <td> {{ $users->birthday }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">性別</th>
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