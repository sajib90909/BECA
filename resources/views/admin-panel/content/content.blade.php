@extends('admin-panel.master')
@section('title')
  {{ $title }}
@stop
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Content <span class="badge badge-primary">{{ $action }}</span></h6>
                </div>
                <div class="card-body">
                    <span class="text-success">{{ Session::get('message')}}</span>
                    @if($action == 'logo')
                        {!! Form::open(['route' => '/admin_panel/action/custom_page', 'method' => 'post','class' => 'py-lg-2','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                            <div class="image-logo">
                                <img src="{{ asset('/admin-panel') }}{{ (!empty($content_data)) ? '/'.$content_data->content_details : '/site_uploads/thumb.jpg' }}" alt="Responsive image" class="img-thumbnail">
                            </div>
                            <input type="text" required hidden name="action" value="logo">
                            <label for="exampleFormControlTextarea1">Change Logo</label>
                            <input required type="file" class="form-control" name="logo">
                            <span class="text-danger">{{ $errors->has('logo')? $errors->first('logo') : '' }}</span>
                            <div>
                                <span class="">Last Update By: <span class="text-success">{{ ($update_by) ? $update_by : ''}}</span></span>
                            </div>
                        </div>
                        <input class="btn btn-success mt-2" type="submit" name="" value="Update">
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => '/admin_panel/action/custom_page', 'method' => 'post','class' => 'py-lg-2']) !!}
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Add Content</label>
                            <input type="text" required hidden name="action" value="{{ $action }}">
                            <textarea required class="form-control" name="description" rows="7" id="{{ ($action == 'head_notice') ? '': 'content_area_id' }}">{{ ($content_data)? $content_data->content_details:'' }}</textarea>
                            <span class="text-danger">{{ $errors->has('description')? $errors->first('description') : '' }}</span>
                            <div>
                                <span class="">Last Update By: <span class="text-success">{{ ($update_by) ? $update_by : ''}}</span></span>
                            </div>
                        </div>
                        <input class="btn btn-success float-right mt-2" type="submit" name="" value="Update">
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('content_area_id', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
