<?php

namespace GrowthOptimized\OptimizelyX\Collections;

use GrowthOptimized\OptimizelyX\Items\Attribute;

/**
 * Class AudienceCollection
 * @package GrowthOptimized\Collections
 */
class AttributesCollection extends CollectionAbstract
{
    /**
     * @param $json
     * @return mixed
     */
    public static function createFromJson($json)
    {
        if (!is_array($json)) {
            $json = json_decode($json, JSON_OBJECT_AS_ARRAY);
        }

        $collection = new static($json);

        return $collection->transform(function ($audience) {
            return new Attribute($audience);
        });
    }
}