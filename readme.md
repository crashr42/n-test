# User and groups management api

# Installation

- install composer and run `composer install`
- rename .env.example to .env
- generate APP_KEY with `php artisan key:generate`
- change database credentials: DB_DATABASE, DB_USERNAME, DB_PASSWORD
- setup migrations with `php artisan migrate`
- create test user with `php artisan db:seed`, it print authorization header, use it for communication with api
```
Authorization: Bearer 25c01bb98d4a04cfba9159c9ce0dea95
```

# Running

Run `php artisan serve`.

# Examples

## Create new group

```bash
curl -s -H "Authorization: Bearer ..." -X POST -d "name=test" http://localhost:8000/api/groups
```

# Tests

Run `vendor/bin/phpunit`.
