@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.video.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.videos.update", [$video->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.video.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $video->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descp">{{ trans('cruds.video.fields.descp') }}</label>
                <textarea class="form-control {{ $errors->has('descp') ? 'is-invalid' : '' }}" name="descp" id="descp">{{ old('descp', $video->descp) }}</textarea>
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
                        <option value="{{ $id }}" {{ ($video->category ? $video->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
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
                <input class="form-control {{ $errors->has('icon_image') ? 'is-invalid' : '' }}" type="file" name="icon_image" id="icon_image" value="{{ old('icon_image', '') }}">
                @if($errors->has('icon_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.icon_image_helper') }}</span>
                <br>
                <div class="">
                    <img src="http://video.niceq8i.tv/{{ $video->icon_image }}" width="100" height="100">
                </div>
            </div>
            <div class="form-group">
                <label for="file_name">{{ trans('cruds.video.fields.file_name') }}</label>
                <a href="#" onclick="window.open('/google','mywindow','width=1100,height=500');">Google</a>
                <input class="form-control {{ $errors->has('file_name') ? 'is-invalid' : '' }}" type="text" name="file_name" id="file_name" value="{{ old('file_name', $video->file_name ) }}">
                @if($errors->has('file_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.file_name_helper') }}</span>
                <br>
                <div class="">
                    <video width="60%"  controls>
                        <source src="http://video.niceq8i.tv/{{ $video->file_name }}" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $video->active || old('active', 0) === 1 ? 'checked' : '' }}>
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')

@endsection