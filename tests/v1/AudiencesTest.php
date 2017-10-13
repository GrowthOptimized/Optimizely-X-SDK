<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;

/**
 * Class AudiencesTest
 */
class AudiencesTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_audiences_in_a_project()
    {
        $client = $this->fakeClient('audiences/audiences');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $audiences = $optimizely->project('1')->audiences()->all();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Collections\AudienceCollection::class, $audiences);
        $this->assertObjectHasAttribute('items', $audiences);
        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Audience::class, $audiences->first());
        $this->assertObjectHasAttribute('id', $audiences->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audiences'), $audiences->toJson());
    }

    /** @test */
    public function it_can_fetch_an_audience()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $audience = $optimizely->audience('1')->find();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }

    /** @test */
    public function it_can_create_an_audience_in_a_project()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \WiderFunnel\OptimizelyX($client);

       $audience = $optimizely->project('1')->audiences()->create(
                    'My Test Audience', 
                    '[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US-CA-SANFRANCISCO\"}]',
                    ["description" => 'People that speak spanish in San Fran']
                );

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }

    /** @test */
    public function it_can_update_an_audience()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \WiderFunnel\OptimizelyX($client);

        $audience = $optimizely->audience('1')->update(
                        [
                            "name" => 'My test update',
                            "description" => 'People that speak spanish in San Fran'
                        ]
                    );

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }
}