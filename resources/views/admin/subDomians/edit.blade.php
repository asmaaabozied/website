@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subDomian.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sub-domians.update", [$subDomian->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="titleEn">{{ trans('cruds.subDomian.fields.titleEn') }}</label>
                <input class="form-control {{ $errors->has('titleEn') ? 'is-invalid' : '' }}" type="text" name="titleEn" id="titleEn" value="{{ old('titleEn', $subDomian->titleEn) }}" required>
                @if($errors->has('titleEn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titleEn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subDomian.fields.titleEn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="titleAr">{{ trans('cruds.subDomian.fields.titleAr') }}</label>
                <input class="form-control {{ $errors->has('titleAr') ? 'is-invalid' : '' }}" type="text" name="titleAr" id="titleAr" value="{{ old('titleAr', $subDomian->titleAr) }}" required>
                @if($errors->has('titleAr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titleAr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subDomian.fields.titleAr_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="url">{{ trans('cruds.subDomian.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $subDomian->url) }}" required>
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subDomian.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.subDomian.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $subDomian->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subDomian.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.subDomian.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subDomian.fields.password_helper') }}</span>
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