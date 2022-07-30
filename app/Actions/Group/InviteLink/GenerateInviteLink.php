<?php

namespace App\Actions\Group\InviteLink;

use App\Models\Group\Group;
use App\Models\Group\InviteLink;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateInviteLink
{
    use AsAction;

    public function handle($groupHash, $userId)
    {
        $group = Group::byHash($groupHash);

        $inviteLink = new InviteLink();
        $inviteLink->created_by = $userId;
        $inviteLink->group_id = $group->id;
        $inviteLink->expired_at = Carbon::now()->addHour(1);
        $inviteLink->save();

        return $inviteLink;
    }
}
