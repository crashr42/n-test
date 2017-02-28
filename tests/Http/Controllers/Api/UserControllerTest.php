<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:33 PM
 */

namespace Tests\Http\Controllers\Api;

use App\User;

class UserControllerTest extends ApiControllerTest
{
    /**
     * @test
     */
    public function it_should_retrieve_users()
    {
        self::assertEquals(1, User::count());

        $response = $this->get('/api/users', [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertCount(1, $response->json()['data']);
    }

    /**
     * @test
     */
    public function it_should_retrieve_user_if_it_exists()
    {
        self::assertEquals(1, User::count());

        $response = $this->get("/api/users/{$this->user->id}", [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertEquals([
            'id'         => $this->user->id,
            'email'      => $this->user->email,
            'last_name'  => $this->user->last_name,
            'first_name' => $this->user->first_name,
            'state'      => $this->user->state,
            'group_id'   => $this->user->group_id,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at,
        ], $response->json());
    }

    /**
     * @test
     */
    public function it_should_not_retrieve_user_if_it_not_exists()
    {
        static::markTestSkipped();

        self::assertEquals(1, User::count());

        $response = $this->get('/api/users/999', [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        self::assertInternalType('array', $response->json());
        self::assertEquals([
            'id'         => $this->user->id,
            'email'      => $this->user->email,
            'last_name'  => $this->user->last_name,
            'first_name' => $this->user->first_name,
            'state'      => $this->user->state,
            'group_id'   => $this->user->group_id,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at,
        ], $response->json());
    }

    /**
     * @test
     */
    public function it_should_create_new_user()
    {
        self::assertEquals(1, User::count());

        $response = $this->post('/api/users', factory(User::class)->raw(), [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        var_dump($response->content());

        static::assertEquals(2, User::count());
    }

    /**
     * @test
     */
    public function it_should_update_exists_user()
    {
        self::assertEquals(1, User::count());

        $response = $this->put("/api/users/{$this->user->id}", [
            'last_name' => 'new_last_name',
        ], [
            'Authorization' => "Bearer {$this->user->api_token}",
        ]);

        /** @var User $updatedUser */
        $updatedUser = User::first();

        self::assertEquals($this->user->id, $updatedUser->id);
        self::assertNotEquals($this->user->last_name, $updatedUser->last_name);
        self::assertEquals('new_last_name', $updatedUser->last_name);
    }
}
