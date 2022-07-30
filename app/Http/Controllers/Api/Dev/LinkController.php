<?php

namespace App\Http\Controllers\Api\Dev;

use App\Actions\Link\CreateLink;
use App\Actions\Link\DeleteLink;
use App\Actions\Link\EditLink;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Group\Group;
use App\Models\Link\Link;
use Illuminate\Http\Request;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class LinkController extends Controller
{
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'group_hash' => ['required', new ExistsByHash(Group::class)],
            'category_hash' => ['required', new ExistsByHash(Category::class)],
            'link' => 'required',
            'title' => 'max:191',
            'note' => 'nullable',
        ]);

        $group = Group::byHash($request->group_hash);
        $category = Group::byHash($request->category_hash);

        return $this->responseJSON(CreateLink::run($request->all(), $group->id, $category->id));
    }

    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'link_hash' => ['required', new ExistsByHash(Link::class)],
            'link' => 'required',
            'title' => 'max:191',
            'note' => 'nullable',
        ]);

        $link = Link::byHash($request->link_hash);

        return $this->responseJSON(EditLink::run($link, $request->all()));
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'link_hash' => ['required', new ExistsByHash(Link::class)],
        ]);

        $link = Link::byHash($request->link_hash);

        return $this->responseJSON(DeleteLink::run($link));
    }
}
