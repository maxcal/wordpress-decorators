<?php

namespace Maxcal\WordpressDecorators\Decorator;

abstract class Decorator {

    protected $object;

    /**
     * @param mixed $decorated_object
     */
    public function __construct($decorated_object){
        $this->object = $decorated_object;
    }

    /**
     * @return mixed
     */
    public function getDecoratedObject(){
        return $this->object;
    }

    /**
     * Magic getter that looks for the presence of a getter method and in in-leu of that tries to get a
     * public property from the decorated object.
     * @param string $property
     * @return mixed
     * @throws \InvalidArgumentException if property is private or cannot be found.
     */
    public function __get($property) {
        $getter = 'get'.ucfirst($property);
        $prefixed = $this->getDecoratedObjectName() . '_' . $property;


        if (method_exists($this, $getter)){
            return $this->$getter();
        }
        elseif (property_exists($this->getDecoratedObject(), $property)){
            $rc = new \ReflectionClass($this->getDecoratedObject());
            if ($rc->getProperty($property)->isPublic()) return $this->object->$property;

        }
        elseif (property_exists($this->getDecoratedObject(), $prefixed)) {
            $rc = new \ReflectionClass($this->getDecoratedObject());
            if ($rc->getProperty($prefixed)->isPublic()) return $this->object->$prefixed;
        }
        else {
            throw new \InvalidArgumentException("Trying to get nonexistant or private property $property");
        }
    }

    /**
     * The table name of the decorated object
     * @return string
     */
    protected abstract function getDecoratedObjectName();
}