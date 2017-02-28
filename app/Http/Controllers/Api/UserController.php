<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:43 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\Exceptions\ModelValidationException;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * List user with pagination.
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return User::paginate();
    }

    /**
     * Find and show user.
     *
     * @param $id
     * @return User
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Create new user.
     *
     * @param UserRequest $request
     * @return User
     * @throws ModelValidationException
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->input());
        $user->saveOrFail();

        return $user;
    }

    /**
     * Update user.
     *
     * @param $id
     * @param UserRequest $request
     * @return User
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->fill($request->input());
        $user->saveOrFail();

        return $user;
    }
}
