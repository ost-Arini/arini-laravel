{{ dd($userdata)}}
{{ dd($input)}}

@extends('layouts.app')

@section('title')
<title>Edit Profile Page</title>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Confirmation Page</h1>
            </div>

            <div class="card-body">
                <form id="form" action="{{ route('confirm', ['user_id'=>$user_id]) }}" method="POST">
                
                {{-- @foreach ($input as $item) --}}
                
                
                <div class="card-body">
                        @csrf
                        <div class="form-group mt-5">
                            <label for="user_name">Name</label>
                             <input id="user_name" type="text" name="user_name" class="form-control" value="{{ $input['user_name'] }}" disabled>
                             <input id="user_name" type="hidden" name="user_name" class="form-control" value="{{ $input['user_name'] }}">
                            
                            <!-- buat lempar ID ke confirm page -->
                            <input type="hidden" name="user_id" value="{{ $input['user_id'] }}">
                        </div>
                        
    
                        <div class="form-group mt-5">
                            <label for="email">Email</label>
                            <input id="email" type="type" name="email" class="form-control" value="{{ $input['email'] }}" disabled>
                            <input id="email" type="hidden" name="email" class="form-control" value="{{ $input['email'] }}">
                        </div>
    
                        <div class="form-group mt-5">
                            <label for="real_name">Full Name</label>
                            <input id="real_name" type="type" name="real_name" class="form-control" value="{{ $input['real_name'] }}" disabled>
                            <input id="real_name" type="hidden" name="real_name" class="form-control" value="{{ $input['real_name'] }}">
                        </div>
    
                        <div class="form-group mt-5">
                            <label for="password">Password</label>
                            {{-- disini bikin if condition, kalo input pass nya 0, pake userdata aja --}}
                            <?php if($input['password'] == 0){ ?>
                                <input id="password" type="password" name="password" class="form-control" value="{{ $userdata['password'] }}" disabled>
                                <input id="password" type="hidden" name="password" class="form-control" value="{{ $userdata['password'] }}">
                            <?php } else { ?>
                                <input id="password" type="password" name="password" class="form-control" value="{{ $input['password'] }}" disabled>
                                <input id="password" type="hidden" name="password" class="form-control" value="{{ $input['password'] }}">
                            <?php } ?>
                        </div>
    
                        <div class="form-group">
                            <label>Gender</label> <br>
                            <div class="form-check-inline">
                                <input type="radio" value="1"{{ $input['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="gender" disabled>
                                <input type="hidden" value="1"{{ $input['gender']=='1'?'checked':'' }} class="form-check-input" id="gender" name="gender" >
                                <label>Male</label>
                                
                                <input type="radio" value="2"{{ $input['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="gender" disabled>
                                <input type="hidden" value="2"{{ $input['gender']=='2'?'checked':'' }} class="form-check-input" id="gender" name="gender">
                                <label>Female</label>
                            </div>
                        </div>
    
                        <button type="submit" name="editconfirm" class="btn btn-primary mb-5">Submit</button>
                        <button type="reset" class="btn btn-danger mb-5">Reset</button>
                    </form> 
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection