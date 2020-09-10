@extends('user-panel.master')
@section('title')
    Contact Info Update
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow p-4 mb-4">
            <h3>Update Contact Info <small class="text-danger">(You can update your data once.)</small></h3>
        </div>
    </div>
    <div class="container-fluid">

    <div class="card shadow p-2">
        {!! Form::open(['route' => '/user_panel/user_details/contact_details/edit/action', 'method' => 'post']) !!}
        <div class="row p-lg-4 p-md-2">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-second_email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control col-md-8" id="form-input-name" value="{{ (old('email')) ? old('email') : $contact_details->email }}" placeholder="Enter Email">
                        <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-secondary_number" class="col-sm-3 col-form-label">Secondary Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="secondary_number" class="form-control col-md-8" id="form-input-work_address" value="{{ (old('secondary_number')) ? old('secondary_number') : $contact_details->secondary_number }}" placeholder="Enter Secondary Number">
                        <span class="text-danger">{{ $errors->has('secondary_number')? $errors->first('secondary_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-emergency_number" class="col-sm-3 col-form-label">Emergency Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="emergency_number" class="form-control col-md-8" id="form-input-emergency_number" value="{{ (old('emergency_number')) ? old('emergency_number') : $contact_details->emergency_number }}" placeholder="Enter Emergency Number">
                        <span class="text-danger">{{ $errors->has('emergency_number')? $errors->first('emergency_number') : '' }}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="form-input-facebook" class="col-sm-3 col-form-label">Facebook Id (url)</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" class="form-control col-md-8" id="form-input-facebook" value="{{ (old('facebook')) ? old('facebook') : $contact_details->facebook }}" placeholder="Enter Facebook Id (url)">
                        <span class="text-danger">{{ $errors->has('facebook')? $errors->first('facebook') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-twitter" class="col-sm-3 col-form-label">Twitter Id (url)</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" class="form-control col-md-8" id="form-input-twitter" value="{{ (old('twitter')) ? old('twitter') : $contact_details->twitter }}" placeholder="Enter Twitter Id (url)">
                        <span class="text-danger">{{ $errors->has('twitter')? $errors->first('twitter') : '' }}</span>
                    </div>
                </div><div class="form-group row">
                    <label for="form-input-skype" class="col-sm-3 col-form-label">Skype Id (url)</label>
                    <div class="col-sm-9">
                        <input type="text" name="skype" class="form-control col-md-8" id="form-input-skype" value="{{ (old('skype')) ? old('skype') : $contact_details->skype }}" placeholder="Enter Skype Id (url)">
                        <span class="text-danger">{{ $errors->has('skype')? $errors->first('skype') : '' }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 pl-2 border-top w-100">
                <a href="{{ route('/user_panel/contact_info') }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>

    </div>
@endsection
