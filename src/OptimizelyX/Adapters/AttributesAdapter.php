<?php

namespace GrowthOptimized\OptimizelyX\Adapters;

use GrowthOptimized\OptimizelyX\Collections\AttributesCollection;
use GrowthOptimized\OptimizelyX\Items\Attribute;

/**
 * Class AttributesAdapter
 * @package GrowthOptimized
 */
class AttributesAdapter extends AdapterAbstract
{
    /**
     * @return mixed
     */
    public function all()
    {
        $response = $this->client->get("attributes?project_id={$this->getResourceId()}");

        return AttributesCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function find()
    {
        $response = $this->client->get("attributes/{$this->getResourceId()}");

        return Attribute::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param string $name
     * @param string $key
     * @param array $attributes
     * @return static
     */
    public function create(string $name, string $key, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'key', 'project_id'));

        $response = $this->client->post("attributes", $attributes);

        return Attribute::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->patch("attributes/{$this->getResourceId()}", $attributes);

        return Attribute::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return request
     */
    public function delete()
    {
        $response = $this->client->delete("attributes/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}