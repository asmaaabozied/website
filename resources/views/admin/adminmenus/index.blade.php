@extends('layouts.admin')
@section('content')
@can('adminmenu_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.adminmenus.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.adminmenu.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.adminmenu.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Adminmenu">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuTitleEn') }}
                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuTitleAr') }}
                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.menuLink') }}
                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.parentMenuID') }}
                        </th>
                        <th>
                            {{ trans('cruds.adminmenu.fields.ordering') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adminmenus as $key => $adminmenu)
                        <tr data-entry-id="{{ $adminmenu->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $adminmenu->id ?? '' }}
                            </td>
                            <td>
                                {{ $adminmenu->menuTitleEn ?? '' }}
                            </td>
                            <td>
                                {{ $adminmenu->menuTitleAr ?? '' }}
                            </td>
                            <td>
                                {{ $adminmenu->menuLink ?? '' }}
                            </td>
                            <td>
                                {{ $adminmenu->parentMenuID ?? '' }}
                            </td>
                            <td>
                                {{ $adminmenu->ordering ?? '' }}
                            </td>
                            <td>
                                @can('adminmenu_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.adminmenus.show', $adminmenu->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('adminmenu_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.adminmenus.edit', $adminmenu->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('adminmenu_delete')
                                    <form action="{{ route('admin.adminmenus.destroy', $adminmenu->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('adminmenu_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.adminmenus.massDestroy') }}",
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
  $('.datatable-Adminmenu:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection