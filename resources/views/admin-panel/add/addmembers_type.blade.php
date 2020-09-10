@extends('admin-panel.master')
@section('title')
    Member Type
@stop
@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=1" class="text-decoration-none">
            <div class="card shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Published</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_published }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=0" class="text-decoration-none">
            <div class="card bg-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Unpublished</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_unpublished }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=2" class="text-decoration-none">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Trash</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $count_trash }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="card shadow mb-4 col-lg-6">
            <div class="py-3">
                <div class="">
                    <span class="text-success">{{ Session::get('message')}}</span>
                    <div class="pt-3 pl-3">Members Type</div>
                    <div class="pt-2">

                        @foreach($members_type as $member_type)
                            <div class="card m-2 m-md-4">
                                <div class="card-header">
                                    {{ $member_type->type_name }}
                                    <span class="badge badge-secondary ml-2">Created by: {{ $member_type->name }}</span>
                                    <span class="badge badge-secondary ml-2">{{ $member_type->created_at }}</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Ammount {{ $member_type->payment_amount }} tk</h5>
                                    <span class="badge badge-dark">{{ $member_type->time_duration }}</span>
                                    <p class="card-text">{{ $member_type->details }}</p>
                                </div>
                                <div class="card-footer text-muted">
                                    <span class="badge badge-light">Total Members: {{ $member_type->reg_member }}</span>
                                    <span class="barge badge-light float-right">
                                        <span class="badge {{ ($member_type->publish == 1) ? 'badge-success' : (($member_type->publish == 0) ? 'badge-dark' : 'badge-danger') }} mr-4">{{ ($member_type->publish == 1) ? 'published' : (($member_type->publish == 0) ? 'unpublished' : 'trash') }}</span>
                                        @if(Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author')
                                            @if ($member_type->publish == 1)
                                                <a href="{{ route('admin_panel/edit_light/member_type',['target'=>$member_type->id,'action'=>'unpublished']) }}">
                                                    <i class="fas fa-arrow-alt-circle-down text-dark mr-2"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin_panel/edit_light/member_type',['target'=>$member_type->id,'action'=>'published']) }}">
                                                    <i class="fas fa-arrow-alt-circle-up text-success mr-2"></i>
                                                 </a>
                                            @endif
                                            <a href="{{ route('admin_panel/edit/member_type',['target'=>$member_type->id]) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @if($member_type->publish != 2)
                                                <a class="pl-2" href="{{ route('admin_panel/edit_light/member_type',['target'=>$member_type->id,'action'=>'trash']) }}">
                                                        <i class="fas fa-trash-restore-alt text-danger"></i>
                                                    </a>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        @if(Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author')
        <div class="mb-4 col-lg-6 col-xl-4 p-0">
            <div class="card shadow p-2 p-md-4 ml-0 ml-lg-4">
                <h4>Add New</h4>
                <div class="">
                    <span class="text-success">{{ Session::get('message')}}</span>
                    {!! Form::open(['route' => 'admin_panel/add/member_type/action', 'method' => 'post','class' => 'py-lg-2']) !!}
                    <div class="form-group">
                        <label for="type_name">Member Type Name</label>
                        <input type="text" class="form-control" name="type_name" id="type_name" value="{{ old('type_name') }}" placeholder="Member Type Name">
                        <span class="text-danger">{{ $errors->has('type_name')? $errors->first('type_name') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label for="payment_amount">Payment Amount</label>
                        <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="{{ old('payment_amount') }}" placeholder="Enter Payment Amount">
                        <span class="text-danger">{{ $errors->has('payment_amount')? $errors->first('payment_amount') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label for="time_duration">Time Duration</label>
                        <input type="text" class="form-control" name="time_duration" id="time_duration" value="{{ old('time_duration') }}" placeholder="Enter Time Duration">
                        <span class="text-danger">{{ $errors->has('time_duration')? $errors->first('time_duration') : '' }}</span>
                    </div>
                    <div class="form-group">
                        <label for="details">Add description <small>(optional)</small></label>
                        <textarea class="form-control" name="details" id="details" rows="3">{{ old('details') }}</textarea>
                        <span class="text-danger">{{ $errors->has('details')? $errors->first('details') : '' }}</span>
                    </div>
                    <input class="btn btn-dark float-right mt-2" type="submit" name="" value="Add New">
                    {!! Form::close() !!}

                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        @endif
    </div>

@stop
