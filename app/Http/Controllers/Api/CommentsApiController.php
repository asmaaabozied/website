<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gate;
use App\Image;
use App\Video;
use App\Sound;
use App\Comment;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CommentsApiController extends Controller
{
    public function image_comments( $image_id ,  $currentPage ){

        $image_comments = Comment::with('replies')->where('parent_comment_id',0)->where('image_id',$image_id)
            ->where('active',1)->paginate ( 10 ,  ['*'], '' , $currentPage );

        foreach ( $image_comments as $img_cmnt )
        {
            $img_cmnt->user_image = "";
            $user_image_qr =User::where ("id" , "=" , $img_cmnt->user_id  )->get();
            if ( count ($user_image_qr) != 0  )
            {
                $img_cmnt->user_image = $user_image_qr[0]->avatar;
            }



            foreach ( $img_cmnt->replies as $cmnt_rep )
            {
                $cmnt_rep->user_image = "";
                $user_image_qr2 =User::where ("id" , "=" , $cmnt_rep->user_id  )->get();
                if ( count ($user_image_qr2) != 0  )
                {
                    $cmnt_rep->user_image = $user_image_qr2[0]->avatar;
                }
            }

        }

        return response()->json([
            'image comments' => $image_comments
        ]);


    }

    public function sound_comments( $sound_id ,  $currentPage ){

        $sound_comments = Comment::with('replies')->where('parent_comment_id',0)->where('sound_id',$sound_id)
            ->where('active',1)->paginate ( 10 ,  ['*'], '' , $currentPage );


        foreach ( $sound_comments as $snd_cmnt )
        {
            $snd_cmnt->user_image = "";
            $user_image_qr =User::where ("id" , "=" , $snd_cmnt->user_id  )->get();
            if ( count ($user_image_qr) != 0  )
            {
                $snd_cmnt->user_image = $user_image_qr[0]->avatar;
            }



            foreach ( $snd_cmnt->replies as $cmnt_rep )
            {
                $cmnt_rep->user_image = "";
                $user_image_qr2 =User::where ("id" , "=" , $cmnt_rep->user_id  )->get();
                if ( count ($user_image_qr2) != 0  )
                {
                    $cmnt_rep->user_image = $user_image_qr2[0]->avatar;
                }
            }

        }

        return response()->json([
            'sound comments' => $sound_comments
        ]);


    }

    public function video_comments( $video_id ,  $currentPage){

        $video_comments = Comment::with('replies')->where('parent_comment_id',0)->where('video_id',$video_id)
            ->where('active',1)->paginate ( 10 ,  ['*'], '' , $currentPage );

        foreach ( $video_comments as $vd_cmnt )
        {
            $vd_cmnt->user_image = "";
            $user_image_qr =User::where ("id" , "=" , $vd_cmnt->user_id  )->get();
            if ( count ($user_image_qr) != 0  )
            {
                $vd_cmnt->user_image = $user_image_qr[0]->avatar;
            }



            foreach ( $vd_cmnt->replies as $cmnt_rep )
            {
                $cmnt_rep->user_image = "";
                $user_image_qr2 =User::where ("id" , "=" , $cmnt_rep->user_id  )->get();
                if ( count ($user_image_qr2) != 0  )
                {
                    $cmnt_rep->user_image = $user_image_qr2[0]->avatar;
                }
            }

        }

        return response()->json([
            'video comments' => $video_comments
        ]);


    }


    public function delete_comment_object( $user_id  , $object_type , $object_id ){


        $result = 'Deletion Successed ...';
        $status = 1;


        if ( $object_type == 1)
        {
            $comnt_id_qr = Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'video_id' , '=' , $object_id ) ->get();

            if ( count ($comnt_id_qr) != 0 )
            {
                $comnt_id = $comnt_id_qr[0]->id;
                Comment::where ( 'parent_comment_id' , '=' , $comnt_id ) ->delete();
            }

            Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'video_id' , '=' , $object_id ) ->delete();

            $comm_count = Comment::where ( 'video_id' , '=' , $object_id )
                ->get()->count();

            Video::where( 'id' , '=' , $object_id )->update(
                array(
                    'comments'  => $comm_count
                )
            );
        }

        if ( $object_type == 2)
        {
            $comnt_id_qr = Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'sound_id' , '=' , $object_id ) ->get();

            if ( count ($comnt_id_qr) != 0 )
            {
                $comnt_id = $comnt_id_qr[0]->id;
                Comment::where ( 'parent_comment_id' , '=' , $comnt_id ) ->delete();
            }

            Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'sound_id' , '=' , $object_id ) ->delete();

            $comm_count = Comment::where ( 'sound_id' , '=' , $object_id )
                ->get()->count();

            Sound::where( 'id' , '=' , $object_id )->update(
                array(
                    'comments'  => $comm_count
                )
            );
        }

        if ( $object_type == 3)
        {
            $comnt_id_qr = Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'image_id' , '=' , $object_id ) ->get();
            if ( count ($comnt_id_qr) != 0 )
            {
                $comnt_id = $comnt_id_qr[0]->id;
                Comment::where ( 'parent_comment_id' , '=' , $comnt_id ) ->delete();
            }


            Comment::where ( 'user_id' , '=' , $user_id ) ->
            where ( 'image_id' , '=' , $object_id ) ->delete();

            $comm_count = Comment::where ( 'image_id' , '=' , $object_id )
                ->get()->count();

            Image::where( 'id' , '=' , $object_id )->update(
                array(
                    'comments'  => $comm_count
                )
            );
        }


        return response()->json([
            'result' => $result,
            'status' => $status

        ]);
    }

    public function add_comment( Request $request ){

        $this->validate($request,[
            'type' => 'required',
            'type_id' => 'required',
            'comment' => 'required',
        ]);

        $result = 'not Exists ...';
        $status = 0;

        if($request->type == 'image') {
            $type = Image::find($request->type_id);
        }elseif ($request->type == 'video'){
            $type = Video::find($request->type_id);
        }elseif ($request->type == 'sound'){
            $type = Sound::find($request->type_id);
        }


        if ( $type ){
            $new_comment = new Comment;

            if($request->type == 'image') {
                $new_comment->image_id =  $request->type_id;
            }elseif($request->type == 'video'){
                $new_comment->video_id =  $request->type_id;
            }elseif($request->type == 'sound'){
                $new_comment->sound_id =  $request->type_id;
            }

            $new_comment->user_id =  Auth::user()->id ;
            $new_comment->comment =  $request->comment ;
            $new_comment->active =  0 ;
            $new_comment->parent_comment_id =  0 ;
            $new_comment->likes =  0 ;
            $new_comment->dlike =  0 ;

            $new_comment->save();



            if($request->type == 'image') {
                $comments_count = Comment::where ( 'image_id' , '=' , $request->type_id )
                    ->get()->count();
                Image::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'comments'  => $comments_count
                    )
                );
            }elseif ($request->type == 'video'){
                $comments_count = Comment::where ( 'video_id' , '=' , $request->type_id )
                    ->get()->count();
                Video::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'comments'  => $comments_count
                    )
                );
            }elseif ($request->type == 'sound'){
                $comments_count = Comment::where ( 'sound_id' , '=' , $request->type_id )
                    ->get()->count();
                Sound::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'comments'  => $comments_count
                    )
                );
            }

            $result = 'Addition Successed ...';
            $status = 1;
        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }


    public function add_comment_reply( Request $request ){

        $this->validate($request,[
            'comment_id' => 'required',
            'comment' => 'required',
        ]);

        $result = 'Comment not Exists ...';
        $status = 0;

        $comment_rs = Comment::find($request->comment_id);

        if ( $comment_rs ){

            $new_comment = new Comment;

            $new_comment->parent_comment_id =  $request->comment_id ;
            $new_comment->user_id =  Auth::user()->id ;
            $new_comment->comment =  $request->comment ;
            $new_comment->active =  0 ;
            $new_comment->likes =  0 ;
            $new_comment->dlike =  0 ;

            $new_comment->save();

            $result = 'Addition Successed ...';
            $status = 1;

        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function delete_comment( Request $request  ){

        $result = 'Deletion Successed ...';
        $status = 1;

        $comment = Comment::findOrFail($request->comment_id);

        if($comment->user_id == Auth::user()->id){
            $comment->delete();
            Comment::where('parent_comment_id' , $request->comment_id)
            ->delete();

        }else{
            $result = 'Deletion Failed ...';
            $status = 0;
        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

}
