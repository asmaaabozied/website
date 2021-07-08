@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.radio.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.radios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.radio.fields.id') }}
                        </th>
                        <td>
                            {{ $radio->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radio.fields.type') }}
                        </th>
                        <td>
                            {{ App\Radio::TYPE_SELECT[$radio->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radio.fields.name') }}
                        </th>
                        <td>
                            {{ $radio->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.radio.fields.file') }}
                        </th>
                        <td>
                            @if($radio->file && $radio->type == 'video')
                                <div class="">
                                    <video width="60%"  controls>
                                        <source src="http://video.niceq8i.tv{{ $radio->file }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                            @if($radio->file && $radio->type == 'sound')
                                <div class="">
                                    <audio controls="" style="display:block">
                                        <source src="http://sounds.niceq8i.tv/{{ $radio->file }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.radios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection