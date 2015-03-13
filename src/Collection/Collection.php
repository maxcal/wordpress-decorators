<?php


namespace Maxcal\WordpressDecorators\Collection;

use ArrayObject;

abstract class Collection extends \ArrayObject implements CollectionInterface {
    /**
     * @return Maxcal\WordpressDecorators\Decorator\PostDecorator|null|void
     */
    public function first(){
        return $this[0];
    }
    /**
     * @return Maxcal\WordpressDecorators\Decorator\PostDecorator|null|void
     */
    public function last(){
        if ($this->count() > 0) return $this[ $this->count() - 1 ];
    }
}