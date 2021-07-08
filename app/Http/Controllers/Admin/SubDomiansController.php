<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubDomianRequest;
use App\Http\Requests\StoreSubDomianRequest;
use App\Http\Requests\UpdateSubDomianRequest;
use App\SubDomian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubDomiansController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sub_domian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subDomians = SubDomian::all();

        return view('admin.subDomians.index', compact('subDomians'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_domian_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subDomians.create');
    }

    public function store(StoreSubDomianRequest $request)
    {
        $subDomian = SubDomian::create($request->all());

        return redirect()->route('admin.sub-domians.index');
    }

    public function edit(SubDomian $subDomian)
    {
        abort_if(Gate::denies('sub_domian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subDomians.edit', compact('subDomian'));
    }

    public function update(UpdateSubDomianRequest $request, SubDomian $subDomian)
    {
        $subDomian->update($request->all());

        return redirect()->route('admin.sub-domians.index');
    }

    public function show(SubDomian $subDomian)
    {
        abort_if(Gate::denies('sub_domian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subDomians.show', compact('subDomian'));
    }

    public function destroy(SubDomian $subDomian)
    {
        abort_if(Gate::denies('sub_domian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subDomian->delete();

        return back();
    }

    public function massDestroy(MassDestroySubDomianRequest $request)
    {
        SubDomian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
