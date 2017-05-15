<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;

/**
 * Class AttributesTest
 */
class AttributesTest extends TestCase
{

	/** @test */
    public function it_can_fetch_the_list_of_audiences_in_a_project()
    {
        $client = $this->fakeClient('attributes/attributes');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        
        $attributes = $optimizely->project('1')->attributes()->all();

        $this->assertInstanceOf(\GrowthOptimized\Collections\AttributesCollection::class, $attributes);
        $this->assertObjectHasAttribute('items', $attributes);
        $this->assertInstanceOf(\GrowthOptimized\Items\Attribute::class, $attributes->first());
        $this->assertObjectHasAttribute('id', $attributes->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('attributes/attributes'), $attributes->toJson());
    }

    /** @test */
    public function it_can_fetch_an_attribute()
    {
        $client = $this->fakeClient('attributes/attribute');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $attribute = $optimizely->attribute('1')->find();

        $this->assertInstanceOf(\GrowthOptimized\Items\Attribute::class, $attribute);
        $this->assertJsonStringEqualsJsonFile($this->getStub('attributes/attribute'), $attribute->toJson());
    }

    /** @test */
    public function it_can_create_an_audience_in_a_project()
    {
        $client = $this->fakeClient('attributes/attribute');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);

       	$attribute = $optimizely->project('1')->attributes()->create(
    					'my testing attribute',
    					'my_testing_attribute',
    					['description' => 'this is a testing attribute']
					);

        $this->assertInstanceOf(\GrowthOptimized\Items\Attribute::class, $attribute);
        $this->assertJsonStringEqualsJsonFile($this->getStub('attributes/attribute'), $attribute->toJson());
    }
    
    /** @test */
    public function it_can_update_an_attribute()
    {
        $client = $this->fakeClient('attributes/attribute');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $attribute = $optimizely->attribute('1')->update(
                        [
                            "name" => 'My test update',
                            "description" => 'People that speak spanish in San Fran'
                        ]
                    );

        $this->assertInstanceOf(\GrowthOptimized\Items\Attribute::class, $attribute);
        $this->assertJsonStringEqualsJsonFile($this->getStub('attributes/attribute'), $attribute->toJson());
    }

    /** @test */
    public function it_can_delete_an_attribute()
    {
        $client = $this->fakeClient('attributes/attribute');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $attribute = $optimizely->experiment('1')->delete();

        $this->assertTrue($attribute);
    }
	
}