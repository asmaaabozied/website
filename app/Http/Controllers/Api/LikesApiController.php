<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gate;
use App\Image;
use App\Video;
use App\Sound;
use App\Like;
use App\Comment;
use Illuminate\Http\Request;
use Auth;

class LikesApiController extends Controller
{

    public function add_like( Request $request ){

        $this->validate($request,[
            'type' => 'required',
            'type_id' => 'required',
            'like_type' => 'required',
        ]);

        if($request->type == 'image') {
            $like = Like::where ( 'image_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                -> where ( 'like_type'  , '=' , $request->like_type )
                ->first();
        }elseif ($request->type == 'video'){
            $like = Like::where ( 'video_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                -> where ( 'like_type'  , '=' , $request->like_type )
                ->first();
        }elseif ($request->type == 'sound'){
            $like = Like::where ( 'sound_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                -> where ( 'like_type'  , '=' , $request->like_type )
                ->first();
        }

        if ( $like )
        {
            $like->delete();
            $result = 'like deleted ...';
            $status = 1;

        }else{
            $new_like = new Like;

            if($request->type == 'image') {
                $new_like->image_id =  $request->type_id;
            }elseif($request->type == 'video'){
                $new_like->video_id =  $request->type_id;
            }elseif($request->type == 'sound'){
                $new_like->sound_id =  $request->type_id;
            }

            $new_like->user_id =  Auth::user()->id ;
            $new_like->like_type =  $request->like_type ;

            $new_like->save();

            $result = 'Addition Successed ...';
            $status = 1;

            if($request->type == 'image') {
                $likes_count = Like::where ( 'image_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 1 )
                    ->get()->count();
                $dislikes_count = Like::where ( 'image_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 2 )
                    ->get()->count();
                Image::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'likes'  => $likes_count ,
                        'dlike'  => $dislikes_count
                    )
                );
            }elseif($request->type == 'video'){
                $likes_count = Like::where ( 'video_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 1 )
                    ->get()->count();
                $dislikes_count = Like::where ( 'video_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 2 )
                    ->get()->count();
                Video::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'likes'  => $likes_count ,
                        'dlike'  => $dislikes_count
                    )
                );
            }elseif($request->type == 'sound'){
                $likes_count = Like::where ( 'sound_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 1 )
                    ->get()->count();
                $dislikes_count = Like::where ( 'sound_id' , '=' , $request->type_id )
                    -> where ( 'like_type'  , '=' , 2 )
                    ->get()->count();
                Sound::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'likes'  => $likes_count ,
                        'dlike'  => $dislikes_count
                    )
                );
            }



        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function add_sound_like( $sound_id , $user_id , $like_type ){


        $result = 'Already exists';
        $status = 0;

        $like_res = Like::where ( 'sound_id' , '=' , $sound_id )
            -> where ( 'user_id'  , '=' , $user_id )
            -> where ( 'like_type'  , '=' , $like_type )
            ->get();


        if ( count ( $like_res ) == 0  )
        {

            $like_type2 = 0;
            if ( $like_type == 1)
            {
                $like_type2 = 2;
            }

            if ( $like_type == 2)
            {
                $like_type2 = 1;
            }

            $delete_like_ops = Like::where ( 'sound_id' , '=' , $sound_id )
                -> where ( 'user_id'  , '=' , $user_id )
                -> where ( 'like_type'  , '=' , $like_type2 )
                ->delete();

            $new_like = new Like;

            $new_like->sound_id =  $sound_id ;
            $new_like->user_id =  $user_id ;
            $new_like->like_type =  $like_type ;

            $new_like->save();


            $result = 'Addition Successed ...';
            $status = 1;

            $likes_count = Like::where ( 'sound_id' , '=' , $sound_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'sound_id' , '=' , $sound_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Sound::where( 'id' , '=' , $sound_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );



        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function add_video_like( $video_id , $user_id , $like_type ){


        $result = 'Already exists';
        $status = 0;

        $like_res = Like::where ( 'video_id' , '=' , $video_id )
            -> where ( 'user_id'  , '=' , $user_id )
            -> where ( 'like_type'  , '=' , $like_type )
            ->get();


        if ( count ( $like_res ) == 0  )
        {

            $like_type2 = 0;
            if ( $like_type == 1)
            {
                $like_type2 = 2;
            }

            if ( $like_type == 2)
            {
                $like_type2 = 1;
            }

            $delete_like_ops = Like::where ( 'video_id' , '=' , $video_id )
                -> where ( 'user_id'  , '=' , $user_id )
                -> where ( 'like_type'  , '=' , $like_type2 )
                ->delete();

            $new_like = new Like;

            $new_like->video_id =  $video_id ;
            $new_like->user_id =  $user_id ;
            $new_like->like_type =  $like_type ;

            $new_like->save();

            $result = 'Addition Successed ...';
            $status = 1;


            $likes_count = Like::where ( 'video_id' , '=' , $video_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'video_id' , '=' , $video_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Video::where( 'id' , '=' , $video_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );

        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);

    }

    public function add_comment_like( $comment_id , $user_id , $like_type ){


        $result = 'Already exists';
        $status = 0;

        $like_res = Like::where ( 'comment_id' , '=' , $comment_id )
            -> where ( 'user_id'  , '=' , $user_id )
            -> where ( 'like_type'  , '=' , $like_type )
            ->get();


        if ( count ( $like_res ) == 0  )
        {
            $like_type2 = 0;
            if ( $like_type == 1)
            {
                $like_type2 = 2;
            }

            if ( $like_type == 2)
            {
                $like_type2 = 1;
            }

            $delete_like_ops = Like::where ( 'comment_id' , '=' , $comment_id )
                -> where ( 'user_id'  , '=' , $user_id )
                -> where ( 'like_type'  , '=' , $like_type2 )
                ->delete();


            $new_like = new Like;

            $new_like->comment_id =  $comment_id ;
            $new_like->user_id =  $user_id ;
            $new_like->like_type =  $like_type ;

            $new_like->save();

            $result = 'Addition Successed ...';
            $status = 1;

            $likes_count = Like::where ( 'comment_id' , '=' , $comment_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'comment_id' , '=' , $comment_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Comment::where( 'id' , '=' , $comment_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);


    }

    public function delete_like( $like_id , $object_type , $like_type ){

        $object_id = 0;

        $like_details = Like::where ('id' , '=' ,  $like_id )->
        where ('like_type' , '=' ,  $like_type )->get();
        if ( count ( $like_details ) == 0  )
        {
            foreach ( $like_details as $like )
            {
                if ($object_type==1)
                {
                    $object_id = $like->video_id;
                }
                if ($object_type==2)
                {
                    $object_id = $like->sound_id;
                }
                if ($object_type==3)
                {
                    $object_id = $like->image_id;
                }
                if ($object_type==4)
                {
                    $object_id = $like->comment_id;
                }
            }
        }



        $result = 'Deletion Successed ...';
        $status = 1;
        Like::where ( 'id' , '=' , $like_id )->where ('like_type' , '=' ,  $like_type )->delete();


        if ( $object_type == 1)
        {
            $likes_count = Like::where ( 'video_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Video::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 2)
        {
            $likes_count = Like::where ( 'sound_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'sound_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Sound::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 3)
        {
            $likes_count = Like::where ( 'image_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'image_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Image::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 4)
        {
            $likes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Comment::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function delete_like_object( $user_id , $object_type , $object_id , $like_type){


        $result = 'Deletion Successed ...';
        $status = 1;



        if ( $object_type == 1)
        {
            Like::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'video_id' , '=' , $object_id )->
            where ( 'like_type' , '=' , $like_type )->delete();

            $likes_count = Like::where ( 'video_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Video::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 2)
        {
            Like::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'sound_id' , '=' , $object_id )->
            where ( 'like_type' , '=' , $like_type )->delete();

            $likes_count = Like::where ( 'sound_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'sound_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Sound::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 3)
        {
            Like::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'image_id' , '=' , $object_id )->
            where ( 'like_type' , '=' , $like_type )->delete();

            $likes_count = Like::where ( 'image_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'image_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Image::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }

        if ( $object_type == 4)
        {
            Like::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'comment_id' , '=' , $object_id )->
            where ( 'like_type' , '=' , $like_type )->delete();

            $likes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 1 )
                ->get()->count();


            $dislikes_count = Like::where ( 'comment_id' , '=' , $object_id )
                -> where ( 'like_type'  , '=' , 2 )
                ->get()->count();

            Comment::where( 'id' , '=' , $object_id )->update(
                array(
                    'likes'  => $likes_count ,
                    'dlike'  => $dislikes_count
                )
            );
        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

}
