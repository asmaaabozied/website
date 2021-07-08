@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subDomian.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-domians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.id') }}
                        </th>
                        <td>
                            {{ $subDomian->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.titleEn') }}
                        </th>
                        <td>
                            {{ $subDomian->titleEn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.titleAr') }}
                        </th>
                        <td>
                            {{ $subDomian->titleAr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.url') }}
                        </th>
                        <td>
                            {{ $subDomian->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.username') }}
                        </th>
                        <td>
                            {{ $subDomian->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subDomian.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-domians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection