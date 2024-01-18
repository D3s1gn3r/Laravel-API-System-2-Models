<?php

namespace App\Services\Permission\Interfaces;

interface PermissionsServiceInterface
{

    public function can(string $permissionName): bool;

}
