<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use App\Image;
use App\Video;
use App\Sound;
use App\Setting;
use App\Like;
use App\Favorite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\PlayList;
use App\PlayListVideo;
use Carbon\Carbon;

class UsersApiController extends Controller
{
    public function test_user_login(Request $request){

        $user_data = new User;
        $status = 0;
        $input = $request->all();

        $username = $input["username"];
        $password = $input["password"];
        $encrypted_password = md5($password);
        $device_token2 = $input["device_token"];
        $device_type2 = $input["device_type"];
        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];


        if ( Auth::attempt($credentials)  )
        {
            $status = 1;
            User::where ( 'username' , '=' , $username )->update(array('device_token'  => $device_token2
            , 'device_type'  => $device_type2) );
            $user_data = User::where ( 'username' , '=' , $username )->first();

            $user        = $request->user();
            $tokenResult = $user->createToken('Login Token');
            $token       = $tokenResult->token;

            if ($request->remember_me)
            {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }

            $token->save();

            return response()->json([
                'user data' => $user_data,
                'status' => $status,
                'accessToken' => $tokenResult->accessToken ,

            ]);

        }

        else
        {
            return response()->json([
                'result' => 'Wrong username or password',
                'status' => $status,

            ]);
        }
    }

    public function test_user_login_get( $username , $password , $device_type , $device_token ){

        $user_data = new User;
        $status = 0;

        $encrypted_password = md5($password);

        $users_res = User::where ( 'username' , '=' , $username )->first();


        if ( Auth::attempt(['username' => $username, 'password' => $password]) )
        {
            $status = 1;

            $user_data = $users_res;
            $user_data ->password = $password;
            User::where ( 'username' , '=' , $username )->update(
                array(
                    'device_token'  => $device_token ,
                    'device_type'  => $device_type
                )
            );

            return response()->json([
                'user data' => $user_data,
                'status' => $status
            ]);

        }

        else
        {
            return response()->json([
                'result' => 'Wrong username or password',
                'status' => $status
            ]);
        }

    }

    public function do_logout( $user_id ){
        $status = 0;
        $users_res = User::find($user_id);

        if ($users_res)
        {
            $status = 1;
            User::where ( 'id' , '=' , $user_id )->update(
                array(
                    'device_token'  => ''
                )
            );
            return response()->json([
                'message' => 'User logged out',
                'status' => $status
            ]);

        }
        else
        {
            return response()->json([
                'result' => 'User does not exist',
                'status' => $status
            ]);
        }

    }

    public function add_new_user(Request $request){

        $result = 'Addition Successed ...';
        $status = 0;
        $input = $request->all();

        $user = new User;

        $username_exist = User::where ( 'username' , '=' , $input['username'] )->get();

        if ( count ( $username_exist ) != 0  )
        {
            $result = 'Username Already exists';

            return response()->json([
                'result' => $result,
                'status' => $status
            ]);

        }

        $email_exist = User::where ( 'email' , '=' , $input['email'] )->get();

        if ( count ( $email_exist ) != 0  )
        {
            $result = 'Email Already exists';

            return response()->json([
                'result' => $result,
                'status' => $status
            ]);

        }


        $user->username = $input['username'];
        $user->name = $input['name'];
        $user->password = md5 ( $input['password'] );
        $user->email = $input['email'] ;
        $user->birth_year = $input['birth_year'];
        $user->gender = $input['gender'];
        $user->device_token = $input['device_token'];
        $user->device_type = $input['device_type'];

        $user->active='1';

        $user->save();
        $new_user_id = $user->id;
        $status = 1;

        return response()->json([
            'result' => $result,
            'new user id' => $new_user_id ,
            'new user info' => $user,
            'status' => $status

        ]);


    }

    public function add_new_user_get(  $username , $password , $email ,
                                       $birth_year , $gender ,  $device_type ,  $device_token )
    {

        $result = 'Addition Successed ...';
        $status = 0;
        $user = new User;

        $username_exist = User::where ( 'username' , '=' , $username )->get();

        if ( count ( $username_exist ) != 0  )
        {
            $result = 'Username Already exists';

            return response()->json([
                'result' => $result,
                'status' => $status
            ]);

        }

        $email_exist = User::where ( 'email' , '=' , $email )->get();

        if ( count ( $email_exist ) != 0  )
        {
            $result = 'Email Already exists';

            return response()->json([
                'result' => $result,
                'status' => $status
            ]);

        }


        $user->username =  $username ;
        $user->name =  $username ;
        $user->password = bcrypt ( $password );
        $user->email =  $email ;
        $user->birth_year = $birth_year ;
        $user->gender =  $gender ;
        $user->device_token = $device_token;

        $user->device_type = $device_type;

        $user->active='1';

        $user->save();
        $new_user_id = $user->id;
        $user->dpassword = $password;
        $status = 1;

        return response()->json([
            'result' => $result,
            'new user id' => $new_user_id,
            'new user info' => $user,
            'status' => $status

        ]);


    }

    public function update_user_info( Request $request){
        $input = $request->all();

        $result = 'Username not Found';
        $status = 0;

        $username_exist = User::where ( 'username' , '=' , $input['username'] )
            ->get();

        if ( count ( $username_exist ) != 0  )
        {
            if ( $input['new_password'] == '-1' )
            {
                User::where ( 'username' , '=' , $input['username'] )->update(
                    array(
                        'username'  => $input['username'] ,
                        'email'  => $input['email'] ,
                        'birth_year'  => $input['birth_year'],
                        'gender'  => $input['gender'] ,
                        'device_token'  => $input['device_token'] ,
                        'device_type'  =>  $input['device_type']
                    ) 		);
            }
            else
            {
                User::where ( 'username' , '=' , $input['username'] )->update(
                    array(
                        'username'  => $input['username'] ,
                        'password'  => md5 ( $input['new_password'] ) ,
                        'email'  => $input['email'] ,
                        'birth_year'  => $input['birth_year'],
                        'gender'  => $input['gender'] ,
                        'device_token'  => $input['device_token'] ,
                        'device_type'  =>  $input['device_type']
                    ) 		);
            }


            $result = 'Update Successed ...';
            $status = 1;
        }
        else
        {
            $result = 'Wrong Username or password ...';
            $status = 0;
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }
    public function update_user_pic( Request $request){


        $result = 'Username not Found';
        $status = 0;
        $input = $request->all();

        $username_exist = User::where ( 'username' , '=' , $input['username'] )->get();

        if ( count ( $username_exist ) != 0  )
        {
            $result = 'User picture updated Successfully';
            $status = 1;

            if ($request->file('user_image')!=null)
                if ($request->file('user_image')->isValid())
                {
                    $path = $request->user_image->path();
                    $userImage = $request->file('user_image');
                    $destinationPath = 'uploads/users/avatars';
                    $file_extension=$userImage->getClientOriginalExtension();
                    $newFileName='user_'.$input['username'].'.'.$file_extension;
                    $userImage->move($destinationPath,$newFileName);

                    User::where ( 'username' , '=' , $input['username']  )->update(
                        array(
                            'avatar'  => $newFileName
                        ) 		);

                }

        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function send_user_password ( $email  ){

        $users_res = User::where ( 'email' , '=' , $email )->get();


        $status = 0;

        $adminEmail_setting = Setting::where ('keyEn' , 'adminEmail') -> first();

        $admin_email = $adminEmail_setting -> value;


        $random_password = '';
        if ( count ( $users_res ) != 0  )
        {

            $random_password =  rand(1, 99999);
            $crp_pass = md5 ( $random_password ) ;

            User::where(  'email' , '=' , $email )->update(
                array( 'password'    =>  $crp_pass  )
            );


            $emails = array ( "user_email" => $email , "admin_email" => $admin_email );

            Mail::raw( $random_password ,  function($message)  use (  $emails )
            {
                $message->from( $emails['admin_email'] , 'demo.niceq8i.tv Info mail');

                $message->to( $emails['user_email']  );
                $message->subject(   'demo.niceq8i.tv Account password'  );
            });

            $status = 1;
            return response()->json([
                'message' => 'Password sent',
                'status' => $status
            ]);
        }

        else
        {
            return response()->json([
                'message' => 'Email Not Found',
                'status' => $status
            ]);
        }


    }

    public function get_play_lists( $user_id  ){

        $play_lists = PlayList::where ('user_id',  $user_id )->get();
        $status = 0;

        if ( count ( $play_lists ) == 0  ){
            return response()->json([
                'play lists' => 0,
                'status' => $status
            ]);
        }
        else
        {
            $status = 1;
            return response()->json([
                'play lists' => $play_lists,
                'status' => $status
            ]);
        }

    }

    public function get_play_list_videos( $paly_list_id , $user_id ){

        $status = 0;
        $play_list_videos = PlayListVideo::where ('paly_list_id',  $paly_list_id )->get();

        if ( count ( $play_list_videos ) == 0  ){
            return response()->json([
                'play list videos' => 0,
                'status' => $status
            ]);
        }
        else
        {
            foreach ( $play_list_videos as $plist_video )
            {
                if ( $plist_video->video_id != null )
                {
                    $plist_video->video_details = new Video;
                    $video = new Video;
                    $video_id = $plist_video->video_id;

                    $video_rs = Video::where ('id',  $video_id )->get();
                    foreach ($video_rs as $video)
                    {
                        $video->user_like = 'no';
                        $video->user_dislike = 'no';
                        $video->user_favourite = 'no';

                        if ( $user_id != -1 )
                        {
                            $user_like_res = Like::where('video_id',$video_id )->where('user_id',$user_id )->where('like_type','1')->get();
                            if ( count ( $user_like_res ) != 0  ){
                                $video->user_like = 'yes';
                            }

                            $user_dis_like_res = Like::where('video_id',$video_id )->where('user_id',$user_id )->where('like_type','2')->get();
                            if ( count ( $user_dis_like_res ) != 0  ){
                                $video->user_dislike = 'yes';
                            }

                            $user_favourite_res = Favorite::where('video_id',$video_id )->where('user_id',$user_id )->get();
                            if ( count ( $user_favourite_res ) != 0  ){
                                $video->user_favourite = 'yes';
                            }

                        }

                    }
                    $plist_video->video_details = $video;
                }
            }
            $status = 1;
            return response()->json([
                'play list videos' => $play_list_videos,
                'status' => $status
            ]);
        }

    }

    public function get_favourites(   $user_id  ){

        $user_favourites = Favorite::where ('user_id',  $user_id )->get();
        $status = 0;

        if ( count ( $user_favourites ) == 0  ){

            return response()->json([
                'user favourites' => 0,
                'status' => $status
            ]);
        }
        else
        {
            foreach ( $user_favourites as $user_fav )
            {

                if ( $user_fav->video_id != null )
                {
                    $user_fav->video_details = new Video;
                    $video = new Video;
                    $video_id = $user_fav->video_id;
                    $video_rs = Video::where ('id',  $video_id )->get();
                    foreach ($video_rs as $video)
                    {
                        $video->user_like = 'no';
                        $video->user_dislike = 'no';
                        $video->user_favourite = 'no';

                        if ( $user_id != -1 )
                        {
                            $user_like_res = Like::where('video_id',$video_id )->where('user_id',$user_id )->where('like_type','1')->get();
                            if ( count ( $user_like_res ) != 0  ){
                                $video->user_like = 'yes';
                            }

                            $user_dis_like_res = Like::where('video_id',$video_id )->where('user_id',$user_id )->where('like_type','2')->get();
                            if ( count ( $user_dis_like_res ) != 0  ){
                                $video->user_dislike = 'yes';
                            }

                            $user_favourite_res = Favorite::where('video_id',$video_id )->where('user_id',$user_id )->get();
                            if ( count ( $user_favourite_res ) != 0  ){
                                $video->user_favourite = 'yes';
                            }

                        }

                    }
                    $user_fav->video_details = $video;
                }

                if ( $user_fav->sound_id != null )
                {
                    $user_fav->sound_details = new Sound;
                    $sound = new Sound;
                    $sound_id = $user_fav->sound_id;
                    $sound_rs = Sound::where ('id',  $sound_id )->get();
                    foreach ($sound_rs as $sound)
                    {
                        $sound->user_like = 'no';
                        $sound->user_dislike = 'no';
                        $sound->user_favourite = 'no';

                        if ( $user_id != -1 )
                        {
                            $user_like_res = Like::where('sound_id',$sound_id )->where('user_id',$user_id )->where('like_type','1')->get();
                            if ( count ( $user_like_res ) != 0  ){
                                $sound->user_like = 'yes';
                            }

                            $user_dis_like_res = Like::where('sound_id',$sound_id )->where('user_id',$user_id )->where('like_type','2')->get();
                            if ( count ( $user_dis_like_res ) != 0  ){
                                $sound->user_dislike = 'yes';
                            }

                            $user_favourite_res = Favorite::where('sound_id',$sound_id )->where('user_id',$user_id )->get();
                            if ( count ( $user_favourite_res ) != 0  ){
                                $sound->user_favourite = 'yes';
                            }

                        }

                    }
                    $user_fav->sound_details = $sound;
                }

                if ( $user_fav->image_id != null )
                {

                    $user_fav->image_details = new Image;
                    $image = new Image;
                    $image_id = $user_fav->image_id;
                    $image_rs = Image::where ('id',  $image_id )->get();
                    foreach ($image_rs as $image)
                    {
                        $image->user_like = 'no';
                        $image->user_dislike = 'no';
                        $image->user_favourite = 'no';

                        if ( $user_id != -1 )
                        {
                            $user_like_res = Like::where('image_id',$image_id )->where('user_id',$user_id )->where('like_type','1')->get();
                            if ( count ( $user_like_res ) != 0  ){
                                $image->user_like = 'yes';
                            }

                            $user_dis_like_res = Like::where('image_id',$image_id )->where('user_id',$user_id )->where('like_type','2')->get();
                            if ( count ( $user_dis_like_res ) != 0  ){
                                $image->user_dislike = 'yes';
                            }

                            $user_favourite_res = Favorite::where('image_id',$image_id )->where('user_id',$user_id )->get();
                            if ( count ( $user_favourite_res ) != 0  ){
                                $image->user_favourite = 'yes';
                            }

                        }

                    }
                    $user_fav->image_details = $image;

                }
            }

            $status = 1;
            return response()->json([
                'user favourites' => $user_favourites,
                'status' => $status
            ]);
        }

    }

    public function add_play_list( $title , $user_id  ){

        $result = 'play List Already exists';
        $status = 0;

        $play_list_res = PlayList::where ( 'title' , '=' , $title )
            -> where ( 'user_id'  , '=' , $user_id )
            ->get();


        if ( count ( $play_list_res ) == 0  )
        {
            $new_play_list = new PlayList;
            $new_play_list->title =  $title ;
            $new_play_list->user_id =  $user_id ;
            $new_play_list->save();

            $result = 'Addition Successed ...';
            $status = 1;
        }


        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }

    public function add_play_list_video( $paly_list_id , $video_id  ){

        $result = 'play List Already exists';
        $status = 0;


        $play_list_video_res = PlayListVideo::where ( 'paly_list_id' , '=' , $paly_list_id )
            -> where ( 'video_id'  , '=' , $video_id )
            ->get();


        if ( count ( $play_list_video_res ) == 0  )
        {
            $new_play_list_vedio = new PlayListVideo;

            $new_play_list_vedio->paly_list_id =  $paly_list_id ;
            $new_play_list_vedio->video_id =  $video_id ;

            $new_play_list_vedio->save();

            $result = 'Addition Successed ...';
            $status = 1;
        }

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);


    }

    public function delete_play_list( $paly_list_id  ){

        $result = 'Deletion Successed ...';
        $status = 1;
        PlayList::where ( 'id' , '=' , $paly_list_id ) ->delete();

        return response()->json([
            'result' => $result,
            'status' => $status
        ]);
    }
}
