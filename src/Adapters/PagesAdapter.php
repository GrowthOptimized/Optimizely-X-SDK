<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Adapters\EventsAdapter;

use GrowthOptimized\Collections\PagesCollection;

use GrowthOptimized\Items\Page;
use GrowthOptimized\Items\Message;
use GrowthOptimized\Items\Event;

/**
 * Class GoalsAdapter
 * @package GrowthOptimized
 */
class PagesAdapter extends AdapterAbstract
{

    /**
    * @return mixed
    */
    public function all()
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
    public function create(string $name, string $edit_url, array $attributes = [])
    {
        $project_id = $this->getResourceId();

        $attributes = array_merge($attributes, compact('name', 'edit_url', 'project_id'));

        $response = $this->client->post("pages", $attributes); 

        return Page::createFromJson($response->getBody()->getContents());   
    }

    /**
     * @return static
     */
    public function find()
    {

        $response = $this->client->get("pages/{$this->getResourceId()}");

        return Page::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->patch("pages/{$this->getResourceId()}", $attributes);

        return Page::createFromJson($response->getBody()->getContents());
    }

    /**
    * @return null
    */
    public function delete()
    {
    	return $this->client->delete("pages/{$this->getResourceId()}");
    }

    /**
     * @param $audienceId
     * @return AudiencesAdapter
     */
    public function event($eventId = null)
    {
        return new EventsAdapter($this->client, $this->getResourceId(), $eventId, 'in-page');
    }

    /**
     * @return EventsAdapter
     */
    public function events($eventId = null)
    {
        return new EventsAdapter($this->client, $this->getResourceId(), $eventId, 'in-page');
    }

}