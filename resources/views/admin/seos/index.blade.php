@extends('layouts.admin')
@section('content')
@can('seo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.seos.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.seo.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.seo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Seo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
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

                            </td>
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


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('seo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.seos.massDestroy') }}",
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
  $('.datatable-Seo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection