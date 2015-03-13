<?php


namespace Maxcal\WordpressDecorators\Collection;

use Maxcal\WordpressDecorators\Decorator\PostDecorator;

interface CollectionInterface extends \ArrayAccess {
    public static function fromQuery(\WP_Query $query);

    /**
     * @return null|Maxcal\WordpressDecorators\Decorator\PostDecorator
     */
    public function first();

    /**
     * @return null|Maxcal\WordpressDecorators\Decorator\PostDecorator
     */
    public function last();
} 