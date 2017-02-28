<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:12 PM
 */

namespace App\Enums;

use App\Libs\Enum;

class UserState
{
    use Enum;

    const ACTIVE   = 'active';
    const INACTIVE = 'inactive';
}
