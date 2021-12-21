<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $guarded = [];
    public function permissionsChildrent()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
