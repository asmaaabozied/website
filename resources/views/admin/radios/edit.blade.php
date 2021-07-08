@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.radio.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.radios.update", [$radio->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.radio.fields.type') }}</label>
                <select readonly class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Radio::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $radio->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.radio.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.radio.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $radio->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.radio.fields.name_helper') }}</span>
            </div>
            @if($radio->type == 'video')
            <div class="form-group">
                <label for="file">{{ trans('cruds.radio.fields.file') }}</label>
                <a href="#" onclick="window.open('/google','mywindow','width=1100,height=500');">Google</a>
                <input class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" type="text" name="file" id="file" value="{{ old('file_name') }}">
                <span class="help-block" id="progrss"></span>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.radio.fields.file_helper') }}</span>
            </div>
            @endif
            @if($radio->type == 'sound')
            <div class="form-group">
                <label for="file">{{ trans('cruds.radio.fields.file') }}</label>
                <input class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" type="file" name="file" id="file" value="{{ old('file', '') }}">
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.radio.fields.file_helper') }}</span>
            </div>
            @endif
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection