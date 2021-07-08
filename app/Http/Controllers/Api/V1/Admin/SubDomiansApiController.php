<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubDomianRequest;
use App\Http\Requests\UpdateSubDomianRequest;
use App\Http\Resources\Admin\SubDomianResource;
use App\SubDomian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubDomiansApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sub_domian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubDomianResource(SubDomian::all());
    }

    public function store(StoreSubDomianRequest $request)
    {
        $subDomian = SubDomian::create($request->all());

        return (new SubDomianResource($subDomian))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubDomian $subDomian)
    {
        abort_if(Gate::denies('sub_domian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubDomianResource($subDomian);
    }

    public function update(UpdateSubDomianRequest $request, SubDomian $subDomian)
    {
        $subDomian->update($request->all());

        return (new SubDomianResource($subDomian))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubDomian $subDomian)
    {
        abort_if(Gate::denies('sub_domian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subDomian->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
