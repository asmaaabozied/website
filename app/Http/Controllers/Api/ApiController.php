<?php

namespace App\Http\Controllers\Api;

use App\Adminmenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminmenuRequest;
use App\Http\Requests\UpdateAdminmenuRequest;
use App\Http\Resources\Admin\AdminmenuResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Category;
use App\Image;
use App\Video;
use App\Sound;
use App\Setting;
use App\SubDomian;
use App\Like;
use App\Favorite;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Mail;
use App\PlayList;
use App\PlayListVideo;
use App\ContactUsMessage;


class ApiController extends Controller
{

    public function video_search(Request $request){
        $videos = Video::where('title' , 'like' ,'%'.$request->title.'%' )->get();
        return response()->json([
            'data' => $videos
        ]);
    }

    public function sound_search(Request $request){
        $videos = Sound::where('title' , 'like' ,'%'.$request->title.'%' )->get();
        return response()->json([
            'data' => $videos
        ]);
    }

    public function image_search(Request $request){
        $videos = Image::where('title' , 'like' ,'%'.$request->title.'%' )->get();
        return response()->json([
            'data' => $videos
        ]);
    }

    public function create_play_list(Request $request){
        $this->validate($request,
            [
                'title' => 'required',
            ]);

        $play_list = PlayList::create([
                'title' => $request->title,
                'user_id' => Auth::user()->id,
            ]
        );

        return response()->json([
            'data' => $play_list
        ]);

    }

    public function add_video_play_list(Request $request){
        $this->validate($request,
            [
                'paly_list_id' => 'required',
                'video_id' => 'required',
            ]);

        $PlayListVideo = PlayListVideo::create([
                'paly_list_id' => $request->paly_list_id,
                'video_id' => $request->video_id,
            ]
        );

        return response()->json([
            'data' => $PlayListVideo
        ]);

    }

    public function get_myCategory_media( $type , $category_id , $current_page , $user_id=-1 ,$per_page = 10 ){

        if ( $type == 1 )
        {
            $category_videos = Video::with('category')->orderBy('id','desc')->where('category_id',$category_id)->select('id','title' ,'category_id','icon_image')->paginate
            ( 10 ,  ['*'], '' , $current_page );



            return response()->json([   'category videos' => $category_videos
            ]);

        }

        if ( $type == 2 )
        {
            $category_sounds = Sound::with('category')->orderBy('id','desc')->where('category_id',$category_id)->select('id','title' ,'category_id','file_name')->paginate
            ( 10 ,  ['*'], '' , $current_page );

            return response()->json([
                'category sounds' => $category_sounds
            ]);

        }

        if ( $type == 3 )
        {
            $category_images = Image::with('category')->orderBy('id','desc')->where('category_id',$category_id)->select('id','title' ,'category_id','file_name')->paginate
            ( 10 ,  ['*'], '' , $current_page );


            return response()->json([
                'category images' => $category_images
            ]);

        }

    }

    public function get_settings(){
        $settings = Setting::orderBy('id', 'ASC')->get();
        return response()->json([
            'user settings' => $settings
        ]);
    }

    public function get_sub_domains(){

        $domains  = SubDomian::orderBy('id', 'ASC')->get();
        return response()->json([
            'domains' => $domains
        ]);
    }

    public function get_categories( $type ){

        $categories = Category::with('categories_parent')->where('parent_category',0)->where('category_type',$type)
            ->where('active',1)->get();

        if ( count ( $categories ) != 0 )
        {
            return response()->json([
                'categories' => $categories
            ]);
        }
        else
        {
            return response()->json([
                'categories' => 0
            ]);
        }

    }

    public function get_category_media( $type , $category_id , $current_page , $user_id=-1 ,$per_page = 10 ){

        if ( $type == 1 )
        {
            $category_videos = Video::orderBy('id','desc')->where('category_id',$category_id)->paginate
            ( $per_page ,  ['*'], '' , $current_page );


            foreach ( $category_videos as $video )
            {
                $video->user_like = 'no';
                $video->user_dislike = 'no';
                $video->user_favourite = 'no';
                if ( $user_id != -1 )
                {


                    $user_like_res = Like::where('video_id',$video->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $video->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('video_id',$video->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $video->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('video_id',$video->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $video->user_favourite = 'yes';
                    }


                }

            }

            return response()->json([   'category videos' => $category_videos
            ]);

        }

        if ( $type == 2 )
        {
            $category_sounds = Sound::orderBy('id','desc')->where('category_id',$category_id)->paginate
            ( 10 ,  ['*'], '' , $current_page );

            foreach ( $category_sounds as $sound )
            {
                $sound->user_like = 'no';
                $sound->user_dislike = 'no';
                $sound->user_favourite = 'no';
                if ( $user_id != -1 )
                {


                    $user_like_res = Like::where('sound_id',$sound->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $sound->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('sound_id',$sound->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $sound->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('sound_id',$sound->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $sound->user_favourite = 'yes';
                    }


                }

            }

            return response()->json([
                'category sounds' => $category_sounds
            ]);


        }

        if ( $type == 3 )
        {
            $category_images = Image::orderBy('id','desc')->where('category_id',$category_id)->paginate
            ( 10 ,  ['*'], '' , $current_page );

            foreach ( $category_images as $image )
            {
                $image->user_like = 'no';
                $image->user_dislike = 'no';
                $image->user_favourite = 'no';
                if ( $user_id != -1 )
                {


                    $user_like_res = Like::where('image_id',$image->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $image->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('image_id',$image->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $image->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('image_id',$image->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $image->user_favourite = 'yes';
                    }


                }

            }

            return response()->json([
                'category images' => $category_images
            ]);

        }

    }

    public function delete_play_list_video( $paly_list_vidoe_id  ){

        $result = 'Deletion Successed ...';
        PlayListVideo::where ( 'id' , '=' , $paly_list_vidoe_id ) ->delete();

        return response()->json([
            'result' => $result
        ]);
    }

    public function change_play_list_name( $old_title , $new_title , $user_id  ){

        $result = 'New Play List Name Already exists';
        $status = 0;

        $play_list_res = PlayList::where ( 'title' , '=' , $new_title )
            -> where ( 'user_id'  , '=' , $user_id )
            ->get();


        if ( count ( $play_list_res ) == 0  )
        {

            $play_list_res2 = PlayList::where ( 'title' , '=' , $old_title )
                -> where ( 'user_id'  , '=' , $user_id )
                ->get();
            if ( count ( $play_list_res2 ) > 0  )
            {
                PlayList::where ( 'title' , '=' , $old_title )
                    -> where ( 'user_id'  , '=' , $user_id )
                    ->update(
                        array(
                            'title'  => $new_title
                        )
                    );
                $result = 'Update Successed ...';
                $status = 1;

            }
            else
            {
                $result = 'Original Play List does not exist...';
                $status = 0;
            }

        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function add_contact_us_message_get( $name , $message ){

        $result = 'Addition Successed ...';
        $new_contact_message = new ContactUsMessage;

        $new_contact_message->from_u =  $name ;
        $new_contact_message->content =  $message ;
        $new_contact_message->readed =  0 ;

        $new_contact_message->save();


        return response()->json([
            'result' => $result
        ]);
    }

    public function add_contact_us_message( Request $request ){

        $result = 'Addition Successed ...';
        $new_contact_message = new ContactUsMessage;
        $input = $request->all();

        $new_contact_message->from_u  =  $input['name'] ;
        $new_contact_message->content  =  $input['message']  ;
        $new_contact_message->readed =  0 ;

        $new_contact_message->save();


        return response()->json([
            'result' => $result
        ]);
    }

    public function search_media( $search_key , $user_id , $media_type , $currentPage  ){

        if ( !  isset ($currentPage) )
        {
            $currentPage = 1;
        }

        if ( $media_type == 1 )
        {

            $videos = Video::orderBy('id','desc')->where ('active', '1')->where(function($q) use ($search_key) {
                $q->where('title', 'like', '%' . $search_key . '%')
                    ->orWhere('descp', 'like', '%' . $search_key . '%');
            })->paginate
            ( 10 ,  ['*'], '' , $currentPage );

            foreach ( $videos as $video )
            {
                $video->user_like = 'no';
                $video->user_dislike = 'no';
                $video->user_favourite = 'no';

                if ( $user_id != -1 )
                {

                    $user_like_res = Like::where('video_id',$video->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $video->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('video_id',$video->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $video->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('video_id',$video->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $video->user_favourite = 'yes';
                    }


                }

            }


            return response()->json([
                'videos' => $videos
            ]);
        }

        if ( $media_type == 2 )
        {


            $sounds = Sound::where ('active', '1')->where(function($q) use ($search_key) {
                $q->where('title', 'like', '%' . $search_key . '%')
                    ->orWhere('descp', 'like', '%' . $search_key . '%');
            })->paginate
            ( 10 ,  ['*'], '' , $currentPage );

            foreach ( $sounds as $sound )
            {
                $sound->user_like = 'no';
                $sound->user_dislike = 'no';
                $sound->user_favourite = 'no';

                if ( $user_id != -1 )
                {

                    $user_like_res = Like::where('sound_id',$sound->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $sound->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('sound_id',$sound->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $sound->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('sound_id',$sound->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $sound->user_favourite = 'yes';
                    }


                }

            }


            return response()->json([
                'sounds' => $sounds
            ]);
        }


        if ( $media_type == 3 )
        {


            $images = Image::where ('active', '1')->where(function($q) use ($search_key) {
                $q->where('title', 'like', '%' . $search_key . '%')
                    ->orWhere('descp', 'like', '%' . $search_key . '%');
            })->paginate
            ( 10 ,  ['*'], '' , $currentPage );

            foreach ( $images as $image )
            {
                $image->user_like = 'no';
                $image->user_dislike = 'no';
                $image->user_favourite = 'no';

                if ( $user_id != -1 )
                {

                    $user_like_res = Like::where('image_id',$image->id )->where('user_id',$user_id )->where('like_type','1')->get();
                    if ( count ( $user_like_res ) != 0  ){
                        $image->user_like = 'yes';
                    }

                    $user_dis_like_res = Like::where('image_id',$image->id )->where('user_id',$user_id )->where('like_type','2')->get();
                    if ( count ( $user_dis_like_res ) != 0  ){
                        $image->user_dislike = 'yes';
                    }

                    $user_favourite_res = Favorite::where('image_id',$image->id )->where('user_id',$user_id )->get();
                    if ( count ( $user_favourite_res ) != 0  ){
                        $image->user_favourite = 'yes';
                    }


                }

            }


            return response()->json([
                'images' => $images
            ]);
        }

    }


}
