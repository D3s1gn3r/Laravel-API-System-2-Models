<?php

namespace App\DTO\User;

use App\DTO\AbstractDTO;
use App\DTO\Traits\StaticCreateSelfTrait;

class UserLoginDTO extends AbstractDTO
{
    use StaticCreateSelfTrait;

    public readonly string $email;
    public readonly string $password;
    public readonly string $tokenName;

}
