@extends('layouts.app')

@section('title')
<title>Edit Profile Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">編集</h1>
            </div>

            {{-- pake nama name routenya buat di action --}}
            <form id="form" action="{{ route('confirm') }}" method="POST">
    
            @foreach ($userdata as $item)
            
            <div class="card-body">
                    @csrf
                    <div class="form-group mt-5">
                        <label for="user_name">ユーザ名</label>
                        <input id="user_name" type="text" name="" class="form-control" value="{{ $item['user_name'] }}" disabled>
                        <input id="user_name" type="hidden" name="user_name" class="form-control" value="{{ $item['user_name'] }}" >
                        <!-- buat lempar ID ke confirm page -->
                        <input type="hidden" name="user_id" value="{{ $item['user_id'] }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="email">メール</label>
                        <input id="email" type="type" name="" class="form-control" value="{{ $item['email'] }}" disabled>
                        <input id="email" type="hidden" name="email" class="form-control" value="{{ $item['email'] }}" >
                    </div>

                    <div class="form-group mt-5">
                        <label for="real_name">名前</label>
                        <input id="real_name" type="type" name="real_name" class="form-control @error('real_name') is-invalid @enderror" value="{{ $item['real_name'] }}"　autocomplete="real_name" autofocus>
                        @error('real_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>

                    <div class="form-group mt-5">
                        <label for="password">パスワード</label>
                        <input id="password" type="password" name="password" class="form-control" value="">
                        <input id="password" type="hidden" name="oldpassword" class="form-control" value="{{ $item['password'] }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="birthday">生年月日</label>
                        <input id="birthday" type="birthday" name="" class="form-control" value="{{ $item['birthday'] }}" disabled>
                        <input id="birthday" type="hidden" name="birthday" class="form-control" value="{{ $item['birthday'] }}" >
                    </div>

                    <div class="form-group">
                        <label>性別</label> <br>
                        <div class="form-check-inline">
                            <input type="radio" value="1"{{ $item['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="" disabled>
                            <input type="hidden" value="1"{{ $item['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="gender">
                            <label>男性</label>
                            
                            <input type="radio" value="2"{{ $item['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="" disabled>
                            <input type="hidden" value="2"{{ $item['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="gender">
                            <label>女性</label>
                        </div>
                    </div>

                    <button type="submit" name="editsubmit" class="btn btn-primary mb-5">編集</button>
                    <button type="reset" class="btn btn-danger mb-5">リセット</button>
                </form> 
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection