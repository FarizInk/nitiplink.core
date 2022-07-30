<?php

namespace App\Actions\User;

use App\Models\User\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckCredentials
{
    use AsAction;

    public function handle($request, $type): bool
    {
        $validation = [];
        $validation[$type] = ['required', $type === 'email' ? $type : null];
        $request->validate($validation);

        $user = User::query()->where($type, $request[$type])->first();

        return $user === null;
    }
}
