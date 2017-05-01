<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Collections\AudienceCollection;
use GrowthOptimized\Items\Audience;

/**
 * Class AudiencesAdapter
 * @package GrowthOptimized
 */
class AudiencesAdapter extends AdapterAbstract
{

    /**
    * @return mixed
    */
    public function all()
    { 

        $response = $this->client->get("audiences?project_id={$this->getResourceId()}");

        return AudienceCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param string $name
     * @param string $conditions
     * @param array $attributes
     * @return static
     */
    public function create(string $name, string $conditions, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'conditions', 'project_id'));

        $response = $this->client->post("audiences", $attributes); 

        return Audience::createFromJson($response->getBody()->getContents());   
    }


    /**
     * @param $audienceId
     * @return static
     */
    public function find()
    {
        $response = $this->client->get("audiences/{$this->getResourceId()}");
        return Audience::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->patch("audiences/{$this->getResourceId()}", $attributes);

        return Audience::createFromJson($response->getBody()->getContents());
    }

}