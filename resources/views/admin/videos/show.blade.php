@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.video.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.id') }}
                        </th>
                        <td>
                            {{ $video->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.title') }}
                        </th>
                        <td>
                            {{ $video->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.descp') }}
                        </th>
                        <td>
                            {{ $video->descp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.category') }}
                        </th>
                        <td>
                            {{ $video->category->category_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.sub_domain_no') }}
                        </th>
                        <td>
                            {{ $video->sub_domain_no->titleEn ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.icon_image') }}
                        </th>
                        <td>
                            @if($video->icon_image)
                                <img src="http://video.niceq8i.tv/{{ $video->icon_image }}" width="100" height="100">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.file_name') }}
                        </th>
                        <td>
                            @if($video->file_name)
                                <div class="">
                                    <video width="60%"  controls>
                                        <source src="http://video.niceq8i.tv/{{ $video->file_name }}" type="video/mp4">

                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.duration') }}
                        </th>
                        <td>
                            {{ $video->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.views') }}
                        </th>
                        <td>
                            {{ $video->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.comments') }}
                        </th>
                        <td>
                            {{ $video->comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.likes') }}
                        </th>
                        <td>
                            {{ $video->likes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.favorites') }}
                        </th>
                        <td>
                            {{ $video->favorites }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $video->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.dlike') }}
                        </th>
                        <td>
                            {{ $video->dlike }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection

@section('script')

@endsection