<?php

namespace App\Actions\Link;

use Lorisleiva\Actions\Concerns\AsAction;

class EditLink
{
    use AsAction;

    public function handle($link, $data)
    {
        $link->link = $data['link'];
        $link->title = $data['title'];
        $link->note = $data['note'];
        $link->save();

        return $link;
    }
}
