<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected  $fillable = ['name','guard_name'];

    public function rolePermissions()
    {
        return $this->belongsToMany(RoleHasPermission::class);
    }
}
