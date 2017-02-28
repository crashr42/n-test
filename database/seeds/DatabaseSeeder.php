<?php

use App\Enums\UserState;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $user */
        $user             = User::firstOrNew([
            'email' => 'test@test.ru',
        ]);
        $user->first_name = 'test';
        $user->last_name  = 'test';
        $user->email      = 'test@test.ru';
        $user->password   = 'test';
        $user->state      = UserState::ACTIVE;
        $user->saveOrFail();

        echo "Authorization: Bearer {$user->api_token}".PHP_EOL;
    }
}
