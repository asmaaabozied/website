@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.notification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notifications.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="alert_text">{{ trans('cruds.notification.fields.alert_text') }}</label>
                <input class="form-control {{ $errors->has('alert_text') ? 'is-invalid' : '' }}" type="text" name="alert_text" id="alert_text" value="{{ old('alert_text', '') }}" required>
                @if($errors->has('alert_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alert_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.alert_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.notification.fields.alert_type') }}</label>
                @foreach(App\Notification::ALERT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('alert_type') ? 'is-invalid' : '' }}">
                        <input class="" type="radio" id="alert_type_{{ $key }}" name="alert_type" value="{{ $key }}" {{ old('alert_type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="" for="alert_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('alert_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alert_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.alert_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="media_number">{{ trans('cruds.notification.fields.media_number') }}</label>
                <input class="form-control {{ $errors->has('media_number') ? 'is-invalid' : '' }}" type="text" name="media_number" id="media_number" value="{{ old('media_number', '') }}">
                @if($errors->has('media_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('media_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.media_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message_details">{{ trans('cruds.notification.fields.message_details') }}</label>
                <input class="form-control {{ $errors->has('message_details') ? 'is-invalid' : '' }}" type="text" name="message_details" id="message_details" value="{{ old('message_details', '') }}" required>
                @if($errors->has('message_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.message_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachments_message">{{ trans('cruds.notification.fields.attachments_message') }}</label>
                <input class="form-control {{ $errors->has('attachments_message') ? 'is-invalid' : '' }}" type="text" name="attachments_message" id="attachments_message" value="{{ old('attachments_message', '') }}">
                @if($errors->has('attachments_message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachments_message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.attachments_message_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.notification.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.link_helper') }}</span>
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