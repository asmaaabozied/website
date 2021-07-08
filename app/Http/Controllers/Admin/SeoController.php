<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySeoRequest;
use App\Http\Requests\StoreSeoRequest;
use App\Http\Requests\UpdateSeoRequest;
use App\Seo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seos = Seo::all();

        return view('admin.seos.index', compact('seos'));
    }

    public function create()
    {
        abort_if(Gate::denies('seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seos.create');
    }

    public function store(StoreSeoRequest $request)
    {
        $seo = Seo::create($request->all());

        return redirect()->route('admin.seos.index');
    }

    public function edit(Seo $seo)
    {
        abort_if(Gate::denies('seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seos.edit', compact('seo'));
    }

    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        $seo->update($request->all());

        return redirect()->route('admin.seos.index');
    }

    public function show(Seo $seo)
    {
        abort_if(Gate::denies('seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seos.show', compact('seo'));
    }

    public function destroy(Seo $seo)
    {
        abort_if(Gate::denies('seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seo->delete();

        return back();
    }

    public function massDestroy(MassDestroySeoRequest $request)
    {
        Seo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
