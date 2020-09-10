@extends('user-panel.master')
@section('title')
    Account Settings
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Account Settings</h1>
                <a href="{{route('customer.printpdf')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
            </div>

        </div>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div>
                        <span class="text-success">{{ Session::get('message')}}</span>
                        <span class="text-danger">{{ Session::get('error_massage')}}</span>
                        <span class="text-danger">{{ (count($errors) != 0) ? $errors : '' }}</span>
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary d-inline-block">Account Settings</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <img class="img-fluid c_img" src="{{ asset('user_panel').'/'.$image->profile_image }}" alt="">
{{--                                        @if($image->check == 0)--}}
                                        <button id="image-change-btn" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Change</button>
{{--                                        @endif--}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-borderless details-show">
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Phone Number</td>
                                            <td>: {{ $account_info->phone }} <span id="change-phone-btn" class="ml-2 edit-btn"><i class="fas fa-edit"></i> change</span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold pt-3" id="change-pass-btn"><button class="btn btn-sm btn-dark" id="pass-change-btn">Change Password</button></td>
                                        </tr>

                                        </tbody>

                                    </table>
                                    <div id="change-phone" class="change-sec">
                                        {!! Form::open(['route' => '/user_panel/account_settings/updatePhone', 'method' => 'post','class'=>'form-inline']) !!}
                                            <div class="input-group input-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
                                                    </div>
                                                    <input required type="text" name="phone" class="form-control input-sec" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>
                                                <div class="input-group-append pl-2">
                                                    <div class="btn-group">
                                                        <button type="submit" name="image_btn" class="btn btn-sm btn-dark">
                                                            <span class="text">Update</span>
                                                        </button>
                                                        <span id="phone-change-cancel" class="btn btn-sm text-white-50 cursor-pointer profile-save-cancel"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div id="change-pass" class="change-sec">
                                        {!! Form::open(['route' => '/user_panel/account_settings/updatePassword', 'method' => 'post']) !!}
                                            <input type="number" hidden name="user_id" value="">
                                            <div class="input-group input-group">
                                                <div class="" id="pass-change">
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Old Password</span>
                                                        </div>
                                                        <input required type="password" name="old_pass" class="form-control input-sec" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">New Password</span>
                                                        </div>
                                                        <input required type="password" name="password" class="form-control input-sec" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Confirm New Pass</span>
                                                        </div>
                                                        <input required type="password" name="password_confirmation" class="form-control input-sec" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="submit" name="image_btn" class="btn btn-sm btn-dark">
                                                            <span class="text">Update</span>
                                                        </button>
                                                        <span id="pass-change-cancel" class="btn btn-sm text-white-50 cursor-pointer profile-save-cancel"><i class="fas fa-times"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                @if($image->check == 0)--}}
                    <div id="change-image" class="change-sec mb-4 ml-3">
                        {!! Form::open(['route' => '/user_panel/account_settings/updateImage', 'method' => 'post','class'=>'form-inline','enctype'=>'multipart/form-data']) !!}
                            <input type="number" hidden name="user_id" value="">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="custom-file custom-file-sm overflow-hidden">
                                        <input required type="file" name="profile_image" class="custom-file-input input-sec" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <div class="input-group-append pl-2">
                                    <div class="btn-group btn-group-sm">
                                        <button type="submit" name="image_btn" class="btn btn-sm btn-dark">
                                            <span class="text">Update</span>
                                        </button>
                                        <span id="image-change-cancel" class="btn btn-sm text-white-50 cursor-pointer profile-save-cancel"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
{{--                @endif--}}
            </div>
            @if(isset($phone) && isset($otp) && isset($vpdxs))
            <div class="card shadow">
                <div class="card-header">
                    A verification code send to your update phone number ({{ $phone }}).
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => '/user_panel/account_settings/updatePhone/confirm', 'method' => 'post','class'=>'form-inline']) !!}
                        <input type="text" hidden name="otp" value="{{ $otp }}">
                        <input type="text" hidden name="vpdxs" value="{{ $vpdxs }}">
                        <div class="input-group input-group-sm">
                            <div class="form-group input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">verification code</span>
                                </div>
                                <input required type="text" name="code" class="form-control input-sec" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="form-group pl-2">
                                <button type="submit" class="btn btn-sm btn-dark mr-2">
                                    confirm
                                </button>
                                <a href="{{ route('/user_panel/account_settings') }}" class="btn btn-sm btn-secondary btn-sm">Cancel</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
{{--        @if($image->check == 0)--}}
        $('#image-change-btn').click(function(){
            $('.change-sec').css('display','none');
            $('#change-image').css('display','flex');
            $('.input-sec').val('');
        })
        $('#image-change-cancel').click(function(){
            $('#change-image').css('display','none');
            $('.input-sec').val('');
        })
{{--        @endif--}}
        $('#change-phone-btn').click(function(){
            $('.change-sec').css('display','none');
            $('#change-phone').css('display','flex');
            $('.input-sec').val('');
        })
        $('#phone-change-cancel').click(function(){
            $('#change-phone').css('display','none');
            $('.input-sec').val('');
        });
        $('#change-pass-btn').click(function(){
            $('.change-sec').css('display','none');
            $('#change-pass').css('display','flex');
            $('.input-sec').val('');
        })
        $('#pass-change-cancel').click(function(){
            $('#change-pass').css('display','none');
            $('.input-sec').val('');
        });
    </script>
    <script>
        $('#inputGroupFile01').on('change',function(e){
            //get the file name
            var fileName = $(this).val();
            fileName = e.target.files[0].name
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection
