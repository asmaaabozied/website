<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category_types = CategoryType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.categories.create', compact('category_types'
        ,'categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        if(isset($request['parent_category'])) {
            $category_level = 1;
        }else{
            $category_level = 1;
        }
        $category = Category::create(array_merge($request->all(), [
            'is_last_level' => 1,
            'category_level' =>$category_level
        ]));
        if ($request->file('icon_img') != null)
            if ($request->file('icon_img')->isValid()) {
                $path = $request->icon_img->path();
                $icon_img = $request->file('icon_img');
                $destinationPath = 'uploads/category/images';
                $file_extension = $icon_img->getClientOriginalExtension();
                $newFileName = 'image_' . $category->id . '.' . $file_extension;
                $icon_img->move($destinationPath, $newFileName);

                $category->icon_img = $newFileName;
                $category->save();
            }
            


        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category_types = CategoryType::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $category->load('categories_type');
        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.categories.edit', compact('category_types'
            , 'category','categories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {

        if(isset($request['parent_category'])) {
            $category_level = 1;
        }else{
            $category_level = 1;
        }
        $category->update(array_merge($request->all(), [
            'is_last_level' => 1,
            'category_level' =>$category_level
        ]));

        if ($request->file('icon_img') != null)
            if ($request->file('icon_img')->isValid()) {
                $path = $request->icon_img->path();
                $icon_img = $request->file('icon_img');
                $destinationPath = 'uploads/category/images';
                $file_extension = $icon_img->getClientOriginalExtension();
                $newFileName = 'image_' . $category->id . '.' . $file_extension;
                $icon_img->move($destinationPath, $newFileName);

                $category->icon_img = $newFileName;
                $category->save();
            }

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->load('categories_type');

        return view('admin.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
