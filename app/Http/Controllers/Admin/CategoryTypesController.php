<?php

namespace App\Http\Controllers\Admin;

use App\CategoryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryTypeRequest;
use App\Http\Requests\StoreCategoryTypeRequest;
use App\Http\Requests\UpdateCategoryTypeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('category_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryTypes = CategoryType::all();

        return view('admin.categoryTypes.index', compact('categoryTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('category_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoryTypes.create');
    }

    public function store(StoreCategoryTypeRequest $request)
    {
        $categoryType = CategoryType::create($request->all());

        return redirect()->route('admin.category-types.index');
    }

    public function edit(CategoryType $categoryType)
    {
        abort_if(Gate::denies('category_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoryTypes.edit', compact('categoryType'));
    }

    public function update(UpdateCategoryTypeRequest $request, CategoryType $categoryType)
    {
        $categoryType->update($request->all());

        return redirect()->route('admin.category-types.index');
    }

    public function show(CategoryType $categoryType)
    {
        abort_if(Gate::denies('category_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoryTypes.show', compact('categoryType'));
    }

    public function destroy(CategoryType $categoryType)
    {
        abort_if(Gate::denies('category_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryType->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryTypeRequest $request)
    {
        CategoryType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
