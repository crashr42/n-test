<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:43 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\User;

class UserController extends ApiController
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->input());
        $user->saveOrFail();

        return $user;
    }
}
