<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/') }}admin-panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/') }}admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}admin-panel/css/style.css" rel="stylesheet">

</head>

<body class="login-body">
<div class="login-card">
    <div class="login-card-cont">
        <div class="m-auto card border-secondary mb-3 shadow" style="max-width: 18rem;">


{{--            forget password step-one  --}}
            @if ($action == 'forgetpass')
                <div class="card-header text-primary">Forget Password</div>
                <div class="card-body text-secondary">
                    <div class="text-center pb-2 text-warning">
                        <small>Enter Your Phone Number To reset Password</small>
                    </div>
                    {!! Form::open(['route' => '/admin_panel/forgetPass/verify', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone Number</label>
                        <input required autocomplete="off" type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="">
                        <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>
                    </div>
                    <div class="text-right">
                        <input class="btn btn-success mt-2" type="submit" name="" value="Next">
                    </div>

                    {!! Form::close() !!}
                    <a href="{{ route('/admin_panel/login') }}" class="btn btn-link">Back to login</a>
                </div>

{{--            forget password step-two  --}}
            @elseif ($action == 'verify')
                <div class="card-header text-primary">Forget Password</div>
                <div class="card-body text-secondary">
                    <div class="text-center pb-2 text-warning">
                        <small>A verification code send to your phone.</small>
                    </div>
                    {!! Form::open(['route' => '/admin_panel/forgetPass/resetpass', 'method' => 'post']) !!}
                    <input type="text" hidden required value="{{ $phone }}" name="phone">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Verification Code</label>
                        <input required autocomplete="off" type="text" class="form-control" name="token" id="token" value="{{ old('token') }}" placeholder="">
                        <span class="text-danger">{{ $errors->has('token')? $errors->first('token') : '' }}</span>
                    </div>
                    <div class="text-right">
                        <input class="btn btn-success mt-2" type="submit" name="" value="Verify">
                    </div>

                    {!! Form::close() !!}
                    <a href="{{ route('/admin_panel/login') }}" class="btn btn-link">Back to login</a>
                </div>

{{--            forget password step-three  --}}
            @elseif ($action == 'passreset')
                <div class="card-header text-primary">Password Reset</div>
                <div class="card-body text-secondary">
                    {!! Form::open(['route' => '/admin_panel/action/forgetPass', 'method' => 'post']) !!}
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

                    {!! Form::close() !!}
                    <a href="{{ route('/admin_panel/login') }}" class="btn btn-link">Back to login</a>
                </div>


{{--            login  --}}
            @else
                <div class="card-header text-primary">Admin Login</div>
                <div class="card-body text-secondary">
                    <span class="text-danger">{{ Session::get('error_message')}}</span>
                    <span class="text-success">{{ Session::get('message')}}</span>
                    {!! Form::open(['route' => '/admin_panel/login/action', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="user_name">UserName</label>
                        <input required type="text" class="form-control" name="user_name" id="user_name" value="{{ old('user_name') }}" placeholder="">
                        <span class="text-danger">{{ $errors->has('user_name')? $errors->first('user_name') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input required type="password" class="form-control" name="password" id="password" placeholder="">
                        <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                    </div>
                    <div class="text-right">
                        <input class="btn btn-success mt-2" type="submit" name="" value="Login">
                    </div>

                    {!! Form::close() !!}
                    <a href="{{ route('/admin_panel/login/forget_pass') }}" class="btn btn-link">Forget Password?</a>
                </div>
            @endif

        </div>
    </div>

</div>

</body>
