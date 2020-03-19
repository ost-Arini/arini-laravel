@extends('layouts.app')

@section('title')
<title>Edit Profile Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Edit Profile</h1>
            </div>

            {{-- pake nama name routenya buat di action --}}
            <form id="form" action="{{ route('confirm', ['user_id'=>$user_id]) }}" method="POST">
    
            @foreach ($userdata as $item)
            
            <div class="card-body">
                    @csrf
                    <div class="form-group mt-5">
                        <label for="user_name">Name</label>
                        <input id="user_name" type="text" name="user_name" class="form-control" value="{{ $item['user_name'] }}" disabled>
                        <input id="user_name" type="hidden" name="user_name" class="form-control" value="{{ $item['user_name'] }}" >
                        <!-- buat lempar ID ke confirm page -->
                        <input type="hidden" name="user_id" value="{{ $item['user_id'] }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="email">Email</label>
                        <input id="email" type="type" name="email" class="form-control" value="{{ $item['email'] }}" disabled>
                        <input id="email" type="hidden" name="email" class="form-control" value="{{ $item['email'] }}" >
                    </div>

                    <div class="form-group mt-5">
                        <label for="real_name">Full Name</label>
                        <input id="real_name" type="type" name="real_name" class="form-control" value="{{ $item['real_name'] }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control" value="">
                        <input id="password" type="hidden" name="password" class="form-control" value="{{ $item['password'] }}">
                    </div>

                    <div class="form-group mt-5">
                        <label for="birthday">Birthday</label>
                        <input id="birthday" type="birthday" name="birthday" class="form-control" value="{{ $item['birthday'] }}" disabled>
                        <input id="birthday" type="hidden" name="birthday" class="form-control" value="{{ $item['birthday'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Gender</label> <br>
                        <div class="form-check-inline">
                            <input type="radio" value="1"{{ $item['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="gender" disabled>
                            <input type="hidden" value="1"{{ $item['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="gender">
                            <label>Male</label>
                            
                            <input type="radio" value="2"{{ $item['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="gender" disabled>
                            <input type="hidden" value="2"{{ $item['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="gender">
                            <label>Female</label>
                        </div>
                    </div>

                    <button type="submit" name="editsubmit" class="btn btn-primary mb-5">Submit</button>
                    <button type="reset" class="btn btn-danger mb-5">Reset</button>
                </form> 
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection