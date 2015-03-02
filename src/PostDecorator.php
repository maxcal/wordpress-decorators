<?php

namespace Maxcal\WordpressDecorators;

class PostDecorator extends Decorator implements DecoratorInterface {

    public function getId(){
        return $this->object->ID;
    }

    public function getTitle(){
        return get_the_title($this->getId());
    }


    protected function getDecoratedObjectName(){
        return 'post';
    }

}