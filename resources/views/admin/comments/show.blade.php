@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.id') }}
                        </th>
                        <td>
                            {{ $comment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.image') }}
                        </th>
                        <td>
                            {{ $comment->image->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.sound') }}
                        </th>
                        <td>
                            {{ $comment->sound->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.video') }}
                        </th>
                        <td>
                            {{ $comment->video->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.parent_comment_id') }}
                        </th>
                        <td>
                            {{ $comment->parent_comment_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.user') }}
                        </th>
                        <td>
                            {{ $comment->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.comment') }}
                        </th>
                        <td>
                            {{ $comment->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $comment->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.likes') }}
                        </th>
                        <td>
                            {{ $comment->likes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.dlike') }}
                        </th>
                        <td>
                            {{ $comment->dlike }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection