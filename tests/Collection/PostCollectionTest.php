<?php


namespace Maxcal\WordpressDecorators\Collection\Tests;

use Maxcal\WordpressDecorators\Collection\PostCollection;

class PostCollectionTest extends \WP_UnitTestCase {

    protected $collection;
    protected $posts;

    public function setUp(){
        parent::setUp();
        $this->factory->post->create_many(3);
        $this->posts = get_posts();
        $this->collection = new PostCollection($this->posts);
    }

    public function test_adds_posts_to_storage(){
        $this->assertEquals(3, $this->collection->count());
    }

    public function test_decorates_posts_on_initialization(){
        $this->assertInstanceOf('Maxcal\WordpressDecorators\Decorator\PostDecorator', $this->collection[0]);
    }

    public function test_createFromQuery_creates_PostCollection(){
        $this->go_to( site_url() . '/' );
        $collection = PostCollection::fromQuery($GLOBALS['wp_query']);
        $this->assertInstanceOf('Maxcal\WordpressDecorators\Collection\PostCollection', $collection);
        $this->assertEquals(3, $collection->count());
    }

    public function test_first(){
        $this->assertEquals(
            $this->collection[0],
            $this->collection->first(),
            'Collection->first should get the first member'
        );
    }

    public function test_last(){
        $this->assertEquals(
            $this->collection[ count($this->collection) - 1 ],
            $this->collection->last(),
            'Collection->last should get the last member'
        );
    }
}