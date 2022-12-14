<?php

namespace Axel\SubscriptionWebhooks\Helpers;

use JsonSerializable;

class BaseJsonClass implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        $json = [];
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json;
    }
    function toArray()
    {
        return $this->object_to_array($this);
    }

    private function object_to_array($obj)
    {
        if (is_object($obj)) $obj = (array)$this->dismount($obj);
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        } else $new = $obj;
        return $new;
    }

    private function dismount($object)
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array           = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
}