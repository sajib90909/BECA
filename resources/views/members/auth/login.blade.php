@extends('members.master')
@section('content')
    <div class="p-4">
        <div class="">
            <a class="text-light" href="{{ route('/') }}">
                <p class="my-2 font-weight-bold btn btn-success ">Home</p>
            </a>
        </div>
        <div class="text-center">
            <span class="text-success">{{ Session::get('message')}}</span>
            <span class="text-danger">{{ Session::get('error_message')}}</span>
        </div>
        <div class="w-customs bg-light p-2 rounded m-auto">
            @if ($action == 'forget_pass')
                {!! Form::open(['route' => '/forget_password/phone_verify', 'method' => 'post']) !!}
                <div class="form-group">
                    <label>Give Your Phone Number</label>
                    <input required type="text" class="form-control form-control-sm" name="phone" placeholder="Enter phone">
                    <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>

                </div>

                <div class=" text-right">
                    <button type="submit" name="login_action" class="btn btn-success btn-sm">Submit</button>
                </div>
                <div> <a href="{{ route('/login') }}" class="text-success"><i class="fas fa-long-arrow-alt-left"></i> Back to login</a> </div>
                {!! Form::close() !!}
            @elseif($action == 'phone_verify')
                <div class="text-primary">A Verification Code Send to Your phone number</div>
                {!! Form::open(['route' => '/reset_password', 'method' => 'post']) !!}
                <input type="text" hidden required value="{{ $phone }}" name="phone">
                <div class="form-group">
                    <label>Verification Code</label>
                    <input required type="text" class="form-control form-control-sm" name="token" placeholder="Enter Verification Code Here">
                    <span class="text-danger">{{ $errors->has('token')? $errors->first('token') : '' }}</span>
                </div>

                <div class=" text-right">
                    <button type="submit" name="login_action" class="btn btn-success btn-sm">Submit</button>
                </div>
                <div> <a href="{{ route('/login') }}" class="text-success"><i class="fas fa-long-arrow-alt-left"></i> Back to login</a> </div>
                {!! Form::close() !!}
            @elseif($action == 'reset_pass')
                <div class="text-primary pb-2">Resset Your Password</div>
                {!! Form::open(['route' => '/reset_password/action', 'method' => 'post']) !!}
                <input type="text" hidden required value="{{ $phone }}" name="phone">
                <input type="text" hidden required value="{{ $token }}" name="token">
                <div class="form-group">
                    <label for="exampleFormControlInput1">New Password</label>
                    <input required autocomplete="off" type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="">
                    <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Confirm New Password</label>
                    <input required autocomplete="off" type="password" class="form-control" name="password_confirmation" id="exampleFormControlInput1" placeholder="">
                    <span class="text-danger">{{ $errors->has('password_confirmation')? $errors->first('password_confirmation') : '' }}</span>
                </div>
                <div class="text-right">
                    <input class="btn btn-success mt-2" type="submit" name="" value="Submit">
                </div>
                <div> <a href="{{ route('/login') }}" class="text-success"><i class="fas fa-long-arrow-alt-left"></i> Back to login</a> </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => '/login/action', 'method' => 'post']) !!}
                <div class="form-group">
                    <label>Phone number</label>
                    <input required type="text" class="form-control form-control-sm" name="phone" placeholder="Enter phone">
                    <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input required type="password" class="form-control form-control-sm" name="password" placeholder="Enter Password">
                    <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                    <small class="text-success"> <a href="{{ route('/forget_password') }}">Forgot Password?</a> </small>
                </div>
                <div class=" text-right">
                    <button type="submit" name="login_action" class="btn btn-success btn-sm">Login</button>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>

@endsection
