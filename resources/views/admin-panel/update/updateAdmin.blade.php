@extends('admin-panel.master')
@section('title')
    Update Admin
@stop
@section('content')
    <div class="card shadow mb-4 d-inline-block col-lg-6 col-xl-4">
        <div class="py-3">
            <div class="">
                <span class="text-success">{{ Session::get('message')}}</span>
                {!! Form::open(['route' => 'admin_panel/update/admin/action', 'method' => 'post','class' => 'py-lg-2']) !!}
                <input type="number" hidden name="admin_id" value="{{ $admin->id }}">
                <div class="form-group">
                    <label for="user_type_id">User Type</label>
                    <select class="form-control" name="user_type" id="user_type_id">
                        <option value="">--</option>
                        <option value="unite_admin">Unite Admin</option>
                        @if(Session::get('admin_type') == 'author')
                            <option value="super_admin">Super Admin</option>
                        @endif
                    </select>
                    <span class="text-danger">{{ $errors->has('user_type')? $errors->first('user_type') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="unite_id_id">Unite</label>
                    <select class="form-control" name="unite_id" id="unite_id_id">
                        <option value="">--</option>
                        @foreach($unites as $unite)
                            <option value="{{ $unite->id }}">{{ $unite->unite_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('unite_id')? $errors->first('unite_id') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="username" value="{{ !empty(old('user_name')) ? old('user_name'): $admin->user_name}}" placeholder="Enter UserName">
                    <span class="text-danger">{{ $errors->has('user_name')? $errors->first('user_name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" name="name" id="fullname" value="{{ !empty(old('name')) ? old('name'): $admin->name}}" placeholder="Enter Full Name">
                    <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ !empty(old('email')) ? old('email'): $admin->email}}" placeholder="Enter Email">
                    <span class="text-danger">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ !empty(old('phone')) ? old('phone'): $admin->phone}}" placeholder="Enter phone Number">
                    <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="beca_reg_id">beca Id</label>
                    <input type="text" class="form-control" name="beca_reg_id" id="beca_reg_id" value="{{ !empty(old('beca_reg_id')) ? old('beca_reg_id'): $admin->beca_reg_id}}" placeholder="Enter Beca registration Id">
                    <span class="text-danger">{{ $errors->has('beca_reg_id')? $errors->first('beca_reg_id') : '' }}</span>
                </div>
                <div class="form-group">
                    <label for="form_password">Password</label>
                    <input type="password" class="form-control" name="password" id="form_password" placeholder="Enter Password">
                    <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                </div>
                <input class="btn btn-success mt-2" type="submit" name="" value="Update User">
                <a class="btn btn-dark float-right mt-2" href="{{ route('/admin_panel/admins') }}">Back</a>
                {!! Form::close() !!}

            </div>
            <div class="col-lg-4"></div>
            <script>
                document.getElementById('user_type_id').value= '{{ $admin->user_type }}';
                document.getElementById('unite_id_id').value='{{ $admin->unite_id }}';
            </script>

        </div>
    </div>
@stop
