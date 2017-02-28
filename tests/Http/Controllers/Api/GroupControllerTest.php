<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:41 PM
 */

namespace Tests\Http\Controllers\Api;

use App\Group;

class GroupControllerTest extends ApiControllerTest
{
    /**
     * @test
     */
    public function it_should_retrieve_groups()
    {
        factory(Group::class)->times(20)->create();

        self::assertEquals(20, Group::count());

        $response = $this->get('/api/groups', [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertCount(15, $response->json()['data']);
    }

    /**
     * @test
     */
    public function it_should_find_group()
    {
        /** @var Group $group */
        $group = factory(Group::class)->create();

        self::assertEquals(1, Group::count());

        $response = $this->get("/api/groups/{$group->id}", [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertArraySubset([
            'name' => $group->name,
        ], $response->json());
    }

    /**
     * @test
     */
    public function it_should_create_new_group()
    {
        $group = factory(Group::class)->raw();

        $response = $this->post('/api/groups', $group, [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertEquals($group['name'], $response->json()['name']);
    }

    /**
     * @test
     */
    public function it_should_update_exists_group()
    {
        /** @var Group $group */
        $group = factory(Group::class)->create();

        $response = $this->put("/api/groups/{$group->id}", ['name' => 'new_test_group'], [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertEquals('new_test_group', $response->json()['name']);
    }
}
