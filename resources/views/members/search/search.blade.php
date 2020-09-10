@extends('members.master')
@section('content')
    <div class="p-4">
        <div class="">
            <a class="text-light" href="{{ route('/') }}">
                <p class="my-2 font-weight-bold btn btn-success ">Home</p>
            </a>
        </div>
    {!! Form::open(['route' => '/search_members/result', 'method' => 'post','class' => 'py-lg-2','onsubmit'=>"return isreCaptchaChecked()"]) !!}
            <!-- <h3 style="color: red;">THIS PAGE IS UNDER CONSTRUCTION; PLEASE TRY AGAIN LATER!</h3> -->
            <div class="pb-md-4">
                <h3 class="text-center">Search Member</h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Registration No.<span class="text-danger"> *</span></label>
                        <div class="col-sm-8">
                            <input id="reg_ful_no" name="reg_number" type="number" class="form-control" value="" required="">
                            <span class="text-dark">Only input Numeric Number, Without A-Z( like 1,2,3 ).</span>
                            <span class="text-danger">{{ $errors->has('reg_number')? $errors->first('reg_number') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Captcha<span class="text-danger"> *</span></label>
                        <div class="col-sm-6">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}" data-callback="recaptchaCallback"></div>
                            <span class="text-danger">{{ $errors->has('g-recaptcha-response')? $errors->first('g-recaptcha-response') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                            <button id="submitButton" name="submitButton" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search Member</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        {!! Form::close() !!}

        @if($action == 'search_result')
            @if(!empty($data))
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr><th colspan="3" align="center"><h4><strong>Member's Information</strong></h4></th>
                    </tr></thead>
                    <tbody>
                    <tr>
                        <th width="20%">Reg. Number</th>
                        <td width="50%"><strong>{{ $data->beca_reg_id }}</strong></td>
                        <td rowspan="4" width="40%"><img src="{{ asset('user_panel/'.$data->profile_image) }}" alt="photo" width="200" class="rounded border border-dark"></td>
                    </tr>
                    <tr>
                        <th width="20%">Member Type</th>
                        <td colspan="2" width="80%"><strong>{{ $data->type_name }}</strong></td>
                    </tr>
                    <tr>
                        <th width="20%">Member's Name</th>
                        <td colspan="2" width="80%"><strong>{{ $data->name }}</strong></td>
                    </tr>
                    <tr>
                        <th width="20%">Current Unite</th>
                        <td colspan="2" width="80%">{{ $data->unite_name }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Home District</th>
                        <td colspan="2" width="80%">{{ $data->present_district }}</td>
                    </tr>
                    </tbody>
                </table>
            @else
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr><th colspan="3" align="center"><h4><strong>Member's Information</strong></h4></th>
                    </tr></thead>
                    <tbody>
                    <tr>
                        <td colspan="3" align="center"><h5 style="color:red; font-weight: bold;">NOT FOUND DATA FOR YOUR SEARCH.</h5></td>
                    </tr>
                    </tbody>
                </table>
            @endif
        @endif
    </div>
    <script>
        var recaptchachecked=false;
        function recaptchaCallback() {
            recaptchachecked = true;
        }
        function isreCaptchaChecked()
        {
            if(recaptchachecked == false){
                alert('please check reCaptcha!')
            }
            return recaptchachecked;
        }
    </script>
@stop
