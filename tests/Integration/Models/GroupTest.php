<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:22 PM
 */

namespace Tests\Integration\Models;

use App\Group;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_should_create_group_with_valid_fields()
    {
        self::assertEquals(0, Group::count());

        /** @var Group $group */
        $group = factory(Group::class)->create();

        self::assertEquals(1, $group->id);

        self::assertEquals(1, Group::count());
    }
}
