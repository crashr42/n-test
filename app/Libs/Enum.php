<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 5:12 PM
 */

namespace App\Libs;

use ReflectionClass;
use RuntimeException;

trait Enum
{
    protected $value;

    /**
     * Get all enum values.
     * @return array
     */
    public static function values()
    {
        $oClass = new ReflectionClass(static::class);

        return array_values($oClass->getConstants());
    }

    /**
     * Get all enum elements.
     * @return array
     */
    public static function elements()
    {
        $oClass = new ReflectionClass(static::class);

        return array_keys($oClass->getConstants());
    }

    /**
     * Check what enum has specified value.
     * @param $value
     * @return bool
     */
    public static function has($value)
    {
        return in_array($value, static::values(), true);
    }

    /**
     * Check what enum has element.
     * @param $name
     * @return bool
     */
    public static function hasElement($name)
    {
        return in_array($name, static::elements(), true);
    }

    /**
     * Build enum instance from value.
     * @param $value
     * @return static
     * @throws RuntimeException
     */
    public static function from($value)
    {
        if (!static::has($value)) {
            throw new RuntimeException(sprintf('Invalid enum %s value %s.', static::class, $value));
        }

        $instance        = new static();
        $instance->value = $value;

        return $instance;
    }

    /**
     * Build enum instance from name.
     * @param $name
     * @return static
     * @throws RuntimeException
     */
    public static function fromName($name)
    {
        $oClass = new ReflectionClass(static::class);
        foreach ($oClass->getConstants() as $key => $value) {
            if ($key !== $name) {
                continue;
            }

            $instance        = new static();
            $instance->value = $value;

            return $instance;
        }

        throw new RuntimeException(sprintf('Invalid enum %s name %s.', static::class, $name));
    }

    /**
     * Get count of enum values.
     * @return int
     */
    public static function count()
    {
        $oClass = new ReflectionClass(static::class);

        return count($oClass->getConstants());
    }

    /**
     * Get current enum value.
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get current enum name.
     * @return string
     * @throws RuntimeException
     */
    public function getName()
    {
        $oClass = new ReflectionClass(static::class);
        foreach ($oClass->getConstants() as $key => $value) {
            if ($value === $this->value) {
                return $key;
            }
        }

        throw new RuntimeException(sprintf('Invalid enum %s value %s.', static::class, $this->value));
    }

    /**
     * Get name of given value.
     * @param string $value
     * @return string
     * @throws RuntimeException
     */
    public static function getNameOfValue($value)
    {
        return self::from($value)->getName();
    }

    /**
     * Get index of value.
     * @return int
     * @throws RuntimeException
     */
    public function getIndex()
    {
        $oClass = new ReflectionClass(static::class);
        $i      = 0;
        foreach ($oClass->getConstants() as $key => $value) {
            if ($value === $this->value) {
                return $i;
            }

            $i++;
        }

        throw new RuntimeException(sprintf('Invalid enum %s value %s.', static::class, $this->value));
    }
}
