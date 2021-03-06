<?php

namespace WiderFunnel\OptimizelyX\Adapters;

use WiderFunnel\OptimizelyX\Collections\EventsCollection;
use WiderFunnel\OptimizelyX\Items\Event;
use GuzzleHttp\ClientInterface;

/**
 * Class GoalsAdapter
 * @package WiderFunnel
 */
class EventsAdapter extends AdapterAbstract
{
    /**
     * @var
     */
    protected $eventId;

    /**
     * @var
     */
    protected $eventType;

    /**
     * Optimizely constructor.
     * @param ClientInterface $client , $id, $parentId, $eventId
     * @param null $id
     * @param null $eventId
     * @param null $eventType
     */
    public function __construct(ClientInterface $client, $id = null, $eventId = null, $eventType = null)
    {
        $this->eventId = $eventId;
        $this->eventType = $eventType;
        parent::__construct($client, $id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $response = $this->client->get("events?project_id={$this->getResourceId()}");

        return EventsCollection::createFromJson($response->getBody()->getContents());
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
     * @param string $name
     * @param string|null $event_type
     * @param array|null $config
     * @param array $attributes
     * @return static
     */
    public function create($name, string $event_type = null, array $config = null, $attributes = [])
    {
        if ($this->eventType == 'in-page') {
            $attributes = array_merge($attributes, compact('name', 'event_type', 'config'));
            $response = $this->client->post("pages/{$this->getResourceId()}/events", $attributes);
        } else {
            $attributes = $name;
            $response = $this->client->post("projects/{$this->getResourceId()}/custom_events", $attributes);
        }

        return Event::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        if ($this->eventType == 'in-page') {
            $response = $this->client->patch("pages/{$this->getResourceId()}/events/{$this->eventId}", $attributes);
        } else {
            $response = $this->client->patch(
                "projects/{$this->getResourceId()}/custom_events/{$this->eventId}",
                $attributes
            );
        }

        return Event::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function delete()
    {
        if ($this->eventType == 'in-page') {
            $response = $this->client->delete("pages/{$this->getResourceId()}/events/{$this->eventId}");
        } else {
            $response = $this->client->delete("projects/{$this->getResourceId()}/custom_events/{$this->eventId}");
        }

        return $this->booleanResponse($response);
    }
}