<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{
    public function setGatePolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateUser();
        $this->defineGateRole();
//        $this->defineGatePermission();
    }

    public function defineGateCategory()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }

    public function defineGateMenu()
    {
        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-menu'));
        });

        Gate::define('menu-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-menu'));
        });

        Gate::define('menu-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-menu'));
        });

        Gate::define('menu-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-menu'));
        });
    }

    public function defineGateProduct()
    {
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }

    public function defineGateSlider()
    {
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }

    public function defineGateSetting()
    {
        Gate::define('setting-list', 'App\Policies\SettingPolicy@view');
        Gate::define('setting-add', 'App\Policies\SettingPolicy@create');
        Gate::define('setting-edit', 'App\Policies\SettingPolicy@update');
        Gate::define('setting-delete', 'App\Policies\SettingPolicy@delete');
    }

    public function defineGateUser()
    {
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }

    public function defineGateRole()
    {
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }

//    public function defineGatePermission()
//    {
//        Gate::define('permission-add','App\Policies\PermissionPolicy@create');
//    }
}
