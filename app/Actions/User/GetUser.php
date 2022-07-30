<?php

namespace App\Actions\User;

use App\Models\User\User;
use App\Traits\ResponseJSON;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUser
{
    use AsAction, ResponseJSON;

    public function handle($value, $type)
    {
        if ($type === 'username') {
            $user = User::query()->where('username', $value)->with('meta')->first();
        } else {
            $user = User::byHash($value);
            $user?->load('meta');
        }

        return $user;
    }
}
