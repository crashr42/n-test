<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:42 PM
 */

namespace Tests\Http\Controllers\Api;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiControllerTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    /**
     * @var User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
}
