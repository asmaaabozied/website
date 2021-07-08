@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.favorite.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.favorites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.favorite.fields.id') }}
                        </th>
                        <td>
                            {{ $favorite->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favorite.fields.image') }}
                        </th>
                        <td>
                            {{ $favorite->image->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favorite.fields.sound') }}
                        </th>
                        <td>
                            {{ $favorite->sound->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favorite.fields.video') }}
                        </th>
                        <td>
                            {{ $favorite->video->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favorite.fields.user') }}
                        </th>
                        <td>
                            {{ $favorite->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.favorites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection