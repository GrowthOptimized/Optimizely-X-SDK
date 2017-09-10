<?php

namespace GrowthOptimized\OptimizelyX\Adapters;

use GrowthOptimized\OptimizelyX\Collections\ExperimentCollection;
use GrowthOptimized\OptimizelyX\Collections\ResultCollection;
use GrowthOptimized\OptimizelyX\Items\Experiment;

/**
 * Class ExperimentsAdapter
 * @package GrowthOptimized
 */
class ExperimentsAdapter extends AdapterAbstract
{
    const ACTION_PUBLISH = 'publish';
    const ACTION_START = 'start';
    const ACTION_PAUSE = 'pause';
    const ACTION_RESUME = 'resume';
    const ACTION_COMPLETE = 'pause';
    const ACTION_UNARCHIVE = 'unarchive';

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
    public function create(string $name, array $variations, array $metrics = null, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $metrics = $metrics ?? [new \stdClass];

        $attributes = array_merge($attributes, compact('name', 'variations', 'metrics', 'project_id'));

        $response = $this->client->post("experiments", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
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
        return $this->delete();
    }

    /**
     * @return static
     */
    public function unarchive()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_UNARCHIVE);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function publish()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_PUBLISH);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function start()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_START);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function pause()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_PAUSE);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function resume()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_RESUME);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function complete()
    {
        $response = $this->client->patch("experiments/{$this->getResourceId()}?action=".self::ACTION_COMPLETE);

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