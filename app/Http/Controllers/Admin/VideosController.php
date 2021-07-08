<?php

namespace App\Http\Controllers\Admin;
use yajra\Datatables\Datatables;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVideoRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\SubDomian;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Comment;
use App\Like;
use App\Favorite;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class VideosController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->ajax()){
            $Video = Video::get();

            return DataTables::of($Video)
                ->setRowId(function ($Video) {
                    return $Video->id;
                })
                ->addColumn('action', function ($Video) {
                return '
                    <a class="btn btn-xs btn-primary" href="'. route('admin.videos.show', $Video->id).' ">
                        '. trans('global.view').'
                    </a>
               
                    <a class="btn btn-xs btn-info" href="'.route('admin.videos.edit', $Video->id) .'">
                        '. trans('global.edit').'
                    </a>
              
                    <form action="'.route('admin.videos.destroy', $Video->id) .'" method="POST" onsubmit="return confirm(\'confirm?\');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="submit" class="btn btn-xs btn-danger" value="'. trans('global.delete') .'">
                    </form>
                ';
                })->make(true);
    }
        return view('admin.videos.index');
    }

    public function create()
    {

        abort_if(Gate::denies('video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_domain_nos = SubDomian::all()->pluck('titleEn', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.videos.create', compact('categories', 'sub_domain_nos'));
    }

    public function test_upload(Request $request){
        $chunkReceiver = new \Q8Intouch\LaraVids\FileReceiver\ChunkReceiver(
        // file index
        // i.e: name of the file parameter in the post request
            "file",
            $request,
            HandlerFactory::classFromRequest($request),
            function (\Illuminate\Http\UploadedFile $file) use ($request){
                // Build file path using date and mime type
                $mime = str_replace('/', '-', $file->getMimeType());
                // Group files by the date (week
                $dateFolder = date("Y-m-W");
                // Build the file path
                $filePathWithOutDisk = "upload/{$mime}/{$dateFolder}/";
                $filePath = "upload/{$mime}/{$dateFolder}/";
                // get the storage path
                $finalPath = storage_path("app/public/".$filePath);
                // get any paramter from the post data
                // in this example we will be setting the video name from the title parameter
                $fileTitle = $file->getClientOriginalName();
                // move the file to the built path
                $file->move($finalPath, $fileTitle);

// http://video.niceq8i.tv/{{ $video->file_name }}

                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//                set_time_limit(-1);
//
//                \FFMpeg::fromDisk('public')
//                    ->open($filePath.$fileTitle)
//                    ->addFilter(function ($filters) {
//                        $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
//                    })
//                    ->export()
//                    ->toDisk('public')
//                    ->inFormat(new \FFMpeg\Format\Video\X264)
//                    ->save('vid.mkv');

                // return any data to be received by the client side
                // any response can be set here and received from the client side
                return response()->json([
                    'path' => $filePath,
                    'name' => $fileTitle,
                    'mime_type' => $mime,
                    'fileName' => $fileName
                ]);
            });

        // Dont forget to return the receive response to track progress && failed parts
        return $chunkReceiver->receive();
    }

    public function after_upload(Request $request) {

        set_time_limit(-1);

        \FFMpeg::fromDisk('public')
            ->open($request['path'].$request['name'])
            ->addFilter(function ($filters) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            })
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save($request['path'].$request['file_name'].'.mkv');
        return 1;
    }


    public function store(StoreVideoRequest $request)
    {
        set_time_limit(-1);

        $video = Video::create(array_merge($request->all(), [
            'sub_domain_no' => 3,
        ]));

        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('icon_image') != null)
            if ($request->file('icon_image')->isValid()) {
                $path = $request->icon_image->path();
                $icon_image = $request->file('icon_image');
                $file_extension = $icon_image->getClientOriginalExtension();
                $newFileName = 'video_image_' . $video->id . '.' . $file_extension;

                $destinationPath = 'uploads/images/' . $date_path;
                Storage::disk('videos_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('icon_image')->getRealPath()));

                $video->icon_image = $destinationPath . $newFileName;
                $video->save();
            }

        if ($request->file('video_file')) {
            $path = $request->video_file->path();
            $video_file = $request->file('video_file');
            $file_extension = $video_file->getClientOriginalExtension();
            $newFileName = 'video_image_' . $video->id . '.' . $file_extension;

            $destinationPath = 'uploads/videos/' . $date_path;
            Storage::disk('videos_ftp')->put($destinationPath . $newFileName,
                File::get($request->file('video_file')->getRealPath()));

            $video->file_name = $destinationPath . $newFileName;
            $video->save();
        }

        $data = array(
            'media_id' => $video->id,
            'media_type' => 1,
            'headings' => $request->title,
            'large_icon' => url($video->icon_image),
            'ios_attachments' => url($video->icon_image)
        );
        // str_limit($message, $limit = 25, $end = '...')
        if (isset($input['is_push']))
            OneSignal::sendNotificationToAll($request->description, $url = null, $data);

        return redirect()->route('admin.videos.index');
    }

    public function edit(Video $video)
    {
        abort_if(Gate::denies('video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_domain_nos = SubDomian::all()->pluck('titleEn', 'id')->prepend(trans('global.pleaseSelect'), '');

        $video->load('category', 'sub_domain_no');

        return view('admin.videos.edit', compact('categories', 'sub_domain_nos', 'video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());
        $date_path = date("Y") . '/' . (int)date("m") . '/';

        if ($request->file('icon_image') != null)
            if ($request->file('icon_image')->isValid()) {
                $path = $request->icon_image->path();
                $icon_image = $request->file('icon_image');
                $file_extension = $icon_image->getClientOriginalExtension();
                $newFileName = 'video_image_' . $video->id . '.' . $file_extension;

                $destinationPath = 'uploads/images/' . $date_path;
                Storage::disk('videos_ftp')->put($destinationPath . $newFileName,
                    File::get($request->file('icon_image')->getRealPath()));

                $video->icon_image = $destinationPath . $newFileName;
                $video->save();
            }

        return redirect()->route('admin.videos.index');
    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->load('category', 'sub_domain_no');

        return view('admin.videos.show', compact('video'));
    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return back();
    }

    public function massDestroy(MassDestroyVideoRequest $request)
    {
        Video::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function comments(){
        $comments = Comment::where('video_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $videos = true;
        return view('admin.comments.index', compact('comments','videos'));
    }
    public function likes(){
        $likes = Like::where('video_id', '<>', 'null')->where('like_type', '=', '1')->orderBy('id', 'DESC')->get();
        $videos = true;
        return view('admin.likes.index', compact('likes','videos'));
    }
    public function dislikes(){
        $likes = Like::where('video_id', '<>', 'null')->where('like_type', '=', '2')->orderBy('id', 'DESC')->get();
        $videos = true;
        return view('admin.likes.index', compact('likes','videos'));
    }
    public function favorites(){
        $favorites = Favorite::where('video_id', '<>', 'null')->orderBy('id', 'DESC')->get();
        $videos = true;
        return view('admin.favorites.index', compact('favorites','videos'));
    }
}
