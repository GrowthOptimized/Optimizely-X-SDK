<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;

/**
 * Class PagesTest
 */
class PagesTest extends TestCase
{

	/** @test */
    public function it_can_fetch_the_list_of_pages_in_a_project()
    {
        $client = $this->fakeClient('pages/pages');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        
        $pages = $optimizely->project('1')->pages()->all();

        $this->assertInstanceOf(\GrowthOptimized\Collections\PagesCollection::class, $pages);
        $this->assertObjectHasAttribute('items', $pages);
        $this->assertInstanceOf(\GrowthOptimized\Items\Page::class, $pages->first());
        $this->assertObjectHasAttribute('id', $pages->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/pages'), $pages->toJson());
    }

    /** @test */
    public function it_can_fetch_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $page = $optimizely->page('1')->find();

        $this->assertInstanceOf(\GrowthOptimized\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_create_an_page_in_a_project()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);

       	$page = $optimizely->project('1')->pages()->create(
       					'my test page', 
       					'http://www.my-test-page.com', 
       					['category' => 'article']
       				);

        $this->assertInstanceOf(\GrowthOptimized\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_update_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $page = $optimizely->page('1')->update(['name' => 'my updated name']);

        $this->assertInstanceOf(\GrowthOptimized\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_delete_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \GrowthOptimized\OptimizelyX($client);
        $page = $optimizely->page('1')->delete();

        $this->assertTrue($page);
    }

}