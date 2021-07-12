<?php


namespace Model;


use Exception;
use Traversable;

class ChildrenOfIluvatarCollection implements \IteratorAggregate
{
    private array $childrenOfiluvatar;

    public function __construct()
    {
        $this->childrenOfiluvatar = [];
    }

    public function add(ChildOfIluvatar $child)
    {
        $this->childrenOfiluvatar[] = $child;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->childrenOfiluvatar);
    }
}