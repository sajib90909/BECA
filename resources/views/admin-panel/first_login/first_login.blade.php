@extends('admin-panel.master')
@section('title')
    Dashboard
@stop
@section('content')

    <div id="content">
        <!-- Begin Page Content -->
        <div class="modal-backdrop first-login-model fade show nw-overlay"></div>
        <div class="container-fluid parent-all-form">
            <div class="card form-all">
                <div class="card-body">
                    <div class="border-bottom">
                        <h4 class="text-primary">Need to fill up this information</h4>
                    </div>
                    <div class="text-right">
                        <a class="dropdown-item" href="{{ route('/admin_panel/logout/action') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('/admin_panel/logout/action') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div class="">
                        {!! Form::open(['route' => '/admin_panel/action/firstLogin', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                @if(empty($admin_data->name))
                                <div class="form-group row">
                                    <label for="form-input-user_nid_pass_doc" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input required type="text" name="name" placeholder="Enter Your Full Name" class="form-control col-md-8" id="form-input-user_nid_pass_doc">
                                        <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
                                    </div>
                                </div>
                                @endif
                                @if(empty($admin_data->email))
                                <div class="form-group row">
                                    <label for="form-input-user_cadet_certificate_doc" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input required type="email" name="email" class="form-control col-md-8" placeholder="Enter Your Email" id="form-input-user_cadet_certificate_doc">
                                        <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="form-input-user_beca_doc" class="col-sm-3 col-form-label">Profile Image</label>
                                    <div class="col-sm-9">
                                        <input required type="file"  name="image" class="form-control col-md-8" id="form-input-user_beca_doc">
                                        <span class="text-danger">{{ $errors->has('image')? $errors->first('image') : '' }}</span>
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
