@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.advertisingSpace.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.advertising-spaces.update", [$advertisingSpace->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.advertisingSpace.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $advertisingSpace->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.advertisingSpace.fields.ads_type') }}</label>
                @foreach(App\AdvertisingSpace::ADS_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('ads_type') ? 'is-invalid' : '' }}">
                        <input class="" type="radio" id="ads_type_{{ $key }}" name="ads_type" value="{{ $key }}" {{ old('ads_type', $advertisingSpace->ads_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="" for="ads_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('ads_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ads_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.ads_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.advertisingSpace.fields.image') }}</label>
                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="file" name="image" id="image" value="{{ old('image', '') }}">
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.image_helper') }}</span>
                <br>
                <div class="">
                    <img src="{{url('/uploads/site/')}}/{{ $advertisingSpace->image }}" width="100" height="100">
                </div>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.advertisingSpace.fields.code') }}</label>
                <textarea class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" name="code" id="code">{{ old('code', $advertisingSpace->code) }}</textarea>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.code_helper') }}</span>
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