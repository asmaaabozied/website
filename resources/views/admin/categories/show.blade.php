@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.category_name') }}
                        </th>
                        <td>
                            {{ $category->category_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.icon_img') }}
                        </th>
                        <td>
                            <img src="{{url('/')}}/uploads/category/images/{{$category->icon_img}}" width="100" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.descp') }}
                        </th>
                        <td>
                            {{ $category->descp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.category_type') }}
                        </th>
                        <td>
                            {{ $category->categories_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $category->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.is_last_level') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $category->is_last_level ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.parent_category') }}
                        </th>
                        <td>
                            {{ $category->categories_parent->category_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.category_level') }}
                        </th>
                        <td>
                            {{ $category->category_level }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection