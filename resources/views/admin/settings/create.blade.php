@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="keyEn">{{ trans('cruds.setting.fields.keyEn') }}</label>
                <input class="form-control {{ $errors->has('keyEn') ? 'is-invalid' : '' }}" type="text" name="keyEn" id="keyEn" value="{{ old('keyEn', '') }}" required>
                @if($errors->has('keyEn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keyEn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.keyEn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.setting.fields.value') }}</label>
                <textarea class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" name="value" id="value" required>{{ old('value') }}</textarea>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="keyAr">{{ trans('cruds.setting.fields.keyAr') }}</label>
                <input class="form-control {{ $errors->has('keyAr') ? 'is-invalid' : '' }}" type="text" name="keyAr" id="keyAr" value="{{ old('keyAr', '') }}" required>
                @if($errors->has('keyAr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keyAr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.keyAr_helper') }}</span>
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