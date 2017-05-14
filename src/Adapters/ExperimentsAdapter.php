<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Collections\ExperimentCollection;
use GrowthOptimized\Collections\ResultCollection;
use GrowthOptimized\Items\Experiment;

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
        $response = $this->client->get("experiments?project_id={$this->getResourceId()}");

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
     * @param string $name
     * @param array $variations
     * @param array $metrics
     * @param array $attributes
     * @return static
     */
    public function create(string $name, array $variations, array $metrics, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'variations', 'metrics', 'project_id'));

        $response = $this->client->post("experiments", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     *
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("experiments/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }

    /**
     * @return ExperimentsAdapter
     */
    public function archive()
    {
        return $this->update(['archived' => true]);
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

    /*
     * @return static
     */

    public function results()
    {
        $response = $this->client->get("experiments/{$this->getResourceId()}/results");

        return ResultCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function variations()
    {
        $project_id = $this->getResourceId();

        return new VariationsAdapter($this->client, $project_id);
    }

}