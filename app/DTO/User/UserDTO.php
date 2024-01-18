<?php

namespace App\DTO\User;

use App\DTO\AbstractDTO;
use App\DTO\Traits\StaticCreateSelfTrait;

class UserDTO extends AbstractDTO
{
    use StaticCreateSelfTrait;

    public readonly string $name;
    public readonly string $email;
    public readonly string $password;

}
