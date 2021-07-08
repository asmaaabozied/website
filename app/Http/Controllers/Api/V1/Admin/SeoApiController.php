<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeoRequest;
use App\Http\Requests\UpdateSeoRequest;
use App\Http\Resources\Admin\SeoResource;
use App\Seo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SeoResource(Seo::all());
    }

    public function store(StoreSeoRequest $request)
    {
        $seo = Seo::create($request->all());

        return (new SeoResource($seo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Seo $seo)
    {
        abort_if(Gate::denies('seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SeoResource($seo);
    }

    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        $seo->update($request->all());

        return (new SeoResource($seo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Seo $seo)
    {
        abort_if(Gate::denies('seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
