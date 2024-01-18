<?php

namespace App\Services\Permission;

use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Services\Permission\Interfaces\PermissionsServiceInterface;

class UserPermissionsService implements PermissionsServiceInterface
{

    public function can(string $permissionName): bool
    {
        return request()->user()->tokenCan($permissionName);
    }

}
