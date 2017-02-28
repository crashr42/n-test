<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:31 PM
 */

namespace Tests\Libs;

use App\Libs\Enum;

class TestEnum
{
    use Enum;

    const A = 'A';
    const B = 'B';
}


class EnumTest extends \Tests\TestCase
{
    public function testValues()
    {
        static::assertEquals(TestEnum::values(), ['A', 'B']);
    }

    public function testHas()
    {
        static::assertTrue(TestEnum::has('A'));
        static::assertFalse(TestEnum::has('AA'));
    }

    public function testGetIndex()
    {
        static::assertEquals(0, TestEnum::from('A')->getIndex());
        static::assertEquals(1, TestEnum::from('B')->getIndex());
    }

    public function testCount()
    {
        self::assertEquals(2, TestEnum::count());
    }
}
