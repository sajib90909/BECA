@extends('admin-panel.master')
@section('title')
    Edit '{!! strtolower($personal_info->name) !!}' Beca Details
@stop
@section('content')
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/admin_panel/members/document_details/edit/action', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
        <div class="row p-lg-4 p-md-2">
            <input type="number" name="user_id" value="{{ $doc_files->user_id }}" hidden>
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
                <a href="{{ route('/admin_panel/members/details/',['user_id'=>$doc_files->user_id]) }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>

@endsection
