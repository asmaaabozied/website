<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Adminmenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminmenuRequest;
use App\Http\Requests\UpdateAdminmenuRequest;
use App\Http\Resources\Admin\AdminmenuResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminmenuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('adminmenu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminmenuResource(Adminmenu::all());
    }

    public function store(StoreAdminmenuRequest $request)
    {
        $adminmenu = Adminmenu::create($request->all());

        return (new AdminmenuResource($adminmenu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Adminmenu $adminmenu)
    {
        abort_if(Gate::denies('adminmenu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminmenuResource($adminmenu);
    }

    public function update(UpdateAdminmenuRequest $request, Adminmenu $adminmenu)
    {
        $adminmenu->update($request->all());

        return (new AdminmenuResource($adminmenu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Adminmenu $adminmenu)
    {
        abort_if(Gate::denies('adminmenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminmenu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
