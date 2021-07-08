<?php

namespace App\Http\Controllers\Admin;
use App\Comment;
use DB;
use App\Image;
use App\Video;
use App\Sound;
use App\User;

class HomeController
{
    public function index()
    {

        $video_comment_count= Comment::where('video_id' ,'<>' ,null)->count();

        $sound_comment_count=Comment::where('sound_id' ,'<>' ,null)->count();

        $image_comment_count=Comment::where('image_id' ,'<>' ,null)->count();

        $user_count = User::count();

        $video_count = Video::count();

        $sound_count = Sound::count();

        $image_count = Image::count();

        $comments = Comment::where('active', 0)->orderBy('id', 'DESC')->get();

        return view('home' , compact('comments','video_comment_count'
        ,'sound_comment_count','image_comment_count','user_count',
            'video_count','sound_count','image_count'));
    }
    public function publish($id)
    {
        $comment = Comment::find($id);
        $comment->active = '1';
        $comment->save();


        return redirect()->back()->with('status', 'تم تفعيل التعليق بنجاح!'); //Good
    }
}
