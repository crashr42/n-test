<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 4:15 PM
 */

namespace Tests\Integration\Models;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_should_create_user_with_valid_fields()
    {
        self::assertEquals(0, User::count());

        /** @var User $user */
        $user = factory(User::class)->create();

        self::assertEquals(1, $user->id);
        self::assertNotNull($user->api_token);
        self::assertEquals(1, User::count());
    }

    /**
     * @test
     * @param string $field
     * @param mixed $value
     * @param string $message
     * @dataProvider invalidUserFields
     */
    public function it_should_not_create_user_with_invalid_field($field, $value, $message)
    {
        self::assertEquals(0, User::count());

        /** @var User $user */
        $user = factory(User::class)->make();

        $user->{$field} = $value;

        $this->assertModelValidationException(function () use ($user) {
            $user->saveOrFail();
        }, [$field => [$message]]);

        self::assertEquals(0, User::count());
    }

    public function invalidUserFields()
    {
        return [
            ['email', 'zzz', 'The email must be a valid email address.'],
            ['email', 1, 'The email must be a valid email address.'],

            ['last_name', null, 'The last name field is required.'],
            ['last_name', str_repeat('z', 51), 'The last name may not be greater than 50 characters.'],
        ];
    }
}
