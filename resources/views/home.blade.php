@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                                <div class="row">
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 yellow">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">مجموع الأعضاء</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $user_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 green">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">تعليقات الفيديوهات</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $video_comment_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 blue">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">تعليقات الصوتيات</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $sound_comment_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 purple">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">تعليقات الصور</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $image_comment_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <br>
                        <div class="row">
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 red">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">مجموع الأعضاء</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $user_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 purple">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">مجموع الفيديوهات</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $video_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 green">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">مجموع الصوتيات</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $sound_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0 yellow">
                                            <div class="card-body color-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="card-title mb-0">مجموع الصور</h6>
                                                        <span class="h2 font-weight-bold mb-0">{{ $image_count }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<br>
                    <div class="row">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Admin">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    عنوان الميديا
                                </th>
                                <th>
                                    العضو
                                </th>
                                <th>
                                    التعليق
                                </th>
                                <th>
                                    النوع
                                </th>
                                <th>
                                    تاريخ الاضافه
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $key => $comment)

                            <?php
$media_title=$media_type='';

if((int)$comment->image_id>0){
 	$image= App\Image::find($comment->image_id);
                         $media_title =  ''.$image['title'];
                           $media_type = "images";

 }




						if((int)$comment->sound_id>0)
                        {
							 $sound= App\Sound::find($comment->sound_id);

                            $media_title= ''.$sound['title'];
						$media_type = "sounds";

						}


						if((int)$comment->video_id>0){
							$video= App\Video::find($comment->video_id);

                            $media_title =  ''.$video['title'];
							$media_type = "videos";

						}
                            ?>
                            @if(trim($media_title))
                                <tr data-entry-id="{{ $comment->id }}">
                                    <td>
                                        {{ $comment->id ?? '' }}
                                    </td>
                                    <td>
                                        @if($comment->image)
                                            {{ $comment->image->title ?? '' }}
                                        @elseif($comment->sound)
                                            {{ $comment->sound->title ?? '' }}
                                        @elseif($comment->video)
                                            {{ $comment->video->title ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $comment->user->username ?? '' }}
                                    </td>
                                    <td>
                                        {{ $comment->comment ?? '' }}
                                    </td>
                                    <td>
                                        @if($comment->image)
                                            images
                                        @elseif($comment->sound)
                                            sounds
                                        @elseif($comment->video)
                                            videos
                                        @endif
                                    </td>
                                    <td>
                                        {{ $comment->creation_date ?? '' }}
                                    </td>
                                    <td>
                                        <a href="/admin/publish/{{ $comment->id }}">

                                            <i class="icon-check"></i> تفعيل </a>
                                    </td>

                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection