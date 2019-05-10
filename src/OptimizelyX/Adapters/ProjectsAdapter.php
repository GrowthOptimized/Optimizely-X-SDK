<?php

namespace WiderFunnel\OptimizelyX\Adapters;

use WiderFunnel\OptimizelyX\Collections\ProjectCollection;
use WiderFunnel\OptimizelyX\Items\Project;

/**
 * Class ProjectsAdapter
 * @package WiderFunnel
 */
class ProjectsAdapter extends AdapterAbstract
{
    /**
     * @return mixed
     */
    public function all()
    {
        $response = $this->client->get('projects');

        return ProjectCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return static
     */
    public function find($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}");

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return \WiderFunnel\OptimizelyX\Items\Project
     */
    public function create(string $name, array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('name'));

        $response = $this->client->post('projects', $attributes);

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return ProjectsAdapter
     */
    public function activate()
    {
        return $this->update([
            'status' => Project::STATUS_ACTIVE,
        ]);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->patch("projects/{$this->getResourceId()}", $attributes);

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function archive()
    {
        return $this->update([
            'status' => Project::STATUS_ARCHIVED,
        ]);
    }

    /**
     * @return mixed
     */
    public function experiments()
    {
        return new ExperimentsAdapter($this->client, $this->getResourceId());
    }

    /**
     * @return CampaignsAdapter
     */
    public function campaigns()
    {
        return new CampaignsAdapter($this->client, $this->getResourceId());
    }

    /**
     * @return AudienceAdapter
     */
    public function audiences()
    {
        return new AudiencesAdapter($this->client, $this->getResourceId());
    }

    /**
     * @return PagesAdapter
     */
    public function pages()
    {
        return new PagesAdapter($this->client, $this->getResourceId());
    }

    /**
     * @return EventsAdapter
     */
    public function events()
    {
        return new EventsAdapter($this->client, $this->getResourceId());
    }

    /**
     * @param $eventId
     * @return EventsAdapter
     */
    public function event($eventId)
    {
        return new EventsAdapter($this->client, $this->getResourceId(), $eventId, 'custom');
    }

    /**
     * @return mixed
     */
    public function attributes()
    {
        return new AttributesAdapter($this->client, $this->getResourceId());
    }
}