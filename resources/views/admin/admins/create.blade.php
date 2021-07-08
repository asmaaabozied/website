@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.admin.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.admins.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.admin.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.admin.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', '') }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.admin.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="permission">{{ trans('cruds.admin.fields.permission') }}</label>
                <input class="form-control {{ $errors->has('permission') ? 'is-invalid' : '' }}" type="text" name="permission" id="permission" value="{{ old('permission', '') }}">
                @if($errors->has('permission'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permission') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.permission_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.admin.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.admin.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_login">{{ trans('cruds.admin.fields.last_login') }}</label>
                <input class="form-control date {{ $errors->has('last_login') ? 'is-invalid' : '' }}" type="text" name="last_login" id="last_login" value="{{ old('last_login') }}">
                @if($errors->has('last_login'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_login') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.admin.fields.last_login_helper') }}</span>
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