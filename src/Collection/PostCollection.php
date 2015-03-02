<?php

namespace Maxcal\WordpressDecorators\Collection;
use Maxcal\WordpressDecorators\Decorator\PostDecorator;

class PostCollection extends Collection implements CollectionInterface {

    public function __construct(array $posts){
        parent::__construct(array_map(function($p){ return new PostDecorator($p); }, $posts));
    }

    public static function fromQuery(\WP_Query $query){
        return new self($query->get_posts());
    }
}