@extends('admin-panel.master')
@section('title')
    Unites
@stop
@section('content')
    <div class="row">

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <a href="?filter=1" class="text-decoration-none">--}}
{{--                <div class="card shadow h-100 py-2 bg-primary">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row no-gutters align-items-center">--}}
{{--                            <div class="col mr-2">--}}
{{--                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Published</div>--}}
{{--                                <div class="h5 mb-0 font-weight-bold text-light">{{ $count_published }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto">--}}
{{--                                <i class="fas fa-calendar fa-2x text-gray-300"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?" class="text-decoration-none">
                <div class="card bg-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Units</div>
                                <div class="h5 mb-0 font-weight-bold text-light">{{ $total_unites }}</div>
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
            <a href="?filter=trash" class="text-decoration-none">
                <div class="card bg-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Trash</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $total_trash }}</div>
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
        <div class="card shadow mb-4 col-lg-6 mr-0 mr-md-4">
            <div class="py-3">
                <div class="">
                    <span class="text-success">{{ Session::get('message')}}</span>
                    <div class="pt-3 pl-3">Members Type</div>
                    <div class="pt-2">


                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Unite Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $unites as $key => $unite)
                                <tr>
                                    <th scope="row">{{ $unites->firstItem() + $key }}</th>
                                    <td>{{ $unite->unite_name }}</td>
                                    <td>{{ $unite->description }}</td>
                                    <td>{{ $unite->created_at }}</td>
                                    <td>
                                        @if(Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author')
                                            @if ($unite->publish == 2)
                                                <a class="pl-2" href="{{ route('admin_panel/edit_light/unite',['target'=>$unite->id,'action'=>'published']) }}">
                                                    <i class="fas fa-arrow-alt-circle-down text-dark mr-2"></i>
                                                </a>
                                            @else
                                                <a class="pl-2" href="{{ route('admin_panel/edit_light/unite',['target'=>$unite->id,'action'=>'trash']) }}">
                                                    <i class="fas fa-trash-restore-alt text-danger"></i>
                                                </a>
                                            @endif
                                            <a class="pl-2" href="{{ route('admin_panel/edit/unite',['target'=>$unite->id]) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $unites->links() }}


                    </div>

                </div>
            </div>
        </div>
        @if(Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author')
            <div class="card shadow mb-4 col-lg-6 col-xl-4">
                <div class="py-3">
                    <h4>Add New</h4>
                    <div class="">
                        <span class="text-success">{{ Session::get('message')}}</span>
                        {!! Form::open(['route' => 'admin_panel/add/unite/action', 'method' => 'post','class' => 'py-lg-2']) !!}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Unite Name</label>
                            <input type="text" class="form-control" name="unite_name" id="exampleFormControlInput1" value="{{ old('unite_name') }}" placeholder="Enter Unite Name">
                            <span class="text-danger">{{ $errors->has('unite_name')? $errors->first('unite_name') : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Add description <small>(optional)</small></label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                            <span class="text-danger">{{ $errors->has('description')? $errors->first('description') : '' }}</span>
                        </div>
                        <input class="btn btn-success mt-2 float-right" type="submit" name="" value="Add new unite">
{{--                        <a class="btn btn-dark float-right mt-2" href="{{ route('/admin_panel/admins') }}">Back</a>--}}
                        {!! Form::close() !!}

                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
        @endif
    </div>

@stop
