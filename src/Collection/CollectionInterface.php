<?php


namespace Maxcal\WordpressDecorators\Collection;

interface CollectionInterface extends \ArrayAccess {
    public static function fromQuery(\WP_Query $query);
} 