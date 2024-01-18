<?php

namespace App\Services\User\Interfaces;

use App\DTO\Response\ResponseDTO;
use App\DTO\User\UserLoginDTO;
use App\Models\User;

interface UserAuthServiceInterface
{

    public function loginUser(UserLoginDTO $data): ResponseDTO;

    public function logoutUser(?User $user): ResponseDTO;

}
