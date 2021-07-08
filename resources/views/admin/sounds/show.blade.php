@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sound.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sounds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.id') }}
                        </th>
                        <td>
                            {{ $sound->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.title') }}
                        </th>
                        <td>
                            {{ $sound->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.descp') }}
                        </th>
                        <td>
                            {{ $sound->descp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.category') }}
                        </th>
                        <td>
                            {{ $sound->category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.sub_domain_no') }}
                        </th>
                        <td>
                            {{ $sound->sub_domain_no->titleAr ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.file_name') }}
                        </th>
                        <td>
                            @if($sound->file_name)
                                <div class="">
                                    <audio controls="" style="display:block">

                                        <source src="http://sounds.niceq8i.tv/{{ $sound->file_name }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.icon_image') }}
                        </th>
                        <td>
                            @if($sound->icon_image)
                                <div class="">
                                    <img src="http://sounds.niceq8i.tv/{{ $sound->icon_image }}" width="100" height="100">
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.duration') }}
                        </th>
                        <td>
                            {{ $sound->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.views') }}
                        </th>
                        <td>
                            {{ $sound->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.comments') }}
                        </th>
                        <td>
                            {{ $sound->comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.likes') }}
                        </th>
                        <td>
                            {{ $sound->likes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.favorites') }}
                        </th>
                        <td>
                            {{ $sound->favorites }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $sound->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sound.fields.dlike') }}
                        </th>
                        <td>
                            {{ $sound->dlike }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sounds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection