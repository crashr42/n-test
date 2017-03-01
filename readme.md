# User and groups management api

# Docker

Run application with docker containers `bin/docker`. See `Examples` section.

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

## Groups API

### List groups

```bash
curl -s -H "Authorization: Bearer ..." -X GET http://localhost:8000/api/groups
```

### Create new group

```bash
curl -s -H "Authorization: Bearer ..." -X POST -d "name=test" http://localhost:8000/api/groups
```

### Update group

```bash
curl -s -H "Authorization: Bearer ..." -X PUT -d "name=auto" http://localhost:8000/api/groups/1
```

### List users in group

```bash
curl -s -H "Authorization: Bearer ..." -X GET http://localhost:8000/api/groups/1/users
```

## Users api

### List users

```bash
curl -s -H "Authorization: Bearer ..." -X GET http://localhost:8000/api/users
```

### Create new user

```bash
curl -s -H "Authorization: Bearer ..." -X POST -d "state=active&first_name=test&last_name=test&email=zzz@test.ru" http://localhost:8000/api/users
```

### Update user

```bash
curl -s -H "Authorization: Bearer ..." -X PUT -d "group_id=1" http://localhost:8000/api/users/1
```

# Tests

Run `vendor/bin/phpunit`.
