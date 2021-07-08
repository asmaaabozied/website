<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function list_files(){

        $files = Storage::disk('videos_ftp')->files('uploads/2017/09');



        $format = new \FFMpeg\Format\Video\X264();
        $format->setAudioCodec("libmp3lame");

        foreach ($files as $file) {

            \FFMpeg::fromDisk('videos_ftp')
                ->open($file)
                ->addFilter(function ($filters) {

                    $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));

                })
                ->export()
                ->toDisk('videos_ftp')
                ->inFormat($format)
                ->save('uploads/2017/09/'.basename($files));
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
