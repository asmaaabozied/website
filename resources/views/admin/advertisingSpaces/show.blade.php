@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.advertisingSpace.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.advertising-spaces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.id') }}
                        </th>
                        <td>
                            {{ $advertisingSpace->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.title') }}
                        </th>
                        <td>
                            {{ $advertisingSpace->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.ads_type') }}
                        </th>
                        <td>
                            {{ App\AdvertisingSpace::ADS_TYPE_RADIO[$advertisingSpace->ads_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.image') }}
                        </th>
                        <td>
                            @if($advertisingSpace->image)
                                <img src="{{url('/uploads/site/')}}/{{ $advertisingSpace->image }}" width="100" height="100">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.code') }}
                        </th>
                        <td>
                            {{ $advertisingSpace->code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.advertising-spaces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection