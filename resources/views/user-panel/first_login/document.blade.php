@extends('user-panel.master')
@section('title')
    Documents
@endsection
@section('content')
    <!-- Main Content -->

    <div id="content">
        <!-- Begin Page Content -->
        <div class="modal-backdrop fade show nw-overlay"></div>
        <div class="container-fluid parent-all-form">
            <div class="card form-all">
                <div class="card-body">
                    <div class="border-bottom">
                        <h4 class="text-primary">You need to Verify your documents</h4>
                    </div>
                    <div class="text-right">
                        <a class="dropdown-item" href="{{ route('/logout/action') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('/logout/action') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div class="">
                        {!! Form::open(['route' => '/user_panel/first_login/document_details/edit/action', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-user_nid_pass_doc" class="col-sm-3 col-form-label">NID/Passport{!! (isset($doc_need->user_nid_pass_doc) && $doc_need->user_nid_pass_doc == 1)? '<span class="text-danger h5">*</span>' : '' !!}</label>
                                    <div class="col-sm-9">
                                        <input {{ (isset($doc_need->user_nid_pass_doc) && $doc_need->user_nid_pass_doc == 1)? 'required' : '' }} required type="file" name="user_nid_pass_doc" class="form-control col-md-8" id="form-input-user_nid_pass_doc">
                                        <span class="text-danger">{{ $errors->has('user_nid_pass_doc')? $errors->first('user_nid_pass_doc') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-user_cadet_certificate_doc" class="col-sm-3 col-form-label">Cadet Certificate{!! (isset($doc_need->user_cadet_certificate_doc) && $doc_need->user_cadet_certificate_doc == 1)? '<span class="text-danger h5">*</span>' : '' !!}</label>
                                    <div class="col-sm-9">
                                        <input type="file" {{ (isset($doc_need->user_cadet_certificate_doc) && $doc_need->user_cadet_certificate_doc == 1)? 'required' : '' }} name="user_cadet_certificate_doc" class="form-control col-md-8" id="form-input-user_cadet_certificate_doc">
                                        <span class="text-danger">{{ $errors->has('user_cadet_certificate_doc')? $errors->first('user_cadet_certificate_doc') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-user_beca_doc" class="col-sm-3 col-form-label">Beca Documents{!! (isset($doc_need->user_beca_doc) && $doc_need->user_beca_doc == 1)? '<span class="text-danger h5">*</span>' : '' !!}</label>
                                    <div class="col-sm-9">
                                        <input type="file" {{ (isset($doc_need->user_beca_doc) && $doc_need->user_beca_doc == 1)? 'required' : '' }} name="user_beca_doc" class="form-control col-md-8" id="form-input-user_beca_doc">
                                        <span class="text-danger">{{ $errors->has('user_beca_doc')? $errors->first('user_beca_doc') : '' }}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Submit</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
