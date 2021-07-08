<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AdvertisingSpace;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAdvertisingSpaceRequest;
use App\Http\Requests\UpdateAdvertisingSpaceRequest;
use App\Http\Resources\Admin\AdvertisingSpaceResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvertisingSpacesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('advertising_space_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdvertisingSpaceResource(AdvertisingSpace::all());
    }

    public function store(StoreAdvertisingSpaceRequest $request)
    {
        $advertisingSpace = AdvertisingSpace::create($request->all());

        if ($request->input('image', false)) {
            $advertisingSpace->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new AdvertisingSpaceResource($advertisingSpace))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AdvertisingSpace $advertisingSpace)
    {
        abort_if(Gate::denies('advertising_space_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdvertisingSpaceResource($advertisingSpace);
    }

    public function update(UpdateAdvertisingSpaceRequest $request, AdvertisingSpace $advertisingSpace)
    {
        $advertisingSpace->update($request->all());

        if ($request->input('image', false)) {
            if (!$advertisingSpace->image || $request->input('image') !== $advertisingSpace->image->file_name) {
                $advertisingSpace->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($advertisingSpace->image) {
            $advertisingSpace->image->delete();
        }

        return (new AdvertisingSpaceResource($advertisingSpace))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AdvertisingSpace $advertisingSpace)
    {
        abort_if(Gate::denies('advertising_space_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $advertisingSpace->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
