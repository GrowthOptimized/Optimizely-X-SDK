<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;

/**
 * Class PagesTest
 */
class PagesTest extends TestCase
{

	/** @test */
    public function it_can_fetch_the_list_of_pages_in_a_project()
    {
        $client = $this->fakeClient('pages/pages');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        
        $pages = $optimizely->project('1')->pages()->all();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Collections\PagesCollection::class, $pages);
        $this->assertObjectHasAttribute('items', $pages);
        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Page::class, $pages->first());
        $this->assertObjectHasAttribute('id', $pages->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/pages'), $pages->toJson());
    }

    /** @test */
    public function it_can_fetch_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $page = $optimizely->page('1')->find();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_create_an_page_in_a_project()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \WiderFunnel\OptimizelyX($client);

       	$page = $optimizely->project('1')->pages()->create(
       					'my test page', 
       					'http://www.my-test-page.com', 
       					['category' => 'article']
       				);

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_update_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $page = $optimizely->page('1')->update(['name' => 'my updated name']);

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Page::class, $page);
        $this->assertJsonStringEqualsJsonFile($this->getStub('pages/page'), $page->toJson());
    }

	/** @test */
    public function it_can_delete_an_page()
    {
        $client = $this->fakeClient('pages/page');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $page = $optimizely->page('1')->delete();

        $this->assertTrue($page);
    }

}