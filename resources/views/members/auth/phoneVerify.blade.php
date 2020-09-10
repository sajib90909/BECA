@extends('members.master')
@section('content')
    <div class="p-4">
        <div class="">
            <a class="text-light" href="{{ route('/') }}">
                <p class="my-2 font-weight-bold btn btn-success ">Home</p>
            </a>
        </div>
        <div>
            <h4 class="text-center">Verify Phone Number</h4>
        </div>
        <div class="p-2 rounded text-center text-gray-600">
            <p >A verification code send your phone number. if you not get any Code please wait 5 minute!</p>
        </div>
        <div class="w-customs bg-light p-2 rounded m-auto">
            {!! Form::open(['route' => '/registration/phoneVerify/action', 'method' => 'post']) !!}
            <div class="form-group">
                <label>Code</label>
                <input required type="number" class="form-control form-control-sm" name="code" placeholder="Enter Code to Confirm">
                <span class="text-danger">{{ $errors->has('code')? $errors->first('code') : '' }}</span>
            </div>
            <input required hidden type="text" name="otp" value="{{ $otp }}">
            <input required hidden type="text" name="name" value="{{ $name }}">
            <input required hidden type="text" name="phone" value="{{ $phone }}">
            <input required hidden type="password" name="password" value="{{ $password }}">
            <input required hidden type="number" name="current_unite" value="{{ $current_unite }}">
            <input required hidden type="password" name="password_confirmation" value="{{ $password }}">
            <div class=" text-right">
                <button type="submit" name="login_action" class="btn btn-success btn-sm">Verify</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection
