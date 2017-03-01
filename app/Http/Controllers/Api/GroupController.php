<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:37 PM
 */

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\Api\GroupRequest;
use App\Models\Exceptions\ModelValidationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class GroupController extends ApiController
{
    /**
     * List groups with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return Group::paginate();
    }

    /**
     * Find and show group.
     *
     * @param $id
     * @return Group
     */
    public function show($id)
    {
        return Group::findOrFail($id);
    }

    /**
     * Create new group.
     *
     * @param GroupRequest $request
     * @return Group
     * @throws ModelValidationException
     */
    public function store(GroupRequest $request)
    {
        $group = new Group($request->input());
        $group->saveOrFail();

        return $group;
    }

    /**
     * Update group.
     *
     * @param $id
     * @param Request $request
     * @return Group
     */
    public function update($id, Request $request)
    {
        $group = Group::findOrFail($id);
        $group->fill($request->input());
        $group->saveOrFail();

        return $group;
    }

    /**
     * Users list in group.
     *
     * @param int $id
     * @return LengthAwarePaginator
     */
    public function users($id)
    {
        /** @var Group $group */
        $group = Group::findOrFail($id);

        return $group->users()->paginate();
    }
}
