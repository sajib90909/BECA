@extends('members.master')
@section('title')
    About Membership
@stop
@section('content')
    <div class="p-4">
        <div class="">
            <a class="text-light" href="{{ route('/') }}">
                <p class="my-2 font-weight-bold btn btn-success ">Home</p>
            </a>
        </div>
        <div>
            <div class="pb-md-4">
                <h3 class="text-center">About Membership</h3>
            </div>
            <div class="pr-md-2 pl-md-2">
                {!! !empty($content_data) ? $content_data->content_details : 'no data' !!}
            </div>
        </div>
    </div>
@endsection
