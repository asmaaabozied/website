@extends('layouts.admin')
@section('content')
@can('video_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.videos.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.video.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.video.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>العنوان</th>
                    <th>القسم</th>
                    <th><i class="fa fa-eye"></i></th>
                    <th><i class="fa fa-comment"></i></th>
                    <th><i class="fa fa-thumbs-o-up"></i></th>
                    <th><i class="fa fa-heart"></i></th>
                    <th>مفعل</th>
                    <th>تاريخ الاضافه</th>
                    <th>action</th>
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
            ajax: '{{ url('admin/videos') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'category_id', name: 'category_id' },
                { data: 'views', name: 'views' },
                { data: 'comments', name: 'comments' },
                { data: 'likes', name: 'likes' },
                { data: 'favorites', name: 'favorites' },
                { data: 'active', name: 'active' },
                { data: 'creation_date', name: 'creation_date' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@endsection