<?php

Route::group(['middleware' => ['admin']], function () {

    Route::prefix('admin')->group(function () {

        $adminLoginControllerRoute=env('LITE_ADMIN_LOGIN_CONTROLLER') ?? 'LiteCode\AdminGentelella\app\Http\Controllers\Backend\Auth\AdminLoginController';
        Route::get('/login', $adminLoginControllerRoute.'@showLoginForm')->name('admin.login');
        Route::post('/login', $adminLoginControllerRoute.'@login')->name('admin.login.submit');
        Route::post('/logout', $adminLoginControllerRoute.'@logout')->name('admin.logout');

        $adminForgotPasswordControllerRoute=env('LITE_ADMIN_FORGOT_PASSWORD_CONTROLLER') ?? 'LiteCode\AdminGentelella\app\Http\Controllers\Backend\Auth\AdminForgotPasswordController';
        Route::post('/password/email', $adminForgotPasswordControllerRoute.'@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', $adminForgotPasswordControllerRoute.'@showLinkRequestForm')->name('admin.password.request');

        $adminResetPasswordControllerRoute=env('LITE_ADMIN_RESER_PASSWORD_CONTROLLER') ?? 'LiteCode\AdminGentelella\app\Http\Controllers\Backend\Auth\AdminResetPasswordController';
        Route::post('/password/reset', $adminResetPasswordControllerRoute.'@reset');
        Route::get('/password/reset/{token}', $adminResetPasswordControllerRoute.'@showResetForm')->name('admin.password.reset');

        Route::get('/', 'LiteCode\AdminGentelella\app\Http\Controllers\Backend\AdminController@dashboard')->name('admin.dashboard');

//        Route::group(['middleware' => ['role:Super Admin,Admin']], function() {
        Route::resource('roles','LiteCode\AdminGentelella\app\Http\Controllers\Backend\RoleController',['as'=>'admin']);
//        });
//        Route::resource('permissions','LiteCode\AdminGentelella\app\Http\Controllers\Backend\PermissionController',['as'=>'admin']);
        Route::resource('admins','LiteCode\AdminGentelella\app\Http\Controllers\Backend\AdminUserController',['as'=>'admin']);
//
    });

});
