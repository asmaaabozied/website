@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.image.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.images.update", [$image->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.image.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $image->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descp">{{ trans('cruds.image.fields.descp') }}</label>
                <textarea class="form-control {{ $errors->has('descp') ? 'is-invalid' : '' }}" name="descp" id="descp">{{ old('descp', $image->descp) }}</textarea>
                @if($errors->has('descp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.descp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.image.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ ($image->category ? $image->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_name">{{ trans('cruds.image.fields.file_name') }}</label>
                <input class="form-control {{ $errors->has('file_name') ? 'is-invalid' : '' }}" type="file" name="file_name" id="file_name" value="{{ old('file_name', '') }}">
                @if($errors->has('file_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.file_name_helper') }}</span>
                <br>
                <div class="">
                    <img src="http://images.niceq8i.tv/{{ $image->file_name }}" width="100" height="100">
                </div>
            </div>
            <div class="form-group">
                <label for="active">{{ trans('cruds.image.fields.active') }}</label>
                <input value="1" {{$image->active ==1 ? 'checked' : ''}} type="checkbox" name="active" id="active">
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.active_helper') }}</span>
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