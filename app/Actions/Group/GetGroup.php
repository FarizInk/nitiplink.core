<?php

namespace App\Actions\Group;

use App\Models\Group\Group;
use Lorisleiva\Actions\Concerns\AsAction;

class GetGroup
{
    use AsAction;

    public function handle($value, $type)
    {
        if ($type === 'unique_path') {
            $group = Group::query()->whereHas('setting', function($q) use ($value) {
                $q->where('unique_path', $value);
            })->with('setting')->first();
        } else {
            $group = Group::byHash($value);
            $group?->load('setting');
        }

        return $group;
    }
}
