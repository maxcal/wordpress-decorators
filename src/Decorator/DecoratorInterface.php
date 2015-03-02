<?php

namespace Maxcal\WordpressDecorators\Decorator;

interface DecoratorInterface {

    public function __construct($decorated_object);

    /**
     * @return mixed
     */
    public function getDecoratedObject();
}