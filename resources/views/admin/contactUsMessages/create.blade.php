@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contactUsMessage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-us-messages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.contactUsMessage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.contactUsMessage.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content') }}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="from_u">{{ trans('cruds.contactUsMessage.fields.from_u') }}</label>
                <input class="form-control {{ $errors->has('from_u') ? 'is-invalid' : '' }}" type="text" name="from_u" id="from_u" value="{{ old('from_u', '') }}" required>
                @if($errors->has('from_u'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from_u') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.from_u_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.contactUsMessage.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.contactUsMessage.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="readed">{{ trans('cruds.contactUsMessage.fields.readed') }}</label>
                <input class="form-control {{ $errors->has('readed') ? 'is-invalid' : '' }}" type="number" name="readed" id="readed" value="{{ old('readed') }}" step="1">
                @if($errors->has('readed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('readed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUsMessage.fields.readed_helper') }}</span>
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