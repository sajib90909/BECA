@extends('admin-panel.master')
@section('title')
    Edit '{!! strtolower($members_name->name) !!}' Beca Details
@stop
@section('content')
    <div class="card shadow p-2">
        {!! Form::open(['route' => '/admin_panel/members/beca_details/edit/action', 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
        <div class="row p-lg-4 p-md-2">
            <input type="number" name="user_id" value="{{ $beca_details->user_id }}" hidden>
            <div class="col-lg-6">
                <div class="form-group row">
                    <label for="form-input-members_type" class="col-sm-3 col-form-label">Members type<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <select required class="form-control col-md-8" name="members_type" id="form-input-members_type" size="1">
                            <option value="" selected="selected">Select Members Type</option>
                            @foreach($members_type as $m_type)
                                <option value="{{ $m_type ->id }}">{{ $m_type ->type_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->has('members_type')? $errors->first('members_type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form-input-current_unite" class="col-sm-3 col-form-label">Current Unite<span class="text-danger h5">*</span></label>
                    <div class="col-sm-9">
                        <select required class="form-control col-md-8" name="current_unite" id="form-input-current_unite" size="1">
                            <option value="" selected="selected">Select Current Unite</option>
                            @foreach($unites as $unite)
                                <option value="{{ $unite ->id }}">{{ $unite->unite_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->has('current_unite')? $errors->first('current_unite') : '' }}</span>
                    </div>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">NEC Member</legend>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nec_member" id="gridRadios1" {{ (old('nec_member')) ? ((old('nec_member') == 1) ? 'checked' :'') : (($beca_details->nec_member == 1)? 'checked':'') }} value="1">
                                <label class="form-check-label" for="gridRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nec_member" id="gridRadios2" {{ (old('nec_member')) ? ((old('nec_member') == 0) ? 'checked' :'') : (($beca_details->nec_member == 0)? 'checked':'') }} value="0">
                                <label class="form-check-label" for="gridRadios2">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="form-input-position" class="col-sm-3 col-form-label">Position</label>
                    <div class="col-sm-9">
                        <input type="text" name="position" class="form-control col-md-8" id="form-input-position" value="{{ (old('position')) ? old('position') : $beca_details->position }}" placeholder="Enter Members beca position">
                        <span class="text-danger">{{ $errors->has('position')? $errors->first('position') : '' }}</span>
                    </div>
                </div>


            </div>

            <div class="pt-4 pl-2 border-top w-100">
                <a href="{{ route('/admin_panel/members/details/',['user_id'=>$beca_details->user_id]) }}" class="btn btn-dark mb-2">back</a>
                <button type="submit" class="btn btn-info mb-2">Save</button>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
    <script>
        document.getElementById('form-input-members_type').value= '{{ (old('members_type')) ? old('members_type') : $current_members_type->member_type }}';
        document.getElementById('form-input-current_unite').value='{{ (old('current_unite')) ? old('current_unite') : $beca_details->current_unite }}';
        document.getElementById('form-input-registration_unite').value='{{ (old('registration_unite')) ? old('registration_unite') : $beca_details->registration_unite }}';
    </script>
@endsection
