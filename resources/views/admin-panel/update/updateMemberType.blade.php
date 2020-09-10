@extends('admin-panel.master')
@section('title')
    Update Member Type
@stop
@section('content')
    <div class="card shadow mb-4 col-lg-6 col-xl-4">
        <div class="py-3">
            <div class="">
                <span class="text-success">{{ Session::get('message')}}</span>
                {!! Form::open(['route' => 'admin_panel/edit/action/member_type', 'method' => 'post','class' => 'py-lg-2']) !!}
                <input type="number" hidden required value="{{ $members_type->id }}" name="member_type_id">
                <div class="form-group">
                    <label for="type_name">Member Type Name</label>

                    <input type="text" class="form-control" name="type_name" id="type_name" value="{{ !empty(old('type_name')) ? old('type_name'): $members_type->type_name}}" placeholder="Member Type Name">
                    <span class="text-danger">{{ $errors->has('type_name')? $errors->first('type_name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="payment_amount">Payment Amount</label>
                    <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="{{ !empty(old('payment_amount')) ? old('payment_amount'): $members_type->payment_amount}}" placeholder="Enter Payment Amount">
                    <span class="text-danger">{{ $errors->has('payment_amount')? $errors->first('payment_amount') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="time_duration">Time Duration</label>
                    <input type="text" class="form-control" name="time_duration" id="time_duration" value="{{ !empty(old('time_duration')) ? old('time_duration'): $members_type->time_duration}}" placeholder="Enter Time Duration">
                    <span class="text-danger">{{ $errors->has('time_duration')? $errors->first('time_duration') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="details">Add description <small>(optional)</small></label>
                    <textarea class="form-control" name="details" id="details" rows="3">{{ old('details') }}{{ !empty(old('details')) ? old('details'): $members_type->details}}</textarea>
                    <span class="text-danger">{{ $errors->has('details')? $errors->first('details') : '' }}</span>
                </div>
                <input class="btn btn-success mt-2" type="submit" name="" value="Update">
                <a class="btn btn-dark float-right mt-2" href="{{ route('/admin_panel/add/members_type') }}">Back</a>
                {!! Form::close() !!}

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
@stop
