<?php

namespace Maxcal\WordpressDecorators\Decorator;

use Maxcal\TagHelper\TagHelper;

class PostDecorator extends Decorator implements DecoratorInterface {
    /**
     * Assigned by Decorator on initialization.
     * @var \WP_Post $object
     */
    /**
     * @return int
     */
    public function getId(){
        return $this->object->ID;
    }
    /**
     * @return string
     * @api
     */
    public function getTitle(){
        return get_the_title($this->getId());
    }
    /**
     * @return string|void
     * @api
     */
    public function getContent(){
        return apply_filters('the_content', $this->object->post_content);
    }
    /**
     * @return bool|string
     * @api
     */
    public function getUrl(){
        return get_permalink($this->getId());
    }
    /**
     * Gets an anchor tag with the post permalink as a href.
     * @param null|array $attr
     * @return string
     * @api
     */
    public function getLink($attr = null){
        $tag = new TagHelper();
        return $tag->link($this->getTitle(), $this->getUrl(), $attr);
    }
    /**
     * Gets the "post class" - a bunch of CSS classes which describe the post
     * @note this does not return the PHP class of the decorator!
     * @param string|array $extras (optional) additional classes to apply
     * @return array
     */
    public function getClass($extras = ''){
        return implode(' ', get_post_class($extras, $this->getId()));
    }
    /**
     * Gets a shortened version of post
     * @return string|void
     */
    public function getExcerpt(){
        return apply_filters( 'get_the_excerpt', $this->object->post_excerpt );
    }
    /**
     * @return string
     */
    protected function getDecoratedObjectName(){
        return 'post';
    }
}