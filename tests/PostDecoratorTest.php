<?php


namespace Maxcal\WordpressDecorators\Tests;

use Maxcal\WordpressDecorators\Decorator\PostDecorator;
use Symfony\Component\DomCrawler\Crawler;

class PostTest extends \WP_UnitTestCase {

    protected $decorator;
    protected $post;

    public function setUp(){
        parent::setUp();
        $this->post = $this->factory->post->create_and_get();
        $this->decorator = new PostDecorator($this->post);
    }

    public function test_getId(){
        $this->assertEquals($this->post->ID, $this->decorator->id);
    }

    public function test_get_property_from_decorated_object(){
        $this->assertEquals($this->post->post_date, $this->decorator->post_date);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_get_nonexistant_property(){
        $this->decorator->foo;
    }

    public function test_get_property_with_prefix(){
        $this->assertEquals($this->post->post_date, $this->decorator->date);
    }

    public function test_getTitle(){
        $this->assertEquals($this->post->post_title, $this->decorator->title);
    }

    public function test_getContent(){
        $this->assertEquals('<p>Post content 1</p>', trim($this->decorator->content));
    }

    public function test_getUrl(){
        $this->assertEquals('http://example.org/?p='.$this->post->ID , $this->decorator->url);
    }

    public function test_GetClass(){
        $this->assertContains("foo", $this->decorator->getClass("foo"));
        $this->assertContains("post", $this->decorator->getClass("foo"));
    }

    function test_Link(){
        $link = $this->decorator->link;
        $crawler = new Crawler($link);
        $this->assertEquals($this->decorator->url, $crawler->selectLink('Post title 1')->attr('href'));
    }

    public function test_getExcerpt(){
        $this->assertEquals('Post excerpt 1', $this->decorator->getExcerpt());
    }
}