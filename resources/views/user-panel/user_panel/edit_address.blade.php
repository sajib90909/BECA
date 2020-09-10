@extends('user-panel.master')
@section('title')
    Address Edit
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow p-4 mb-4">
            <h3>Update Address Info <small class="text-danger">(You can update your data once.)</small></h3>
        </div>
    </div>
    <div class="container-fluid">
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/user_panel/user_details/address_details/edit/action', 'method' => 'post']) !!}
        <div class="row p-lg-4 p-md-2">

            <div class="col-lg-6">
                <div class="font-weight-bold pb-4 text-primary">Permanent Address</div>
                <div class="form-group row">
                    <label for="form_permanent_division" class="col-sm-2 col-form-label">Division<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="permanent_division" id="form_permanent_division" size="1">
                            <option selected value="{{ (old('permanent_division')) ? old('permanent_division') : $address_details->permanent_division }}">{{ (old('permanent_division')) ? old('permanent_division') : $address_details->permanent_division }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('permanent_division')? $errors->first('permanent_division') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form_permanent_district" class="col-sm-2 col-form-label">District<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="permanent_district" id="form_permanent_district" size="1">
                            <option selected value="{{ (old('permanent_district')) ? old('permanent_district') : $address_details->permanent_district }}">{{ (old('permanent_district')) ? old('permanent_district') : $address_details->permanent_district }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('permanent_district')? $errors->first('permanent_district') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form_permanent_upazila" class="col-sm-2 col-form-label">Upazila<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="permanent_upazila" id="form_permanent_upazila" size="1">
                            <option selected value="{{ (old('permanent_upazila')) ? old('permanent_upazila') : $address_details->permanent_upazila }}">{{ (old('permanent_upazila')) ? old('permanent_upazila') : $address_details->permanent_upazila }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('permanent_upazila')? $errors->first('permanent_upazila') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-permanent_village" class="col-sm-2 col-form-label">Village</label>
                    <div class="col-sm-10">
                        <input type="text" name="permanent_village" class="form-control col-md-8" id="form-permanent_village" value="{{ (old('permanent_village')) ? old('permanent_village') : $address_details->permanent_village }}" placeholder="Enter Your village">
                        <span class="text-danger">{{ $errors->has('permanent_village')? $errors->first('permanent_village') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-permanent_house" class="col-sm-2 col-form-label">House</label>
                    <div class="col-sm-10">
                        <input type="text" name="permanent_house" class="form-control col-md-8" id="form-permanent_house" value="{{ (old('permanent_house')) ? old('permanent_house') : $address_details->permanent_house }}" placeholder="Enter Your House/road no..">
                        <span class="text-danger">{{ $errors->has('permanent_house')? $errors->first('permanent_house') : '' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="font-weight-bold pb-4 text-primary">Present Address</div>
                <div class="form-group row">
                    <label for="form_present_division" class="col-sm-2 col-form-label">Division<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="present_division" id="form_present_division" size="1">
                            <option selected value="{{ (old('present_division')) ? old('present_division') : $address_details->present_division }}">{{ (old('present_division')) ? old('present_division') : $address_details->present_division }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('present_division')? $errors->first('present_division') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form_present_district" class="col-sm-2 col-form-label">District<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="present_district" id="form_present_district" size="1">
                            <option selected value="{{ (old('present_district')) ? old('present_district') : $address_details->present_district }}">{{ (old('present_district')) ? old('present_district') : $address_details->present_district }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('present_district')? $errors->first('present_district') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form_present_upazila" class="col-sm-2 col-form-label">Upazila<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <select required class="form-control col-md-8" name="present_upazila" id="form_present_upazila" size="1">
                            <option selected value="{{ (old('present_upazila')) ? old('present_upazila') : $address_details->present_upazila }}">{{ (old('present_upazila')) ? old('present_upazila') : $address_details->present_upazila }}</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('present_upazila')? $errors->first('present_upazila') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-present_village" class="col-sm-2 col-form-label">Village</label>
                    <div class="col-sm-10">
                        <input type="text" name="present_village" class="form-control col-md-8" id="form-present_village" value="{{ (old('present_village')) ? old('present_village') : $address_details->present_village }}" placeholder="Enter Your village">
                        <span class="text-danger">{{ $errors->has('present_village')? $errors->first('present_village') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-present_house" class="col-sm-2 col-form-label">House</label>
                    <div class="col-sm-10">
                        <input type="text" name="present_house" class="form-control col-md-8" id="form-present_house" value="{{ (old('present_house')) ? old('present_house') : $address_details->present_house }}" placeholder="Enter Your House/road no..">
                        <span class="text-danger">{{ $errors->has('present_house')? $errors->first('present_house') : '' }}</span>
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
    <script src="{{ asset('user_panel/js/address/address.js') }}"></script>
    {{--    <script>--}}
    {{--        document.getElementById('form_permanent_upazila').value= '{{ (old('permanent_upazila')) ? old('permanent_upazila') : $address_details->permanent_upazila }}';--}}
    {{--        document.getElementById('form_permanent_district').value='{{ (old('permanent_district')) ? old('permanent_district') : $address_details->permanent_district }}';--}}
    {{--        document.getElementById('form_permanent_division').value= '{{ (old('permanent_division')) ? old('permanent_division') : $address_details->permanent_division }}';--}}
    {{--        document.getElementById('form_present_division').value='{{ (old('present_division')) ? old('present_division') : $address_details->present_division }}';--}}
    {{--        document.getElementById('form_present_district').value= '{{ (old('present_district')) ? old('present_district') : $address_details->present_district }}';--}}
    {{--        document.getElementById('form_present_upazila').value='{{ (old('present_upazila')) ? old('present_upazila') : $address_details->current_unite }}';--}}
    {{--    </script>--}}
@endsection
