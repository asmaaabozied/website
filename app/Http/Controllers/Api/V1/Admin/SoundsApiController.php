<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSoundRequest;
use App\Http\Requests\UpdateSoundRequest;
use App\Http\Resources\Admin\SoundResource;
use App\Sound;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoundsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sound_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SoundResource(Sound::with(['category', 'sub_domain_no'])->get());
    }

    public function store(StoreSoundRequest $request)
    {
        $sound = Sound::create($request->all());

        if ($request->input('file_name', false)) {
            $sound->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
        }

        if ($request->input('icon_image', false)) {
            $sound->addMedia(storage_path('tmp/uploads/' . $request->input('icon_image')))->toMediaCollection('icon_image');
        }

        return (new SoundResource($sound))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sound $sound)
    {
        abort_if(Gate::denies('sound_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SoundResource($sound->load(['category', 'sub_domain_no']));
    }

    public function update(UpdateSoundRequest $request, Sound $sound)
    {
        $sound->update($request->all());

        if ($request->input('file_name', false)) {
            if (!$sound->file_name || $request->input('file_name') !== $sound->file_name->file_name) {
                $sound->addMedia(storage_path('tmp/uploads/' . $request->input('file_name')))->toMediaCollection('file_name');
            }
        } elseif ($sound->file_name) {
            $sound->file_name->delete();
        }

        if ($request->input('icon_image', false)) {
            if (!$sound->icon_image || $request->input('icon_image') !== $sound->icon_image->file_name) {
                $sound->addMedia(storage_path('tmp/uploads/' . $request->input('icon_image')))->toMediaCollection('icon_image');
            }
        } elseif ($sound->icon_image) {
            $sound->icon_image->delete();
        }

        return (new SoundResource($sound))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sound $sound)
    {
        abort_if(Gate::denies('sound_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sound->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
