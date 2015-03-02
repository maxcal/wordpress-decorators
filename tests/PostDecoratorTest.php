<?php


namespace Maxcal\WordpressDecorators\Tests;

use Maxcal\WordpressDecorators\PostDecorator;

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

    public function test_get_title(){
        $this->assertEquals($this->post->post_title, $this->decorator->title);
    }

}