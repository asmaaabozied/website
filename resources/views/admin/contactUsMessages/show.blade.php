@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactUsMessage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-us-messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.id') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.title') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.content') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.from_u') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->from_u }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.phone') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.email') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUsMessage.fields.readed') }}
                        </th>
                        <td>
                            {{ $contactUsMessage->readed }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-us-messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>


    </div>
</div>
@endsection