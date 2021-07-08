<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRadioRequest;
use App\Http\Requests\StoreRadioRequest;
use App\Http\Requests\UpdateRadioRequest;
use App\Radio;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RadioController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('radio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radios = Radio::all();

        return view('admin.radios.index', compact('radios'));
    }

    public function create()
    {
        abort_if(Gate::denies('radio_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.radios.create');
    }

    public function store(StoreRadioRequest $request)
    {
        ini_set('max_execution_time', 1800);

        $radio = Radio::create($request->all());

        if ($request->file('file')) {

            $date_path = date("Y") . '/' . (int)date("m") . '/';
            $path = $request->file->path();
            $file_name = $request->file('file');

            $destinationPath = 'uploads/' . $date_path;
            $file_extension = $file_name->getClientOriginalExtension();
            $newFileName = 'sound_' . $radio->id . '.' . $file_extension;
            Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                File::get($request->file('file')->getRealPath()));


            $radio->file = $destinationPath . $newFileName;
            $radio->save();
        }

        return redirect()->route('admin.radios.index');

    }

    public function edit(Radio $radio)
    {
        abort_if(Gate::denies('radio_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.radios.edit', compact('radio'));
    }

    public function update(UpdateRadioRequest $request, Radio $radio)
    {
        if($radio->type == 'sound') {
            $radio->update([
                'name' => $request->name
            ]);
        }else{
            $radio->update([
                'name' => $request->name,
                'file' => $request->file
            ]);
        }

        if ($request->file('file')) {

            $date_path = date("Y") . '/' . (int)date("m") . '/';
            $path = $request->file->path();
            $file_name = $request->file('file');

            $destinationPath = 'uploads/' . $date_path;
            $file_extension = $file_name->getClientOriginalExtension();
            $newFileName = 'sound_' . $radio->id . '.' . $file_extension;
            Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                File::get($request->file('file')->getRealPath()));


            $radio->file = $destinationPath . $newFileName;
            $radio->save();
        }

        return redirect()->route('admin.radios.index');

    }

    public function show(Radio $radio)
    {
        abort_if(Gate::denies('radio_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.radios.show', compact('radio'));
    }

    public function destroy(Radio $radio)
    {
        abort_if(Gate::denies('radio_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $radio->delete();

        return back();

    }

    public function massDestroy(MassDestroyRadioRequest $request)
    {
        Radio::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
