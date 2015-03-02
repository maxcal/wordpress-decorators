<?php

namespace Maxcal\WordpressDecorators;

interface DecoratorInterface {

    public function __construct($decorated_object);

    /**
     * @return mixed
     */
    public function getDecoratedObject();
}