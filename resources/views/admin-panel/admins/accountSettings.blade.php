@extends('admin-panel.master')
@section('title')
    Update Your Account
@stop
@section('content')
    <div class="card shadow mb-4 d-inline-block col-lg-6 col-xl-4">
        <div class="py-3">
            <div class="">
                <span class="text-success">{{ Session::get('message')}}</span>
                {!! Form::open(['route' => 'admin_panel/update/account/action', 'method' => 'post','class' => 'py-lg-2','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <img src="{{ asset('admin-panel/'.( ($account_data->image) ? $account_data->image : '/admin_profile_images/thumbnail.png')) }}" class="rounded mx-auto d-block w-25 pb-3" alt="img-thumbnail">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <span class="text-danger">{{ $errors->has('image')? $errors->first('image') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" name="name" id="fullname" value="{{ !empty(old('name')) ? old('name'): $account_data->name}}" placeholder="Enter Full Name">
                    <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ !empty(old('email')) ? old('email'): $account_data->email}}" placeholder="Enter Email">
                    <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="form_password">Password</label>
                    <input type="password" class="form-control" name="password" id="form_password" placeholder="Enter Password">
                    <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                </div>
                <input class="btn btn-success mt-2" type="submit" name="" value="Update">
                {!! Form::close() !!}

            </div>
            <div class="p-4 m-2 rounded border border-danger">
                <h5 class="text-danger">You cant change this information. if you want contact with authorities</h5>
                <div>
                    <span><strong>Unite name:</strong> {{ $unite_name->unite_name }}</span>
                </div>
                <div>
                    <span><strong>User name:</strong> {{ $account_data->user_name }}</span>
                </div>
                <div>
                    <span><strong>Phone:</strong> {{ $account_data->phone }}</span>
                </div>
                <div>
                    <span><strong>Beca id:</strong> {{ $account_data->beca_reg_id }}</span>
                </div>

            </div>
            <div class="col-lg-4"></div>

        </div>
    </div>
@stop
