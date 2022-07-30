<?php

namespace App\Actions\Link;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Link\Link;

class CreateLink
{
    use AsAction;

    public function handle($data, $groupId, $categoryId): Link
    {
        $link = new Link();
        $link->created_by = auth()->user()->id;
        $link->group_id = $groupId;
        $link->category_id = $categoryId;
        $link->link = $data['link'];
        $link->title = $data['title'];
        $link->note = $data['note'];
        $link->save();

        return $link;
    }
}
