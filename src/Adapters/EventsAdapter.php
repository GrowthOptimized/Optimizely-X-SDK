<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Items\Event;
use GrowthOptimized\Items\Message;

use GuzzleHttp\ClientInterface;

/**
 * Class GoalsAdapter
 * @package GrowthOptimized
 */
class EventsAdapter extends AdapterAbstract
{

    /**
     * @var
     */
    protected $pageId;

        /**
     * @var
     */
    protected $eventType;

    /**
     * Optimizely constructor.
     * @param ClientInterface $client, $id, $parentId, $eventId
     * @param null $id
     */
    public function __construct(ClientInterface $client, $id = null, $parentId = null, $eventType = null)
    {
        $this->parentId = $parentId;
        $this->eventType = $eventType;
        parent::__construct($client, $id);
    }

    /**
     * @return static
     */
    public function find()
    {
        $response = $this->client->get("events/{$this->getResourceId()}");

        return Event::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        if ($this->eventType == 'in-page') {

            $response = $this->client->patch("pages/{$this->parentId}/events/{$this->getResourceId()}", $attributes);

        } else {

            $response = $this->client->patch("projects/{$this->parentId}/custom_events/{$this->getResourceId()}", $attributes);
            
        }
        
        return Event::createFromJson($response->getBody()->getContents());

    }

    // /**
    // * @return static
    // */
    public function delete()
    {

        if ($this->eventType == 'in-page') {

            $response = $this->client->delete("pages/{$this->parentId}/events/{$this->getResourceId()}");

        } else {

            $response = $this->client->delete("projects/{$this->parentId}/custom_events/{$this->getResourceId()}");
            
        }

    	return Message::createFromJson(['status' => $response->getStatusCode()]);

    }

}