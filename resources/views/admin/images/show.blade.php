@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.image.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.id') }}
                        </th>
                        <td>
                            {{ $image->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.title') }}
                        </th>
                        <td>
                            {{ $image->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.descp') }}
                        </th>
                        <td>
                            {{ $image->descp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.category') }}
                        </th>
                        <td>
                            {{ $image->category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.sub_domain_no') }}
                        </th>
                        <td>
                            {{ $image->sub_domain_no->titleEn ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.file_name') }}
                        </th>
                        <td>
                            @if($image->file_name)
                                <img src="http://images.niceq8i.tv/{{ $image->file_name }}" width="100" height="100">
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.views') }}
                        </th>
                        <td>
                            {{ $image->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.comments') }}
                        </th>
                        <td>
                            {{ $image->comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.likes') }}
                        </th>
                        <td>
                            {{ $image->likes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.favorites') }}
                        </th>
                        <td>
                            {{ $image->favorites }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.active') }}
                        </th>
                        <td>
                            {{ $image->active }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.dlike') }}
                        </th>
                        <td>
                            {{ $image->dlike }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.image.fields.img_thm') }}
                        </th>
                        <td>
                            @if($image->img_thm)
                                <img src="{{url('/')}}/uploads/images/thumb/{{ $image->img_thm }}" width="100" height="100">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection