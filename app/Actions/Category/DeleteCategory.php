<?php

namespace App\Actions\Category;

use App\Models\Link\Link;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCategory
{
    use AsAction;

    public function handle($category)
    {
        Link::query()->where('category_id', $category->id)->delete();
        $category->delete();

        return $category;
    }
}
