@extends('user-panel.master')
@section('title')
    Confirm Payments
@endsection
@section('content')
    <!-- Main Content -->

    <div id="content">
        <!-- Begin Page Content -->
        <div class="modal-backdrop fade show nw-overlay"></div>
        <div class="container-fluid parent-all-form">
            <div class="card form-all">
                <div class="card-body">
                    <div class="border-bottom">
                        <h4 class="text-primary">Confirm Your Payment</h4>
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
                    <div class="row">
                        <div class="d-inline-block mr-lg-4 mr-md-2 pl-lg-4 pl-md-2">
                            <div class="pt-3 pl-3">Members Type</div>
                            <div class="pt-2">
                                @php($color = ['primary','info','dark'])
                                @php($rand_value = 0)
                                @foreach($members_type as $member_type)
                                    <div class="ml-2 mb-2 card text-white bg-{{ $color[($rand_value < 2) ? $rand_value++ : $rand_value--] }} mb-3" style="max-width: 18rem;">
                                        <div class="card-header bg-secondary">{{ $member_type->type_name }}</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Ammount {{ $member_type->payment_amount }} tk</h5>
                                            <span class="badge badge-dark">{{ $member_type->time_duration }}</span>
                                            <p class="card-text">{{ $member_type->details }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-md-4 d-inline-block ml-lg-4 mr-2 pl-lg-4 pr-md-2">
                            <div class="ml-4 ml-lg-0 border-left">
                                <div class="pt-3 pl-3 text-info">Select Your Membership Type</div>
                                <div class="pt-2 pl-lg-4 pl-2">
                                    {!! Form::open(['route' => '/user_panel/payment/action', 'method' => 'post']) !!}
                                    @foreach($members_type as $member_type)
                                        <div class="form-check pb-1">
                                            <input required class="form-check-input type-check" type="radio" name="member_type" id="type_{{ $member_type->id }}" value="{{ $member_type->id }}">
                                            <label class="form-check-label" for="type_{{ $member_type->id }}">
                                                {{ $member_type->type_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="mt-4 mb-2 bg-warning pt-1 pl-2 pr-2 rounded member-type-d">
                                        <div class="text-dark"><span id="membership_amount">0</span><small id="membership_time"></small></div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn bks-btn" disabled>Payment with bKash</button>
                                    </div>
                                    {!! Form::close() !!}

                                    {!! Form::open(['route' => '/user_panel/payment/coupon/action', 'method' => 'post']) !!}
                                    <div class="pt-4 pb-2">
                                        <div class="">
                                                <button type="button" id="coupon-show-btn" class="btn btn-info btn-sm">Coupon Code</button>
                                                <button type="button" class="btn btn-dark btn-sm" id="coupon-form-close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div id="coupon-form-id">
                                        <div class="input-group mb-3">
                                            <input type="text" required autocomplete="off" class="form-control" name="code" placeholder="Enter code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    <span class="text-danger">{{ Session::get('payment_message_error')}}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        @foreach($members_type as $member_type)
        $('#type_{{ $member_type->id }}').click(function() {
            $('#membership_amount').text("{{ $member_type->payment_amount }} tk");
            $('#membership_time').text(" ({{ $member_type->time_duration }}) ");
            $('#coupon-form-id').css('display','none');
            $('#coupon-form-close').css('display','none');
        });
        @endforeach
        $('#coupon-show-btn').click(function() {
            $('#coupon-form-id').css('display','block');
            $('#coupon-form-close').css('display','inline-block');
            $('.type-check').prop('checked', false);
            $('#membership_amount').text("0");
            $('#membership_time').text("");
        });
        $('#coupon-form-close').click(function() {
            $('#coupon-form-id').css('display','none');
            $('#coupon-form-close').css('display','none');
        });
    </script>
@endsection
