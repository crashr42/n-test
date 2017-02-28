<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:42 PM
 */

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiControllerTestCase extends \Tests\TestCase
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
