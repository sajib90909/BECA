@extends('user-panel.master')
@section('title')
    Personal Data Update
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow p-4 mb-4">
            <h3>Update Personal Info <small class="text-danger">(You can update your data once.)</small></h3>
        </div>
    </div>
    <div class="container-fluid">
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/user_panel/user_details/personal_info/edit/action', 'method' => 'post']) !!}
        <div class="row p-lg-4 p-md-2">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-name" class="col-sm-2 col-form-label">Name<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" required name="name" class="form-control col-md-8" id="form-input-name" value="{{ (old('name')) ? old('name') : $personal_info->name }}" placeholder="Enter your Full Name">
                        <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-spouse-name" class="col-sm-2 col-form-label">Spouse Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="spouse_name" class="form-control col-md-8" id="form-spouse-name" value="{{ (old('spouse_name')) ? old('spouse_name') : $personal_info->spouse_name }}" placeholder="Enter Your Spouse Name">
                        <span class="text-danger">{{ $errors->has('spouse_name')? $errors->first('spouse_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-father-name" class="col-sm-2 col-form-label">Father Name<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" required name="father_name" class="form-control col-md-8" id="form-father-name" value="{{ (old('father_name')) ? old('father_name') : $personal_info->father_name }}" placeholder="Enter Your Father Name">
                        <span class="text-danger">{{ $errors->has('father_name')? $errors->first('father_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-mother-name" class="col-sm-2 col-form-label">Mother Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="mother_name" class="form-control col-md-8" id="form-mother-name" value="{{ (old('mother_name')) ? old('mother_name') : $personal_info->mother_name }}" placeholder="Enter Your Mother Name">
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
                        <input type="text" name="height" class="form-control col-md-8" id="form-input-height" value="{{ (old('height')) ? old('height') : $personal_info->height }}" placeholder="Enter Your Height">
                        <span class="text-danger">{{ $errors->has('height')? $errors->first('height') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-religion" class="col-sm-2 col-form-label">Religion<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <input required type="text" name="religion" class="form-control col-md-8" id="form-input-religion" value="{{ (old('religion')) ? old('religion') : $personal_info->religion }}" placeholder="Enter Your Religion">
                        <span class="text-danger">{{ $errors->has('religion')? $errors->first('religion') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-birth_date" class="col-sm-2 col-form-label">Birth Date<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <input required type="date" name="birth_date" class="form-control col-md-8" id="form-input-birth_date" value="{{ (old('birth_date')) ? old('birth_date') : $personal_info->birth_date }}">
                        <span class="text-danger">{{ $errors->has('birth_date')? $errors->first('birth_date') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-nid_pass" class="col-sm-2 col-form-label">NID/Passport<span class="text-danger h5">*</span></label>
                    <div class="col-sm-10">
                        <input required type="text" name="nid_pass" class="form-control col-md-8" id="form-input-nid_pass" value="{{ (old('nid_pass')) ? old('nid_pass') : $personal_info->nid_pass }}" placeholder="Enter NID/Passport">
                        <span class="text-danger">{{ $errors->has('nid_pass')? $errors->first('nid_pass') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-driving_lic" class="col-sm-2 col-form-label">Driving Licence</label>
                    <div class="col-sm-10">
                        <input type="text" name="driving_lic" class="form-control col-md-8" id="form-input-driving_lic" value="{{ (old('driving_lic')) ? old('driving_lic') : $personal_info->driving_lic }}" placeholder="Enter Driving Licence">
                        <span class="text-danger">{{ $errors->has('driving_lic')? $errors->first('driving_lic') : '' }}</span>
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
    <script>
        document.getElementById('form-input-gender').value= '{{ (old('gender')) ? old('gender') : $personal_info->gender }}';
        document.getElementById('form-input-blood').value='{{ (old('blood')) ? old('blood') : $personal_info->blood }}';
    </script>
@endsection
