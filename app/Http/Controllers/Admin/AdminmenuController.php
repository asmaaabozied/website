<?php

namespace App\Http\Controllers\Admin;

use App\Adminmenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAdminmenuRequest;
use App\Http\Requests\StoreAdminmenuRequest;
use App\Http\Requests\UpdateAdminmenuRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminmenuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('adminmenu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminmenus = Adminmenu::all();

        return view('admin.adminmenus.index', compact('adminmenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('adminmenu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $adminmenus = Adminmenu::all()->pluck('menuTitleAr', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.adminmenus.create',compact('adminmenus'));
    }

    public function store(StoreAdminmenuRequest $request)
    {
        $adminmenu = Adminmenu::create($request->all());

        return redirect()->route('admin.adminmenus.index');
    }

    public function edit(Adminmenu $adminmenu)
    {
        abort_if(Gate::denies('adminmenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $adminmenus = Adminmenu::all()->pluck('menuTitleAr', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.adminmenus.edit', compact('adminmenu','adminmenus'));
    }

    public function update(UpdateAdminmenuRequest $request, Adminmenu $adminmenu)
    {
        $adminmenu->update($request->all());

        return redirect()->route('admin.adminmenus.index');
    }

    public function show(Adminmenu $adminmenu)
    {
        abort_if(Gate::denies('adminmenu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adminmenus.show', compact('adminmenu'));
    }

    public function destroy(Adminmenu $adminmenu)
    {
        abort_if(Gate::denies('adminmenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminmenu->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdminmenuRequest $request)
    {
        Adminmenu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
