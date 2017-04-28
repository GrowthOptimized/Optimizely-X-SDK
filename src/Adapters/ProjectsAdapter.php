<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Adapters\EventsAdapter;

use GrowthOptimized\Collections\AudienceCollection;
use GrowthOptimized\Collections\ExperimentCollection;
use GrowthOptimized\Collections\ProjectCollection;
use GrowthOptimized\Collections\CampaignsCollection;
use GrowthOptimized\Collections\PagesCollection;
use GrowthOptimized\Collections\EventsCollection;
use GrowthOptimized\Collections\AttributesCollection;
use GrowthOptimized\Items\Audience;
use GrowthOptimized\Items\Experiment;
use GrowthOptimized\Items\Project;
use GrowthOptimized\Items\Campaign;
use GrowthOptimized\Items\Page;
use GrowthOptimized\Items\Event;

/**
 * Class ProjectsAdapter
 * @package GrowthOptimized
 */
class ProjectsAdapter extends AdapterAbstract
{
    // /**
    //  * @return mixed
    //  */
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
     * @param $project_name
     * @param array $attributes
     * @return Project
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
            'status' => Project::STATUS_ACTIVE
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
            'status' => Project::STATUS_ARCHIVED
        ]);
    }

    /**
     * @return mixed
     */
    public function experiments()
    {
        $response = $this->client->get("experiments?project_id={$this->getResourceId()}");
        return ExperimentCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param array $attributes
     * @return static
     */
    public function createExperiment(string $name, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'project_id'));

        $response = $this->client->post("experiments", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function campaigns()
    {
        $response = $this->client->get("campaigns?project_id={$this->getResourceId()}");
        return CampaignsCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param array $attributes
     * @return static
     */
    public function createCampaign(string $name, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'project_id'));

        $response = $this->client->post("campaigns", $attributes);

        return Campaign::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function audiences()
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
    public function createAudience(string $name, string $conditions, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'conditions', 'project_id'));

        $reponse = $this->client->post("audiences", $attributes); 

        return Audience::createFromJson($response->getBody()->getContents());   
    }


    /**
     * @param $projectId
     * @return mixed
     */
    public function pages()
    {
        $response = $this->client->get("pages?project_id={$this->getResourceId()}");

        return PagesCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param string $name
     * @param string $edit_url
     * @param array $attributes
     * @return static
     */
    public function createPage(string $name, string $edit_url, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'edit_url', 'project_id'));

        $response = $this->client->post("pages", $attributes); 

        return Page::createFromJson($response->getBody()->getContents());   
    }


    /**
    * @param $projectId
    * @return mixed
    */
    public function events()
    {
        $response = $this->client->get("events?project_id={$this->getResourceId()}");

        return EventsCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function createCustomEvent(array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $response = $this->client->post("projects/{$project_id}/custom_events", $attributes); 

        return Event::createFromJson($response->getBody()->getContents());   
    }

    /**
     * @param $audienceId
     * @return EventsAdapter
     */
    public function event($eventId)
    {
        return new EventsAdapter($this->client, $eventId, $this->getResourceId(), 'custom');
    }

    /**
    * @param $projectId
    * @return mixed
    */
    public function attributes()
    {
        $response = $this->client->get("attributes?project_id={$this->getResourceId()}");

        return AttributesCollection::createFromJson($response->getBody()->getContents());
    }

}