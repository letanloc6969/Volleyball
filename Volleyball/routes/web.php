<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('welcome');
});

//Router LoginAdmin
Route::get('/admin', [
    'as' => 'admin.login',
    'uses' => 'AdminController@loginAdmin'
]);
Route::post('/admin', [
    'as' => 'admin.post-login',
    'uses' => 'AdminController@postLoginAdmin'
]);

Route::get('/logout', [
    'as' => 'admin.logout',
    'uses' => 'AdminController@logout'
]);

//Router của Admin
Route::prefix('admin')->group(function () {
    //Router của Danh Mục Sản Phẩm
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as'=>'categories.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);

        Route::get('/create', [
            'as'=>'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);

        Route::post('/store', [
            'as'=>'categories.store',
            'uses' => 'CategoryController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'categories.update',
            'uses' => 'CategoryController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

        Route::post('/deleted/{id}', [
            'as'=>'categories.deleted',
            'uses' => 'CategoryController@deleted'
        ]);
    });

    //Router của Menu
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as'=>'menus.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);

        Route::get('/create', [
            'as'=>'menus.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);

        Route::post('/store', [
            'as'=>'menus.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'menus.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'menus.update',
            'uses' => 'MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'menus.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);

        Route::post('/deleted/{id}', [
            'as'=>'menus.deleted',
            'uses' => 'MenuController@deleted'
        ]);
    });

    //Router của sản phẩm
    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as'=>'products.index',
            'uses' => 'AdminProductController@index',
            'middleware' => 'can:product-list'
        ]);

        Route::get('/create', [
            'as'=>'products.create',
            'uses' => 'AdminProductController@create',
            'middleware' => 'can:product-add'
        ]);

        Route::post('/search', [
            'as' => 'products.search',
            'uses' => 'AdminProductController@search'
        ]);

        Route::post('/store', [
            'as'=>'products.store',
            'uses' => 'AdminProductController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'products.edit',
            'uses' => 'AdminProductController@edit',
            'middleware' => 'can:product-edit,id'
        ]);

        Route::post('/update/{id}', [
            'as'=>'products.update',
            'uses' => 'AdminProductController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'products.delete',
            'uses' => 'AdminProductController@delete',
            'middleware' => 'can:product-delete'
        ]);

    });

    //Router của Slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as'=>'sliders.index',
            'uses' => 'AdminSliderController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create', [
            'as'=>'sliders.create',
            'uses' => 'AdminSliderController@create',
            'middleware' => 'can:slider-add'
        ]);

        Route::post('/store', [
            'as'=>'sliders.store',
            'uses' => 'AdminSliderController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'sliders.edit',
            'uses' => 'AdminSliderController@edit',
            'middleware' => 'can:slider-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'sliders.update',
            'uses' => 'AdminSliderController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'sliders.delete',
            'uses' => 'AdminSliderController@delete',
            'middleware' => 'can:slider-delete'
        ]);
    });

    //Router của Setting
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as'=>'settings.index',
            'uses' => 'AdminSettingController@index',
            'middleware' => 'can:setting-list'
        ]);

        Route::get('/create', [
            'as'=>'settings.create',
            'uses' => 'AdminSettingController@create',
            'middleware' => 'can:setting-add'
        ]);

        Route::post('/store', [
            'as'=>'settings.store',
            'uses' => 'AdminSettingController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'settings.edit',
            'uses' => 'AdminSettingController@edit',
            'middleware' => 'can:setting-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'settings.update',
            'uses' => 'AdminSettingController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'settings.delete',
            'uses' => 'AdminSettingController@delete',
            'middleware' => 'can:setting-delete'
        ]);
    });

    //Router của User (Phân Quyền)
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as'=>'users.index',
            'uses' => 'AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);

        Route::get('/create', [
            'as'=>'users.create',
            'uses' => 'AdminUserController@create',
            'middleware' => 'can:user-add'
        ]);

        Route::post('/store', [
            'as'=>'users.store',
            'uses' => 'AdminUserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'users.edit',
            'uses' => 'AdminUserController@edit',
            'middleware' => 'can:user-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'users.update',
            'uses' => 'AdminUserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'users.delete',
            'uses' => 'AdminUserController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });

    //Router của User (Phân Quyền)
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as'=>'roles.index',
            'uses' => 'AdminRoleController@index',
            'middleware' => 'can:role-list'
        ]);

        Route::get('/create', [
            'as'=>'roles.create',
            'uses' => 'AdminRoleController@create',
            'middleware' => 'can:role-add'
        ]);

        Route::post('/store', [
            'as'=>'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'roles.edit',
            'uses' => 'AdminRoleController@edit',
            'middleware' => 'can:role-edit'
        ]);

        Route::post('/update/{id}', [
            'as'=>'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);

        Route::get('/delete/{id}', [
            'as'=>'roles.delete',
            'uses' => 'AdminRoleController@delete',
            'middleware' => 'can:role-delete'
        ]);
    });

    //Router của Permission (Phân Quyền)
    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as'=>'permissions.create',
            'uses' => 'AdminPermissionController@createPermissions',
//            'middleware' => 'can:permission-add'
        ]);

        Route::post('/store', [
            'as'=>'permissions.store',
            'uses' => 'AdminPermissionController@store',
        ]);

    });

    //Router của Order
    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as'=>'orders.index',
            'uses' => 'AdminOrderController@index',
//            'middleware' => 'can:role-list'
        ]);

        Route::get('/confirm/{id}', [
            'as'=>'orders.confirm',
            'uses' => 'AdminOrderController@confirm',
//            'middleware' => 'can:role-list'
        ]);

        Route::post('/update/{id}', [
            'as'=>'orders.update',
            'uses' => 'AdminOrderController@update',
//            'middleware' => 'can:role-list'
        ]);

        Route::POST('/search/', [
            'as'=>'orders.search',
            'uses' => 'AdminOrderController@search',
        ]);

    });

    //Router của Phí vận chuyển
    Route::prefix('delivery')->group(function () {
        Route::get('/', [
            'as'=>'delivery.index',
            'uses' => 'DeliveryController@index',
//            'middleware' => 'can:role-list'
        ]);

        Route::post('/select-delivery', [
            'as'=>'delivery.add',
            'uses' => 'DeliveryController@select_Delivery',
//            'middleware' => 'can:role-list'
        ]);

        Route::post('/store-delivery', [
            'as'=>'delivery.store',
            'uses' => 'DeliveryController@store',
//            'middleware' => 'can:role-list'
        ]);

        Route::post('/select-feeship', [
            'as'=>'delivery.feeship',
            'uses' => 'DeliveryController@select_Feeship',
//            'middleware' => 'can:role-list'
        ]);
        Route::post('/update-feeship', [
            'as'=>'delivery.update',
            'uses' => 'DeliveryController@update_Feeship',
//            'middleware' => 'can:role-list'
        ]);


    });

    //router của coupon
    Route::get('/insert-coupon','CouponController@insert_coupon');
    Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
    Route::get('/list-coupon','CouponController@list_coupon');
    Route::post('/insert-coupon-code','CouponController@insert_coupon_code');
});

