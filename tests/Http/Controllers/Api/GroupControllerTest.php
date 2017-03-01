<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:41 PM
 */

namespace Tests\Http\Controllers\Api;

use App\Group;
use App\User;
use Tests\ApiControllerTestCase;

class GroupControllerTestCase extends ApiControllerTestCase
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

        $response->assertStatus(200);
        self::assertInternalType('array', $response->json());
        self::assertCount(15, $response->json()['data']);
    }

    /**
     * @test
     */
    public function it_should_get_exists_group()
    {
        /** @var Group $group */
        $group = factory(Group::class)->create();

        self::assertEquals(1, Group::count());

        $response = $this->get("/api/groups/{$group->id}", [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        $response->assertStatus(200);
        self::assertInternalType('array', $response->json());
        self::assertArraySubset([
            'name' => $group->name,
        ], $response->json());
    }

    /**
     * @test
     */
    public function it_should_get_not_exists_group()
    {
        self::assertEquals(0, Group::count());

        $response = $this->get('/api/groups/999', [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        $response->assertStatus(404);
        self::assertEquals('model.not_found', $response->json()['error']);
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

        $response->assertStatus(200);
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

        $response->assertStatus(200);
        self::assertEquals('new_test_group', $response->json()['name']);
    }

    /**
     * @test
     */
    public function it_should_retrieve_users_in_group()
    {
        /** @var Group $group */
        $group = factory(Group::class)->create();

        factory(User::class)->times(50)->create([
            'group_id' => $group->id,
        ]);

        $response = $this->get("/api/groups/{$group->id}/users", [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        $response->assertStatus(200);

        self::assertCount(15, $response->json()['data']);
    }
}
