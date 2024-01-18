<?php

namespace App\Http\Controllers\API;

use App\DTO\User\UserDTO;
use App\DTO\User\UserLoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Services\User\Interfaces\UserAuthServiceInterface;
use App\Services\User\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private UserAuthServiceInterface $authService,
        private UserServiceInterface $service
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->service->getAvailableUsers(request()->user()->id);
        return response()->json($response->data, $response->code);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $response = $this->service->storeUser(
            request()->user()->id,
            UserDTO::create($request->validated())
        );
        return response()->json($response->data, $response->code);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $response = $this->service->getUserById(request()->user()->id, $user->id);
        return response()->json($response->data, $response->code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $response = $this->service->updateUserById(
            request()->user()->id, $user->id,
            UserDTO::create($request->validated())
        );
        return response()->json($response->data, $response->code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $response = $this->service->deleteUser(request()->user()->id, $user->id);
        return response()->json($response->data, $response->code);
    }

    /**
     * Login user by getting token
     */
    public function login(UserLoginRequest $request)
    {
        $response = $this->authService->loginUser(UserLoginDTO::create($request->validated()));
        return response()->json($response->data, $response->code);
    }

    /**
     * Logout user by deleting all tokens
     */
    public function logout(Request $request)
    {
        $response = $this->authService->logoutUser($request->user());
        return response()->json($response->data, $response->code);
    }
}
