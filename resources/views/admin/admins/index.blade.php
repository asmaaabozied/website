@extends('layouts.admin')
@section('content')
@can('admin_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.admins.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.admin.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.admin.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Admin">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.username') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.permission') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.admin.fields.last_login') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $key => $admin)
                        <tr data-entry-id="{{ $admin->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $admin->id ?? '' }}
                            </td>
                            <td>
                                {{ $admin->name ?? '' }}
                            </td>
                            <td>
                                {{ $admin->username ?? '' }}
                            </td>
                            <td>
                                {{ $admin->permission ?? '' }}
                            </td>
                            <td>
                                {{ $admin->email ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $admin->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $admin->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $admin->last_login ?? '' }}
                            </td>
                            <td>
                                @can('admin_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.admins.show', $admin->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('admin_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.admins.edit', $admin->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('admin_delete')
                                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('admin_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.admins.massDestroy') }}",
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
  $('.datatable-Admin:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection