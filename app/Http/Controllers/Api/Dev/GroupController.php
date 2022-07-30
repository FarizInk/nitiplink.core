<?php

namespace App\Http\Controllers\Api\Dev;

use App\Actions\Group\CreateGroup;
use App\Actions\Group\GetGroup;
use App\Actions\Group\InviteLink\AcceptInviteLink;
use App\Actions\Group\InviteLink\GenerateInviteLink;
use App\Actions\Group\InviteLink\ListInviteLink;
use App\Actions\Group\ListGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function getListGroup(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'paginate' => 'in:basic,simple',
            'limit' => 'max:100'
        ]);

        $reqs = [
            'paginate' => $request->paginate ?? 'basic',
            'limit' => $request->limit ?? 15,
        ];

        $userId = auth()->check() ? auth()->user()->id : null;
        return $this->responseJSON(ListGroup::run($reqs, $userId));
    }

    public function getCategories(Request $request)
    {

    }

    public function getLinks(Request $request)
    {

    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required|in:public,private',
            'prevent_double_link' => 'required|boolean'
        ]);

        $data = array_merge($request->all(), [
            'user_id' => auth()->user()->id,
        ]);

        return $this->responseJSON(CreateGroup::run($data));
    }

    public function edit(Request $request, $hash)
    {

    }

    public function getInviteList(Request $request, $hash)
    {
        return $this->responseJson(ListInviteLink::run($hash));
    }

    public function generateInviteLink(Request $request, $hash): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(GenerateInviteLink::run($hash), auth()->user()->id);
    }

    public function acceptInviteLink(Request $request, $hash): \Illuminate\Http\JsonResponse
    {
        return $this->responseJson(AcceptInviteLink::run($hash), auth()->user()->id);
    }

    public function getGroupByHash($hash): \Illuminate\Http\JsonResponse
    {
        $group = GetGroup::run($hash, 'hash');
        return $this->responseJson($group, null, $group ? 200 : 404);
    }

    public function getGroupByUniquePath($unique_path): \Illuminate\Http\JsonResponse
    {
        $group = GetGroup::run($unique_path, 'unique_path');
        return $this->responseJson($group, null, $group ? 200 : 404);
    }
}
