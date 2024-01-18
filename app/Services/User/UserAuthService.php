<?php

namespace App\Services\User;

use App\DTO\Response\ResponseDTO;
use App\DTO\User\UserLoginDTO;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\UserAuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserAuthService implements UserAuthServiceInterface
{
    public function __construct(private UserRepositoryInterface $repository){}

    public function loginUser(UserLoginDTO $data): ResponseDTO
    {
        $user = $this->repository->retrieveUserByEmail($data->email);

        if(!$user || !Hash::check($data->password, $user->password)){
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }

        $tokenName = $data?->tokenName ?? 'token';
        $token = $user->createToken($tokenName, $user->availableTokenPermissions());

        return new ResponseDTO([$tokenName => $token->plainTextToken]);
    }

    public function logoutUser(?User $user): ResponseDTO
    {
        if($user){
            $user->tokens()->delete();
            return new ResponseDTO(["message" => "Success."]);
        }
        else{
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
    }
}
