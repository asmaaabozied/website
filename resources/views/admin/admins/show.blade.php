@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.admin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.id') }}
                        </th>
                        <td>
                            {{ $admin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.name') }}
                        </th>
                        <td>
                            {{ $admin->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.username') }}
                        </th>
                        <td>
                            {{ $admin->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.permission') }}
                        </th>
                        <td>
                            {{ $admin->permission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.email') }}
                        </th>
                        <td>
                            {{ $admin->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $admin->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.admin.fields.last_login') }}
                        </th>
                        <td>
                            {{ $admin->last_login }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection