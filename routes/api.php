<?php


Route::namespace('Api')->prefix('users')->group( function () {
    Route::post('/login', 'UsersApiController@test_user_login');
    Route::get('/login/{username}/{password}/{device_type}/{device_token}',
        ['uses' => 'UsersApiController@test_user_login_get']);
    Route::get('/logout/{user_id}', 'UsersApiController@do_logout');
    Route::post('/register', 'UsersApiController@add_new_user');
    Route::get('/register/{username}/{password}/{email}/{birth_year}/{gender}/{device_type}/{device_token}',
        ['uses' => 'UsersApiController@add_new_user_get']);
    Route::post('/update', 'UsersApiController@update_user_info');
    Route::post('/update_pic', 'UsersApiController@update_user_pic');
    Route::get('/forget_password/{email}', ['uses' => 'UsersApiController@send_user_password']);
    Route::get('/get_play_lists/{user_id}', ['uses' => 'UsersApiController@get_play_lists']);
    Route::get('/get_play_list_videos/{play_list_id}/{user_id}',
        ['uses' => 'UsersApiController@get_play_list_videos']);
    Route::get('/get_favourites/{user_id}', ['uses' => 'UsersApiController@get_favourites']);
    Route::get('/add_play_list/{title}/{user_id}', ['uses' => 'UsersApiController@add_play_list']);
    Route::get('/add_play_list_video/{paly_list_id}/{video_id}',
        ['uses' => 'UsersApiController@add_play_list_video']);
    Route::get('/delete_play_list/{paly_list_id}', ['uses' => 'UsersApiController@delete_play_list']);

    Route::post('/create_play_list', 'ApiController@create_play_list')->middleware('auth:api');
    Route::post('/add_video_play_list', 'ApiController@add_video_play_list')->middleware('auth:api');

});

Route::namespace('Api')->prefix('images')->group( function () {
    Route::get('random_images' ,  'ImageApiController@random_images');

    Route::get('category_image' ,  'ImageApiController@category_image');
});

Route::namespace('Api')->prefix('sounds')->group( function () {
    Route::get('random_sounds' ,  'SoundApiController@random_sounds');
    Route::get('category_sound' ,  'SoundApiController@category_sound');
});

Route::namespace('Api')->prefix('videos')->group( function () {
    Route::get('random_videos' ,  'VideoApiController@random_videos');
    Route::get('category_video' ,  'VideoApiController@category_video');
});

Route::namespace('Api')->prefix('comments')->group( function () {

    Route::post('/add_comment'
        , ['uses' => 'CommentsApiController@add_comment'])->middleware('auth:api');

    Route::post('/add_comment_reply',
        ['uses' => 'CommentsApiController@add_comment_reply'])->middleware('auth:api');

    Route::post('/delete_comment',
        ['uses' => 'CommentsApiController@delete_comment'])->middleware('auth:api');
});

Route::namespace('Api')->prefix('likes')->group( function () {

    Route::post('/add_like'
        , ['uses' => 'LikesApiController@add_like'])->middleware('auth:api');
});

Route::namespace('Api')->prefix('favorites')->group( function () {


    Route::post('/add_favorite'
        , ['uses' => 'FavoritesApiController@add_favorite'])->middleware('auth:api');
});

Route::group(['namespace' => 'Api'], function () {
    Route::get('/homeimages/{user_id}','ImageApiController@get_images');
    Route::get('/homesounds/{user_id}','SoundApiController@get_sounds');
    Route::get('/homevideos/{user_id}','VideoApiController@get_videos');
    Route::get('/settings/get', ['uses' => 'ApiController@get_settings']);
    Route::get('/settings/sub_domains', ['uses' => 'ApiController@get_sub_domains']);
    Route::get('/settings/categories/{type}', ['uses' => 'ApiController@get_categories']);
    Route::get('/settings/category_media/{type}/{category_id}/{current_page}/{user_id}'
        , ['uses' => 'ApiController@get_category_media']);
    Route::get('/settings/category_media/{type}/{category_id}/{current_page}'
        , ['uses' => 'ApiController@get_category_media']);
    Route::get('/play_lists/delete_play_list/{paly_list_id}'
        , ['uses' => 'ApiController@delete_play_list']);
    Route::get('/users/delete_play_list_video/{paly_list_video_id}'
        , ['uses' => 'ApiController@delete_play_list_video']);
    Route::get('/play_list_videos/delete_play_list_video/{paly_list_video_id}'
        , ['uses' => 'ApiController@delete_play_list_video']);
    Route::get('/users/change_play_list_name/{old_title}/{new_title}/{user_id}'
        , ['uses' => 'ApiController@change_play_list_name']);
    Route::get('/contacts/add_contact_us_message/{name}/{message}',
        ['uses' => 'ApiController@add_contact_us_message_get']);
    Route::post('/contacts/add_contact_us_message'
        , ['uses' => 'ApiController@add_contact_us_message']);
    Route::get('/media/search/{search_key}/{user_id}/{media_type}/{currentPage}'
        , 'ApiController@search_media');


    Route::get('video-search','ApiController@video_search');
    Route::get('sound-search','ApiController@sound_search');
    Route::get('image-search','ApiController@image_search');
});