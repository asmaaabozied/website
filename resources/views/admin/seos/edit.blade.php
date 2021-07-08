@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.seo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.seos.update", [$seo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="seo_title">{{ trans('cruds.seo.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $seo->seo_title) }}" required>
                @if($errors->has('seo_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seo_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seo.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_keywords">{{ trans('cruds.seo.fields.seo_keywords') }}</label>
                <input class="form-control {{ $errors->has('seo_keywords') ? 'is-invalid' : '' }}" type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $seo->seo_keywords) }}">
                @if($errors->has('seo_keywords'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seo_keywords') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seo.fields.seo_keywords_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_description">{{ trans('cruds.seo.fields.seo_description') }}</label>
                <textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}" name="seo_description" id="seo_description">{{ old('seo_description', $seo->seo_description) }}</textarea>
                @if($errors->has('seo_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seo_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.seo.fields.seo_description_helper') }}</span>
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