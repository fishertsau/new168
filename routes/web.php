<?php

Route::get('/test',function ()
{
    return phpinfo();
});
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'Frontend\HomeController@home')->name('home');

    Route::resource('/vendors', 'Frontend\VendorsController');

    Route::get('/subpage', function () {
        return view('frontend.home.subpage');
    });

    /** Account*/
    Route::get('/account', 'Frontend\AccountController@index')->name('account');
    Route::put('/account/{user}', 'Frontend\AccountController@update');


    /** Devices*/
    Route::resource('devices', 'Frontend\DevicesController');
    Route::any('/ajax/frontend/devices/{command}/{data}', 'Frontend\DevicesController@ajaxHandler');
});


/*** admin****/
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', array('as' => 'dashboard', 'uses' => 'Admin\HomeController@dashboard'));

    /**SystemConfig */
    Route::get('/systemConfig', 'Admin\System_configsController@editSystemConfig');
    Route::post('/systemConfig', 'Admin\System_configsController@update');

    # User Management
    Route::group(array('prefix' => 'user'), function () {
//        Route::get('profile/{user}', ['as' => 'userProfile', 'uses' => 'Admin\UserController@personalProfile']);
//        Route::post('profile/{user}', ['as' => 'updateUserProfile', 'uses' => 'Admin\UserController@updatePersonalInfo']);
//        Route::get('list', 'Admin\UserController@makeUserList');
//        Route::get('listSimple', 'Admin\UserController@makeUserListSimple');
//        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'Admin\UserController@getModalDelete'));
//        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Admin\UserController@getRestore'));
    });

//    Route::resource('user', 'Admin\UserController');
//
//    /**   */
//    Route::resource('occasions', 'Admin\Device\OccasionsController');
//    Route::get('occasions/list/{paginated?}', 'Admin\Device\OccasionsController@getList');
//
//    /**  �*/
////    Route::resource('admin/devices', 'Admin\Device\DevicesController');
//
//    /** ajax� ****/
//    Route::match(['get', 'post'], 'ajax/{command}/{data}', 'Admin\AjaxController@handler');
});

/**************綜合功能  ********************/
Route::group(['middleware' => 'web'], function () {
    /** 圖片處理 **/
    Route::post('/photo/store/{model}/{id}/{field?}', 'PhotoController@store');
    Route::post('/photo/delete/{filepath}', 'PhotoController@delete');
});


/************ Auth Controller *******************/
Route::group(['middleware' => 'web',
//    ['except' => ['confirmEmail']]
], function () {

    //Email Confirmation
    Route::get('email/confirm/{token}', ['as' => 'confirmEmail', 'uses' => 'Auth\EmailConfirmationController@confirmEmail']);
    Route::post('email/confirm',
        ['as' => 'sendEmailConfirmForm', 'uses' => 'Auth\EmailConfirmationController@sendConfirmationEmail']);
    Route::get('email/verification', 'Auth\EmailConfirmationController@showEmailVerification');


    # Socialite Login/Register
    Route::get('/auth/socialite/callback/{user}', 'Auth\SocialiteAuthController@handleProviderCallback');
    Route::get('/auth/socialite/{service}', 'Auth\SocialiteAuthController@redirectToProvider');

    # Lock Screen
//    Route::get('/admin/lockscreen', 'Auth\LockScreenController@getLockScreen');
//    Route::post('/admin/lockscreen', 'Auth\LockScreenController@postLockScreen');


    //Role and Permission management
    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        # Role Management
        Route::group(array('prefix' => 'role'), function () {
//            Route::post('/storeList', ['as' => 'storeRoleList', 'uses' => 'Auth\RoleController@saveListToStorage']);
//            Route::get('/listByCat', ['as' => 'roleListByCat', 'uses' => 'Auth\RoleController@indexByCat']);
//            Route::get('{roleId}/confirm-delete', array('as' => 'confirm-delete/role', 'uses' => 'Auth\RoleController@getModalDelete'));
        });
//        Route::resource('/role', 'Auth\RoleController');

        Route::group(array('prefix' => 'permission'), function () {
//            Route::post('storeList', ['as' => 'storePermissionList', 'uses' => 'Auth\PermissionController@saveListToStorage']);
//            Route::get('/listByCat', ['as' => 'permissionListByCat', 'uses' => 'Auth\PermissionController@indexByCat']);
//            Route::get('{id}/delete', array('as' => 'admin.permission.delete', 'uses' => 'Auth\PermissionController@getDelete'));
//            Route::get('{id}/confirm-delete', array('as' => 'admin.permission.confirm-delete', 'uses' => 'Auth\PermissionController@getModalDelete'));
        });
        # Permission Management
//        Route::resource('/permission', 'Auth\PermissionController');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index');