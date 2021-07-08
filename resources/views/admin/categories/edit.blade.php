@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category_name">{{ trans('cruds.category.fields.category_name') }}</label>
                <input class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" type="text" name="category_name" id="category_name" value="{{ old('category_name', $category->category_name) }}" required>
                @if($errors->has('category_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.category_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon_img">{{ trans('cruds.category.fields.icon_img') }}</label>
                <input class="form-control {{ $errors->has('icon_img') ? 'is-invalid' : '' }}" type="file" name="icon_img" id="icon_img" value="{{ old('icon_img', '') }}" >
                @if($errors->has('icon_img'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon_img') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.icon_img_helper') }}</span>
                <br>
                <img src="{{url('/')}}/uploads/category/images/{{$category->icon_img}}" width="100" height="100">
            </div>
            <div class="form-group">
                <label for="descp">{{ trans('cruds.category.fields.descp') }}</label>
                <textarea class="form-control {{ $errors->has('descp') ? 'is-invalid' : '' }}" name="descp" id="descp">{{ old('descp', $category->descp) }}</textarea>
                @if($errors->has('descp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.descp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_type">{{ trans('cruds.category.fields.category_type') }}</label>
                <select class="form-control select2 {{ $errors->has('category_type') ? 'is-invalid' : '' }}" name="category_type" id="category_type" required>
                    @foreach($category_types as $id => $category_type)
                        <option value="{{ $id }}" {{ ($category->category_type ? $category->categories_type->id : old('category_type')) == $id ? 'selected' : '' }}>{{ $category_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.category_type_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $category->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.category.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.active_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="parent_category">{{ trans('cruds.category.fields.parent_category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="parent_category" id="parent_category">
                    @foreach($categories as $id => $categoryi)
                        <option value="{{ $id }}" {{ $category->parent_category == $id ? 'selected' : '' }}>{{ $categoryi }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.parent_category_helper') }}</span>
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