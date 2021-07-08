@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.like.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.likes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.id') }}
                        </th>
                        <td>
                            {{ $like->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.image') }}
                        </th>
                        <td>
                            {{ $like->image->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.sound') }}
                        </th>
                        <td>
                            {{ $like->sound->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.video') }}
                        </th>
                        <td>
                            {{ $like->video->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.comment') }}
                        </th>
                        <td>
                            {{ $like->comment->comment ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.user') }}
                        </th>
                        <td>
                            {{ $like->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.like.fields.like_type') }}
                        </th>
                        <td>
                            {{ App\Like::LIKE_TYPE_RADIO[$like->like_type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.likes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection