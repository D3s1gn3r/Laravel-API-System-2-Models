<?php

namespace App\Repositories\User\Interfaces;

use App\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{

    public function retrieveAllUsers(): Collection;

    public function retrieveUser(int $userId): User;

    public function retrieveUserByEmail(string $email): ?User;

    public function createUser(UserDTO $userData): bool;

    public function updateUser(int $loggedUserId, UserDTO $userData): bool;

    public function removeUser(int $userId): bool;

}
