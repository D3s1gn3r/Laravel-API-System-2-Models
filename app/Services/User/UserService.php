<?php

namespace App\Services\User;

use App\DTO\Response\ResponseDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Services\Permission\Interfaces\PermissionsServiceInterface;
use App\Services\User\Interfaces\UserServiceInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{

    public function __construct(
        private PermissionsServiceInterface $permissionService,
        private UserRepositoryInterface $repository
    ){}

    public function getAvailableUsers(int $loggedUserId): ResponseDTO
    {
        if($this->permissionService->can(User::USER_ACCESS)){
            return new ResponseDTO($this->repository->retrieveAllUsers()->toArray());
        }
        else{
            return new ResponseDTO([$this->repository->retrieveUser($loggedUserId)->toArray()]);
        }
    }

    public function storeUser(int $loggedUserId, UserDTO $userData): ResponseDTO
    {
        if(!$this->permissionService->can(User::USER_ACCESS)) {
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            if($this->repository->createUser($userData)){
                return new ResponseDTO(["message" => "Success."]);
            }
            else{
                return new ResponseDTO(["message" => "Unexpected error."], 500);
            }
        }
    }

    public function getUserById(int $loggedUserId, int $userId): ResponseDTO
    {
        $user = $this->repository->retrieveUser($userId);
        if(!$this->permissionService->can(User::USER_ACCESS) &&
            $user->id != $loggedUserId
        ) {
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            return new ResponseDTO($user->toArray());
        }
    }

    public function updateUserById(int $loggedUserId, int $userId, UserDTO $userData): ResponseDTO
    {
        $user = $this->repository->retrieveUser($userId);
        if(!$this->permissionService->can(User::USER_ACCESS) &&
            $user->id != $loggedUserId
        ){
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            if($this->repository->updateUser($userId, $userData)){
                return new ResponseDTO(["message" => "Success."]);
            }
            else{
                return new ResponseDTO(["message" => "Unexpected error."], 500);
            }
        }
    }

    public function deleteUser(int $loggedUserId, int $userId): ResponseDTO
    {
        $user = $this->repository->retrieveUser($userId);
        if(!$this->permissionService->can(User::USER_ACCESS) &&
            $user->id != $loggedUserId
        ){
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            if($this->repository->removeUser($userId)){
                return new ResponseDTO(["message" => "Success."]);
            }
            else{
                return new ResponseDTO(["message" => "Unexpected error."], 500);
            }
        }
    }
}
