<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CategoryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryTypeRequest;
use App\Http\Requests\UpdateCategoryTypeRequest;
use App\Http\Resources\Admin\CategoryTypeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryTypeResource(CategoryType::all());
    }

    public function store(StoreCategoryTypeRequest $request)
    {
        $categoryType = CategoryType::create($request->all());

        return (new CategoryTypeResource($categoryType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CategoryType $categoryType)
    {
        abort_if(Gate::denies('category_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryTypeResource($categoryType);
    }

    public function update(UpdateCategoryTypeRequest $request, CategoryType $categoryType)
    {
        $categoryType->update($request->all());

        return (new CategoryTypeResource($categoryType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CategoryType $categoryType)
    {
        abort_if(Gate::denies('category_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
