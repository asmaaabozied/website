<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Like;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyImageRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Image;
use App\SubDomian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use OneSignal;
use Illuminate\Support\Str;
use yajra\Datatables\Datatables;

class ImagesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $Image = Image::get();
        if($request->ajax()){
            $Image = Image::get();

            return DataTables::of($Image)
                ->setRowId(function ($Image) {
                    return $Image->id;
                })
                ->addColumn('action', function ($Image) {
                    return '
                    <a class="btn btn-xs btn-primary" href="'. route('admin.images.show', $Image->id).' ">
                        '. trans('global.view').'
                    </a>

                    <a class="btn btn-xs btn-info" href="'.route('admin.images.edit', $Image->id) .'">
                        '. trans('global.edit').'
                    </a>

                    <form action="'.route('admin.images.destroy', $Image->id) .'" method="POST" onsubmit="return confirm(\'confirm?\');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-xs btn-danger" value="'. trans('global.delete') .'">
                    </form>
                ';
                })->make(true);
        }
        return view('admin.images.index', compact('Image'));
    }

    public function create()
    {
        abort_if(Gate::denies('image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.images.create', compact('categories'));
    }

    public function store(StoreImageRequest $request)
    {
        if (isset($request['active'])) {
            $active = 1;
        }else{
            $active = 0;
        }

        $image = Image::create(array_merge($request->all(), [
            'sub_domain_no' => 3,
            'active' => $active,
        ]));

        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('file_name') != null)
            if ($request->file('file_name')->isValid()) {
                $path = $request->file_name->path();
                $file_name = $request->file('file_name');

                $destinationPath = 'uploads/' . $date_path;
                $file_extension = $file_name->getClientOriginalExtension();
                $newFileName = 'image_' . $image->id . '.' . $file_extension;
                Storage::disk('images_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('file_name')->getRealPath()));


                $imageManager = new ImageManager();

                $img = $imageManager->make(File::get($request->file('file_name')->getRealPath()));
                $img->resize(100, 100);
                $img->save('uploads/images/thumb/' . 'thumb_' . $newFileName);

                $image->img_thm = 'thumb_' . $newFileName;

                $image->file_name = $destinationPath . $newFileName;

                $image->save();
            }
        $data = array(
            'media_id' => $image->id,
            'media_type' => 3
        );

        if (isset($request->notify))
            OneSignal::sendNotificationToAll(Str::limit($request->title, $limit = 25, $end = '...'), $url = null, $data);

        return redirect()->route('admin.images.index');
    }

    public function edit(Image $image)
    {
        abort_if(Gate::denies('image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_domain_nos = SubDomian::all()->pluck('titleEn', 'id')->prepend(trans('global.pleaseSelect'), '');

        $image->load('category', 'sub_domain_no');

        return view('admin.images.edit', compact('categories', 'sub_domain_nos', 'image'));
    }

    public function update(UpdateImageRequest $request, Image $image)
    {
        if (isset($request['active'])) {
            $active = 1;
        }else{
            $active = 0;
        }
        $image->update(array_merge($request->all(), ['active' => $active]));


        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('file_name') != null)
            if ($request->file('file_name')->isValid()) {
                $path = $request->file_name->path();
                $file_name = $request->file('file_name');

                $destinationPath = 'uploads/' . $date_path;
                $file_extension = $file_name->getClientOriginalExtension();
                $newFileName = 'image_' . $image->id . '.' . $file_extension;
                Storage::disk('images_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('file_name')->getRealPath()));

                $imageManager = new ImageManager();

                $img = $imageManager->make(File::get($request->file('file_name')->getRealPath()));
                $img->resize(100, 100);
                $img->save('uploads/images/thumb/' . 'thumb_' . $newFileName);

                $image->img_thm = 'thumb_' . $newFileName;

                $image->file_name = $destinationPath . $newFileName;
                $image->save();

            }


        return redirect()->route('admin.images.index');
    }

    public function show(Image $image)
    {
        abort_if(Gate::denies('image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image->load('category', 'sub_domain_no');

        return view('admin.images.show', compact('image'));
    }

    public function destroy(Image $image)
    {
        abort_if(Gate::denies('image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $image->delete();

        return back();
    }

    public function massDestroy(MassDestroyImageRequest $request)
    {
        Image::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function comments(){
        $comments = Comment::where('image_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $images = true;
        return view('admin.comments.index', compact('comments','images'));
    }
    public function likes(){
        $likes = Like::where('image_id', '<>', 'null')->where('like_type', '=', '1')->orderBy('id', 'DESC')->get();
        $images = true;
        return view('admin.likes.index', compact('likes','images'));
    }
    public function dislikes(){
        $likes = Like::where('image_id', '<>', 'null')->where('like_type', '=', '2')->orderBy('id', 'DESC')->get();
        $images = true;
        return view('admin.likes.index', compact('likes','images'));
    }
    public function favorites(){
        $favorites = Favorite::where('image_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $images = true;
        return view('admin.favorites.index', compact('favorites','images'));
    }
}
