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
    * @return static
    */
    public function find()
    {
        $response = $this->client->get("campaigns/{$this->getResourceId()}");

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
    * @return null
    */
    public function delete()
    {
    	return $this->client->delete("campaigns/{$this->getResourceId()}");
    }

}