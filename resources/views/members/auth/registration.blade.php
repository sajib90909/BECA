@extends('members.master')
@section('content')
    <div class="p-4">
        <div class="">
            <a class="text-light" href="{{ route('/') }}">
                <p class="my-2 font-weight-bold btn btn-success ">Home</p>
            </a>
        </div>
        <div>
            <h4 class="text-center">New Registration</h4>
        </div>
        <div class="w-customs bg-light p-2 rounded m-auto">
            {!! Form::open(['route' => '/registration/action', 'method' => 'post']) !!}
            <div class="form-group">
                <label>Full Name</label>
                <input required type="text" class="form-control form-control-sm" name="name" placeholder="Enter Your Full Name">
                <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input required type="text" class="form-control form-control-sm" name="phone" placeholder="Enter Your Phone Number">
                <span class="text-danger">{{ $errors->has('phone')? $errors->first('phone') : '' }}</span>
            </div>
            <div class="form-group">
                <label>Your Current Beca Unite</label>
                <select required class="form-control" name="current_unite" id="form-input-cadet_rank" size="1">
                    <option value="" selected="selected">Select Current Unite</option>
                    @foreach($unites as $unite)
                        <option value="{{ $unite->id }}">
                            {{ $unite->unite_name }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->has('current_unite')? $errors->first('current_unite') : '' }}</span>
            </div>

                <div class="form-group">
                    <label>Password</label>
                    <input required type="password" class="form-control form-control-sm" name="password" placeholder="Enter Password">
                    <span class="text-danger">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input required type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Enter Password">
                    <span class="text-danger">{{ $errors->has('password_confirmation')? $errors->first('password_confirmation') : '' }}</span>
                </div>


                <div class=" text-right">
                    <button type="submit" name="login_action" class="btn btn-success btn-sm">Registration</button>
                </div>

            {!! Form::close() !!}

            </div>

    </div>

@endsection

