<?php

namespace App\Actions\User;

use App\Models\User\User;
use App\Traits\ResponseJSON;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProfile
{
    use AsAction, ResponseJSON;

    public function handle($request, $type): array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        $request->validate($this->getValidation($type));
        return $this->updateUser($request, $type);
    }

    private function getValidation($type): array
    {
        $validation = [];
        if ($type === 'name') {
            $validation[$type] = ['required', 'max:191'];
        } else if ($type === 'username') {
            $validation[$type] = ['required', 'unique:users', 'min:3', 'max:191'];
        } else if ($type === 'email') {
            $validation[$type] = ['required', 'unique:users', 'max:191'];
        } else if ($type === 'password') {
            $validation[$type] = ['required', 'confirmed', 'min:8', 'max:191'];
        }

        return $validation;
    }

    public function getControllerMiddleware(): array
    {
        return ['auth'];
    }

    private function updateUser($request, $type): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        $user = User::query()->find(auth()->user()->id);
        if ($type === 'name') {
            $user->name = $request->name;
        } else if ($type === 'username') {
            $user->username = $request->username;
        } else if ($type === 'email') {
            $user->email = $request->email;
            $user->email_verified_at =  null;
        } else if ($type === 'password') {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->load('meta');

        return $user;
    }
}
