@extends('admin-panel.master')
@section('title')
    Update Unite
@stop
@section('content')
    <div class="card shadow mb-4 col-lg-6 col-xl-4">
        <div class="py-3">
            <div class="">
                {!! Form::open(['route' => 'admin_panel/edit/action/unite', 'method' => 'post','class' => 'py-lg-2']) !!}
                <input type="number" hidden required value="{{ $unite->id }}" name="unite_id">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Unite Name</label>
                    <input type="text" class="form-control" name="unite_name" id="exampleFormControlInput1" value="{{ !empty(old('unite_name')) ? old('unite_name'): $unite->unite_name}}" placeholder="Enter Unite Name">
                    <span class="text-danger">{{ $errors->has('unite_name')? $errors->first('unite_name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Add description <small>(optional)</small></label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ !empty(old('description')) ? old('description'): $unite->description}}</textarea>
                    <span class="text-danger">{{ $errors->has('description')? $errors->first('description') : '' }}</span>
                </div>
                <input class="btn btn-success mt-2" type="submit" name="" value="Update">
                <a class="btn btn-dark float-right mt-2" href="{{ route('/admin_panel/add/unite') }}">Back</a>
                {!! Form::close() !!}

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
@stop
