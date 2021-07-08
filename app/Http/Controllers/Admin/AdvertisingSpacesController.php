<?php

namespace App\Http\Controllers\Admin;

use App\AdvertisingSpace;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAdvertisingSpaceRequest;
use App\Http\Requests\StoreAdvertisingSpaceRequest;
use App\Http\Requests\UpdateAdvertisingSpaceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvertisingSpacesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('advertising_space_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $advertisingSpaces = AdvertisingSpace::all();

        return view('admin.advertisingSpaces.index', compact('advertisingSpaces'));
    }

    public function create()
    {
        abort_if(Gate::denies('advertising_space_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.advertisingSpaces.create');
    }

    public function store(StoreAdvertisingSpaceRequest $request)
    {
        $advertisingSpace = AdvertisingSpace::create($request->all());


        return redirect()->route('admin.advertising-spaces.index');
    }

    public function edit(AdvertisingSpace $advertisingSpace)
    {
        abort_if(Gate::denies('advertising_space_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.advertisingSpaces.edit', compact('advertisingSpace'));
    }

    public function update(UpdateAdvertisingSpaceRequest $request, AdvertisingSpace $advertisingSpace)
    {
        $advertisingSpace->update($request->all());

        if ($request->file('image') != null)
            if ($request->file('image')->isValid()) {
                $path = $request->image->path();
                $userImage = $request->file('image');
                $destinationPath = 'uploads/site';
                $file_extension = $userImage->getClientOriginalExtension();
                $newFileName = 'image_' . $advertisingSpace->id . '.' . $file_extension;
                $userImage->move($destinationPath, $newFileName);

                $advertisingSpace->image = $newFileName;
                $advertisingSpace->save();
            }

        return redirect()->route('admin.advertising-spaces.index');
    }

    public function show(AdvertisingSpace $advertisingSpace)
    {
        abort_if(Gate::denies('advertising_space_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.advertisingSpaces.show', compact('advertisingSpace'));
    }

    public function destroy(AdvertisingSpace $advertisingSpace)
    {
        abort_if(Gate::denies('advertising_space_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $advertisingSpace->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdvertisingSpaceRequest $request)
    {
        AdvertisingSpace::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
