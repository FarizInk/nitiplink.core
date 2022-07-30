<?php

namespace App\Actions\Category;

use App\Models\Category\Category;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCategory
{
    use AsAction;

    public function handle($data, $groupId)
    {

        $category = new Category();
        $category->group_id = $groupId;
        $category->created_by = auth()->user()->id;
        $category->path = $data['path'];
        $category->name = $data['name'];
        $category->save();

        return $category;
    }
}
