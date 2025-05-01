<?php

namespace App\Models;

use Sweet1s\MoonshineRBAC\Traits\HasMoonShineRolePermissions;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasMoonShineRolePermissions;

    protected $with = ['permissions'];
}
