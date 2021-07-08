@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.update", [$comment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @if(app()->request->type == 'image')
            <div class="form-group">
                <label for="image_id">{{ trans('cruds.comment.fields.image') }}</label>
                <select class="form-control select2 {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image_id" id="image_id">
                    @foreach($images as $id => $image)
                        <option value="{{ $id }}" {{ ($comment->image ? $comment->image->id : old('image_id')) == $id ? 'selected' : '' }}>{{ $image }}</option>
                    @endforeach
                </select>
                @if($errors->has('image_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.image_helper') }}</span>
            </div>
            @elseif(app()->request->type == 'sound')
            <div class="form-group">
                <label for="sound_id">{{ trans('cruds.comment.fields.sound') }}</label>
                <select class="form-control select2 {{ $errors->has('sound') ? 'is-invalid' : '' }}" name="sound_id" id="sound_id">
                    @foreach($sounds as $id => $sound)
                        <option value="{{ $id }}" {{ ($comment->sound ? $comment->sound->id : old('sound_id')) == $id ? 'selected' : '' }}>{{ $sound }}</option>
                    @endforeach
                </select>
                @if($errors->has('sound_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sound_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.sound_helper') }}</span>
            </div>
            @elseif(app()->request->type == 'video')
            <div class="form-group">
                <label for="video_id">{{ trans('cruds.comment.fields.video') }}</label>
                <select class="form-control select2 {{ $errors->has('video') ? 'is-invalid' : '' }}" name="video_id" id="video_id">
                    @foreach($videos as $id => $video)
                        <option value="{{ $id }}" {{ ($comment->video ? $comment->video->id : old('video_id')) == $id ? 'selected' : '' }}>{{ $video }}</option>
                    @endforeach
                </select>
                @if($errors->has('video_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.video_helper') }}</span>
            </div>
            @endif
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.comment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($comment->user ? $comment->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment" required>{{ old('comment', $comment->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $comment->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.comment.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.active_helper') }}</span>
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