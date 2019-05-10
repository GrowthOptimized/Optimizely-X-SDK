<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;

/**
 * Class CampaignTest
 */
class CampaignTest extends TestCase
{

	/** @test */
    public function it_can_fetch_the_list_of_campaigns_in_a_project()
    {
        $client = $this->fakeClient('campaigns/campaigns');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        
        $campaigns = $optimizely->project('1')->campaigns()->all();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Collections\CampaignsCollection::class, $campaigns);
        $this->assertObjectHasAttribute('items', $campaigns);
        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Campaign::class, $campaigns->first());
        $this->assertObjectHasAttribute('id', $campaigns->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('campaigns/campaigns'), $campaigns->toJson());
    }

    /** @test */
    public function it_can_fetch_an_campaign()
    {
        $client = $this->fakeClient('campaigns/campaign');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $campaign = $optimizely->campaign('1')->find();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Campaign::class, $campaign);
        $this->assertJsonStringEqualsJsonFile($this->getStub('campaigns/campaign'), $campaign->toJson());
    }

    /** @test */
    public function it_can_create_an_campaign_in_a_project()
    {
        $client = $this->fakeClient('campaigns/campaign');

        $optimizely = new \WiderFunnel\OptimizelyX($client);

       	$campaign = $optimizely->project('1')->campaigns()->create(
    					'Landing Page Optimization', 
    					["status" => "not_started"]
					);

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Campaign::class, $campaign);
        $this->assertJsonStringEqualsJsonFile($this->getStub('campaigns/campaign'), $campaign->toJson());
    }

    /** @test */
    public function it_can_update_an_campaign()
    {
        $client = $this->fakeClient('campaigns/campaign');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $campaign = $optimizely->campaign('1')->update([
    					'name' => 'this is my new campaign'
					]);

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Campaign::class, $campaign);
        $this->assertJsonStringEqualsJsonFile($this->getStub('campaigns/campaign'), $campaign->toJson());
    }

    /** @test */
    public function it_can_delete_an_campaign()
    {
        $client = $this->fakeClient('campaigns/campaign');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $campaign = $optimizely->experiment('1')->delete();

        $this->assertTrue($campaign);
    }



}