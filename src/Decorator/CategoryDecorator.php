<?php


namespace Maxcal\WordpressDecorators\Decorator;

use Maxcal\TagHelper\TagHelper;

class CategoryDecorator extends Decorator implements DecoratorInterface {

    /**
     * @var \StdClass $object
     */
    public function getId(){
        return $this->object->term_id;
    }

    /**
     * @return string
     */
    public function getUrl(){
        return get_category_link($this->getId());
    }

    /**
     * @param null|array $html_attributes
     * @return string
     */
    public function getLink($html_attributes = null){
        $tag = new TagHelper();
        return $tag->link($this->object->name, $this->getUrl(), $html_attributes);
    }

    /**
     * The table name of the decorated object
     * @return string
     */
    protected function getDecoratedObjectName()
    {
        return 'term';
    }
}