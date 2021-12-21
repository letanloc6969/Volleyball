<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($permissionCheck)
    {
        //B1: Lấy tất cả quyền của User đang Login
        // 1 User sẽ có nhiều Role(Vai trò) nên phải gọi phương thức trung gian roles() và phải foreach
        //B2: So sánh giá trị đưa vào của Router hiện tại xem có trùng với Permission khi foreach hay không
        $roles = auth()->user()->roles;
        foreach ($roles as $role)
        {
            $permission = $role->permissions;
            if($permission->contains('key_code',$permissionCheck )){
                return true;
            }
        }
        return false;
    }
}
