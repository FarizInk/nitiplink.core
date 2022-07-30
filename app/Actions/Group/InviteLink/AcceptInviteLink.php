<?php

namespace App\Actions\Group\InviteLink;

use App\Models\Group\InviteLink;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class AcceptInviteLink
{
    use AsAction;

    public function handle($inviteHash, $userId)
    {
        $inviteLink = InviteLink::byHash($inviteHash);

    }
}
