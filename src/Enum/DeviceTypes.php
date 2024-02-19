<?php

namespace Axel\SubscriptionWebhooks\Enum;

use ReflectionClass;
use ReflectionException;

class DeviceTypes
{
    private static $values = [];
    const APPLE = 'apple';
    const GOOGLE = 'google';

    /**
     * Gets all available keys with values.
     *
     * @throws ReflectionException
     *
     * @return array The available values, keyed by constant.
     */
    public static function getAll(): array
    {
        $class = get_called_class();

        if (!isset(static::$values[$class])) {
            $reflection = new ReflectionClass($class);
            static::$values[$class] = $reflection->getConstants();
        }

        return static::$values[$class];
    }
}
