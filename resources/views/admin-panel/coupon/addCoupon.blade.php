@extends('admin-panel.master')
@section('title')
    ADD Unite
@stop
@section('content')
    <div class="card shadow mb-4 d-inline-block col-lg-6 col-xl-4">
        <div class="py-3">
            <div class="">
                <span class="text-success">{{ Session::get('message')}}</span>
                {!! Form::open(['route' => '/admin_panel/newCreate/coupons/action', 'method' => 'post','class' => 'py-lg-2']) !!}
                <div class="form-group">
                    <label for="type_name">Coupon Code</label>
                    <input required readonly type="text" class="form-control" name="code" id="type_name" value="{{ (old('code')) ? old('code') : $couponsCode }}">
                    <span class="text-danger">{{ $errors->has('code')? $errors->first('code') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="unite_id_id">Member Type</label>
                    <select required class="form-control" name="member_type" id="unite_id_id">
                        <option value="">Select Membership Type</option>
                        @foreach($members_type as $member_type)
                            <option value="{{ $member_type->id }}">{{ $member_type->type_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('member_type')? $errors->first('member_type') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="user_phone">Assigned user by phone</label>
                    <input type="text" class="form-control" name="user_phone" id="user_phone" value="{{ old('user_phone') }}" placeholder="Enter user phone number">
                    <span class="text-danger">{{ $errors->has('user_phone')? $errors->first('user_phone') : '' }}</span>
                </div>
                @if(Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author')
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="receive_cash" id="defaultCheck1" checked>
                    <label class="form-check-label" for="defaultCheck1">
                        Cash Received
                    </label>
                </div>
                @endif
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="1" name="send_code" id="defaultCheck2" checked>
                    <label class="form-check-label" for="defaultCheck2">
                        Send Code to users phone
                    </label>
                </div>
                <input class="btn btn-success mt-2" type="submit" name="" value="Add Coupon">
                <a class="btn btn-dark float-right mt-2" href="{{ route('/admin_panel/admins') }}">Back</a>
                {!! Form::close() !!}

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
@stop
