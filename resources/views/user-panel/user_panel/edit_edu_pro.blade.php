@extends('user-panel.master')
@section('title')
    Education & Profession Edit
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow p-4 mb-4">
            <h3>Update Education And Profession Info <small class="text-danger">(You can update your data once.)</small></h3>
        </div>
    </div>
    <div class="container-fluid">
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/user_panel/user_details/edu_pro_details/edit/action', 'method' => 'post']) !!}
        <div class="row p-lg-4 p-md-2">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-ssc_batch" class="col-sm-3 col-form-label">SSC Batch<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="number" placeholder="Enter Your SSC Passing Year" name="ssc_batch" class="form-control col-md-8" id="form-input-ssc_batch" value="{{ (old('ssc_batch')) ? old('ssc_batch') : $edu_pro_details->ssc_batch }}" min="1900" max="2099" step="1" />
                        <span class="text-danger">{{ $errors->has('ssc_batch')? $errors->first('ssc_batch') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-edu_qualification" class="col-sm-3 col-form-label">Education Qualification<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" name="edu_qualification" class="form-control col-md-8" id="form-input-edu_qualification" value="{{ (old('edu_qualification')) ? old('edu_qualification') : $edu_pro_details->edu_qualification }}" placeholder="Enter Education Qualification Last one">
                        <span class="text-danger">{{ $errors->has('edu_qualification')? $errors->first('edu_qualification') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-profession" class="col-sm-3 col-form-label">Profession<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" name="profession" class="form-control col-md-8" id="form-input-profession" value="{{ (old('profession')) ? old('profession') : $edu_pro_details->profession }}" placeholder="Enter your profession">
                        <span class="text-danger">{{ $errors->has('profession')? $errors->first('profession') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-work_address" class="col-sm-3 col-form-label">Work Address<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" name="work_address" class="form-control col-md-8" id="form-input-work_address" value="{{ (old('work_address')) ? old('work_address') : $edu_pro_details->work_address }}" placeholder="Enter Work address">
                        <span class="text-danger">{{ $errors->has('work_address')? $errors->first('work_address') : '' }}</span>
                    </div>
                </div>

            </div>


            <div class="pt-4 pl-2 border-top w-100">
                <a href="{{ route('/user_panel/user_details') }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
    </div>
@endsection
