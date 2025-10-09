<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInUserRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Services\UserService;
use App\Traits\apiResponseTrait;

use Throwable;

class UserController extends Controller
{
    use apiResponseTrait;
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function signup(SignUpUserRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->userService->signup($request->validated());
            return $this->successResponse($data, 'User created successfully', 201);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }

    public function signin(SignInUserRequest $request)
    {
        try {
            $data = $this->userService->signin($request->validated());
            return $this->successResponse(
                $data,
                'User signed in successfully',
                200
            );
        }
        catch (Throwable $th)
        {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }

        public function logout()
        {
        try {
            $this->userService->logout();
            return $this->successResponse(
                null,
                'User Logout Successfully',
                200
            );
        }
        catch (Throwable $th)
        {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
        }
    }

