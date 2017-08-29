<?php

namespace GrowthOptimized;

use GrowthOptimized\OptimizelyX\Adapters\AttributesAdapter;
use GrowthOptimized\OptimizelyX\Adapters\AudiencesAdapter;
use GrowthOptimized\OptimizelyX\Adapters\CampaignsAdapter;
use GrowthOptimized\OptimizelyX\Adapters\EventsAdapter;
use GrowthOptimized\OptimizelyX\Adapters\ExperimentsAdapter;
use GrowthOptimized\OptimizelyX\Adapters\PagesAdapter;
use GrowthOptimized\OptimizelyX\Adapters\ProjectsAdapter;
use GrowthOptimized\OptimizelyX\Http\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class Optimizely
 * @package GrowthOptimized
 */
class OptimizelyX
{
    /**
     * Optimizely API endpoint
     */
    const BASE_URI = 'https://api.optimizely.com/v2/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * Optimizely constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $access_token
     * @param $refresh_token
     * @return static
     */
    public static function create($access_token, $refresh_token = null)
    {

        $headers = ['Content-Type' => 'application/json', 'Authorization' => "Bearer {$access_token}"];

        $client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => $headers,
        ]);

        return new static($client);
    }

    /**
     * @param null $projectId
     * @return $this
     */
    public function project($projectId)
    {
        return new ProjectsAdapter($this->client, $projectId);
    }

    /**
     * @return ProjectsAdapter
     */
    public function projects()
    {
        return new ProjectsAdapter($this->client);
    }

    /**
     * @param null $campaignId
     * @return $this
     */
    public function campaign($campaignId)
    {
        return new CampaignsAdapter($this->client, $campaignId);
    }

    /**
     * @param $experimentId
     * @return ExperimentsAdapter
     */
    public function experiment($experimentId = null)
    {
        return new ExperimentsAdapter($this->client, $experimentId);
    }

    /**
     * @param $audienceId
     * @return AudiencesAdapter
     */
    public function audience($audienceId)
    {
        return new AudiencesAdapter($this->client, $audienceId);
    }

    /**
     * @param $pageId
     * @return PagesAdapter
     */
    public function page($pageId)
    {
        return new PagesAdapter($this->client, $pageId);
    }

    /**
     * @param $eventId
     * @return EventAdapter
     */
    public function event($eventId)
    {
        return new EventsAdapter($this->client, $eventId);
    }

    /**
     * @param $attributeId
     * @return AttributeAdapter
     */
    public function attribute($attributeId)
    {
        return new AttributesAdapter($this->client, $attributeId);
    }
}