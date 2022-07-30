<?php

namespace App\Actions\Authorization;

use App\Models\User\User;
use App\Traits\ResponseJSON;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Login
{
    use AsAction, ResponseJSON;

    /**
     * @throws ValidationException
     */
    #[ArrayShape(['token' => "mixed", 'user' => "\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object"])]
    public function handle($request): array
    {
        $user = User::query()
            ->where('username', $request->username)
            ->orWhere('email', $request->username)
            ->first();

        $exceptionMessage = ['username' => 'Invalid Credentials'];
        if (!$user) {
            throw ValidationException::withMessages($exceptionMessage);
        }

        if (!password_verify($request->password, $user->password)) {
            throw ValidationException::withMessages($exceptionMessage);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user,
        ];
    }

    #[ArrayShape(['username' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }

    /**
     * @throws ValidationException
     */
    #[ArrayShape(['token' => "mixed", 'user' => "\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object"])]
    public function asController(ActionRequest $request): array
    {
        return $this->handle($request);
    }

    public function htmlResponse($data)
    {
        return $data;
    }

    public function jsonResponse($data): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson($data);
    }
}
