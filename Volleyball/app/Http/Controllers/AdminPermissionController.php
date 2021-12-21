<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    private $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function createPermissions()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        $permission = $this->permission->create([
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
            'key_code'=>''
        ]);

        foreach ($request->module_childrent as $value)
        {
            $this->permission->create([
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permission->id,
                'key_code' => $request->module_parent . '_' . $value
            ]);
        }
    }
}
