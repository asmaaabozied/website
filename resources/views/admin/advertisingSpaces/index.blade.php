@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.advertisingSpace.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AdvertisingSpace">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.ads_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.advertisingSpace.fields.code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertisingSpaces as $key => $advertisingSpace)
                        <tr data-entry-id="{{ $advertisingSpace->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $advertisingSpace->id ?? '' }}
                            </td>
                            <td>
                                {{ $advertisingSpace->title ?? '' }}
                            </td>
                            <td>
                                {{ App\AdvertisingSpace::ADS_TYPE_RADIO[$advertisingSpace->ads_type] ?? '' }}
                            </td>
                            <td>
                                @if($advertisingSpace->image)
                                    <img src="{{url('/uploads/site/')}}/{{ $advertisingSpace->image }}" width="100" height="100">
                                @endif
                            </td>
                            <td>
                                {{ $advertisingSpace->code ?? '' }}
                            </td>
                            <td>
                                @can('advertising_space_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.advertising-spaces.show', $advertisingSpace->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('advertising_space_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.advertising-spaces.edit', $advertisingSpace->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('advertising_space_delete')
                                    <form action="{{ route('admin.advertising-spaces.destroy', $advertisingSpace->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('advertising_space_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.advertising-spaces.massDestroy') }}",
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
  $('.datatable-AdvertisingSpace:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection