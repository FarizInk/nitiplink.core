<?php

namespace App\Actions\Group;

use App\Models\Group\Group;
use App\Models\Group\GroupSetting;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateGroup
{
    use AsAction;

    public function handle($data)
    {
        $group = new Group();
        $group->created_by = $data['user_id'];
        $group->owner = $data['user_id'];
        $group->save();
        $group->users()->attach($data['user_id']);

        $groupSetting = new GroupSetting();
        $groupSetting->group_id = $group->id;
        $groupSetting->name = $data['name'];
        $groupSetting->description = $data['description'];
        $groupSetting->type = $data['type'];
        $groupSetting->prevent_double_link = $data['prevent_double_link'];
        $groupSetting->save();

        return $group->load('setting');
    }
}
