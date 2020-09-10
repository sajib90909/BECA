@extends('admin-panel.master')
@section('title')
    SMS
@stop
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Sent</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $sms_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Failed</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $failed_sms_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card bg-danger shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Balance</div>--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">$900980</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sent SMS Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('/admin_panel/balance/update/sms') }}" class="text-decoration-none">
            <div class="card bg-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Balance</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">Click For Update</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ isset($sms_balance->balance) ? $sms_balance->balance : 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Estimate SMS</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ (isset($sms_balance->sms)) ? $sms_balance->sms : 0 }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-4 col-lg-6">
            <div class="card shadow py-3">
                <div class="p-4">
                    <div class="">
                        <span class="text-danger">{{ Session::get('error_message') }}</span>
                        <span class="text-success">{{ Session::get('message') }}</span>
                        <span class="text-danger">{{ (count($errors) != 0) ? $errors : '' }}</span>
                    </div>
                    <h4>Send SMS</h4>
                    <div class="pt-2">
                        {!! Form::open(['route' => 'admin_panel/sms/send/action', 'method' => 'post']) !!}
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">SMS content</label>
                                <textarea class="form-control" required name="sms_content" id="exampleFormControlTextarea1" rows="3" placeholder="Limit: 400 letter">{{ old('sms_content') }}</textarea>
                            </div>
                            <div class="pl-2">
                                <div class="form-check">
                                    <input class="form-check-input" name="active_member"  type="checkbox" id="inlineCheckbox1" value="option1" {{ old('active_member') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Active Members</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="deactivated_member" id="inlineCheckbox6" value="option1" {{ old('deactivated_member') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox6">Deactivated Members</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="unite_wise" id="inlineCheckbox7" value="option1" {{ old('unite_wise') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox7">Unite wise Member</label>
                                    <div class="form-group ml-2 form-check-inline">
                                        <select name="unite" id="unite" class="form-control form-control-sm">
                                            <option value="">select unite</option>
                                            @foreach($unites as $unite)
                                                <option value="{{ $unite->id }}">{{ $unite->unite_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="member_type_wise" id="inlineCheckbox8" value="option1" {{ old('member_type_wise') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox8">Member type wise</label>
                                    <div class="form-group ml-2 form-check-inline">
                                        <select name="member_type" id="member_type" class="form-control form-control-sm">
                                            <option value="">select member types</option>
                                            @foreach($members_type as $member_type)
                                                <option value="{{ $member_type->id }}">{{ $member_type->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="super_admin" id="inlineCheckbox2" value="option2" {{ old('super_admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Super admins</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="unite_admin" id="inlineCheckbox4" value="option2" {{ old('unite_admin') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox4">Unite admins</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="custom" id="inlineCheckbox3" value="option3" {{ old('custom') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Customs-</label>
                                    <div class="">
                                        <textarea class="form-control col-xl-8" name="custom_number" id="exampleFormControlTextarea4" rows="3" placeholder="ex: 01771335956,01840286860,1313...">{{ old('custom_number') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right pt-2">
                                <input type="submit" class="btn btn-success" value="Send">
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-lg-6">
            <div class="card shadow py-3">
                <div class="p-4">
                    <h4>SMS DATA</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">send by</th>
                                <th scope="col">sms</th>
                                <th scope="col">send to</th>
                                <th scope="col">status</th>
                                <th scope="col">date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $sms_data as $key => $data)
                                <tr>
                                    <th scope="row">{{ $sms_data->firstItem() + $key }}</th>
                                    <td>{{ ($data->send_by == 0) ? 'OTP' : $data->name }}</td>
                                    <td>{{ $data->content }}</td>
                                    <td>{{ $data->send_to }}</td>
                                    <td>{!! ($data->status == 1 ) ? '<span class="text-success">success</span>' : '<span class="text-danger">'.$data->response_msg.'</span>' !!} </td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $sms_data->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('member_type').value= '{{ old('member_type') }}';
        document.getElementById('unite').value='{{ old('unite') }}';
    </script>

@stop
