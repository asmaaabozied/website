<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gate;
use App\Image;
use App\Video;
use App\Sound;
use App\Favorite;
use Illuminate\Http\Request;
use Auth;

class FavoritesApiController extends Controller
{
    public function add_favorite( Request $request ){

        $this->validate($request,[
            'type' => 'required',
            'type_id' => 'required',
        ]);




        if($request->type == 'image') {
            $fav_res = Favorite::where ( 'image_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                ->first();
        }elseif($request->type == 'video'){
            $fav_res = Favorite::where ( 'video_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                ->first();
        }elseif($request->type == 'sound'){
            $fav_res = Favorite::where ( 'sound_id' , '=' , $request->type_id )
                -> where ( 'user_id'  , '=' , Auth::user()->id )
                ->first();
        }


        if ( !$fav_res  )
        {
            $new_favourite = new Favorite;
            if($request->type == 'image') {
                $new_favourite->image_id =  $request->type_id ;
            }elseif($request->type == 'video'){
                $new_favourite->video_id =  $request->type_id;
            }elseif($request->type == 'sound'){
                $new_favourite->sound_id =  $request->type_id;
            }

            $new_favourite->user_id =  Auth::user()->id ;
            $new_favourite->save();

            $result = 'Addition Successed ...';
            $status = 1;

            if($request->type == 'image'){
                $favorites_count = Favorite::where('image_id' , '=' , $request->type_id)
                    ->get()->count();

                Image::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'favorites'  => $favorites_count
                    )
                );
            }elseif($request->type == 'video'){
                $favorites_count = Favorite::where ('video_id' , '=' , $request->type_id)
                    ->get()->count();

                Video::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'favorites'  => $favorites_count
                    )
                );
            }elseif($request->type == 'sound'){
                $favorites_count = Favorite::where('sound_id' , '=' , $request->type_id)
                    ->get()->count();

                Sound::where( 'id' , '=' , $request->type_id )->update(
                    array(
                        'favorites'  => $favorites_count
                    )
                );
            }

        }else{

            $fav_res->delete();
            $result = 'deleted success';
            $status = 1;
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);

    }

    public function add_sound_favorite( $sound_id , $user_id   ){

        $result = 'Already exists';
        $status = 0;

        $fav_res = Favorite::where ( 'sound_id' , '=' , $sound_id )
            -> where ( 'user_id'  , '=' , $user_id )
            ->get();


        if ( count ( $fav_res ) == 0  )
        {
            $new_favourite = new Favorite;
            $new_favourite->sound_id =  $sound_id ;
            $new_favourite->user_id =  $user_id ;
            $new_favourite->save();

            $result = 'Addition Successed ...';
            $status = 1;

            $favorites_count = Favorite::where ( 'sound_id' , '=' , $sound_id )
                ->get()->count();

            Sound::where( 'id' , '=' , $sound_id )->update(
                array(
                    'favorites'  => $favorites_count
                )
            );
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);

    }

    public function add_video_favorite( $video_id , $user_id   ){

        $result = 'Already exists';
        $status = 0;

        $fav_res = Favorite::where ( 'video_id' , '=' , $video_id )
            -> where ( 'user_id'  , '=' , $user_id )
            ->get();


        if ( count ( $fav_res ) == 0  )
        {

            $new_favourite = new Favorite;
            $new_favourite->video_id =  $video_id ;
            $new_favourite->user_id =  $user_id ;
            $new_favourite->save();

            $result = 'Addition Successed ...';
            $status = 1;

            $favorites_count = Favorite::where ( 'video_id' , '=' , $video_id )
                ->get()->count();

            Video::where( 'id' , '=' , $video_id )->update(
                array(
                    'favorites'  => $favorites_count
                )
            );
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);

    }

    public function delete_favorite( $favorite_id , $object_type  ){

        $object_id = 0;

        $fav_details = Favorite::where ( 'id' , '=' ,  $favorite_id )->get();
        if ( count ( $fav_details ) == 0  )
        {
            foreach ( $fav_details as $fav )
            {

                if ($object_type==1)
                {
                    $object_id = $fav->video_id;
                }
                if ($object_type==2)
                {
                    $object_id = $fav->sound_id;
                }
                if ($object_type==3)
                {
                    $object_id = $fav->image_id;
                }

            }
        }




        $result = 'Deletion Successed ...';
        $status = 1;
        Favorite::where ( 'id' , '=' , $favorite_id ) ->delete();

        if ( $object_type == 1)
        {
            $fav_count = Favorite::where ( 'video_id' , '=' , $object_id )
                ->get()->count();

            Video::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        if ( $object_type == 2)
        {
            $fav_count = Favorite::where ( 'sound_id' , '=' , $object_id )
                ->get()->count();

            Sound::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        if ( $object_type == 3)
        {
            $fav_count = Favorite::where ( 'image_id' , '=' , $object_id )
                ->get()->count();

            Image::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function delete_favorite_object( $user_id , $object_type , $object_id ){


        $result = 'Deletion Successed ...';
        $status = 1;


        if ( $object_type == 1)
        {
            Favorite::where ( 'user_id' , '=' , $user_id )
                ->where ( 'video_id' , '=' , $object_id )
                ->delete();

            $fav_count = Favorite::where ( 'video_id' , '=' , $object_id )
                ->get()->count();

            Video::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        if ( $object_type == 2)
        {
            Favorite::where ( 'user_id' , '=' , $user_id )
                ->where ( 'sound_id' , '=' , $object_id )
                ->delete();

            $fav_count = Favorite::where ( 'sound_id' , '=' , $object_id )
                ->get()->count();

            Sound::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        if ( $object_type == 3)
        {
            Favorite::where ( 'user_id' , '=' , $user_id )
                ->where ( 'image_id' , '=' , $object_id )
                ->delete();

            $fav_count = Favorite::where ( 'image_id' , '=' , $object_id )
                ->get()->count();

            Image::where( 'id' , '=' , $object_id )->update(
                array(
                    'favorites'  => $fav_count
                )
            );
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }
}
