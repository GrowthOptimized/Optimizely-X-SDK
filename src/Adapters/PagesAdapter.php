<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Adapters\EventsAdapter;

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
    	$response = $this->client->delete("pages/{$this->getResourceId()}");

    	return Message::createFromJson(['status' => $response->getStatusCode()]);

    }

    /**
    * @param string $name
    * @param string $event_type
    * @param array $attributes
    * @return static
    */
    public function createEvent(string $name, string $event_type, array $config, $attributes = [])
    {
    	$attributes = array_merge($attributes, ['config' => $config], compact('name', 'event_type'));

    	$response = $this->client->post("pages/{$this->getResourceId()}/events", $attributes);

    	return Event::createFromJson($response->getBody()->getContents());
    }


    /**
     * @param $audienceId
     * @return AudiencesAdapter
     */
    public function event($eventId)
    {
        return new EventsAdapter($this->client, $eventId, $this->getResourceId(), 'in-page');
    }


}