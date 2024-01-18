<?php

namespace App\Services\User\Interfaces;

use App\DTO\Response\ResponseDTO;
use App\DTO\User\UserDTO;
use App\DTO\User\UserLoginDTO;

interface UserServiceInterface
{

    public function getAvailableUsers(int $loggedUserId): ResponseDTO;

    public function storeUser(int $loggedUserId, UserDTO $userData): ResponseDTO;

    public function getUserById(int $loggedUserId, int $userId): ResponseDTO;

    public function updateUserById(int $loggedUserId, int $userId, UserDTO $userData): ResponseDTO;

    public function deleteUser(int $loggedUserId, int $userId): ResponseDTO;

}
