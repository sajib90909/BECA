@extends('admin-panel.master')
@section('title')
    Account Settings ({!! strtolower($image->name) !!})
@stop
@section('content')
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/admin_panel/members/account_settings/action/edit/', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
        <div class="row p-lg-4 p-md-2">
            <div class="col-lg-6">
                <input type="text" hidden name="user_id" value="{{ $account_info->id }}" required >
                <div class="form-group row">
                    <label for="form-input-second_email" class="col-sm-3 col-form-label">Change Phone<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" required name="phone" class="form-control col-md-8" id="form-input-name" value="{{ (old('phone')) ? old('phone') : $account_info->phone }}">
                        <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-secondary_number" class="col-sm-3 col-form-label">Change Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control col-md-8" id="form-input-work_address" placeholder="*********">
                        <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                    </div>
                </div>

                <div class="">
                    <img src="{{ asset('user_panel/'.$image->profile_image) }}" class="rounded mx-auto d-block w-25 pb-3" alt="img-thumbnail">
                    <div class="form-group row">
                        <label for="form-input-profile_image" class="col-sm-3 col-form-label">Change Image</label>
                        <div class="col-sm-9">
                            <input type="file" name="profile_image" class="form-control col-md-8" id="form-input-profile_image">
                            <span class="text-danger">{{ $errors->has('profile_image')? $errors->first('profile_image') : '' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-4 pl-2 border-top w-75">
                <button type="submit" class="btn btn-info mb-2 w-50">Submit</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
@endsection
