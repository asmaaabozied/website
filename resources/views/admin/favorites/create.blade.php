@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.favorite.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.favorites.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image_id">{{ trans('cruds.favorite.fields.image') }}</label>
                <select class="form-control select2 {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image_id" id="image_id">
                    @foreach($images as $id => $image)
                        <option value="{{ $id }}" {{ old('image_id') == $id ? 'selected' : '' }}>{{ $image }}</option>
                    @endforeach
                </select>
                @if($errors->has('image_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.favorite.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sound_id">{{ trans('cruds.favorite.fields.sound') }}</label>
                <select class="form-control select2 {{ $errors->has('sound') ? 'is-invalid' : '' }}" name="sound_id" id="sound_id">
                    @foreach($sounds as $id => $sound)
                        <option value="{{ $id }}" {{ old('sound_id') == $id ? 'selected' : '' }}>{{ $sound }}</option>
                    @endforeach
                </select>
                @if($errors->has('sound_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sound_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.favorite.fields.sound_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_id">{{ trans('cruds.favorite.fields.video') }}</label>
                <select class="form-control select2 {{ $errors->has('video') ? 'is-invalid' : '' }}" name="video_id" id="video_id">
                    @foreach($videos as $id => $video)
                        <option value="{{ $id }}" {{ old('video_id') == $id ? 'selected' : '' }}>{{ $video }}</option>
                    @endforeach
                </select>
                @if($errors->has('video_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.favorite.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.favorite.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.favorite.fields.user_helper') }}</span>
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