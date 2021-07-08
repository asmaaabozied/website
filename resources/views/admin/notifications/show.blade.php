@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.notification.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.id') }}
                        </th>
                        <td>
                            {{ $notification->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.alert_text') }}
                        </th>
                        <td>
                            {{ $notification->alert_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.alert_type') }}
                        </th>
                        <td>
                            {{ App\Notification::ALERT_TYPE_RADIO[$notification->alert_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.media_number') }}
                        </th>
                        <td>
                            {{ $notification->media_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.message_details') }}
                        </th>
                        <td>
                            {{ $notification->message_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.attachments_message') }}
                        </th>
                        <td>
                            {{ $notification->attachments_message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notification.fields.link') }}
                        </th>
                        <td>
                            {{ $notification->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection