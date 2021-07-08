@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.adminmenu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adminmenus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.id') }}
                        </th>
                        <td>
                            {{ $adminmenu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuTitleEn') }}
                        </th>
                        <td>
                            {{ $adminmenu->menuTitleEn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuTitleAr') }}
                        </th>
                        <td>
                            {{ $adminmenu->menuTitleAr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuLink') }}
                        </th>
                        <td>
                            {{ $adminmenu->menuLink }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuIco') }}
                        </th>
                        <td>
                            {{ $adminmenu->menuIco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.parentMenuID') }}
                        </th>
                        <td>
                            {{ $adminmenu->parentMenuID }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.ordering') }}
                        </th>
                        <td>
                            {{ $adminmenu->ordering }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.visable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $adminmenu->visable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.adminmenu.fields.member') }}
                        </th>
                        <td>
                            {{ $adminmenu->member }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adminmenus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection