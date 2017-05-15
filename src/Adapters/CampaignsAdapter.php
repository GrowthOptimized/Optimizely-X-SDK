<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Collections\CampaignsCollection;
use GrowthOptimized\Items\Campaign;


/**
 * Class CampaignsAdapter
 * @package GrowthOptimized
 */
class CampaignsAdapter extends AdapterAbstract
{

    /**
     * @return mixed
     */
    public function all()
    {

        $response = $this->client->get("campaigns?project_id={$this->getResourceId()}");

        return CampaignsCollection::createFromJson($response->getBody()->getContents());
    }


    /**
     * @return static
     */
    public function find()
    {
        $response = $this->client->get("campaigns/{$this->getResourceId()}");

        return Campaign::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param array $attributes
     * @return static
     */
    public function create(string $name, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'project_id'));

        $response = $this->client->post("campaigns", $attributes);

        return Campaign::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function results()
    {
        $response = $this->client->get("campaigns/{$this->getResourceId()}/results");

        return CampaignsCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function update($attributes = [])
    {
        $response = $this->client->patch("campaigns/{$this->getResourceId()}", $attributes);

        return Campaign::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return request
     */
    public function delete()
    {
        $response = $this->client->delete("campaigns/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }

}