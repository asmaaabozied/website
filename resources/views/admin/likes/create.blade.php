@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.like.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.likes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image_id">{{ trans('cruds.like.fields.image') }}</label>
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
                <span class="help-block">{{ trans('cruds.like.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sound_id">{{ trans('cruds.like.fields.sound') }}</label>
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
                <span class="help-block">{{ trans('cruds.like.fields.sound_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_id">{{ trans('cruds.like.fields.video') }}</label>
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
                <span class="help-block">{{ trans('cruds.like.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment_id">{{ trans('cruds.like.fields.comment') }}</label>
                <select class="form-control select2 {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment_id" id="comment_id">
                    @foreach($comments as $id => $comment)
                        <option value="{{ $id }}" {{ old('comment_id') == $id ? 'selected' : '' }}>{{ $comment }}</option>
                    @endforeach
                </select>
                @if($errors->has('comment_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.like.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.like.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.like.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.like.fields.like_type') }}</label>
                @foreach(App\Like::LIKE_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('like_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="like_type_{{ $key }}" name="like_type" value="{{ $key }}" {{ old('like_type', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="like_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('like_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('like_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.like.fields.like_type_helper') }}</span>
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