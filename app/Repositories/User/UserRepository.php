<?php

namespace App\Repositories\User;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function retrieveAllUsers(): Collection
    {
        return User::with('vehicles')->get();
    }

    public function retrieveUser(int $userId): User
    {
        return User::where('id', $userId)->with('vehicles')->first();
    }

    public function retrieveUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createUser(UserDTO $userData): bool
    {
        $user = new User();
        foreach ($userData->toArray() as $key => $value){
            $user->{$key} = $value;
        }
        return $user->save();
    }

    public function updateUser(int $loggedUserId, UserDTO $userData): bool
    {
        $user = User::where('id', $loggedUserId)->firstOrFail();
        foreach ($userData->toArray() as $key => $value){
            if($key == 'password' && !$user->{$key}){
                continue;
            }
            $user->{$key} = $value;
        }
        return $user->save();
    }

    public function removeUser(int $userId): bool
    {
        return User::where('id', $userId)->delete();
    }
}
