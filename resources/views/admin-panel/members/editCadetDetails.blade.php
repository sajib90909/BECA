@extends('admin-panel.master')
@section('title')
    Edit '{!! strtolower($personal_info->name) !!}' Beca Details
@stop
@section('content')
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/admin_panel/members/cadet_details/edit/action', 'method' => 'post']) !!}
        <div class="row p-lg-4 p-md-2">
            <input type="number" name="user_id" value="{{ $cadet_details->user_id }}" hidden>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-institute_name" class="col-sm-3 col-form-label">Institute Name<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" placeholder="Enter Your Cadet Institute Name" name="institute_name" class="form-control col-md-8" id="form-input-institute_name" value="{{ (old('institute_name')) ? old('institute_name') : $cadet_details->institute_name }}" />
                        <span class="text-danger">{{ $errors->has('institute_name')? $errors->first('institute_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-institute_address" class="col-sm-3 col-form-label">Institute Address<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" placeholder="Enter Your Cadet Institute Address" name="institute_address" class="form-control col-md-8" id="form-input-institute_address" value="{{ (old('institute_address')) ? old('institute_address') : $cadet_details->institute_address }}" />
                        <span class="text-danger">{{ $errors->has('institute_address')? $errors->first('institute_address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-cadet_id" class="col-sm-3 col-form-label">Cadet ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="cadet_id" class="form-control col-md-8" id="form-input-cadet_id" value="{{ (old('height')) ? old('height') : $personal_info->height }}" placeholder="Enter Your Cadet ID">
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
                <div class="form-group row">
                    <label for="form-input-cadet_ship_year" class="col-sm-3 col-form-label">Cadetship Year<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" name="cadet_ship_year" class="form-control col-md-8" id="form-input-cadet_ship_year" value="{{ (old('cadet_ship_year')) ? old('cadet_ship_year') : $cadet_details->cadet_ship_year }}" placeholder="Enter CadetShip year (2009-2011)">
                        <span class="text-danger">{{ $errors->has('cadet_ship_year')? $errors->first('cadet_ship_year') : '' }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 pl-2 border-top w-100">
                <a href="{{ route('/admin_panel/members/details/',['user_id'=>$cadet_details->user_id]) }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
    <script>
        document.getElementById('form-input-cadet_rank').value= '{{ (old('cadet_rank')) ? old('cadet_rank') : $cadet_details->cadet_rank }}';
        document.getElementById('form-input-cadet_wing').value='{{ (old('cadet_wing')) ? old('cadet_wing') : $cadet_details->cadet_wing }}';
        document.getElementById('form-input-regiment').value='{{ (old('regiment')) ? old('regiment') : $cadet_details->regiment }}';
    </script>
@endsection
