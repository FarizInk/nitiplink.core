<?php

namespace App\Actions\Category;

use App\Models\Category\Category;
use Lorisleiva\Actions\Concerns\AsAction;

class EditCategory
{
    use AsAction;

    public function handle($category, $data)
    {
        $category->path = $data['path'];
        $category->name = $data['name'];
        $category->save();

        return $category;
    }
}
