@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.video.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" class="video_upload_form" action="{{ route("admin.videos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.video.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="video-title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descp">{{ trans('cruds.video.fields.descp') }}</label>
                <textarea class="form-control {{ $errors->has('descp') ? 'is-invalid' : '' }}" name="descp" id="descp">{{ old('descp') }}</textarea>
                @if($errors->has('descp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.descp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.video.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="icon_image">{{ trans('cruds.video.fields.icon_image') }}</label>
                <input class="form-control {{ $errors->has('icon_image') ? 'is-invalid' : '' }}" type="file" name="icon_image" id="icon_image" value="{{ old('icon_image', '') }}" required>
                @if($errors->has('icon_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.icon_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_name">{{ trans('cruds.video.fields.file_name') }}</label>
<a href="#" onclick="window.open('/google','mywindow','width=1100,height=500');">Google</a>
<input class="form-control {{ $errors->has('file_name') ? 'is-invalid' : '' }}" type="text" name="file_name" id="file_name" value="{{ old('file_name') }}">

                {{--<div class="row">--}}
                    {{--<div class="col-10">--}}
                        {{--<button class="form-control" type="button" id="browseButton">Choose Video</button>--}}
                    {{--</div>--}}
{{--<input  type="hidden" name="file_name" id="file_name">--}}

                    {{--<div class="col-2">--}}
                        {{--<button class="form-control" type="button" id="upload">upload</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <span class="help-block" id="progrss"></span>
                @if($errors->has('file_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.file_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="icon_image">او رفع ملف</label>
                <input class="form-control {{ $errors->has('video_file') ? 'is-invalid' : '' }}" type="file" name="video_file" id="video_file" value="{{ old('video_file', '') }}" required>
                @if($errors->has('video_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_file') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.video.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <input value="1" type="checkbox" name="notify" id="notify">
                <label for="notify">{{ trans('cruds.image.fields.notify') }}</label>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>


    </div>
</div>

@endsection

@section('scripts')

    <script src="{{ asset('/vendor/Q8Intouch/LaraVids/app.js') }}"></script>

    {{--<script>--}}
        {{--laraVids = new LaraVids('{{route('admin.videos.test_upload')}}');--}}

        {{--laraVids.assignBrowse(document.getElementById('browseButton'));--}}

        {{--$('#upload').click( function (e) {--}}
            {{--e.preventDefault();--}}

            {{--const form = $('form.video_upload_form');--}}
            {{--var vid = laraVids.upload(form.serializeArray());--}}

            {{--laraVids.onFail(function(file, event){--}}
                {{--laraVids.retry();--}}
            {{--});--}}

            {{--laraVids.onProgressUpdated(function(file, event){--}}
                {{--$('#progrss').text(Math.floor((file.progress() / 1) * 100)+'%');--}}
            {{--});--}}

            {{--laraVids.onSuccess(function(file, event){--}}
                {{--$('#progrss').text('prepare & resizing video ....');--}}
                {{--//alert('success Upload Video');--}}
                {{--console.log(JSON.parse(event).path);--}}

                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--dataType: 'json',--}}
                    {{--url: '{{ route("admin.videos.after_upload") }}',--}}
                    {{--data: {--}}
                            {{--path :JSON.parse(event).path ,--}}
                            {{--name :JSON.parse(event).name,--}}
                            {{--file_name :JSON.parse(event).fileName,--}}
                            {{--_token: "{{ csrf_token() }}",--}}
                    {{--},--}}
                    {{--success: function (rData) {--}}
                        {{--//console.log(rData)--}}
                        {{--$('#progrss').text('success');--}}
                        {{--//window.location.href = "{{ route('admin.videos.store') }}";--}}
                        {{--$('#file_name').val(JSON.parse(event).path+JSON.parse(event).fileName+'.mkv');--}}

                    {{--},--}}
                    {{--error: function (req, err) {--}}
                        {{--console.log(err)--}}
                        {{--$('#progrss').text('Error Try Again');--}}

                    {{--}--}}

                {{--})--}}

            {{--});--}}




        {{--});--}}
    {{--</script>--}}
@endsection