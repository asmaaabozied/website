<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLikeRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Image;
use App\Like;
use App\Sound;
use App\User;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('like_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $likes = Like::all();

        return view('admin.likes.index', compact('likes'));
    }

    public function create()
    {
        abort_if(Gate::denies('like_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $images = Image::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sounds = Sound::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comments = Comment::all()->pluck('comment', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.likes.create', compact('images', 'sounds', 'videos', 'comments', 'users'));
    }

    public function store(StoreLikeRequest $request)
    {
        $like = Like::create($request->all());

        return redirect()->route('admin.likes.index');
    }

    public function edit(Like $like)
    {
        abort_if(Gate::denies('like_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $images = Image::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sounds = Sound::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comments = Comment::all()->pluck('comment', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $like->load('image', 'sound', 'video', 'comment', 'user');

        return view('admin.likes.edit', compact('images', 'sounds', 'videos', 'comments', 'users', 'like'));
    }

    public function update(UpdateLikeRequest $request, Like $like)
    {
        $like->update($request->all());

        return redirect()->route('admin.likes.index');
    }

    public function show(Like $like)
    {
        abort_if(Gate::denies('like_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $like->load('image', 'sound', 'video', 'comment', 'user');

        return view('admin.likes.show', compact('like'));
    }

    public function destroy(Like $like)
    {
        abort_if(Gate::denies('like_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $like->delete();

        return back();
    }

    public function massDestroy(MassDestroyLikeRequest $request)
    {
        Like::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
