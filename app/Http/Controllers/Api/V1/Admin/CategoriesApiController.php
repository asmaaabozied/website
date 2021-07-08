<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource(Category::with(['categories_type'])->get());
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        if ($request->input('icon_img', false)) {
            $category->addMedia(storage_path('tmp/uploads/' . $request->input('icon_img')))->toMediaCollection('icon_img');
        }

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoryResource($category->load(['categories_type']));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        if ($request->input('icon_img', false)) {
            if (!$category->icon_img || $request->input('icon_img') !== $category->icon_img->file_name) {
                $category->addMedia(storage_path('tmp/uploads/' . $request->input('icon_img')))->toMediaCollection('icon_img');
            }
        } elseif ($category->icon_img) {
            $category->icon_img->delete();
        }

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
