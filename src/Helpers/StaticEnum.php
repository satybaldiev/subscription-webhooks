<?php

namespace Axel\SubscriptionWebhooks\Helpers;

use BadMethodCallException;
use ReflectionClass;

abstract class StaticEnum
{
    protected static array $constants = [];

    public static function __callStatic(string $name, array $arguments)
    {
        $constants = static::getConstants();

        if (!array_key_exists($name, $constants)) {
            throw new BadMethodCallException(sprintf('No enum constant [%s] defined for [%s].', $name, static::class));
        }

        return $constants[$name];
    }

    protected static function getConstants(): array
    {
        $class = static::class;

        if (!array_key_exists($class, static::$constants)) {
            static::$constants[$class] = (new ReflectionClass($class))->getConstants();
        }

        return static::$constants[$class];
    }
}
