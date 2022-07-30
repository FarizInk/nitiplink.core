<?php

namespace App\Http\Controllers\Api\Dev;

use App\Actions\User\CheckCredentials;
use App\Actions\User\GetProfile;
use App\Actions\User\GetUser;
use App\Actions\User\UpdateProfile;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getProfile(): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(GetProfile::run(auth()->user()->id));
    }

    public function updateName(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(UpdateProfile::run($request, 'name'));
    }

    public function updateUsername(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(UpdateProfile::run($request, 'username'));
    }

    public function updateEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(UpdateProfile::run($request, 'email'));
    }

    public function updatePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(UpdateProfile::run($request, 'password'));
    }

    public function getUserByHash($hash): \Illuminate\Http\JsonResponse
    {
        $user = GetUser::run($hash, 'hash');
        return $this->responseJson($user, null, $user ? 200 : 404);
    }

    public function getUserByUsername($username): \Illuminate\Http\JsonResponse
    {
        $user = GetUser::run($username, 'username');
        return $this->responseJson($user, null, $user ? 200 : 404);
    }

    public function checkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(CheckCredentials::run($request, 'email'));
    }

    public function checkUsername(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(CheckCredentials::run($request, 'username'));
    }
}
