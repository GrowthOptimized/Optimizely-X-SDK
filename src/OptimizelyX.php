<?php

namespace GrowthOptimized;

use GuzzleHttp\ClientInterface;
use GrowthOptimized\Adapters\AudiencesAdapter;
use GrowthOptimized\Adapters\ExperimentsAdapter;
use GrowthOptimized\Adapters\ProjectsAdapter;
use GrowthOptimized\Adapters\CampaignsAdapter;
use GrowthOptimized\Adapters\PagesAdapter;
use GrowthOptimized\Adapters\EventsAdapter;
use GrowthOptimized\Http\Client;

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
     * @param $token
     * @param bool $oauth
     * @return static
     */
    public static function create($token)
    {
        
        $headers = ['Content-Type' => 'application/json', 'Authorization' => "Bearer {$token}"];

        $client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => $headers
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
     * @return ExperimentsAdapter
     */
    public function experiments()
    {
        return new ExperimentsAdapter($this->client);
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
     * @return string
     */
    public function audiences()
    {
        return new AudiencesAdapter($this->client);
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

}