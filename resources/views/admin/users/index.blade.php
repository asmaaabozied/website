@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                           مفعل
                        </th>
                        <th>
                           نوع الجهاز
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.creation_date') }}
                        </th>
                        <th>
                            action
                        </th>
                    </tr>
                </thead>

            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent

<script>
    $(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('admin/users') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'active', name: 'active' },
                { data: 'device_type', name: 'device_type' },
                { data: 'creation_date', name: 'creation_date' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>

@endsection