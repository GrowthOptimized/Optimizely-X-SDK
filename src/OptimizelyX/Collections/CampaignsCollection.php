<?php

namespace WiderFunnel\OptimizelyX\Collections;

use WiderFunnel\OptimizelyX\Items\Campaign;

/**
 * Class ExperimentCollection
 * @package WiderFunnel\Collections
 */
class CampaignsCollection extends CollectionAbstract
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

        return $collection->transform(function ($experiment) {
            return new Campaign($experiment);
        });
    }
}