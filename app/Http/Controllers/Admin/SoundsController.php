<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySoundRequest;
use App\Http\Requests\StoreSoundRequest;
use App\Http\Requests\UpdateSoundRequest;
use App\Sound;
use App\SubDomian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Comment;
use App\Like;
use App\Favorite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use OneSignal;
use Illuminate\Support\Str;
use yajra\Datatables\Datatables;

class SoundsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sound_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->ajax()){
            $Sound = Sound::get();

            return DataTables::of($Sound)
                ->setRowId(function ($Sound) {
                    return $Sound->id;
                })
                ->addColumn('action', function ($Sound) {
                    return '
                    <a class="btn btn-xs btn-primary" href="'. route('admin.sounds.show', $Sound->id).' ">
                        '. trans('global.view').'
                    </a>
               
                    <a class="btn btn-xs btn-info" href="'.route('admin.sounds.edit', $Sound->id) .'">
                        '. trans('global.edit').'
                    </a>
              
                    <form action="'.route('admin.sounds.destroy', $Sound->id) .'" method="POST" onsubmit="return confirm(\'confirm?\');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-xs btn-danger" value="'. trans('global.delete') .'">
                    </form>
                ';
                })->make(true);
        }
        return view('admin.sounds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sound_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_domain_nos = SubDomian::all()->pluck('titleAr', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sounds.create', compact('categories', 'sub_domain_nos'));
    }

    public function store(StoreSoundRequest $request)
    {

        $sound = Sound::create(array_merge($request->all(), [
            'sub_domain_no' => 2,
        ]));

        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('icon_image') != null)
            if ($request->file('icon_image')->isValid()) {
                $path = $request->icon_image->path();
                $icon_image = $request->file('icon_image');
                $file_extension = $icon_image->getClientOriginalExtension();
                $newFileName = 'sound_image_' . $sound->id . '.' . $file_extension;

                $destinationPath = 'uploads/images/' . $date_path;
                Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('icon_image')->getRealPath()));
                $sound->icon_image = $destinationPath . $newFileName;
                $sound->save();
            }


        if ($request->file('file_name') != null)
            if ($request->file('file_name')->isValid()) {
                $path = $request->file_name->path();
                $file_name = $request->file('file_name');

                $destinationPath = 'uploads/' . $date_path;
                $file_extension = $file_name->getClientOriginalExtension();
                $newFileName = 'sound_' . $sound->id . '.' . $file_extension;
                Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('file_name')->getRealPath()));


                $sound->file_name = $destinationPath . $newFileName;
                $sound->save();
            }
        $data = array(
            'media_id' => $sound->id,
            'media_type' => 2
        );

        if (isset($request->notify))
            OneSignal::sendNotificationToAll(Str::limit($request->title, $limit = 25, $end = '...'), $url = null, $data);

        return redirect()->route('admin.sounds.index');
    }

    public function edit(Sound $sound)
    {
        abort_if(Gate::denies('sound_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_domain_nos = SubDomian::all()->pluck('titleAr', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sound->load('category', 'sub_domain_no');

        return view('admin.sounds.edit', compact('categories', 'sub_domain_nos', 'sound'));
    }

    public function update(UpdateSoundRequest $request, Sound $sound)
    {
        $sound->update($request->all());

        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('icon_image') != null)
            if ($request->file('icon_image')->isValid()) {
                $path = $request->icon_image->path();
                $icon_image = $request->file('icon_image');
                $file_extension = $icon_image->getClientOriginalExtension();
                $newFileName = 'sound_image_' . $sound->id . '.' . $file_extension;

                $destinationPath = 'uploads/images/' . $date_path;
                Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('icon_image')->getRealPath()));
                $sound->icon_image = $destinationPath . $newFileName;
                $sound->save();
            }


        if ($request->file('file_name') != null)
            if ($request->file('file_name')->isValid()) {
                $path = $request->file_name->path();
                $file_name = $request->file('file_name');

                $destinationPath = 'uploads/' . $date_path;
                $file_extension = $file_name->getClientOriginalExtension();
                $newFileName = 'sound_' . $sound->id . '.' . $file_extension;
                Storage::disk('sounds_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('file_name')->getRealPath()));


                $sound->file_name = $destinationPath . $newFileName;
                $sound->save();
            }


        return redirect()->route('admin.sounds.index');
    }

    public function show(Sound $sound)
    {
        abort_if(Gate::denies('sound_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sound->load('category', 'sub_domain_no');

        return view('admin.sounds.show', compact('sound'));
    }

    public function destroy(Sound $sound)
    {
        abort_if(Gate::denies('sound_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sound->delete();

        return back();
    }

    public function massDestroy(MassDestroySoundRequest $request)
    {
        Sound::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function comments(){
        $comments = Comment::where('sound_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $sounds = true;
        return view('admin.comments.index', compact('comments','sounds'));
    }
    public function likes(){
        $likes = Like::where('sound_id', '<>', 'null')->where('like_type', '=', '1')->orderBy('id', 'DESC')->get();
        $sounds = true;
        return view('admin.likes.index', compact('likes','sounds'));
    }
    public function dislikes(){
        $likes = Like::where('sound_id', '<>', 'null')->where('like_type', '=', '2')->orderBy('id', 'DESC')->get();
        $sounds = true;
        return view('admin.likes.index', compact('likes','sounds'));
    }
    public function favorites(){
        $favorites = Favorite::where('sound_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $sounds = true;
        return view('admin.favorites.index', compact('favorites','sounds'));
    }
}
