<?php

namespace App\Actions\Link;

use Lorisleiva\Actions\Concerns\AsAction;

class DeleteLink
{
    use AsAction;

    public function handle($link)
    {
        $link->delete();
        return $link;
    }
}
