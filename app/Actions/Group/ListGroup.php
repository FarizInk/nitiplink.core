<?php

namespace App\Actions\Group;

use App\Models\Group\Group;
use Lorisleiva\Actions\Concerns\AsAction;

class ListGroup
{
    use AsAction;

    public function handle($request, $userId = null): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $group = Group::query()->with('setting');

        if ($userId !== null) {
            $group = $group->whereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        if ($request['paginate'] === 'simple') {
            $group = $group->simplePaginate($request['limit']);
        } else {
            $group = $group->paginate($request['limit']);
        }

        return $group;
    }
}
