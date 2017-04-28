<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Collections\ResultCollection;
use GrowthOptimized\Items\Experiment;
use GrowthOptimized\Items\Schedule;
use GrowthOptimized\Items\Result;
use GrowthOptimized\Items\Message;

/**
 * Class ExperimentsAdapter
 * @package GrowthOptimized
 */
class ExperimentsAdapter extends AdapterAbstract
{

    /**
    * @return mixed
    */
    public function all()
    {   
        $response = $this->client->get("experiments");
        return ExperimentCollection::createFromJson($response->getBody()->getContents());
    }

    /**
    * @return static
    */
    public function find()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}");

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * 
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("experiments/{$this->getResourceId()}");

        return Message::createFromJson(['status' => $response->getStatusCode()]);
    }

    /**
     * @return ExperimentsAdapter
     */
    public function archive()
    {
        return $this->update(['archived' => true]);
    }

    /**
    * @param $attributes
    * @return Experiment
    */
    public function changeVariations($attributes = [])
    {   
        return $this->update(['variations' => $attributes]);
    }

    /*
     * @return static
     */
    public function results()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/results");
        return ResultCollection::createFromJson($response->getBody()->getContents());
    }

}