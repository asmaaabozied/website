@extends('layouts.admin')
@section('content')
@can('setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.settings.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.setting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-right: 0;">
            <li class="nav-item">
                <a class="nav-link active" id="public_settings-tab" data-toggle="tab" href="#public_settings" role="tab" aria-controls="public_settings">
                    اعدادات عامه
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="email_settings-tab" data-toggle="tab" href="#email_settings" role="tab" aria-controls="email_settings">
                    اعدادات البريد
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="social_settings-tab" data-toggle="tab" href="#social_settings" role="tab" aria-controls="social_settings">
                    مواقع التواصل الاجتماعي
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="seo_improve_settings-tab" data-toggle="tab" href="#seo_improve_settings" role="tab" aria-controls="seo_improve_settings">
                     تحسين محركات البحث
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="subdomain_settings-tab" data-toggle="tab" href="#subdomain_settings" role="tab" aria-controls="subdomain_settings">
                     اعدادات SubDomains
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="seo_settings-tab" data-toggle="tab" href="#seo_settings" role="tab" aria-controls="seo_settings">
                    محركات البحث SEO
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="drive_settings-tab" data-toggle="tab" href="#drive_settings" role="tab" aria-controls="drive_settings">
                    اعدادات الدرايف
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="public_settings" role="tabpanel" aria-labelledby="public_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <form method="post" action="{{url('admin/setting/general')}}">
                        @csrf
                        <div class="row">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                                {{$settings_collection['siteNameAr'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="siteNameAr" value="{{ $settings_collection['siteNameAr'][1] }}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{$settings_collection['siteNameEn'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="siteNameEn" value="{{ $settings_collection['siteNameEn'][1] }}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{$settings_collection['siteurl'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="siteurl" value="{{ $settings_collection['siteurl'][1] }}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{$settings_collection['adsExpireDays'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="adsExpireDays" value="{{ $settings_collection['adsExpireDays'][1] }}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{$settings_collection['app_store_link'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="app_store_link" value="{{ $settings_collection['app_store_link'][1] }}" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{$settings_collection['google_play_link'][0]}}
                                            </th>
                                            <td>
                                                <input class="form-control" type="text" name="google_play_link" value="{{ $settings_collection['google_play_link'][1] }}" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="form-control btn-success">
                        </div>
                    </form>
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="email_settings" role="tabpanel" aria-labelledby="email_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <form method="post" action="{{url('admin/setting/mail_settings')}}">
                        @csrf
                        <div class="row">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <th>
                                        {{$settings_collection['email_id'][0]}}
                                    </th>
                                    <td>
                                        <input class="form-control" type="text" name="email_id" value="{{ $settings_collection['email_id'][1] }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp'][0]}}
                                    </th>
                                    <td>
                                        <input type="checkbox" name="smtp" {{ $settings_collection['smtp'][1]==1? 'checked' : '' }} value="{{ $settings_collection['smtp'][1] }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp_host'][0]}}
                                    </th>
                                    <td>
                                        <input class="form-control" type="text" name="smtp_host" value="{{ $settings_collection['smtp_host'][1] }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp_user'][0]}}
                                    </th>
                                    <td>
                                        <input class="form-control" type="text" name="smtp_user" value="{{ $settings_collection['smtp_user'][1] }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp_pass'][0]}}
                                    </th>
                                    <td>
                                        <input class="form-control" type="text" name="smtp_pass" value="{{ $settings_collection['smtp_pass'][1] }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp_auth'][0]}}
                                    </th>
                                    <td>
                                        <input type="checkbox" name="smtp_auth" {{ $settings_collection['smtp_auth'][1]==1? 'checked':'' }} value="{{ $settings_collection['smtp_auth'][1] }}" >
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{$settings_collection['smtp_port'][0]}}
                                    </th>
                                    <td>
                                        <input class="form-control" type="text" name="smtp_port" value="{{ $settings_collection['smtp_port'][1] }}" required>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                            <input type="submit" class="form-control btn-success">
                        </div>
                    </form>
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

            </div>
        </div>
        <div class="tab-pane fade show" id="social_settings" role="tabpanel" aria-labelledby="social_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <form method="post" action="{{url('admin/setting/social')}}">
                        @csrf
                        <div class="row">
                            <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialInstagram'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialInstagram" value="{{ $settings_collection['socialInstagram'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialFacebook'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialFacebook" value="{{ $settings_collection['socialFacebook'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialTwitter'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialTwitter" value="{{ $settings_collection['socialTwitter'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialGoogle'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialGoogle" value="{{ $settings_collection['socialGoogle'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialLinkedin'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialLinkedin" value="{{ $settings_collection['socialLinkedin'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['socialYoutube'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="socialYoutube" value="{{ $settings_collection['socialYoutube'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['forumsLink'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="forumsLink" value="{{ $settings_collection['forumsLink'][1] }}" required>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <input type="submit" class="form-control btn-success">
                        </div>
                    </form>
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

            </div>
        </div>
        <div class="tab-pane fade show" id="seo_improve_settings" role="tabpanel" aria-labelledby="seo_improve_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <form method="post" action="{{url('admin/setting/seo_setting')}}">
                        @csrf
                        <div class="row">
                            <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>
                                            {{$settings_collection['metakeysAr'][0]}}
                                        </th>
                                        <td>
                                            <textarea class="form-control" name="metakeysAr" required>{{ $settings_collection['metakeysAr'][1] }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['metakeysEn'][0]}}
                                        </th>
                                        <td>
                                            <textarea class="form-control" name="metakeysEn" required>{{ $settings_collection['metakeysEn'][1] }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['metadescrbAr'][0]}}
                                        </th>
                                        <td>
                                            <textarea class="form-control" name="metadescrbAr" required>{{ $settings_collection['metadescrbAr'][1] }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['metadescrbEn'][0]}}
                                        </th>
                                        <td>
                                            <textarea class="form-control" name="metadescrbEn" required>{{ $settings_collection['metadescrbEn'][1] }}</textarea>
                                        </td>
                                    </tr>
                                </table>
                            <input type="submit" class="form-control btn-success">
                        </div>
                    </form>

                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="subdomain_settings" role="tabpanel" aria-labelledby="subdomain_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <div class="row">
                        <table class=" table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.subDomian.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subDomian.fields.titleEn') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subDomian.fields.titleAr') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subDomian.fields.url') }}
                                </th>
                                <th>
                                    {{ trans('cruds.subDomian.fields.username') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subDomians as $key => $subDomian)
                                <tr data-entry-id="{{ $subDomian->id }}">
                                    <td>
                                        {{ $subDomian->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $subDomian->titleEn ?? '' }}
                                    </td>
                                    <td>
                                        {{ $subDomian->titleAr ?? '' }}
                                    </td>
                                    <td>
                                        {{ $subDomian->url ?? '' }}
                                    </td>
                                    <td>
                                        {{ $subDomian->username ?? '' }}
                                    </td>
                                    <td>
                                        @can('sub_domian_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.sub-domians.show', $subDomian->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan

                                        @can('sub_domian_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.sub-domians.edit', $subDomian->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('sub_domian_delete')
                                            <form action="{{ route('admin.sub-domians.destroy', $subDomian->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

            </div>
        </div>
        <div class="tab-pane fade show" id="seo_settings" role="tabpanel" aria-labelledby="seo_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <div class="row">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Seo">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.seo.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seo.fields.seo_title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seo.fields.seo_keywords') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seo.fields.seo_description') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($seos as $key => $seo)
                                <tr data-entry-id="{{ $seo->id }}">
                                    <td>
                                        {{ $seo->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $seo->seo_title ?? '' }}
                                    </td>
                                    <td>
                                        {{ $seo->seo_keywords ?? '' }}
                                    </td>
                                    <td>
                                        {{ $seo->seo_description ?? '' }}
                                    </td>
                                    <td>
                                        @can('seo_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.seos.show', $seo->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan

                                        @can('seo_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.seos.edit', $seo->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('seo_delete')
                                            <form action="{{ route('admin.seos.destroy', $seo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

            </div>
        </div>
        <div class="tab-pane fade show" id="drive_settings" role="tabpanel" aria-labelledby="drive_settings-tab">
            <div class="card-body">
                <div class="mb-2">
                    <div class="row">

                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{$settings_collection['GOOGLE_CLIENT_ID'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="GOOGLE_CLIENT_ID" value="{{ $settings_collection['GOOGLE_CLIENT_ID'][1] }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{$settings_collection['GOOGLE_CLIENT_SECRET'][0]}}
                                        </th>
                                        <td>
                                            <input class="form-control" type="text" name="GOOGLE_CLIENT_SECRET" value="{{ $settings_collection['GOOGLE_CLIENT_SECRET'][1] }}" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                    </div>

                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

                <nav class="mb-3">
                    <div class="nav nav-tabs">

                    </div>
                </nav>
                <div class="tab-content">

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.settings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Setting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection