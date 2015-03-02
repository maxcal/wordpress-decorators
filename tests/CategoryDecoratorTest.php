<?php

namespace Maxcal\WordpressDecorators\Tests;

use Maxcal\WordpressDecorators\Decorator\CategoryDecorator;
use Symfony\Component\DomCrawler\Crawler;

class CategoryDecoratorTest extends \WP_UnitTestCase {

    protected $category;
    protected $decorator;

    public function setUp(){
        parent::setUp();
        $this->category = $this->factory->category->create_and_get();
        $this->decorator = new CategoryDecorator($this->category);
    }

    public function test_getId(){
        $this->assertEquals($this->category->term_id, $this->decorator->id);
    }

    public function test_getUrl(){
        $this->assertEquals('http://example.org/?cat='.$this->decorator->getId(), $this->decorator->getUrl());
    }

    public function test_getLink(){
        $link = $this->decorator->getLink();
        $crawler = new Crawler($link);
        $this->assertEquals($this->decorator->getUrl(), $crawler->selectLink("Term 1")->attr('href'));
    }
}