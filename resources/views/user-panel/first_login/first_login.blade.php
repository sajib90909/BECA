@extends('user-panel.master')
@section('title')
    First login
@endsection
@section('content')
    <!-- Main Content -->

    <div id="content">
        <!-- Begin Page Content -->
        <div class="modal-backdrop fade show nw-overlay"></div>
        <div class="container-fluid parent-all-form">
            <div class="card form-all">
                <div class="card-body">
                        <div class="container-progress border-bottom">
                            <ul class="progressbar">
                                <li class="{{ ($personal_info)? 'active':'' }} {{ ($set_action == 'personal_info')? 'text-primary':'' }}">Personal Information</li>
                                <li class="{{ ($address_details)? 'active':'' }} {{ ($set_action == 'address_details')? 'text-primary':'' }}">Address Details</li>
                                <li class="{{ ($edu_pro_details)? 'active':'' }} {{ ($set_action == 'edu_pro_details')? 'text-primary':'' }}">Education And Profession</li>
                                <li class="{{ ($cadet_details)? 'active':'' }} {{ ($set_action == 'cadet_details')? 'text-primary':'' }}">Cadet Details</li>
                                <li class="{{ ($contact_details)? 'active':'' }} {{ ($set_action == 'contact_details')? 'text-primary':'' }}">Contact Details</li>
                            </ul>
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
                    @if($set_action == 'personal_info')
                        {{--                    personal information form-------------------------------------------------}}
                        {!! Form::open(['route' => '/first_login/personal_info/action', 'method' => 'post']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-spouse-name" class="col-sm-2 col-form-label">Spouse Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="spouse_name" class="form-control col-md-8" id="form-spouse-name" value="{{ old('spouse_name') }}" placeholder="Enter Your Spouse Name">
                                        <span class="text-danger">{{ $errors->has('spouse_name')? $errors->first('spouse_name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-father-name" class="col-sm-2 col-form-label">Father Name<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" required name="father_name" class="form-control col-md-8" id="form-father-name" value="{{ old('father_name') }}" placeholder="Enter Your Father Name">
                                        <span class="text-danger">{{ $errors->has('father_name')? $errors->first('father_name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-mother-name" class="col-sm-2 col-form-label">Mother Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mother_name" class="form-control col-md-8" id="form-mother-name" value="{{ old('mother_name') }}" placeholder="Enter Your Mother Name">
                                        <span class="text-danger">{{ $errors->has('mother_name')? $errors->first('mother_name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-gender" class="col-sm-2 col-form-label">Gender<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="gender" id="form-input-gender" size="1">
                                            <option value="" selected="selected">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('gender')? $errors->first('gender') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-blood" class="col-sm-2 col-form-label">Blood Group<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="blood" id="form-input-blood" size="1">
                                            <option value="" selected="selected">Select Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('blood')? $errors->first('blood') : '' }}</span>
                                    </div>
                                </div>
                            </div><div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-height" class="col-sm-2 col-form-label">Height</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="height" class="form-control col-md-8" id="form-input-height" value="{{ old('height') }}" placeholder="Enter Your Height">
                                        <span class="text-danger">{{ $errors->has('height')? $errors->first('height') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-religion" class="col-sm-2 col-form-label">Religion<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="religion" class="form-control col-md-8" id="form-input-religion" value="{{ old('religion') }}" placeholder="Enter Your Religion">
                                        <span class="text-danger">{{ $errors->has('religion')? $errors->first('religion') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-birth_date" class="col-sm-2 col-form-label">Birth Date<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <input required type="date" name="birth_date" class="form-control col-md-8" id="form-input-birth_date" value="{{ old('birth_date') }}">
                                        <span class="text-danger">{{ $errors->has('birth_date')? $errors->first('birth_date') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-nid_pass" class="col-sm-2 col-form-label">NID/Passport<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="nid_pass" class="form-control col-md-8" id="form-input-nid_pass" value="{{ old('nid_pass') }}" placeholder="Enter NID/Passport">
                                        <span class="text-danger">{{ $errors->has('nid_pass')? $errors->first('nid_pass') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-driving_lic" class="col-sm-2 col-form-label">Driving Licence</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="driving_lic" class="form-control col-md-8" id="form-input-driving_lic" value="{{ old('driving_lic') }}" placeholder="Enter Driving Licence">
                                        <span class="text-danger">{{ $errors->has('driving_lic')? $errors->first('driving_lic') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Next</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        {{--                    personal information form end--}}
                    @endif
                    @if($set_action == 'address_details')

                        {{--                    address details----------------------------------------------------------------------------------}}
                        {!! Form::open(['route' => '/first_login/address_details/action', 'method' => 'post']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="font-weight-bold pb-4 text-primary">Permanent Address</div>
                                <div class="form-group row">
                                    <label for="form_permanent_division" class="col-sm-2 col-form-label">Division<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="permanent_division" id="form_permanent_division" size="1">
                                            <option value="" selected="selected">Select Division</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('permanent_division')? $errors->first('permanent_division') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_permanent_district" class="col-sm-2 col-form-label">District<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="permanent_district" id="form_permanent_district" size="1">
                                            <option value="" selected="selected">Select District</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('permanent_district')? $errors->first('permanent_district') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_permanent_upazila" class="col-sm-2 col-form-label">Upazila<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="permanent_upazila" id="form_permanent_upazila" size="1">
                                            <option value="" selected="selected">Select Upazila</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('permanent_upazila')? $errors->first('permanent_upazila') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-permanent_village" class="col-sm-2 col-form-label">Village</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="permanent_village" class="form-control col-md-8" id="form-permanent_village" value="{{ old('permanent_village') }}" placeholder="Enter Your village">
                                        <span class="text-danger">{{ $errors->has('permanent_village')? $errors->first('permanent_village') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-permanent_house" class="col-sm-2 col-form-label">House</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="permanent_house" class="form-control col-md-8" id="form-permanent_house" value="{{ old('permanent_house') }}" placeholder="Enter Your House/road no..">
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
                                            <option value="" selected="selected">Select Division</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('present_division')? $errors->first('present_division') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_present_district" class="col-sm-2 col-form-label">District<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="present_district" id="form_present_district" size="1">
                                            <option value="" selected="selected">Select District</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('present_district')? $errors->first('present_district') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_present_upazila" class="col-sm-2 col-form-label">Upazila<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-10">
                                        <select required class="form-control col-md-8" name="present_upazila" id="form_present_upazila" size="1">
                                            <option value="" selected="selected">Select Upazila</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('present_upazila')? $errors->first('present_upazila') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-present_village" class="col-sm-2 col-form-label">Village</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="present_village" class="form-control col-md-8" id="form-present_village" value="{{ old('present_village') }}" placeholder="Enter Your village">
                                        <span class="text-danger">{{ $errors->has('present_village')? $errors->first('present_village') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-present_house" class="col-sm-2 col-form-label">House</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="present_house" class="form-control col-md-8" id="form-present_house" value="{{ old('present_house') }}" placeholder="Enter Your House/road no..">
                                        <span class="text-danger">{{ $errors->has('present_house')? $errors->first('present_house') : '' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Next</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        <script src="{{ asset('user_panel/js/address/address.js') }}"></script>
                        {{--                    address details end--}}
                    @endif
                    @if($set_action == 'edu_pro_details')

                        {{--                    education and profession details-------------------------------------------------------------}}
                        {!! Form::open(['route' => '/first_login/edu_pro_details/action', 'method' => 'post']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-ssc_batch" class="col-sm-3 col-form-label">SSC Batch<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="number" placeholder="Enter Your SSC Passing Year" name="ssc_batch" class="form-control col-md-8" id="form-input-ssc_batch" value="{{ old('ssc_batch') }}" min="1900" max="2099" step="1" />
                                        <span class="text-danger">{{ $errors->has('ssc_batch')? $errors->first('ssc_batch') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-edu_qualification" class="col-sm-3 col-form-label">Education Qualification<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" name="edu_qualification" class="form-control col-md-8" id="form-input-edu_qualification" value="{{ old('edu_qualification') }}" placeholder="Enter Education Qualification Last one">
                                        <span class="text-danger">{{ $errors->has('edu_qualification')? $errors->first('edu_qualification') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-profession" class="col-sm-3 col-form-label">Profession<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" name="profession" class="form-control col-md-8" id="form-input-profession" value="{{ old('profession') }}" placeholder="Enter your profession">
                                        <span class="text-danger">{{ $errors->has('profession')? $errors->first('profession') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-work_address" class="col-sm-3 col-form-label">Work Address<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" name="work_address" class="form-control col-md-8" id="form-input-work_address" value="{{ old('work_address') }}" placeholder="Enter Work address">
                                        <span class="text-danger">{{ $errors->has('work_address')? $errors->first('work_address') : '' }}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Next</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        {{--                    education and profession details end--}}
                    @endif
                    @if($set_action == 'cadet_details')


                        {{--                    cadet details----------------------------------------------------------------------------------}}
                        {!! Form::open(['route' => '/first_login/cadet_details/action', 'method' => 'post']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-institute_name" class="col-sm-3 col-form-label">Institute Name<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" placeholder="Enter Your Cadet Institute Name" name="institute_name" class="form-control col-md-8" id="form-input-institute_name" value="{{ old('institute_name') }}" />
                                        <span class="text-danger">{{ $errors->has('institute_name')? $errors->first('institute_name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-institute_address" class="col-sm-3 col-form-label">Institute Address<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" placeholder="Enter Your Cadet Institute Address" name="institute_address" class="form-control col-md-8" id="form-input-institute_address" value="{{ old('institute_address') }}" />
                                        <span class="text-danger">{{ $errors->has('institute_address')? $errors->first('institute_address') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-cadet_id" class="col-sm-3 col-form-label">Cadet ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cadet_id" class="form-control col-md-8" id="form-input-cadet_id" value="{{ old('cadet_id') }}" placeholder="Enter Your Cadet ID">
                                        <span class="text-danger">{{ $errors->has('cadet_id')? $errors->first('cadet_id') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-regiment" class="col-sm-3 col-form-label">Regiment</label>
                                    <div class="col-sm-9">
                                        <select class="form-control col-md-8" name="regiment" id="form-input-regiment" size="1">
                                            <option value="" selected="selected">Select Regiment</option>
                                            <option value="Ramna Regiment">Ramna Regiment</option>
                                            <option value="Karnaphuli Regiment">Karnaphuli Regiment</option>
                                            <option value="Moinamati Regiment">Moinamati Regiment</option>
                                            <option value="Sundorbon Regiment">Sundorbon Regiment</option>
                                            <option value="Mohasthan Regiment">Mohasthan Regiment</option>
                                            <option value="Number 1 Squadron">Number 1 Squadron</option>
                                            <option value="Number 2 Squadron">Number 2 Squadron</option>
                                            <option value="Number 3 Squadron">Number 3 Squadron</option>
                                            <option value="Dhaka Flotilla">Dhaka Flotilla</option>
                                            <option value="Chittagong Flotilla">Chittagong Flotilla</option>
                                            <option value="Khulna Flotilla">Khulna Flotilla</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('regiment')? $errors->first('regiment') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-cadet_rank" class="col-sm-3 col-form-label">Cadet Rank<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control col-md-8" name="cadet_rank" id="form-input-cadet_rank" size="1">
                                            <option value="" selected="selected">Select Cadet Rank</option>
                                            <option value="Cadet Under Officer">Cadet Under Officer</option>
                                            <option value="A">Cadet Under Officer</option>
                                            <option value="Cadet Sergeant">Cadet Sergeant</option>
                                            <option value="Cadet Corporal">Cadet Corporal</option>
                                            <option value="Cadet Lance Corporal">Cadet Lance Corporal</option>
                                            <option value="Cadet">Cadet</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('cadet_rank')? $errors->first('cadet_rank') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-cadet_wing" class="col-sm-3 col-form-label">Cadet Wing<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control col-md-8" name="cadet_wing" id="form-input-cadet_wing" size="1">
                                            <option value="" selected="selected">Select Cadet Wing</option>
                                            <option value="Army">Army</option>
                                            <option value="Navy">Navy</option>
                                            <option value="Air">Air</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('cadet_wing')? $errors->first('cadet_wing') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-cadet_ship_year" class="col-sm-3 col-form-label">Cadetship Year<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="text" name="cadet_ship_year" class="form-control col-md-8" id="form-input-cadet_ship_year" value="{{ old('cadet_ship_year') }}" placeholder="Enter CadetShip year (2009-2011)">
                                        <span class="text-danger">{{ $errors->has('cadet_ship_year')? $errors->first('cadet_ship_year') : '' }}</span>
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label for="form-input-current_unite" class="col-sm-3 col-form-label">Current Unite<span class="text-danger h5">*</span></label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <select required class="form-control col-md-8" name="current_unite" id="form-input-current_unite" size="1">--}}
{{--                                            <option value="" selected="selected">Select Current Unite</option>--}}
{{--                                            @foreach($unites as $unite)--}}
{{--                                                <option value="{{ $unite ->id }}">{{ $unite->unite_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="text-danger">{{ $errors->has('current_unite')? $errors->first('current_unite') : '' }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="form-input-registration_unite" class="col-sm-3 col-form-label">Registration Unite<span class="text-danger h5">*</span></label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <select required class="form-control col-md-8" name="registration_unite" id="form-input-registration_unite" size="1">--}}
{{--                                            <option value="" selected="selected">Select Registration Unite</option>--}}
{{--                                            @foreach($unites as $unite)--}}
{{--                                                <option value="{{ $unite ->id }}">{{ $unite ->unite_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="text-danger">{{ $errors->has('registration_unite')? $errors->first('registration_unite') : '' }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Next</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        {{--                    cadet details end--}}
                    @endif
                    @if($set_action == 'contact_details')

                        {{--                    contact details-------------------------------------------------}}
                        {!! Form::open(['route' => '/first_login/contact_details/action', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row p-lg-4 p-md-2">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="form-input-second_email" class="col-sm-3 col-form-label">Email<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control col-md-8" id="form-input-name" value="{{ old('email') }}" placeholder="Enter Second Email">
                                        <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-secondary_number" class="col-sm-3 col-form-label">Secondary Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="secondary_number" class="form-control col-md-8" id="form-input-work_address" value="{{ old('secondary_number') }}" placeholder="Enter Secondary Number">
                                        <span class="text-danger">{{ $errors->has('secondary_number')? $errors->first('secondary_number') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-emergency_number" class="col-sm-3 col-form-label">Emergency Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emergency_number" class="form-control col-md-8" id="form-input-emergency_number" value="{{ old('emergency_number') }}" placeholder="Enter Emergency Number">
                                        <span class="text-danger">{{ $errors->has('emergency_number')? $errors->first('emergency_number') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-facebook" class="col-sm-3 col-form-label">Facebook Id (url)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="facebook" class="form-control col-md-8" id="form-input-facebook" value="{{ old('facebook') }}" placeholder="Enter Facebook Id (url)">
                                        <span class="text-danger">{{ $errors->has('facebook')? $errors->first('facebook') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-input-twitter" class="col-sm-3 col-form-label">Twitter Id (url)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="twitter" class="form-control col-md-8" id="form-input-twitter" value="{{ old('twitter') }}" placeholder="Enter Twitter Id (url)">
                                        <span class="text-danger">{{ $errors->has('twitter')? $errors->first('twitter') : '' }}</span>
                                    </div>
                                </div><div class="form-group row">
                                    <label for="form-input-skype" class="col-sm-3 col-form-label">Skype Id (url)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="skype" class="form-control col-md-8" id="form-input-skype" value="{{ old('skype') }}" placeholder="Enter Skype Id (url)">
                                        <span class="text-danger">{{ $errors->has('skype')? $errors->first('skype') : '' }}</span>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6">
                                <img src="{{ asset('user_panel/img/thumbnail.png') }}" class="rounded mx-auto d-block w-25 pb-3" alt="img-thumbnail">
                                <div class="form-group row">
                                    <label for="form-input-profile_image" class="col-sm-3 col-form-label">Your Image<span class="text-danger h5">*</span></label>
                                    <div class="col-sm-9">
                                        <input required type="file" name="profile_image" class="form-control col-md-8" id="form-input-profile_image">
                                        <span class="text-danger">{{ $errors->has('profile_image')? $errors->first('profile_image') : '' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 pl-2 border-top w-75">
                                <button type="submit" class="btn btn-info mb-2 w-50">Submit</button>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        {{--                    contact details end--}}
                    @endif




                </div>
            </div>
        </div>
    </div>


@endsection
