@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seo.fields.id') }}
                        </th>
                        <td>
                            {{ $seo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seo.fields.seo_title') }}
                        </th>
                        <td>
                            {{ $seo->seo_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seo.fields.seo_keywords') }}
                        </th>
                        <td>
                            {{ $seo->seo_keywords }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seo.fields.seo_description') }}
                        </th>
                        <td>
                            {{ $seo->seo_description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection