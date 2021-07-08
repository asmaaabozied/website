<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\Admin\VideoResource;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource(Video::with(['category', 'sub_domain_no'])->get());
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->all());

        if ($request->input('icon_image', false)) {
            $video->addMedia(storage_path('tmp/uploads/' . $request->input('icon_image')))->toMediaCollection('icon_image');
        }

        if ($request->input('file_name', false)) {
            $video->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
        }

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoResource($video->load(['category', 'sub_domain_no']));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());

        if ($request->input('icon_image', false)) {
            if (!$video->icon_image || $request->input('icon_image') !== $video->icon_image->file_name) {
                $video->addMedia(storage_path('tmp/uploads/' . $request->input('icon_image')))->toMediaCollection('icon_image');
            }
        } elseif ($video->icon_image) {
            $video->icon_image->delete();
        }

        if ($request->input('file_name', false)) {
            if (!$video->file_name || $request->input('file_name') !== $video->file_name->file_name) {
                $video->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
            }
        } elseif ($video->file_name) {
            $video->file_name->delete();
        }

        return (new VideoResource($video))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
