<?php

namespace App\Actions\User;

use App\Models\User\User;
use App\Traits\ResponseJSON;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProfile
{
    use AsAction, ResponseJSON;

    public function handle($userId): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        if (is_numeric($userId)) {
            $user = User::query()->with('meta')->find($userId);
        } else {
            $user = User::byHash($userId);
        }

        return $user;
    }
}
