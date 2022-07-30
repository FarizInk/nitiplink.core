<?php

namespace App\Http\Controllers\Api\Dev;

use App\Actions\Category\CreateCategory;
use App\Actions\Category\DeleteCategory;
use App\Actions\Category\EditCategory;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Group\Group;
use Illuminate\Http\Request;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'group_hash' => ['required', new ExistsByHash(Group::class)],
            'path' => 'required',
            'name' => 'required'
        ]);
        $group = Group::byHash($request->group_hash);

        $this->responseJSON(CreateCategory::run($request->all(), $group->id));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'category_hash' => ['required', new ExistsByHash(Category::class)],
            'path' => 'required',
            'name' => 'required'
        ]);

        $category = Category::byHash($request->category_hash);

        $this->responseJSON(EditCategory::run($category, $request->all()));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'category_hash' => ['required', new ExistsByHash(Category::class)]
        ]);

        $category = Category::byHash($request->category_hash);

        $this->responseJSON(DeleteCategory::run($category));
    }
}
