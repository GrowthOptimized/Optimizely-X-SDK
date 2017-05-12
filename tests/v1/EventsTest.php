<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;
use GrowthOptimized\Items\Event;

/**
 * Class GoalsTest
 */
class EventsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_events_in_a_project()
    {
        $client = $this->fakeClient('events/events');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goals = $optimizely->project('1')->events()->all();

        $this->assertInstanceOf(\GrowthOptimized\Collections\EventsCollection::class, $goals);
        $this->assertObjectHasAttribute('items', $goals);
        $this->assertInstanceOf(Event::class, $goals->first());
        $this->assertObjectHasAttribute('id', $goals->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/events'), $goals->toJson());
    }

    /** @test */
    public function it_can_fetch_an_event()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->event('1')->find();

        $this->assertInstanceOf(Event::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/event'), $goal->toJson());
    }

    /** @test */
    public function it_can_create_an_in_page_event_in_a_project()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        
        $goal = $optimizely->page('1')->events()->create(
           'my sign up goal', 
            'click', 
            ['selector' => '.sign-up-btn'],
            ['category' => 'sign_up']
        );

        $this->assertInstanceOf(Event::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/event'), $goal->toJson());
    }

        /** @test */
    public function it_can_create_an_custom_event_in_a_project()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->project('1')->events()->create([
                    'event_type' => 'custom',
                    'name' => 'my custom event',
                    'key' => 'my_event_key'
                ]);

        $this->assertInstanceOf(Event::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/event'), $goal->toJson());
    }

    /** @test */
    public function it_can_update_in_page_event()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->page('1')->event('1')->update([
                    'name' => 'my new page event name'
                ]);

        $this->assertInstanceOf(Event::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/event'), $goal->toJson());
    }

    /** @test */
    public function it_can_update_custom_event()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->project('1')->event('1')->update([
                    'name' => 'my new custom event name'
                ]);

        $this->assertInstanceOf(Event::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('events/event'), $goal->toJson());
    }

    /** @test */
    public function it_can_delete_in_page_event()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->page('1')->event('1')->delete();

        $this->assertTrue($goal);
    }

    /** @test */
    public function it_can_delete_custom_event()
    {
        $client = $this->fakeClient('events/event');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $goal = $optimizely->project('1')->event('1')->delete();

        $this->assertTrue($goal);
    }

}