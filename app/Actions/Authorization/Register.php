<?php

namespace App\Actions\Authorization;

use App\Models\User\User;
use App\Models\User\UserMeta;
use App\Traits\ResponseJSON;
use JetBrains\PhpStorm\ArrayShape;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Register
{
    use AsAction, ResponseJSON;

    public function handle($request): User
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user) {
            $meta = new UserMeta();
            $meta->user_id = $user->id;
            $meta->save();
        }

        $user->load('meta');

        return $user;
    }

    #[ArrayShape(['name' => "string[]", 'username' => "string[]", 'email' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:191'],
            'username' => ['required', 'unique:users', 'min:3', 'max:191'],
            'email' => ['required', 'email', 'unique:users', 'max:191'],
            'password' => ['required', 'min:8', 'max:191'],
        ];
    }

    public function asController(ActionRequest $request): User
    {
        return $this->handle($request);
    }

    public function htmlResponse(User $user): User
    {
        return $user;
    }

    public function jsonResponse(User $user): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson($user);
    }
}
