<?php
/**
 * Created by PhpStorm.
 * User: klock
 * Date: 01/06/2018
 * Time: 10:15
 */

namespace App\Models;

use App\Observers\AdUserObserver;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdUser extends Authenticatable
{
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'ad_users';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'objectguid',
        'username',
        'password',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['password', 'remember_token'];

    //    public function roles()
    //    {
    //        return $this->belongsToMany(Role::class, 'role_users','user_id')->withTimestamps();
    //    }
    //
    //    /**
    //     * Checks if User has access to $permissions.
    //     */
    //    public function hasAccess(array $permissions) : bool
    //    {
    //        // check if the permission is available in any role
    //        foreach ($this->roles as $role) {
    ////            dd($permissions);
    //            if($role->hasAccess($permissions)) {
    //                return true;
    //            }
    //        }
    //        return false;
    //    }
    //
    //
    //    public function inRole(string $roleSlug)
    //    {
    //        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    //    }
}
