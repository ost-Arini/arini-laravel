{{-- {{dd($userdata)}} --}}
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

            @if(session()->has('errormessage'))
              <div class="alert alert-danger text-center">
                {{ session()->get('errormessage') }}
              </div>
            @endif

            <div class="card-body">
                <table cellpadding='8'>
                    @foreach($userdata as $item)
                    <tr>
                        <th class="text-right">ユーザ名</th>
                        <td> {{ $item['user_name'] }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">メール</th>
                        <td> {{ $item['email'] }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">名前</th>
                        <td> {{ $item['real_name'] }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">生年月日</th>
                        <td> {{ $item['birthday'] }} </td>
                    </tr>
                    <tr>
                        <th class="text-right">性別</th>
                        <td> {{ $item['gender'] == 1 ? '男性' : '女性' }} </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection