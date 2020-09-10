@extends('user-panel.master')
@section('title')
    Documents Edit
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow p-4 mb-4">
            <h3>Update Document Info <small class="text-danger">(You can update your data once.)</small></h3>
        </div>
    </div>
    <div class="container-fluid">
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/user_panel/user_details/document_details/edit/action', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
        <div class="row p-lg-4 p-md-2">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-user_nid_pass_doc" class="col-sm-3 col-form-label">NID/Passport</label>
                    <div class="col-sm-9">
                        <input type="file" name="user_nid_pass_doc" class="form-control col-md-8" id="form-input-user_nid_pass_doc">
                        <span class="text-danger">{{ $errors->has('user_nid_pass_doc')? $errors->first('user_nid_pass_doc') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-user_cadet_certificate_doc" class="col-sm-3 col-form-label">Cadet Certificate</label>
                    <div class="col-sm-9">
                        <input type="file" name="user_cadet_certificate_doc" class="form-control col-md-8" id="form-input-user_cadet_certificate_doc">
                        <span class="text-danger">{{ $errors->has('user_cadet_certificate_doc')? $errors->first('user_cadet_certificate_doc') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-user_beca_doc" class="col-sm-3 col-form-label">Beca Documents</label>
                    <div class="col-sm-9">
                        <input type="file" name="user_beca_doc" class="form-control col-md-8" id="form-input-user_beca_doc">
                        <span class="text-danger">{{ $errors->has('user_beca_doc')? $errors->first('user_beca_doc') : '' }}</span>
                    </div>
                </div>
            </div>
            <div class="pt-4 pl-2 border-top w-100">
                <a href="{{ route('/user_panel/verification_doc') }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
    </div>
@endsection
