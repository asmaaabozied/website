<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\Admin\ImageResource;
use App\Image;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImagesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ImageResource(Image::with(['category', 'sub_domain_no'])->get());
    }

    public function store(StoreImageRequest $request)
    {
        $image = Image::create($request->all());

        if ($request->input('file_name', false)) {
            $image->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
        }

        if ($request->input('img_thm', false)) {
            $image->addMedia(storage_path('tmp/uploads/' . $request->input('img_thm')))->toMediaCollection('img_thm');
        }

        return (new ImageResource($image))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Image $image)
    {
        abort_if(Gate::denies('image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ImageResource($image->load(['category', 'sub_domain_no']));
    }

    public function update(UpdateImageRequest $request, Image $image)
    {
        $image->update($request->all());

        if ($request->input('file_name', false)) {
            if (!$image->file_name || $request->input('file_name') !== $image->file_name->file_name) {
                $image->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
            }
        } elseif ($image->file_name) {
            $image->file_name->delete();
        }

        if ($request->input('img_thm', false)) {
            if (!$image->img_thm || $request->input('img_thm') !== $image->img_thm->file_name) {
                $image->addMedia(storage_path('tmp/uploads/' . $request->input('img_thm')))->toMediaCollection('img_thm');
            }
        } elseif ($image->img_thm) {
            $image->img_thm->delete();
        }

        return (new ImageResource($image))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Image $image)
    {
        abort_if(Gate::denies('image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
