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
}
