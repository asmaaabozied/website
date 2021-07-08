<?php

Route::get('/', 'frontend\FrontendController@index')->name('home');

Route::get('/register', function () {

    return view('frontend.register');

})->name('register');

Route::get('/resetpassword', function () {

    return view('frontend.resetpassword');

})->name('resetpassword');

Route::get('/logins', function () {

    return view('frontend.login');

})->name('logins');

Route::get('/error404', function () {

    return view('frontend.404');

})->name('error404');

Route::get('/blankpages', function () {

    return view('frontend.blankpages');

})->name('blankpages');
//frontend

Route::post('login/create', 'frontend\FrontendController@checklogin')->name('login.store');

Route::post('register/create', 'frontend\FrontendController@addregister')->name('register.store');

Route::get('catogeries', 'frontend\FrontendController@index');

Route::get('videohome', 'frontend\FrontendController@index');

Route::get('uploadvideo', 'frontend\FrontendController@uploadvideo')->name('uploadvideo');

Route::post('uploadvideo/create', 'frontend\FrontendController@add_uploadvideo')->name('uploadvideo.store');


Route::get('contacts', 'frontend\FrontendController@contacts')->name('contacts');

Route::post('contacts/create', 'frontend\FrontendController@addcontact')->name('contacts.store');



Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::post('test_upload', 'VideosController@test_upload')->name('videos.test_upload');

    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Notifications
    Route::delete('notifications/destroy', 'NotificationsController@massDestroy')->name('notifications.massDestroy');
    Route::resource('notifications', 'NotificationsController');

    // Advertising Spaces
    Route::delete('advertising-spaces/destroy', 'AdvertisingSpacesController@massDestroy')->name('advertising-spaces.massDestroy');
    Route::post('advertising-spaces/media', 'AdvertisingSpacesController@storeMedia')->name('advertising-spaces.storeMedia');
    Route::resource('advertising-spaces', 'AdvertisingSpacesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    Route::post('setting/general', 'SettingsController@general');
    Route::post('setting/mail_settings', 'SettingsController@mail_settings');
    Route::post('setting/social', 'SettingsController@social');
    Route::post('setting/seo_setting', 'SettingsController@seo_setting');

    // Category Types
    Route::delete('category-types/destroy', 'CategoryTypesController@massDestroy')->name('category-types.massDestroy');
    Route::resource('category-types', 'CategoryTypesController');

    // Categories
    Route::delete('categories/destroy', 'FrontendController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'FrontendController@storeMedia')->name('categories.storeMedia');
    Route::resource('categories', 'FrontendController');

    // Sub Domians
    Route::delete('sub-domians/destroy', 'SubDomiansController@massDestroy')->name('sub-domians.massDestroy');
    Route::resource('sub-domians', 'SubDomiansController');

    // Images
    Route::delete('images/destroy', 'ImagesController@massDestroy')->name('images.massDestroy');
    Route::post('images/media', 'ImagesController@storeMedia')->name('images.storeMedia');
    Route::resource('images', 'ImagesController');
    Route::get('image/comments', 'ImagesController@comments');
    Route::get('image/likes', 'ImagesController@likes');
    Route::get('image/dislikes', 'ImagesController@dislikes');
    Route::get('image/favorites', 'ImagesController@favorites');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

    // Likes
    Route::delete('likes/destroy', 'LikesController@massDestroy')->name('likes.massDestroy');
    Route::resource('likes', 'LikesController');

    // Favorites
    Route::delete('favorites/destroy', 'FavoritesController@massDestroy')->name('favorites.massDestroy');
    Route::resource('favorites', 'FavoritesController');

    // Sounds
    Route::delete('sounds/destroy', 'SoundsController@massDestroy')->name('sounds.massDestroy');
    Route::post('sounds/media', 'SoundsController@storeMedia')->name('sounds.storeMedia');
    Route::resource('sounds', 'SoundsController');
    Route::get('sound/comments', 'SoundsController@comments');
    Route::get('sound/likes', 'SoundsController@likes');
    Route::get('sound/dislikes', 'SoundsController@dislikes');
    Route::get('sound/favorites', 'SoundsController@favorites');

    // Videos
    Route::delete('videos/destroy', 'VideosController@massDestroy')->name('videos.massDestroy');
    Route::post('videos/media', 'VideosController@storeMedia')->name('videos.storeMedia');
    Route::resource('videos', 'VideosController');

    Route::post('after_upload', 'VideosController@after_upload')->name('videos.after_upload');

    Route::get('video/comments', 'VideosController@comments');
    Route::get('video/likes', 'VideosController@likes');
    Route::get('video/dislikes', 'VideosController@dislikes');
    Route::get('video/favorites', 'VideosController@favorites');

    // Adminmenus
    Route::delete('adminmenus/destroy', 'AdminmenuController@massDestroy')->name('adminmenus.massDestroy');
    Route::resource('adminmenus', 'AdminmenuController');

    // Seos
    Route::delete('seos/destroy', 'SeoController@massDestroy')->name('seos.massDestroy');
    Route::resource('seos', 'SeoController');

    // Admins
    Route::delete('admins/destroy', 'AdminsController@massDestroy')->name('admins.massDestroy');
    Route::resource('admins', 'AdminsController');

    // Contact Us Messages
    Route::delete('contact-us-messages/destroy', 'ContactUsMessagesController@massDestroy')->name('contact-us-messages.massDestroy');
    Route::resource('contact-us-messages', 'ContactUsMessagesController');
    Route::get('/publish/{id}', 'HomeController@publish');

    // Radios
    Route::delete('radios/destroy', 'RadioController@massDestroy')->name('radios.massDestroy');
    Route::resource('radios', 'RadioController');

});


Route::get('/google', 'GoogleController@index');
Route::get('/google/login/', 'GoogleController@login');
Route::get('/dashboard', 'AdminController_2@index');
Route::get('/files', 'AdminController_2@files');
Route::get('/copy/{id}', 'AdminController_2@doCopy2');

Route::get('/search', 'AdminController_2@search');

Route::get('/upload', 'AdminController_2@upload');
Route::post('/upload', 'AdminController_2@doUpload');

Route::get('/delete/{id}', 'AdminController_2@delete');
Route::get('/copy/{id}', 'AdminController_2@doCopy2');

Route::get('/list_files', 'HomeController@list_files');






